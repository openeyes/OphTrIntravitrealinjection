<?php

class DefaultController extends BaseEventTypeController {
	
	// TODO: check this is in line with Jamie's change circa 3rd April 2013
	protected function beforeAction($action)
	{
		if (!Yii::app()->getRequest()->getIsAjaxRequest() && !(in_array($action->id,$this->printActions())) ) {
			Yii::app()->getClientScript()->registerCssFile(Yii::app()->createUrl('css/spliteventtype.css'));
			Yii::app()->getClientScript()->registerScriptFile(Yii::app()->createUrl('js/spliteventtype.js'));
		}
	
		$res = parent::beforeAction($action);
	
		return $res;
	}
	
	public function actionCreate() {
		parent::actionCreate();
	}

	public function actionUpdate($id) {
		parent::actionUpdate($id);
	}

	public function actionView($id) {
		parent::actionView($id);
	}

	public function actionPrint($id) {
		parent::actionPrint($id);
	}
	
	/*
	 * override to set the defaults on the elements that are arrived at dynamically
	 */
	public function getDefaultElements($action, $event_type_id=false, $event=false) {
		$elements = parent::getDefaultElements($action, $event_type_id, $event);
	
		if ($action == 'create' && empty($_POST)) {
			// set any calculated defaults on the elements
			foreach ($elements as $element) {
				// get the side of the episode diagnosis and use that as the default for the elements
				if ($this->episode && $this->episode->eye_id) {	
					$element->eye_id = $this->episode->eye_id;
				}
				
				if (get_class($element) == 'Element_OphTrIntravitrealinjection_Treatment') {
					if ($api = Yii::app()->moduleAPI->get('OphCoTherapyapplication')) {
						// get the latest drug that has been applied for and set it as default (for the appropriate eye)
						if ($drug = $api->getLatestApplicationDrug($this->patient, $this->episode, 'left')) {
							$element->left_drug_id = $drug->id;
						}
						if ($drug = $api->getLatestApplicationDrug($this->patient, $this->episode, 'right')) {
							$element->right_drug_id = $drug->id;
						}
					}
				}
			}
			
		}
		
		return $elements;
	}
	
	protected function setPOSTManyToMany($element) {
		if (get_class($element) == 'Element_OphTrIntravitrealinjection_Complications') {
			if (isset($_POST['Element_OphTrIntravitrealinjection_Complications']['left_complications']) ) {
				$complications = array();
			
				foreach ($_POST['Element_OphTrIntravitrealinjection_Complications']['left_complications'] as $comp_id) {
					if ($comp = OphTrIntravitrealinjection_Complication::model()->findByPk($comp_id)) {
						$complications[] = $comp;
					}
				}
				$element->left_complications = $complications;
			}
			if (isset($_POST['Element_OphTrIntravitrealinjection_Complications']['right_complications']) ) {			
				$complications = array();
				foreach ($_POST['Element_OphTrIntravitrealinjection_Complications']['right_complications'] as $comp_id) {
					if ($comp = OphTrIntravitrealinjection_Complication::model()->findByPk($comp_id)) {
						$complications[] = $comp;
					}
				}
				$element->right_complications = $complications;
			}
		}
	}
	
	/*
	 * similar to setPOSTManyToMany, but will actually call methods on the elements that will create database entries
	* should be called on create and update.
	*
	*/
	protected function storePOSTManyToMany($elements) {
		foreach ($elements as $el) {
			if (get_class($el) == 'Element_OphTrIntravitrealinjection_Complications') {
				$el->updateComplications(SplitEventTypeElement::LEFT,
						isset($_POST['Element_OphTrIntravitrealinjection_Complications']['left_complications']) ?
						$_POST['Element_OphTrIntravitrealinjection_Complications']['left_complications'] :
						array());
				$el->updateComplications(SplitEventTypeElement::RIGHT,
						isset($_POST['Element_OphTrIntravitrealinjection_Complications']['right_complications']) ?
						$_POST['Element_OphTrIntravitrealinjection_Complications']['right_complications'] :
						array());
	
			}
		}
	}
	
	/*
	 * ensures Many Many fields processed for elements
	*/
	public function createElements($elements, $data, $firm, $patientId, $userId, $eventTypeId) {
		if ($id = parent::createElements($elements, $data, $firm, $patientId, $userId, $eventTypeId)) {
			// create has been successful, store many to many values
			$this->storePOSTManyToMany($elements);
		}
		return $id;
	}
	
	/*
	 * ensures Many Many fields processed for elements
	*/
	public function updateElements($elements, $data, $event) {
		if (parent::updateElements($elements, $data, $event)) {
			// update has been successful, now need to deal with many to many changes
			$this->storePOSTManyToMany($elements);
		}
		return true;
	}
	
}
