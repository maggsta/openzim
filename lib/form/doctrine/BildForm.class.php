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

    $this->validatorSchema['path'] = new sfValidatorFile(array(
      'required'   => false,
      'path'       => sfConfig::get('sf_upload_dir').'/bilder',
      'mime_types' => 'web_images',
    ));

    $this->widgetSchema['path'] = new sfWidgetFormInputFileEditable(array(
        'file_src'    => '/'.basename(sfConfig::get('sf_upload_dir')).'/bilder/'.$this->getObject()->getPath(),
        'edit_mode'   => !$this->isNew(),
        'is_image'    => true,
        'with_delete' => !$this->isNew(),
    ));
  }
}
