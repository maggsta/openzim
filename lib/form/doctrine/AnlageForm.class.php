<?php

/**
 * Anlage form.
 *
 * @package    openZIM
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class AnlageForm extends BaseAnlageForm
{
  public function configure()
  {
    unset(
      $this['rolle_tm'], $this['zim_id'],
      $this['lnr']     
    );

    $form = new BildCollectionForm(null, array(
       'anlage' => $this->getObject(),
       'size'    => 1,
       'label' => 'Bilder hinzufügen',
     ));
 
    $this->embedRelation('Bilder');
    $this->embedForm('neueBilder', $form);
  }

  public function saveEmbeddedForms($con = null, $forms = null)
  {
     if (null === $forms)
     {
        $bilder = $this->getValue('neueBilder');
        $forms = $this->embeddedForms;
        foreach ($this->embeddedForms['neueBilder'] as $name => $form)
        {
          if (!isset($bilder[$name]))
          {
            unset($forms['neueBilder'][$name]);
          }
        }
     }
     return parent::saveEmbeddedForms($con, $forms);
   }
}
