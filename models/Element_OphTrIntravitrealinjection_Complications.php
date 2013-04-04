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

/**
 * This is the model class for table "et_ophtrintravitinjection_complicat".
 *
 * The followings are the available columns in table:
 * @property string $id
 * @property integer $event_id
 * @property string $oth_descrip
 *
 * The followings are the available model relations:
 *
 * @property ElementType $element_type
 * @property EventType $eventType
 * @property Event $event
 * @property User $user
 * @property User $usermodified
 * @property array(Element_OphTrIntravitrealinjection_Complications_Complicat_Assignment) $left_complications
 * @property array(Element_OphTrIntravitrealinjection_Complications_Complicat_Assignment) $right_complications
 */

class Element_OphTrIntravitrealinjection_Complications extends SplitEventTypeElement
{
	public $service;

	/**
	 * Returns the static model of the specified AR class.
	 * @return the static model class
	 */
	public static function model($className = __CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'et_ophtrintravitinjection_complicat';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('event_id, eye_id, left_oth_descrip, right_oth_descrip', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, event_id, eye_id, left_oth_descrip, right_oth_descrip', 'safe', 'on' => 'search'),
		);
	}
	
	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'element_type' => array(self::HAS_ONE, 'ElementType', 'id','on' => "element_type.class_name='".get_class($this)."'"),
			'eventType' => array(self::BELONGS_TO, 'EventType', 'event_type_id'),
			'event' => array(self::BELONGS_TO, 'Event', 'event_id'),
			'user' => array(self::BELONGS_TO, 'User', 'created_user_id'),
			'usermodified' => array(self::BELONGS_TO, 'User', 'last_modified_user_id'),
			'eye' => array(self::BELONGS_TO, 'Eye', 'eye_id'),
			// TODO: determine whether this can be altered to be a MANY_MANY when testing
			'left_complications' => array(self::HAS_MANY, 'Element_OphTrIntravitrealinjection_Complications_Complicat_Assignment', 'element_id', 'on' => 'left_complications.eye_id = ' . SplitEventTypeElement::LEFT),
			'right_complications' => array(self::HAS_MANY, 'Element_OphTrIntravitrealinjection_Complications_Complicat_Assignment', 'element_id', 'on' => 'right_complications.eye_id = ' . SplitEventTypeElement::RIGHT),
		);
	}

	public function sidedFields() {
		return array('oth_descrip');
	}
	
	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'event_id' => 'Event',
			'left_complications' => 'Complications',
			'right_complications' => 'Complications',
			'left_oth_descrip' => 'Other Description',
			'right_oth_descrip' => 'Other Description',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria = new CDbCriteria;

		$criteria->compare('id', $this->id, true);
		$criteria->compare('event_id', $this->event_id, true);
		$criteria->compare('complicat', $this->complicat);
		$criteria->compare('oth_descrip', $this->oth_descrip);
		
		return new CActiveDataProvider(get_class($this), array(
			'criteria' => $criteria,
		));
	}


	public function getet_ophtrintravitinjection_complicat_complicat_defaults() {
		$ids = array();
		foreach (Element_OphTrIntravitrealinjection_Complications_Complicat::model()->findAll('`default` = ?',array(1)) as $item) {
			$ids[] = $item->id;
		}
		return $ids;
	}

	protected function beforeSave()
	{
		return parent::beforeSave();
	}

	protected function afterSave()
	{
		if (!empty($_POST['MultiSelect_complicat'])) {

			$existing_ids = array();

			foreach (Element_OphTrIntravitrealinjection_Complications_Complicat_Assignment::model()->findAll('element_id = :elementId', array(':elementId' => $this->id)) as $item) {
				$existing_ids[] = $item->et_ophtrintravitinjection_complicat_complicat_id;
			}

			foreach ($_POST['MultiSelect_complicat'] as $id) {
				if (!in_array($id,$existing_ids)) {
					$item = new Element_OphTrIntravitrealinjection_Complications_Complicat_Assignment;
					$item->element_id = $this->id;
					$item->et_ophtrintravitinjection_complicat_complicat_id = $id;

					if (!$item->save()) {
						throw new Exception('Unable to save MultiSelect item: '.print_r($item->getErrors(),true));
					}
				}
			}

			foreach ($existing_ids as $id) {
				if (!in_array($id,$_POST['MultiSelect_complicat'])) {
					$item = Element_OphTrIntravitrealinjection_Complications_Complicat_Assignment::model()->find('element_id = :elementId and et_ophtrintravitinjection_complicat_complicat_id = :lookupfieldId',array(':elementId' => $this->id, ':lookupfieldId' => $id));
					if (!$item->delete()) {
						throw new Exception('Unable to delete MultiSelect item: '.print_r($item->getErrors(),true));
					}
				}
			}
		}

		return parent::afterSave();
	}

	protected function beforeValidate()
	{
		return parent::beforeValidate();
	}
	
	public function updateComplications($side, $complication_ids) {
		$current_complications = array();
		$save_complications = array();
		if ($side == $this::LEFT) {
			$complications = $this->left_complications;
		}
		elseif ($side == $this::RIGHT) {
			$complications = $this->right_complications;
		}
		else {
			throw Exception("Invalid side value");
		}
		
		foreach ($complications as $curr_comp) {
			$current_complications[$curr_comp->et_ophtrintravitinjection_complicat_complicat_id] = $curr_comp;
		}
		
		// go through each update complication, if there isn't one for this element,
		// create it and store for saving
		// if there is, check if the value is the same ... if it has changed
		// update and store for saving, otherwise remove from the current responses array
		// anything left in current responses at the end is ripe for deleting
		foreach ($complication_ids as $comp_id) {
			if (!array_key_exists($comp_id, $current_complications)) {
				$s = new OphCoTherapyapplication_PatientSuitability_DecisionTreeNodeResponse();
				$s->attributes = array('element_id' => $this->id, 'eye_id' => $side, 'et_ophtrintravitinjection_complicat_complicat_id' => $comp_id);
				$save_complications[] = $s;
			} else {
				// don't want to delete later
				unset($current_complications[$node_id]);
			}
		}
		// save what needs saving
		foreach ($save_complications as $save) {
			$save->save();
		}
		// delete the rest
		foreach ($current_complications as $curr) {
			$curr->delete();
		}
	}
}
?>