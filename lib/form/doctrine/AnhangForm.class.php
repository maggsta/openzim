<?php

/**
 * Anhang form.
 *
 * @package    openZIM
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class AnhangForm extends BaseAnhangForm
{
  public function configure()
  {
    unset($this['anlage_id'],$this['name']);
    $this->validatorSchema['path'] = new sfValidatorFile(array(
      'required'   => false,
      'path'       => sfConfig::get('sf_upload_dir').DIRECTORY_SEPARATOR.'anhaenge',
//      'mime_types' => 'web_images',
    ));

    $this->widgetSchema['path'] = new sfWidgetFormInputFileEditable(array(
        'file_src'    => '/'.basename(sfConfig::get('sf_upload_dir')).'/anhaenge/'.$this->getObject()->getPath(),
        'edit_mode'   => !$this->isNew(),
        'is_image'    => false,
        'with_delete' => !$this->isNew(),
	'template'    => '%input%<br/>%delete% %delete_label%',
	'label'       => $this->isNew() ? 'Anhang hinzufügen' : $this->getObject()->getName(),
    ));

    $this->validatorSchema['path_delete'] = new sfValidatorPass();

  }

  public function updateObject($values = null)
  {
    $file = $this['path']->getValue();
    $object = parent::updateObject($values);
    $newfile = $object->getPath();
    $path = sfConfig::get('sf_upload_dir').DIRECTORY_SEPARATOR.'anhaenge'.DIRECTORY_SEPARATOR.$file;
    if ($file &&  file_exists($path) && $newfile != $file )
    {
      unlink($path);
    }	
    return $object;
  }

}
