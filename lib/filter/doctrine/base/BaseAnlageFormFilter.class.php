<?php

/**
 * Anlage filter form base class.
 *
 * @package    openZIM
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseAnlageFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'name'       => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'zeit'       => new sfWidgetFormFilterInput(),
      'ziel'       => new sfWidgetFormFilterInput(),
      'methode'    => new sfWidgetFormFilterInput(),
      'material'   => new sfWidgetFormFilterInput(),
      'tip'        => new sfWidgetFormFilterInput(),
      'kurzinhalt' => new sfWidgetFormFilterInput(),
      'inhalt'     => new sfWidgetFormFilterInput(),
      'rolle_tm'   => new sfWidgetFormFilterInput(),
      'zim_id'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Zim'), 'add_empty' => true)),
      'lnr'        => new sfWidgetFormFilterInput(),
      'created_at' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'name'       => new sfValidatorPass(array('required' => false)),
      'zeit'       => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'ziel'       => new sfValidatorPass(array('required' => false)),
      'methode'    => new sfValidatorPass(array('required' => false)),
      'material'   => new sfValidatorPass(array('required' => false)),
      'tip'        => new sfValidatorPass(array('required' => false)),
      'kurzinhalt' => new sfValidatorPass(array('required' => false)),
      'inhalt'     => new sfValidatorPass(array('required' => false)),
      'rolle_tm'   => new sfValidatorPass(array('required' => false)),
      'zim_id'     => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Zim'), 'column' => 'id')),
      'lnr'        => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'created_at' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('anlage_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Anlage';
  }

  public function getFields()
  {
    return array(
      'id'         => 'Number',
      'name'       => 'Text',
      'zeit'       => 'Number',
      'ziel'       => 'Text',
      'methode'    => 'Text',
      'material'   => 'Text',
      'tip'        => 'Text',
      'kurzinhalt' => 'Text',
      'inhalt'     => 'Text',
      'rolle_tm'   => 'Text',
      'zim_id'     => 'ForeignKey',
      'lnr'        => 'Number',
      'created_at' => 'Date',
      'updated_at' => 'Date',
    );
  }
}
