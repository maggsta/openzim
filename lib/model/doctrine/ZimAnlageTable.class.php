<?php


class ZimAnlageTable extends Doctrine_Table
{
    
    public static function getInstance()
    {
        return Doctrine_Core::getTable('ZimAnlage');
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
    		return array();
 	 }
 
  	$q = $this->createQuery('j')
    		->whereIn('j.id', $pks)
    		->limit(20);
 
  	return $q->execute();
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
  		return sfConfig::get('sf_data_dir').'/zimAnlage.'.sfConfig::get('sf_environment').'.index';
	}
}
