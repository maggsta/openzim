<?php

/**
 * Anlage Edit form.
 *
 * @package    openZIM
 * @subpackage form
 * @author     Christoph Herbst
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class AnlageEditForm extends AnlageForm
{
  public function configure()
  {
    parent::configure();
    unset(
      $this['kuerzel'],
      $this['lnr'],$this['stunde_id']     
    );
    $this->widgetSchema->setLabel('longname', 'Name');

    $form = new SectionCollectionForm(null, array(
    		'anlage' => $this->getObject(),
    		'size'    => 1,
    		'label' => 'Abschnitt hinzufügen',
    ));
    $this->embedRelation('Sections');
    $this->embedForm('neueSections', $form);
    
    $anhang = new Anhang();
    $anhang->Anlage = $this->getObject();
    $form = new AnhangForm($anhang);
    $this->embedRelation('Anhaenge');
    $this->embedForm('neuerAnhang', $form);
    
    $this->mergePostValidator(new AnhangValidatorSchema('neuerAnhang'));
  }

  public function saveEmbeddedForms($con = null, $forms = null)
  {
     if (null === $forms)
     {
        $sections = $this->getValue('neueSections');
        foreach ($this->embeddedForms['neueSections'] as $name => $form)
        {
        	if (!isset($sections[$name]))
        	{
        		unset($forms['neueSections'][$name]);
        	}
        }
	$anhang = $this->getValue('neuerAnhang');
        if ( !isset($anhang['path'] ) )
	    unset($forms['neuerAnhang']);  
     }
     return parent::saveEmbeddedForms($con, $forms);
   }
}
