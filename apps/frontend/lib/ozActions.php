<?php

class ozActions extends sfActions {

	protected function processForm(sfWebRequest $request, sfForm $form) {
		$form
		->bind($request->getParameter($form->getName()),
				$request->getFiles($form->getName()));
		if ($form->isValid())
			return $form->save();
		else{
			// save in user session
			$this->getUser()->setAttribute($this->form->getName(), false);
		}
		return false;
	}
	
	protected function resetValid(){
		$isValid = $this->getUser()->getAttribute($this->form->getName(), true);
		$this->getUser()->setAttribute($this->form->getName(), true);
		return $isValid;
	}
}
