<?php

/**
 * Project form base class.
 *
 * @package    form
 * @version    SVN: $Id: sfDoctrineFormBaseTemplate.php 6174 2007-11-27 06:22:40Z fabien $
 */
abstract class BaseFormDoctrine extends sfFormDoctrine
{
    public function renderHiddenFields()
    {
        $output = parent::renderHiddenFields();
        foreach ($this->getFormFieldSchema() as $name => $field) if ($field->isHidden()) unset($this[$name]);
        return $output;
    }
}