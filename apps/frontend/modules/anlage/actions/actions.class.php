<?php

/**
 * anlage actions.
 *
 * @package    openZIM
 * @subpackage anlage
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class anlageActions extends ozActions {
	private function getAnlagenQuery($query = '*', $zim_id = null) {
		$anlage = Doctrine::getTable('Anlage');
		if ($this->getUser()->hasCredential('admin')) {
			$q = $anlage->getAllQuery($query, null, $zim_id);
		} else {
			$q = $anlage->getAllQuery($query, $this->getUser(), $zim_id);
		}
		return $q;
	}

	private function getZimFilterForm($zim_id = null) {
		$options['zim'] = $zim_id;
		if ( !$this->getUser()->hasCredential('admin')) {
			$options['zims'] = $this->getUser()->getZims();
		}
		return new FilterZimForm(null, $options);
	}

	public function executeIndex(sfWebRequest $request) {
		$this->getUser()->setAttribute('query', null);
		$this->form = $this->getZimFilterForm();
		$this->initPager($request, $this->getAnlagenQuery());
	}

	public function validateUser($anlage) {
		return $this->getUser()->hasCredential('admin')
				|| $anlage->ownedByUser($this->getUser());
	}

	public function executeShow(sfWebRequest $request) {
		$this->anlage = $this->getRoute()->getObject();
		$this->forward404Unless($this->validateUser($this->anlage));
	}

	private function getAnlageCreateForm() {
		if ($this->getUser()->hasCredential('admin')) {
			return new AnlageCreateForm();
		}
		$this->forward404Unless($this->getUser()->hasZim());
		return new AnlageCreateForm(null,
				array('zims' => $this->getUser()->getZims()));
	}

	public function executeNew(sfWebRequest $request) {
		$this->form = $this->getAnlageCreateForm();
	}

	public function executeCreate(sfWebRequest $request) {
		$this->forward404Unless($request->isMethod(sfRequest::POST));

		$this->form = $this->getAnlageCreateForm();

		if ( ($anlage = $this->processForm($request, $this->form)) )
			$this->redirect($this->generateUrl('anlage_edit', $anlage));

		$this->setTemplate('new');
	}

	public function executeEdit(sfWebRequest $request) {
		$anlage = $this->getRoute()->getObject();
		$this->forward404Unless($this->validateUser($anlage));
		$this->form = new AnlageEditForm($anlage);
	}

	public function executeUpdate(sfWebRequest $request) {
		$anlage = $this->getRoute()->getObject();
		$this->forward404Unless($this->validateUser($anlage));
		$this->form = new AnlageEditForm($anlage);
		$oldCnt = $anlage->getBilderCount();

		if ( $anlage = $this->processForm($request, $this->form) ){
			if ( $request->isXmlHttpRequest() ){
				// get previous form valid state
				$isValid = $this->resetValid();
				AnlageTable::getInstance()->getConnection()->clear();
				$this->form = new AnlageEditForm(AnlageTable::getInstance()->find($anlage->getId()));
				if ( $oldCnt == $anlage->getBilderCount() && $isValid )
					return $this->renderText(json_encode(array('anlage_name' => $anlage->__toString())));
			}else
				$this->redirect($this->generateUrl('anlage_edit', $anlage));
		}
		$this->setTemplate('edit');
	}

	public function executeDelete(sfWebRequest $request) {
		$request->checkCSRFProtection();

		$anlage = $this->getRoute()->getObject();
		$this->forward404Unless($this->validateUser($anlage));
		$anlage->delete();

		$this->redirect('anlage/index');
	}

	public function executeExport(sfWebRequest $request) {
		$anlage = $this->getRoute()->getObject();
		$this->forward404Unless($this->validateUser($anlage));

		$odf = $anlage->generateOdf();
		$odf->exportAsAttachedFile ($anlage->getFilename().'.odt');
		throw new sfStopException();
	}

	public function executeExportPreview(sfWebRequest $request) {
		$anlage = $this->getRoute()->getObject();
		$this->forward404Unless($this->validateUser($anlage));
	
		$odf = $anlage->generateOdf();
		$odf->exportAsHtml("anlage_preview.css");
		throw new sfStopException();
	}

	public function executeRemoveStunde(sfWebRequest $request) {
		$anlage = $this->getRoute()->getObject();
		$this->forward404Unless($this->validateUser($anlage));
		$zim = $anlage->getStunde()->getZim();
		$anlage->setStunde(null);
		$anlage->save();

		$this->redirect($this->generateUrl('zim_edit', $zim));
	}

	public function executeRemoveSection(sfWebRequest $request) {
		$section = $this->getRoute()->getObject();
		$this->forward404Unless($this->validateUser($section->getAnlage()));
		$section->delete();

		$this->redirect($this->generateUrl('anlage_edit', $section->getAnlage()));
	}

	public function executeAddSection(sfWebRequest $request) {
		$anlage = $this->getRoute()->getObject();
		$this->forward404Unless($this->validateUser($anlage));
		$section = new Section();
		$section->setAnlage($anlage);;
		$section->save();
	
		$this->redirect($this->generateUrl('anlage_edit', $anlage));
	}

	private function initPager(sfWebRequest $request, $query) {
		$this->pager = new sfDoctrinePager('Anlage',
				sfConfig::get('app_max_anlagen'));
		$this->pager->setQuery($query);
		$this->pager->setPage($request->getParameter('page', 1));
		$this->pager->init();
	}

	public function executeSearch(sfWebRequest $request) {
		// save query string in user session for paginator
		$query = $request->getParameter('query');
		$zim_id = $request->getParameter('zim');
		$user = $this->getUser();
		if ($query != null)
			$user['query'] = $query;
		else if (!$query = $user['query'])
			$query = '*';
		$q = $this->getAnlagenQuery($query, $zim_id);

		$this->form = $this->getZimFilterForm($zim_id);
		$this->setTemplate('index');
		$this->initPager($request, $q);
	}
}
