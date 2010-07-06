<?php


class BildTable extends Doctrine_Table
{
    
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Bild');
    }

    public static function updateLnrDeleted($lnr = 0)
    {
	$q = self::getInstance()->createQuery('b')
		->where('b.lnr >'.$lnr)
		->orderBy('b.lnr');

	foreach( $q->execute() as $bild )
	{
		$bild->setLnr($bild->getLnr()-1);
		$bild->save();
	}
    }
}
