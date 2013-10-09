<?php

class DefaultController extends BaseEventTypeController
{
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

	public $side_to_inject = null;

	/**
	 * override to set the defaults on the elements that are arrived at dynamically
	 *
	 * @return Element[]
	 */
	public function getDefaultElements($action, $event_type_id=false, $event=false)
	{
		$elements = parent::getDefaultElements($action, $event_type_id, $event);

		if ($action == 'create' && empty($_POST)) {
			// set any calculated defaults on the elements
			$therapy_api = Yii::app()->moduleAPI->get('OphCoTherapyapplication');
			$injection_api = Yii::app()->moduleAPI->get('OphTrIntravitrealinjection');
			$exam_api = Yii::app()->moduleAPI->get('OphCiExamination');

			$default_eye = Eye::BOTH;
			$default_left_drug = null;
			$default_right_drug = null;

			$since = new DateTime();
			$since->setTime(0, 0, 0);

			if ($this->episode && $exam_api && $imc = $exam_api->getLatestInjectionManagementComplex($this->episode, $since) ) {
				if ($side = $imc->getInjectionSide()) {
					$default_eye = $side;
					$this->side_to_inject = $default_eye;
					$default_left_drug = $imc->left_treatment;
					$default_right_drug = $imc->right_treatment;
				}
				else {
					$this->side_to_inject = 0;
				}
			}
			// get the side of the latest therapy application
			elseif ($this->episode && $therapy_api && $side = $therapy_api->getLatestApplicationSide($this->patient, $this->episode)) {
				$default_eye = $side;
			}
			// get the side of the episode diagnosis and use that as the default for the elements
			elseif ($this->episode && $this->episode->eye_id) {
				$default_eye = $this->episode->eye_id;
			}

			// if we haven't got the default drug from the imc, try therapy application
			if ($therapy_api) {
				if ($default_eye != Eye::RIGHT && !$default_left_drug) {
					$default_left_drug = $therapy_api->getLatestApplicationDrug($this->patient, $this->episode, 'left');
				}
				if ($default_eye != Eye::LEFT && !$default_right_drug) {
					$default_right_drug = $therapy_api->getLatestApplicationDrug($this->patient, $this->episode, 'right');
				}
			}

			foreach ($elements as $element) {
				if ($element->hasAttribute('eye_id') ) {
					$element->eye_id = $default_eye;
				}

				if (get_class($element) == 'Element_OphTrIntravitrealinjection_Treatment') {
					if ($therapy_api) {
						// get the latest drug that has been applied for and set it as default (for the appropriate eye)
						if ($default_left_drug) {
							$element->left_drug_id = $default_left_drug->id;
							$previous = $injection_api->previousInjections($this->patient, $this->episode, 'left', $default_left_drug);
							$element->left_number = count($previous) + 1;
						}
						if ($default_right_drug) {
							$element->right_drug_id = $default_right_drug->id;
							$previous = $injection_api->previousInjections($this->patient, $this->episode, 'right', $default_right_drug);
							$element->right_number = count($previous) + 1;
						}
					}
					$element->left_injection_given_by_id = Yii::app()->user->id;
					$element->right_injection_given_by_id = Yii::app()->user->id;
				}
				if (get_class($element) == 'Element_OphTrIntravitrealinjection_Site') {
					$element->site_id = $this->selectedSiteId;
				}
			}

		}

		return $elements;
	}

