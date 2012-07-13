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

	$date_choices = array();
	foreach( range(sfConfig::get('app_start_date'),sfConfig::get('app_end_date')) as $tmpdate ){
		$date_choices[$tmpdate] = $tmpdate;
	}
	$this->widgetSchema['ptjahr'] = new sfWidgetFormChoice(array(
		'choices'=>$date_choices,
		'default'=>date('Y'), 
		'label'=>'Jahr'));
	$this->validatorSchema['ptjahr'] = new sfValidatorChoice(array(
		'choices' =>array_keys($date_choices),
		'required' => true));
	$this->widgetSchema->setLabels(array(
		'ptkuerzel'  => 'PT Kürzel',
		'roterFaden' => 'Roter Faden',
		'zielGruppe' => 'Zielgruppe'));
 
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
