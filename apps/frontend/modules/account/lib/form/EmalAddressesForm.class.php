<?php

/**
 *
 * @package    merhab
 * @author     Olmo Maldonado <ibolmo@ucla.edu>
 */
class EmailAddressesForm extends sfFormDoctrine
{
    private $nbrEmails = 0;
    
    public function __construct($Profile = null, $options = array(), $CSRFSecret = null)
    {
        parent::__construct($Profile, $options, $CSRFSecret);
        
        $this->EmailAddressForms = array();
        for ($i = 0, $l = max($this->object->Emails->count(), 2); $i < $l; $i++){
            $this->EmailAddressForms[] = $Form = new EmailAddressForm();
            
            $Form->widgetSchema->setNameFormat("Emails[$i][%s]");
            $Form->widgetSchema['address']->setLabel(($i == 0) ? 'Primary' : (($i == 1) ? 'Additional' : ''));
            
            if (isset($this->object->Emails[$i])) $Form->setDefaults($this->object->Emails[$i]->toArray(false));
        }
    }
    
    public function getModelName() 
    {
        return 'Profile';
    }
    
    public function bind(array $taintedValues = null, array $taintedFiles = null)
    {
        foreach ($taintedValues['Emails'] as $i => $Form) {
            if (!isset($Form['address']) || !$Form['address']) unset($taintedValues['Emails'][$i]);
        }
        $this->validatorSchema['Emails'] = new sfValidatorSchemaForEach(new sfValidatorEmailAddress(), max(count($taintedValues['Emails']), $this->object->Emails->count(), 2));
        return parent::bind($taintedValues, $taintedFiles);
    }
    
    public function doSave($con = null)
    {
        if (is_null($con)) $con = $this->getConnection();
        
        $this->object->Emails->delete();
        
        foreach ($this->values['Emails'] as $Email) {
            if (!$Email['address'])  continue;
            $EmailAddress = new EmailAddress();
            $EmailAddress->fromArray($Email);
            $this->object->Emails[] = $EmailAddress;
        }
        
        $this->object->save($con);
    }

}