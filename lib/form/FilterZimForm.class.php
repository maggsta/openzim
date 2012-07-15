<?php

/**
 * FilterZimForm form.
 * 
 * @package    openZIM
 * @subpackage form
 * @author     Christoph Herbst
 */
class FilterZimForm extends BaseForm
{
	public function configure()
	{
		if (!$zims = $this->getOption('zims'))
		{
			$zims = ZimTable::getInstance()->findAll();
		}

		$choices = array();
		foreach( $zims as $zim ){
			if ( $zim->hasAnlagen() )
				$choices[$zim->getId()] = $zim;
		}

		if ( count($choices) <= 1 )
			return;

		$choices[null] = 'Alle';
		$this->setWidgets(array(
				'zim'    => new sfWidgetFormChoice(
						array('choices' => $choices)),
		));
		$this->setDefault('zim', $this->getOption('zim'));
	}
}
