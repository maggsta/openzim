<?php

/**
 * Stunde validator schema.
 * 
 * @package    openZIM
 * @subpackage validator
 * @author     Christoph Herbst
 */
class StundeValidatorSchema extends sfValidatorSchema
{
  protected function configure($options = array(), $messages = array())
  {
  }
 
  protected function doClean($values)
  {
    $errorSchema = new sfValidatorErrorSchema($this);
 
    foreach($values as $key => $value)
    {
      $errorSchemaLocal = new sfValidatorErrorSchema($this);
 
      // no caption and no path, remove the empty values
      if (!$value['name'] )
      {
        unset($values[$key]);
      }
 
      // some error for this embedded-form
      if (count($errorSchemaLocal))
      {
        $errorSchema->addError($errorSchemaLocal, (string) $key);
      }
    }
 
    // throws the error for the main form
    if (count($errorSchema))
    {
      throw new sfValidatorErrorSchema($this, $errorSchema);
    }
 
    return $values;
  }
}
