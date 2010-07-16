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
	$form = new StundeCollectionForm(null, array(
	       'zim' => $this->getObject(),
	       'size'    => 1,
	));
	$this->embedRelation('Stunden');
    	$this->embedForm('neueStunden', $form);

    	$choices = array();
	$choices[null] = 'gesperrt';
	foreach( sfGuardUserTable::getInstance()->findAll() as $user ){
		if( ! $user->hasCredential('admin'))
			$choices[$user->getId()] = $user->getUserName();
    	}
	$this->widgetSchema['user_id']  = new sfWidgetFormChoice(array(
                'choices' => $choices,
                'label' => 'Bearbeiter'));
        $this->validatorSchema['user_id'] = new sfValidatorChoice(array(
                'choices' => array_keys($choices),
                'required' => false));

	$this->widgetSchema['ptjahr'] = new sfWidgetFormChoice(array(
		'choices'=>range(sfConfig::get('app_start_date'),sfConfig::get('app_end_date')),
		'default'=>20, 
		'label'=>'Jahr'));
	$this->validatorSchema['ptjahr'] = new sfValidatorChoice(array(
		'choices' =>array_keys(range(sfConfig::get('app_start_date'),sfConfig::get('app_end_date'))),
		'required' => true));
	$this->widgetSchema['ptkuerzel']->setLabel('PT Kürzel');
 
  }

  public function saveEmbeddedForms($con = null, $forms = null)
  {
     if (null === $forms)
     {
        $stunden = $this->getValue('neueStunden');
        $forms = $this->embeddedForms;
        foreach ($this->embeddedForms['neueStunden'] as $name => $form)
        {
          if (!isset($stunden[$name]))
          {
            unset($forms['neueStunden'][$name]);
          }
        }
     }
     return parent::saveEmbeddedForms($con, $forms);
   }

}
