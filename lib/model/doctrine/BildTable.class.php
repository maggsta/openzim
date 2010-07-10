<?php


class BildTable extends Doctrine_Table
{
    
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Bild');
    }

    public static function getBilderSorted( $anlage_id )
    {
	return self::getInstance()->createQuery()
		->from('Bild b')
		->where('b.anlage_id = ?',$anlage_id)
		->orderBy('b.lnr')->execute();
    }

    public static function updateLnrDeleted($lnr = 0,$anlage_id)
    {
	$q = self::getInstance()->createQuery('b')
		->where('b.anlage_id = ?',$anlage_id)
		->andWhere('b.lnr > ?',$lnr)
		->orderBy('b.lnr');

	foreach( $q->execute() as $bild )
	{
		$bild->setLnr($bild->getLnr()-1);
		$bild->save();
	}
    }
}
