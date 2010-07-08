<?php


class AnlageTable extends Doctrine_Table
{
    
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Anlage');
    }

    public static function getAllFreeQuery()
    {
        return AnlageTable::getInstance()->createQuery('a')
           ->where('a.stunde_id NOT IN (SELECT id FROM stunde)');
    }
    
    public static function getAllFreeCount()
    {
	return self::getAllFreeQuery()->count();
    }

    public function getAll($query = '*')
    {
      if ('*' == $query )
      {
          return $this->createQuery('a');      
      } 
      else 
        return $this->getForLuceneQuery($query);
    }

    public function getForLuceneQuery($query)
    {
  	$hits = self::getLuceneIndex()->find($query);
 
  	$pks = array();
  	foreach ($hits as $hit)
  	{
  	  	$pks[] = $hit->pk;
  	}
 
  	if (empty($pks))
  	{
		$q = $this->createQuery('a')
		->where('a.id = -1');
 	}
	else
	{
	  	$q = $this->createQuery('a')
    		->whereIn('a.id', $pks);
	}
 
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
