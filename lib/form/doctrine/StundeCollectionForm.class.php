<?php

/**
 * StundeCollection form.
 *
 * @package    openZIM
 * @subpackage form
 * @author     Christoph Herbst
 */
class StundeCollectionForm extends sfForm
{
  public function configure()
  {
    if (!$zim = $this->getOption('zim'))
    {
      throw new InvalidArgumentException('You must provide a zim object.');
    }
 
    for ($i = 0; $i < $this->getOption('size', 2); $i++)
    {
      $stunde = new Stunde();
      $stunde->Zim = $zim;
 
      $form = new StundeForm($stunde);
 
      $this->embedForm($i, $form);
    }

    $this->mergePostValidator(new StundeValidatorSchema());
  }
}
