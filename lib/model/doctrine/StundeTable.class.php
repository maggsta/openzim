<?php


class StundeTable extends Doctrine_Table
{
    
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Stunde');
    }
 
    public static function getStundenSorted( $zim_id )
    {
	return self::getInstance()->createQuery()
		->from('Stunde s,s.Zim z')
		->where('z.id = ?',$zim_id)
		->orderBy('s.lnr')->execute();
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
