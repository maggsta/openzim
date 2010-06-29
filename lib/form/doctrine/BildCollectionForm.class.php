<?php

/**
 * Anlage form.
 *
 * @package    openZIM
 * @subpackage form
 * @author     Christoph Herbst
 */
class BildCollectionForm extends sfForm
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
      $bild = new Bild();
      $bild->Anlage = $anlage;
 
      $form = new BildForm($bild);
 
      $this->embedForm($i, $form);
    }

    $this->mergePostValidator(new BildValidatorSchema());
  }
}
