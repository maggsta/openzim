<?php

/**
 * Anlage form.
 *
 * @package    openZIM
 * @subpackage form
 * @author     Christoph Herbst
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class AnlageForm extends BaseAnlageForm
{
  public function configure()
  {
    $this->widgetSchema->setLabel('kuerzel', 'Kürzel');
    $this->widgetSchema->setLabel('lnr', 'Nr.');
  }
}
