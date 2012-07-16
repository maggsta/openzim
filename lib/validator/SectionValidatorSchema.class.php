<?php

/**
 * Section validator schema.
 * 
 * @package    openZIM
 * @subpackage validator
 * @author     Christoph Herbst
 */
class SectionValidatorSchema extends sfValidatorSchema
{
  protected function configure($options = array(), $messages = array())
  {
    $this->addMessage('inhalt', 'Inhalt is required.');
  }
 
  protected function doClean($values)
  {
    $errorSchema = new sfValidatorErrorSchema($this);
 
    foreach($values as $key => $value)
    {
      $errorSchemaLocal = new sfValidatorErrorSchema($this);
 
      // tip is filled but no inhalt
      if ($value['tip'] && !$value['inhalt'])
      {
        $errorSchemaLocal->addError(new sfValidatorError($this, 'required'),
'path');
      }
 
      // no inhalt and no tip, remove the empty values
      if (!$value['inhalt'] && !$value['tip'])
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
