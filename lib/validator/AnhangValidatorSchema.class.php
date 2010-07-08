<?php

/**
 * Anhang validator schema.
 * 
 * @package    openZIM
 * @subpackage validator
 * @author     Christoph Herbst
 */
class AnhangValidatorSchema extends sfValidatorSchema
{

  public function __construct($key) {
     $this->key = $key;
  }

  protected function configure($options = array(), $messages = array())
  {
  }
 
  protected function doClean($values)
  {
    if(!$values[$this->key]['path'])
        unset($values[$this->key]['path']);
    return $values;
  }
}
