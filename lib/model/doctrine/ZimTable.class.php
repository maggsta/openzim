<?php


class ZimTable extends Doctrine_Table
{
    
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Zim');
    }
    
    public static function getZimFromUser(myUser $user)
    {
	return self::getInstance()->createQuery()
		->from('zim z,z.sfGuardUser u')
		->where('u.username = ?',$user->getUsername())
		->fetchOne();
    }
}
