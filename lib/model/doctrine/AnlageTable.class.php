<?php


class AnlageTable extends Doctrine_Table
{
    
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Anlage');
    }

    public static function getAnlagenSorted( $stunde_id )
    {
	return self::getInstance()->createQuery()
		->from('Anlage a,a.Stunde s')
		->where('s.id = ?',$stunde_id)
		->orderBy('a.lnr')->execute();
    }

    public static function getAllFreeQuery()
    {
        return AnlageTable::getInstance()->createQuery('a')
           ->where('a.stunde_id IS NULL');
    }
    
    public static function getAllFreeCount()
    {
	return self::getAllFreeQuery()->count();
    }

    private function getAllFromUserQuery($user)
    {
	return $q = Doctrine_Query::create()
  		->from('Anlage a, a.Stunde s, s.Zim z, z.sfGuardUser u')
		->where('u.username = ?', $user->getUsername());
    }

    public function getAllQuery($query = '*',$user = null)
    {
      if ('*' == $query )
      {	
	if ( $user )
	   return $this->getAllFromUserQuery($user);
	return $this->createQuery('a');
      } 
      else 
        return $this->getForLuceneQuery($query,$user);
    }

    private function getForLuceneQuery($query, $user = null)
    {
  	$hits = self::getLuceneIndex()->find($query);
 
  	$pks = array();
  	foreach ($hits as $hit)
  	{
  	  	$pks[] = $hit->pk;
  	}
 
	$q = $this->createQuery('a');
  	if (empty($pks))
  	{
		return $q->andWhere('a.id = -1');
 	}	
	if ( $user )
	{
	  	$q = $this->getAllFromUserQuery($user);
	}
	
	$q->andwhereIn('a.id', $pks);
  	return $q;
    }

    static public function getLuceneIndex()
    {   
  	ProjectConfiguration::registerZend();
 
  	if (file_exists($index = self::getLuceneIndexFile()))
  	{
    		return Zend_Search_Lucene::open($index);
 	}
 
  	return Zend_Search_Lucene::create($index);
    }
 
    static public function getLuceneIndexFile()
    {
    	return sfConfig::get('sf_data_dir').'/anlage.'.sfConfig::get('sf_environment').'.index';
    }

}
