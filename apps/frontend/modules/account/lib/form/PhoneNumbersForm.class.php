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
            if (isset($this->object->Phones[$i])) {
                $Form->setDefaults($this->object->Phones[$i]->toArray(false));
            }
        }
    }
    
    public function configure()
    {
        $this->validatorSchema['Phones'] = new sfValidatorSchemaForEach(new sfValidatorPhoneNumber(), max($this->object->Phones->count(), 2));
    }
    
    public function getModelName() 
    {
        return 'Profile';
    }
    
    public function doSave($con = null)
    {
        if (is_null($con)) {
          $con = $this->getConnection();
        }
        
        $this->object->Phones->delete();
        
        foreach ($this->values['Phones'] as $i => $number) {
            $Phone = new PhoneNumber();
            $Phone->number = $number;
            $this->object->Phones[] = $Phone;
        }
        
        $this->object->save($con);
    }

}