	/**
	 * (non-PHPdoc)
	 * @see BaseEventTypeController::setPOSTManyToMany()
	 */
	protected function setPOSTManyToMany($element)
	{
		foreach (array('left', 'right') as $side) {
			if (get_class($element) == 'Element_OphTrIntravitrealinjection_Complications') {
				if (isset($_POST['Element_OphTrIntravitrealinjection_Complications'][$side . '_complications']) ) {
					$complications = array();

					foreach ($_POST['Element_OphTrIntravitrealinjection_Complications'][$side . '_complications'] as $comp_id) {
						if ($comp = OphTrIntravitrealinjection_Complication::model()->findByPk($comp_id)) {
							$complications[] = $comp;
						}
					}
					$element->{$side . '_complications'} = $complications;
				}
			}
			else if (get_class($element) == 'Element_OphTrIntravitrealinjection_Treatment') {
				foreach (array('pre', 'post') as $stage) {
					if (isset($_POST['Element_OphTrIntravitrealinjection_Treatment'][$side . '_' . $stage . '_ioploweringdrugs']) ) {
						$ioplowerings = array();

						foreach ($_POST['Element_OphTrIntravitrealinjection_Treatment'][$side . '_' . $stage . '_ioploweringdrugs'] as $ioplowering_id) {
							if ($ioplowering = OphTrIntravitrealinjection_IOPLoweringDrug::model()->findByPk($ioplowering_id)) {
								$ioplowerings[] = $ioplowering;
							}
						}
						$element->{$side . '_' . $stage . '_ioploweringdrugs'} = $ioplowerings;
					}
				}
			}
		}
	}

	/**
	 * similar to setPOSTManyToMany, but will actually call methods on the elements that will create database entries
	 * should be called on create and update.
	 *
	 * @param BaseEventTypeElement[] $elements
	 */
	protected function storePOSTManyToMany($elements)
	{
		foreach ($elements as $el) {
			foreach (array('left' => SplitEventTypeElement::LEFT, 'right' => SplitEventTypeElement::RIGHT) as $side => $sconst) {
				if (get_class($el) == 'Element_OphTrIntravitrealinjection_Complications') {
					$comps = array();
					if (isset($_POST['Element_OphTrIntravitrealinjection_Complications'][$side . '_complications']) &&
						($el->eye_id == $sconst || $el->eye_id == Eye::BOTH)
					) {
						// only set if relevant to element side, otherwise force reset of data
						$comps = $_POST['Element_OphTrIntravitrealinjection_Complications'][$side . '_complications'];
					}
					$el->updateComplications($sconst, $comps);
				}
				else if (get_class($el) == 'Element_OphTrIntravitrealinjection_Treatment') {
					$drugs = array();
					if ($el->{$side . '_pre_ioplowering_required'} &&
						isset($_POST['Element_OphTrIntravitrealinjection_Treatment'][$side . '_pre_ioploweringdrugs']) &&
						($el->eye_id == $sconst || $el->eye_id == Eye::BOTH)
					) {
						// only set if relevant to element side, otherwise force reset of data
						$drugs = $_POST['Element_OphTrIntravitrealinjection_Treatment'][$side . '_pre_ioploweringdrugs'];
					}
					$el->updateIOPLoweringDrugs($sconst, true, $drugs);
					// reset for post
					$drugs = array();
					if ($el->{$side . '_post_ioplowering_required'} &&
						isset($_POST['Element_OphTrIntravitrealinjection_Treatment'][$side . '_post_ioploweringdrugs']) &&
						($el->eye_id == $sconst || $el->eye_id == Eye::BOTH)
					) {
						// only set if relevant to element side, otherwise force reset of data
						$drugs = $_POST['Element_OphTrIntravitrealinjection_Treatment'][$side . '_post_ioploweringdrugs'];
					}
					$el->updateIOPLoweringDrugs($sconst, false, $drugs);
				}

			}
		}
	}

	/**
	 * ensures Many Many fields processed for elements
	 */
	public function createElements($elements, $data, $firm, $patientId, $userId, $eventTypeId)
	{
		if ($id = parent::createElements($elements, $data, $firm, $patientId, $userId, $eventTypeId)) {
			// create has been successful, store many to many values
			$this->storePOSTManyToMany($elements);
		}
		return $id;
	}

	/**
	 * ensures Many Many fields processed for elements
	 */
	public function updateElements($elements, $data, $event)
	{
		if (parent::updateElements($elements, $data, $event)) {
			// update has been successful, now need to deal with many to many changes
			$this->storePOSTManyToMany($elements);
		}
		return true;
	}

}
