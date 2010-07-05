<?php

/**
 * Stunde form.
 *
 * @package    openZIM
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class StundeForm extends BaseStundeForm
{
  public function configure()
  {
    unset(
      $this['zim_id']
    );
    $this->validatorSchema['lnr'] = new sfValidatorPass();
    $this->validatorSchema['name'] = new sfValidatorString(array(
	'max_length' => 255, 'required' => !$this->isNew() ));

    $this->embedRelation('Anlagen','AnlageCreateForm');
  }
}
