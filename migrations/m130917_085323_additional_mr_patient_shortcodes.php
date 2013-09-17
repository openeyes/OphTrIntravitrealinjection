<?php

class m130917_085323_additional_mr_patient_shortcodes extends CDbMigration
{
	public function up()
	{
		$event_type = EventType::model()->find('class_name=?',array('OphTrIntravitrealinjection'));

		$event_type->registerShortcode('idl','getLetterTreatmentDrugLeft','Intravitreal injection drug for left eye');
		$event_type->registerShortcode('idr','getLetterTreatmentDrugRight','Intravitreal injection drug for right eye');
		$event_type->registerShortcode('inl','getLetterTreatmentNumberLeft','Intravitreal injection number for left eye');
		$event_type->registerShortcode('inr','getLetterTreatmentNumberRight','Intravitreal injection number for right eye');
		$event_type->registerShortcode('pid','getLetterPostInjectionDrops','Post injection examination drops');

	}

	public function down()
	{
		$this->delete('patient_shortcode','code = :sc',array(':sc'=>'idl'));
		$this->delete('patient_shortcode','code = :sc',array(':sc'=>'idr'));
		$this->delete('patient_shortcode','code = :sc',array(':sc'=>'inl'));
		$this->delete('patient_shortcode','code = :sc',array(':sc'=>'inr'));
		$this->delete('patient_shortcode','code = :sc',array(':sc'=>'pid'));

	}

	/*
	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
	}

	public function safeDown()
	{
	}
	*/
}