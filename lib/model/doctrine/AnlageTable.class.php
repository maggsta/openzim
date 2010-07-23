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

    private function getAllQueryPrivate(){
	return $this->createQuery()
  		->from('Anlage a, a.Stunde s')
		->orderBy('s.zim_id,a.lnr');
    }

    private function getAllFromUserQuery($user)
    {
	return $this->getAllQueryPrivate()
		->leftJoin('s.Zim z, z.sfGuardUser u')
		->where('u.username = ?', $user->getUsername());
    }

    private static function cleanQuery($query)
    {
	// trim the query, search for substring except if query is quoted
	$query = trim($query);
	if ( strlen($query) <= 2 )
		$query = '*';
	elseif ( $query[0] != '"' &&
		 $query[strlen($query)-1] != '"' ){
		if ( $query[strlen($query)-1] != '*' )
			$query = $query.'*';
	}
	return $query;
    }

    public function getAllQuery($query = '*',$user = null)
    {
      $query = self::cleanQuery($query);
      if ('*' == $query )
      {	
	if ( $user )
	   return $this->getAllFromUserQuery($user);
	return $this->getAllQueryPrivate();
      } 
      return $this->getForLuceneQuery($query,$user);
    }

    private function getForLuceneQuery($query, $user = null)
    {
	$index = self::getLuceneIndex();

	Zend_Search_Lucene_Analysis_Analyzer::setDefault(
	    new Zend_Search_Lucene_Analysis_Analyzer_Common_Utf8Num_CaseInsensitive());

  	$hits = $index->find($query);
 
  	$pks = array();
  	foreach ($hits as $hit)
  	{
  	  	$pks[] = $hit->pk;
  	}
 
	$q = $this->getAllQueryPrivate();
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
