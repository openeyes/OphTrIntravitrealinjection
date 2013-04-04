<?php
/**
 * OpenEyes
 *
 * (C) Moorfields Eye Hospital NHS Foundation Trust, 2008-2011
 * (C) OpenEyes Foundation, 2011-2013
 * This file is part of OpenEyes.
 * OpenEyes is free software: you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation, either version 3 of the License, or (at your option) any later version.
 * OpenEyes is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details.
 * You should have received a copy of the GNU General Public License along with OpenEyes in a file titled COPYING. If not, see <http://www.gnu.org/licenses/>.
 *
 * @package OpenEyes
 * @link http://www.openeyes.org.uk
 * @author OpenEyes <info@openeyes.org.uk>
 * @copyright Copyright (c) 2008-2011, Moorfields Eye Hospital NHS Foundation Trust
 * @copyright Copyright (c) 2011-2013, OpenEyes Foundation
 * @license http://www.gnu.org/licenses/gpl-3.0.html The GNU General Public License V3.0
 */

class AdminController extends ModuleAdminController
{
	public $defaultAction = "ViewAllElement_OphTrIntravitrealinjection_Treatment_Drug";
	
	// Treatment Drug actions
	public function actionViewAllElement_OphTrIntravitrealinjection_Treatment_Drug() {
		$dataProvider=new CActiveDataProvider('Element_OphTrIntravitrealinjection_Treatment_Drug');
		$model_list = Element_OphTrIntravitrealinjection_Treatment_Drug::model()->findAll(array('order' => 'display_order asc'));
		$this->jsVars['OphTrIntravitrealinjection_sort_url'] = $this->createUrl('sortTreatmentDrugs');
		
		$this->render('list',array(
				'model_list'=>$model_list,
				'title'=>'Treatment Drugs',
				'model_class'=>'Element_OphTrIntravitrealinjection_Treatment_Drug',
		));
	}
	
	public function actionCreateElement_OphTrIntravitrealinjection_Treatment_Drug() {
		$model = new Element_OphTrIntravitrealinjection_Treatment_Drug();
		
		if (isset($_POST['Element_OphTrIntravitrealinjection_Treatment_Drug'])) {
			$model->attributes = $_POST['Element_OphTrIntravitrealinjection_Treatment_Drug'];
			
			if ($bottom_drug = Element_OphTrIntravitrealinjection_Treatment_Drug::model()->find(array('order'=>'display_order desc'))) {
				$display_order = $bottom_drug->display_order+1;
			} else {
				$display_order = 1;
			}
			$model->display_order = $display_order;
			
			if ($model->save()) {
				Audit::add('Element_OphTrIntravitrealinjection_Treatment_Drug', 'create', serialize($model->attributes));
				Yii::app()->user->setFlash('success', 'Treatment drug created');
		
				$this->redirect(array('ViewAllElement_OphTrIntravitrealinjection_Treatment_Drug'));
			}
		}
		
		$this->render('create', array(
			'model' => $model,
		));
	}
	
	
	public function actionUpdateElement_OphTrIntravitrealinjection_Treatment_Drug($id) {
		$model = Element_OphTrIntravitrealinjection_Treatment_Drug::model()->findByPk((int)$id);
	
		if (isset($_POST['Element_OphTrIntravitrealinjection_Treatment_Drug'])) {
			$model->attributes = $_POST['Element_OphTrIntravitrealinjection_Treatment_Drug'];
	
			if ($model->save()) {
				Audit::add('Element_OphTrIntravitrealinjection_Treatment_Drug', 'update', serialize($model->attributes));
				Yii::app()->user->setFlash('success', 'Treatment drug updated');
	
				$this->redirect(array('ViewAllElement_OphTrIntravitrealinjection_Treatment_Drug'));
			}
		}
	
		$this->render('create', array(
				'model' => $model,
		));
	}
	
	/*
	 * sorts the drugs into the provided order (NOTE does not support a paginated list of drugs)
	 */
	public function actionSortTreatmentDrugs() {
		if (!empty($_POST['order'])) {
			foreach ($_POST['order'] as $i => $id) {
				if ($drug = Element_OphTrIntravitrealinjection_Treatment_Drug::model()->findByPk($id)) {
					$drug->display_order = $i+1;
					if (!$drug->save()) {
						throw new Exception("Unable to save drug: ".print_r($drug->getErrors(),true));
					}
				}
			}
		}
	}
}
