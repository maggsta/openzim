<?php


class StundeTable extends Doctrine_Table
{
    
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Stunde');
    }
    
    public static function getZimStundenQuery(Zim $zim)
    {
	return self::getInstance()->createQuery('s')
		->where('s.zim_id = ?',$zim->getId());
    }

    public static function getLastZimStunde($zim_id)
    {
       	$maxLnr = self::getInstance()->createQuery('s')
		->select('MAX(s.lnr) as maxLnr')
		->where('s.zim_id='.$zim_id)
		->fetchOne();
       	$stunde = self::getInstance()->createQuery('s')
		->where("zim_id = $zim_id AND lnr = $maxLnr->maxLnr")
		->execute();
	return $stunde;
    }
}
