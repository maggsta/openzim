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
      $this['kuerzel'],
      $this['lnr'],$this['stunde_id']     
    );

    $form = new BildCollectionForm(null, array(
       'anlage' => $this->getObject(),
       'size'    => 1,
       'label' => 'Bilder hinzufügen',
     ));
 
    $this->embedRelation('Bilder');
    $this->embedForm('neueBilder', $form);

    $this->widgetSchema['inhalt'] = new isicsWidgetFormTinyMCE(array('tiny_options' => sfConfig::get('app_tiny_mce_my_settings')));
    $this->widgetSchema['ziel'] = new isicsWidgetFormTinyMCE(array('tiny_options' => sfConfig::get('app_tiny_mce_my_settings')));
    $this->widgetSchema['rolle_tm'] = new isicsWidgetFormTinyMCE(array('tiny_options' => sfConfig::get('app_tiny_mce_my_settings')));
    $this->widgetSchema['methode'] = new isicsWidgetFormTinyMCE(array('tiny_options' => sfConfig::get('app_tiny_mce_my_settings')));
    $this->widgetSchema['kurzinhalt'] = new isicsWidgetFormTinyMCE(array('tiny_options' => sfConfig::get('app_tiny_mce_my_settings')));
    $this->widgetSchema['tip'] = new isicsWidgetFormTinyMCE(array('tiny_options' => sfConfig::get('app_tiny_mce_my_settings')));
    $this->widgetSchema['material'] = new isicsWidgetFormTinyMCE(array('tiny_options' => sfConfig::get('app_tiny_mce_my_settings')));

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
