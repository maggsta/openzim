<?php

/**
 * Bild form.
 *
 * @package    openZIM
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class BildForm extends BaseBildForm
{
  public function configure()
  { 
    unset(
      $this['anlage_id']    
    );

    $this->widgetSchema['path'] = new sfWidgetFormInputFile(array(
      'label' => 'Bild',
    ));

    $this->validatorSchema['path'] = new sfValidatorFile(array(
      'required'   => false,
      'path'       => sfConfig::get('sf_upload_dir').'/bilder',
      'mime_types' => 'web_images',
    ));
  }
}
