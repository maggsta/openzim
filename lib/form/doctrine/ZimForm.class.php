<?php

/**
 * Zim form.
 *
 * @package    openZIM
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class ZimForm extends BaseZimForm
{
  public function configure()
  {
	$this->embedRelation('Anlagen');
	$this->widgetSchema['Anlagen'] = 
		new sfWidgetFormDoctrineChoice(array(
			'model' => $this->getRelatedModelName('Anlagen'),
			'multiple' => true,
			'add_empty' => true,
        		'renderer_class' => 'sfWidgetFormSelectDoubleList'));

  }
}
