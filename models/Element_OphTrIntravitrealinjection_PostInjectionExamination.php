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
 * This is the model class for table "et_ophtrintravitinjection_postinject".
 *
 * The followings are the available columns in table:
 * @property string $id
 * @property integer $event_id
 * @property integer $eye_id
 * @property integer $left_cra
 * @property string $right_cra
 *
 * The followings are the available model relations:
 *
 * @property ElementType $element_type
 * @property EventType $eventType
 * @property Event $event
 * @property User $user
 * @property User $usermodified
 */

class Element_OphTrIntravitrealinjection_PostInjectionExamination extends SplitEventTypeElement
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
		return 'et_ophtrintravitinjection_postinject';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('event_id, eye_id, left_cra, left_iop_instrument_id, left_iop_reading_id, right_cra, right_iop_instrument_id, right_iop_reading_id', 'safe'),
			array('eye_id', 'required'),
			array('left_cra, left_iop_instrument_id, left_iop_reading_id', 'requiredIfSide', 'side' => 'left'),
			array('right_cra, right_iop_instrument_id, right_iop_reading_id', 'requiredIfSide', 'side' => 'right'),
			// The following rule is used by search().
			array('id, event_id, eye_id, left_cra, right_cra, ', 'safe', 'on' => 'search'),
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
			'left_iop_instrument' => array(self::BELONGS_TO, 'OphTrIntravitrealinjection_Instrument', 'left_iop_instrument_id'),
			'right_iop_instrument' => array(self::BELONGS_TO, 'OphTrIntravitrealinjection_Instrument', 'right_iop_instrument_id'),
			'left_iop_reading' => array(self::BELONGS_TO, 'OphTrIntravitrealinjection_IntraocularPressure_Reading', 'left_iop_reading_id'),
			'right_iop_reading' => array(self::BELONGS_TO, 'OphTrIntravitrealinjection_IntraocularPressure_Reading', 'right_iop_reading_id'),
		);
	}

	public function sidedFields() {
		return array('cra', 'iop_instrument', 'iop_reading');
	}
	
	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'event_id' => 'Event',
			'left_cra' => 'CRA',
			'right_cra' => 'CRA',
			'left_iop_instrument' => 'Instrument',
			'right_iop_instrument' => 'Instrument',
			'left_iop_reading' => 'IOP Reading',
			'right_iop_reading' => 'IOP Reading',
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
		$criteria->compare('left_cra', $this->left_cra);
		$criteria->compare('right_cra', $this->right_cra);
		$criteria->compare('left_iop_reading_id', $this->left_iop_reading_id);
		$criteria->compare('right_iop_reading_id', $this->right_iop_reading_id);
		$criteria->compare('left_iop_instrument_id', $this->left_iop_instrument_id);
		$criteria->compare('right_iop_instrument_id', $this->right_iop_instrument_id);
				
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
	
	public function getInstrumentValues() {
		return CHtml::listData(OphTrIntravitrealinjection_Instrument::model()->findAll(array('order' => 'display_order')), 'id', 'name') ;
	}
	
}
?>