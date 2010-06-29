<?php

/**
 * Bild validator schema.
 * 
 * @package    openZIM
 * @subpackage validator
 * @author     Christoph Herbst
 */
class BildValidatorSchema extends sfValidatorSchema
{
  protected function configure($options = array(), $messages = array())
  {
    $this->addMessage('caption', 'The caption is required.');
    $this->addMessage('path', 'The filename is required.');
  }
 
  protected function doClean($values)
  {
    $errorSchema = new sfValidatorErrorSchema($this);
 
    foreach($values as $key => $value)
    {
      $errorSchemaLocal = new sfValidatorErrorSchema($this);
 
      // path is filled but no caption
      if ($value['path'] && !$value['caption'])
      {
        $errorSchemaLocal->addError(new sfValidatorError($this, 'required'),
'caption');
      }
 
      // caption is filled but no path
      if ($value['caption'] && !$value['path'])
      {
        $errorSchemaLocal->addError(new sfValidatorError($this, 'required'),
'path');
      }
 
      // no caption and no path, remove the empty values
      if (!$value['path'] && !$value['caption'])
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
