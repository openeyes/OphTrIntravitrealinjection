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
			}
		}
		
		return $elements;
	}
	
	/*
	 * similar to setPOSTManyToMany, but will actually call methods on the elements that will create database entries
	* should be called on create and update.
	*
	*/
	protected function storePOSTManyToMany($elements) {
		foreach ($elements as $el) {
			if (get_class($el) == 'Element_OphTrIntravitrealinjection_Complications') {
				$el->updateDecisionTreeResponses(SplitEventTypeElement::LEFT,
						isset($_POST['Element_OphTrIntravitrealinjection_Complications']['left_complications']) ?
						$_POST['Element_OphTrIntravitrealinjection_Complications']['left_complications'] :
						array());
				$el->updateDecisionTreeResponses(SplitEventTypeElement::RIGHT,
						isset($_POST['Element_OphTrIntravitrealinjection_Complications']['right_complications']) ?
						$_POST['Element_OphTrIntravitrealinjection_Complications']['right_complications'] :
						array());
	
			}
		}
	}
}
