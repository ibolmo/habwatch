<?php

/**
 *
 * @package    merhab
 * @author     Olmo Maldonado <ibolmo@ucla.edu>
 */
class PhoneNumbersForm extends sfFormDoctrine
{
    private $nbrPhones = 0;
    
    public function __construct($Profile = null, $options = array(), $CSRFSecret = null)
    {
        parent::__construct($Profile, $options, $CSRFSecret);
        
        $this->PhoneNumberForms = array();
        for ($i = 0, $l = max($this->object->Phones->count(), 2); $i < $l; $i++){
            $this->PhoneNumberForms[] = $Form = new PhoneNumberForm();
            
            $Form->widgetSchema->setNameFormat("Phones[$i][%s]");
            $Form->widgetSchema['number']->setLabel(($i == 0) ? 'Primary' : (($i == 1) ? 'Additional' : ''));
            
            if (isset($this->object->Phones[$i])) $Form->setDefaults($this->object->Phones[$i]->toArray(false));
        }
    }
    
    public function getModelName() 
    {
        return 'Profile';
    }
    
    public function bind(array $taintedValues = null, array $taintedFiles = null)
    {
        foreach ($taintedValues['Phones'] as $i => $Form) {
            if (!isset($Form['number']) || !$Form['number']) unset($taintedValues['Phones'][$i]);
        }
        $this->validatorSchema['Phones'] = new sfValidatorSchemaForEach(new sfValidatorPhoneNumber(), max(count($taintedValues['Phones']), $this->object->Phones->count(), 2));
        return parent::bind($taintedValues, $taintedFiles);
    }
    
    public function doSave($con = null)
    {
        if (is_null($con)) $con = $this->getConnection();
        
        $this->object->Phones->delete();
        
        foreach ($this->values['Phones'] as $Phone) {
            if (!$Phone['number'])  continue;
            $PhoneNumber = new PhoneNumber();
            $PhoneNumber->fromArray($Phone);
            $this->object->Phones[] = $PhoneNumber;
        }
        
        $this->object->save($con);
    }

}