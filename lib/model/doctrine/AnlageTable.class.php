<?php

class AnlageTable extends Doctrine_Table {

	public static function getInstance() {
		return Doctrine_Core::getTable('Anlage');
	}

	public static function getAnlagenSorted($stunde_id) {
		return self::getInstance()->createQuery()->from('Anlage a,a.Stunde s')
				->where('s.id = ?', $stunde_id)->orderBy('a.lnr')->execute();
	}

	public static function getAllFreeQuery() {
		return AnlageTable::getInstance()->createQuery('a')
				->where('a.stunde_id IS NULL');
	}

	public static function getAllFreeCount() {
		return self::getAllFreeQuery()->count();
	}

	public static function getAllCount($zim_id) {
		return self::getInstance()->createQuery()->from('Anlage a, a.Stunde s')
				->where('s.zim_id = ?', $zim_id)->count();
	}

	private function getAllQueryPrivate($zim_id) {
		$query = $this->createQuery()->from('Anlage a, a.Stunde s')
				->orderBy('s.zim_id,a.lnr');
		if ( $zim_id == null )
			return $query;
		return $query->leftJoin('s.Zim z')->where('z.id = ?', $zim_id);
	}

	private function getAllFromUserQuery($user, $zim_id) {
		$query = $this->getAllQueryPrivate()
				->leftJoin('s.Zim z, z.sfGuardUser u')
				->where('u.username = ?', $user->getUsername());
		if ( $zim_id == null )
			return $query;
		return $query->where('z.id = ?', $zim_id);
	}

	private static function cleanQuery($query) {
		// trim the query, search for substring except if query is quoted
		$query = trim($query);
		if (strlen($query) <= 2)
			$query = '*';
		elseif ($query[0] != '"' && $query[strlen($query) - 1] != '"') {
			if ($query[strlen($query) - 1] != '*')
				$query = $query . '*';
		}
		return $query;
	}

	public function getAllQuery($query = '*', $user = null, $zim_id) {
		$query = self::cleanQuery($query);
		if ('*' == $query) {
			if ($user)
				return $this->getAllFromUserQuery($user, $zim_id);
			return $this->getAllQueryPrivate($zim_id);
		}
		return $this->getForLuceneQuery($query, $user, $zim_id);
	}

	private function getForLuceneQuery($query, $user = null, $zim_id) {
		$index = self::getLuceneIndex();

		Zend_Search_Lucene_Analysis_Analyzer::setDefault(
				new Zend_Search_Lucene_Analysis_Analyzer_Common_Utf8Num_CaseInsensitive());

		$hits = $index->find($query);

		$pks = array();
		foreach ($hits as $hit) {
			$pks[] = $hit->pk;
		}

		$q = $this->getAllQueryPrivate($zim_id);
		if (empty($pks)) {
			return $q->andWhere('a.id = -1');
		}
		if ($user) {
			$q = $this->getAllFromUserQuery($user, $zim_id);
		}

		$q->andwhereIn('a.id', $pks);
		return $q;
	}

	static public function getLuceneIndex() {
		ProjectConfiguration::registerZend();

		if (file_exists($index = self::getLuceneIndexFile())) {
			return Zend_Search_Lucene::open($index);
		}

		return Zend_Search_Lucene::create($index);
	}

	static public function getLuceneIndexFile() {
		return sfConfig::get('sf_data_dir') . '/anlage.'
				. sfConfig::get('sf_environment') . '.index';
	}

}
