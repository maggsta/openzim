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
      $this['anlage_id'],$this['lnr'],$this['name'] 
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
	'label'     => $this->isNew() ? 'Bild hinzufügen' : 
		$this->getObject()->getLnr().'. Bild',
    ));

    $this->validatorSchema['path_delete'] = new sfValidatorPass();
    $this->widgetSchema['caption'] = new isicsWidgetFormTinyMCE(array('tiny_options' => sfConfig::get('app_tiny_mce_my_settings')), array('cols' => '100', 'rows' => '4'));
  }

  public function updateObject($values = null)
  {
    $file = $this['path']->getValue();
    $object = parent::updateObject($values);
    $newfile = $object->getPath();
    $path = sfConfig::get('sf_upload_dir').'/bilder/'.$file;
    if ($file &&  file_exists($path) && $newfile != $file )
    {
      unlink($path);
    }	
    return $object;
  }
}
