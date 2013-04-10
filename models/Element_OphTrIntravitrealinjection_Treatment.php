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
 * This is the model class for table "et_ophtrintravitinjection_treatment".
 *
 * The followings are the available columns in table:
 * @property string $id
 * @property integer $event_id
 * @property integer $left_drug_id
 * @property integer $left_number
 * @property string $left_batch_number
 * @property string $left_batch_expiry_date
 * @property integer $left_injection_given_by_id
 * @property integer $right_drug_id
 * @property integer $right_number
 * @property string $right_batch_number
 * @property string $right_batch_expiry_date
 * @property integer $right_injection_given_by_id
 *
 * The followings are the available model relations:
 *
 * @property ElementType $element_type
 * @property EventType $eventType
 * @property Event $event
 * @property User $user
 * @property User $usermodified
 * @property Element_OphTrIntravitrealinjection_Treatment_Drug $left_drug
 * @property User $left_injection_given_by
 * @property Element_OphTrIntravitrealinjection_Treatment_Drug $right_drug
 * @property User $right_injection_given_by
 */

class Element_OphTrIntravitrealinjection_Treatment extends SplitEventTypeElement
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
		return 'et_ophtrintravitinjection_treatment';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('event_id, eye_id, left_drug_id, left_number, left_batch_number, left_batch_expiry_date, left_injection_given_by_id, ' .
				'right_drug_id, right_number, right_batch_number, right_batch_expiry_date, right_injection_given_by_id', 'safe'),
			array('left_drug_id, left_number, left_batch_number, left_batch_expiry_date, left_injection_given_by_id, ', 'requiredIfSide', 'side' => 'left'),
			array('right_drug_id, right_number, right_batch_number, right_batch_expiry_date, right_injection_given_by_id, ', 'requiredIfSide', 'side' => 'right'),
			array('left_batch_expiry_date', 'todayOrFutureValidation', 'message' => 'Left {attribute} cannot be in the past.'),
			array('right_batch_expiry_date', 'todayOrFutureValidation', 'message' => 'Right {attribute} cannot be in the past.'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, event_id, eye_id, left_drug_id, left_number, left_batch_number, left_batch_expiry_date, left_injection_given_by_id, ' .
				'right_drug_id, right_number, right_batch_number, right_batch_expiry_date, right_injection_given_by_id', 'safe', 'on' => 'search'),
			array('left_number, right_number', 'numerical', 'integerOnly' => true, 'min' => 1, 'message' => 'Number of Injections must be higher or equal to 1'),
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
			'left_drug' => array(self::BELONGS_TO, 'Element_OphTrIntravitrealinjection_Treatment_Drug', 'left_drug_id'),
			'right_drug' => array(self::BELONGS_TO, 'Element_OphTrIntravitrealinjection_Treatment_Drug', 'right_drug_id'),
			'left_injection_given_by' => array(self::BELONGS_TO, 'User', 'left_injection_given_by_id'),
			'right_injection_given_by' => array(self::BELONGS_TO, 'User', 'right_injection_given_by_id'),
		);
	}

	public function sidedFields() {
		return array('drug_id', 'number', 'batch_number', 'batch_expiry_date', 'injection_given_by_id');
	}
	
	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'event_id' => 'Event',
			'left_drug_id' => 'Drug',
			'left_number' => 'Number of Injections',
			'left_batch_number' => 'Batch Number',
			'left_batch_expiry_date' => 'Batch Expiry Date',
			'left_injection_given_by_id' => 'Injection Given By',
			'right_drug_id' => 'Drug',
			'right_number' => 'Number of Injections',
			'right_batch_number' => 'Batch Number',
			'right_batch_expiry_date' => 'Batch Expiry Date',
			'right_injection_given_by_id' => 'Injection Given By',
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
		$criteria->compare('left_drug_id', $this->left_drug_id);
		$criteria->compare('left_number', $this->left_number);
		$criteria->compare('left_batch_number', $this->left_batch_number);
		$criteria->compare('left_batch_expiry_date', $this->left_batch_expiry_date);
		$criteria->compare('left_injection_given_by_id', $this->left_injection_given_by_id);
		$criteria->compare('right_drug_id', $this->right_drug_id);
		$criteria->compare('right_number', $this->right_number);
		$criteria->compare('right_batch_number', $this->right_batch_number);
		$criteria->compare('right_batch_expiry_date', $this->right_batch_expiry_date);
		$criteria->compare('right_injection_given_by_id', $this->right_injection_given_by_id);
		
		return new CActiveDataProvider(get_class($this), array(
			'criteria' => $criteria,
		));
	}



	protected function beforeSave()
	{
		return parent::beforeSave();
	}

	protected function afterSave()
	{

		return parent::afterSave();
	}

	protected function beforeValidate()
	{
		return parent::beforeValidate();
	}
	
	/*
	 * Validator ripe for refactoring up the tree, checks if the given date attribute is in the future
	 * 
	 */
	public function todayOrFutureValidation($attribute, $params) {
		$min_date = $this->id ? date('Y-m-d', strtotime($this->created_date)) : date('Y-m-d');  
		if (!@$params['message']) {
			$params['message'] = "{attribute} cannot be in the past";
		}
		 
		$params['{attribute}'] = $this->getAttributeLabel($attribute);
		
		if ($this->$attribute < $min_date) {
			$this->addError($attribute, strtr($params['message'], $params) );
		}

	}
}
?>