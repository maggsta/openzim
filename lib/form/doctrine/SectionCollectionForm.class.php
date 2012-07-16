<?php

/**
 * Section collection form.
 *
 * @package    openZIM
 * @subpackage form
 * @author     Christoph Herbst
 */
class SectionCollectionForm extends sfForm
{
  public function configure()
  {
    if (!$anlage = $this->getOption('anlage'))
    {
      throw new InvalidArgumentException('You must provide a anlage
object.');
    }
 
    for ($i = 0; $i < $this->getOption('size', 2); $i++)
    {
      $section = new Section();
      $section->Anlage = $anlage;
 
      $form = new SectionForm($section);
 
      $this->embedForm($i, $form);
    }
    
    $this->mergePostValidator(new SectionValidatorSchema());
  }
}
