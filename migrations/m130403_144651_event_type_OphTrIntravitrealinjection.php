<?php 
class m130403_144651_event_type_OphTrIntravitrealinjection extends CDbMigration
{
	public function up() {

		// --- EVENT TYPE ENTRIES ---

		// create an event_type entry for this event type name if one doesn't already exist
		if (!$this->dbConnection->createCommand()->select('id')->from('event_type')->where('class_name=:class_name', array(':class_name'=>'OphTrIntravitrealinjection'))->queryRow()) {
			$group = $this->dbConnection->createCommand()->select('id')->from('event_group')->where('name=:name',array(':name'=>'Treatment events'))->queryRow();
			$this->insert('event_type', array('class_name' => 'OphTrIntravitrealinjection', 'name' => 'Intravitreal injection','event_group_id' => $group['id']));
		}
		// select the event_type id for this event type name
		$event_type = $this->dbConnection->createCommand()->select('id')->from('event_type')->where('class_name=:class_name', array(':class_name'=>'OphTrIntravitrealinjection'))->queryRow();

		// --- ELEMENT TYPE ENTRIES ---

		// create an element_type entry for this element type name if one doesn't already exist
		if (!$this->dbConnection->createCommand()->select('id')->from('element_type')->where('name=:name and event_type_id=:eventTypeId', array(':name'=>'Treatment',':eventTypeId'=>$event_type['id']))->queryRow()) {
			$this->insert('element_type', array('name' => 'Treatment','class_name' => 'Element_OphTrIntravitrealinjection_Treatment', 'event_type_id' => $event_type['id'], 'display_order' => 1));
		}
		// select the element_type_id for this element type name
		$element_type = $this->dbConnection->createCommand()->select('id')->from('element_type')->where('event_type_id=:eventTypeId and name=:name', array(':eventTypeId'=>$event_type['id'],':name'=>'Treatment'))->queryRow();
		// create an element_type entry for this element type name if one doesn't already exist
		if (!$this->dbConnection->createCommand()->select('id')->from('element_type')->where('name=:name and event_type_id=:eventTypeId', array(':name'=>'Post Injection Examination',':eventTypeId'=>$event_type['id']))->queryRow()) {
			$this->insert('element_type', array('name' => 'Post Injection Examination','class_name' => 'Element_OphTrIntravitrealinjection_PostInjectionExamination', 'event_type_id' => $event_type['id'], 'display_order' => 1));
		}
		// select the element_type_id for this element type name
		$element_type = $this->dbConnection->createCommand()->select('id')->from('element_type')->where('event_type_id=:eventTypeId and name=:name', array(':eventTypeId'=>$event_type['id'],':name'=>'Post Injection Examination'))->queryRow();
		// create an element_type entry for this element type name if one doesn't already exist
		if (!$this->dbConnection->createCommand()->select('id')->from('element_type')->where('name=:name and event_type_id=:eventTypeId', array(':name'=>'Complications',':eventTypeId'=>$event_type['id']))->queryRow()) {
			$this->insert('element_type', array('name' => 'Complications','class_name' => 'Element_OphTrIntravitrealinjection_Complications', 'event_type_id' => $event_type['id'], 'display_order' => 1));
		}
		// select the element_type_id for this element type name
		$element_type = $this->dbConnection->createCommand()->select('id')->from('element_type')->where('event_type_id=:eventTypeId and name=:name', array(':eventTypeId'=>$event_type['id'],':name'=>'Complications'))->queryRow();

		// element lookup table ophtrintravitinjection_treatment_drug
		$this->createTable('ophtrintravitinjection_treatment_drug', array(
				'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
				'name' => 'varchar(128) COLLATE utf8_bin NOT NULL',
				'display_order' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'available' => 'boolean NOT NULL DEFAULT True',
				'last_modified_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'last_modified_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'created_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'created_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'PRIMARY KEY (`id`)',
				'KEY `ophtrintravitinjection_treatment_drug_lmui_fk` (`last_modified_user_id`)',
				'KEY `ophtrintravitinjection_treatment_drug_cui_fk` (`created_user_id`)',
				'CONSTRAINT `ophtrintravitinjection_treatment_drug_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `ophtrintravitinjection_treatment_drug_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`)',
			), 'ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin');

		$this->insert('ophtrintravitinjection_treatment_drug',array('name'=>'Avastin','display_order'=>1));
		$this->insert('ophtrintravitinjection_treatment_drug',array('name'=>'Eylea','display_order'=>2));
		$this->insert('ophtrintravitinjection_treatment_drug',array('name'=>'Lucentis','display_order'=>3));
		$this->insert('ophtrintravitinjection_treatment_drug',array('name'=>'Macugen','display_order'=>4));
		$this->insert('ophtrintravitinjection_treatment_drug',array('name'=>'PDT','display_order'=>5));
		$this->insert('ophtrintravitinjection_treatment_drug',array('name'=>'Ozurdex','display_order'=>6));
		$this->insert('ophtrintravitinjection_treatment_drug',array('name'=>'Intravitreal triamcinolone','display_order'=>7));
		

		// create the table for this element type: et_modulename_elementtypename
		$this->createTable('et_ophtrintravitinjection_treatment', array(
				'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
				'event_id' => 'int(10) unsigned NOT NULL',
				'drug_id' => 'int(10) unsigned NOT NULL', // Drug
				'number' => 'int(10) unsigned NOT NULL', // Number of Injections
				'batch_number' => 'varchar(255) DEFAULT \'\'', // Batch Number
				'batch_expiry_date' => 'date DEFAULT NULL', // Batch Expiry Date
				'injection_given_by_id' => 'int(10) unsigned NOT NULL', // Injection Given By
				'last_modified_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'last_modified_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'created_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'created_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'PRIMARY KEY (`id`)',
				'KEY `et_ophtrintravitinjection_treatment_lmui_fk` (`last_modified_user_id`)',
				'KEY `et_ophtrintravitinjection_treatment_cui_fk` (`created_user_id`)',
				'KEY `et_ophtrintravitinjection_treatment_ev_fk` (`event_id`)',
				'KEY `ophtrintravitinjection_treatment_drug_fk` (`drug_id`)',
				'KEY `et_ophtrintravitinjection_treatment_injection_given_by_id_fk` (`injection_given_by_id`)',
				'CONSTRAINT `et_ophtrintravitinjection_treatment_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `et_ophtrintravitinjection_treatment_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `et_ophtrintravitinjection_treatment_ev_fk` FOREIGN KEY (`event_id`) REFERENCES `event` (`id`)',
				'CONSTRAINT `ophtrintravitinjection_treatment_drug_fk` FOREIGN KEY (`drug_id`) REFERENCES `ophtrintravitinjection_treatment_drug` (`id`)',
				'CONSTRAINT `et_ophtrintravitinjection_treatment_injection_given_by_id_fk` FOREIGN KEY (`injection_given_by_id`) REFERENCES `firm` (`id`)',
			), 'ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin');



		// create the table for this element type: et_modulename_elementtypename
		$this->createTable('et_ophtrintravitinjection_postinject', array(
				'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
				'event_id' => 'int(10) unsigned NOT NULL',
				'cra' => 'tinyint(1) unsigned NOT NULL DEFAULT 0', // CRA
				'iop' => 'varchar(255) DEFAULT \'\'', // IOP
				'last_modified_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'last_modified_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'created_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'created_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'PRIMARY KEY (`id`)',
				'KEY `et_ophtrintravitinjection_postinject_lmui_fk` (`last_modified_user_id`)',
				'KEY `et_ophtrintravitinjection_postinject_cui_fk` (`created_user_id`)',
				'KEY `et_ophtrintravitinjection_postinject_ev_fk` (`event_id`)',
				'CONSTRAINT `et_ophtrintravitinjection_postinject_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `et_ophtrintravitinjection_postinject_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `et_ophtrintravitinjection_postinject_ev_fk` FOREIGN KEY (`event_id`) REFERENCES `event` (`id`)',
			), 'ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin');

		// element lookup table et_ophtrintravitinjection_complicat_complicat
		$this->createTable('et_ophtrintravitinjection_complicat_complicat', array(
				'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
				'name' => 'varchar(128) COLLATE utf8_bin NOT NULL',
				'display_order' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'default' => 'tinyint(1) unsigned NOT NULL DEFAULT 0',
				'last_modified_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'last_modified_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'created_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'created_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'PRIMARY KEY (`id`)',
				'KEY `et_ophtrintravitinjection_complicat_complicat_lmui_fk` (`last_modified_user_id`)',
				'KEY `et_ophtrintravitinjection_complicat_complicat_cui_fk` (`created_user_id`)',
				'CONSTRAINT `et_ophtrintravitinjection_complicat_complicat_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `et_ophtrintravitinjection_complicat_complicat_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`)',
			), 'ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin');

		$this->insert('et_ophtrintravitinjection_complicat_complicat',array('name'=>'Subconjunctival haemorrhage','display_order'=>1));
		$this->insert('et_ophtrintravitinjection_complicat_complicat',array('name'=>'Conjunctival injection','display_order'=>2));
		$this->insert('et_ophtrintravitinjection_complicat_complicat',array('name'=>'Uveitis','display_order'=>3));
		$this->insert('et_ophtrintravitinjection_complicat_complicat',array('name'=>'Vitreous haze or haemorrhage','display_order'=>4));
		$this->insert('et_ophtrintravitinjection_complicat_complicat',array('name'=>'Retinal damage','display_order'=>5));
		$this->insert('et_ophtrintravitinjection_complicat_complicat',array('name'=>'Lens damage','display_order'=>6));
		$this->insert('et_ophtrintravitinjection_complicat_complicat',array('name'=>'Other','display_order'=>7));



		// create the table for this element type: et_modulename_elementtypename
		$this->createTable('et_ophtrintravitinjection_complicat', array(
				'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
				'event_id' => 'int(10) unsigned NOT NULL',
				'oth_descrip' => 'text DEFAULT \'\'', // Other Description
				'last_modified_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'last_modified_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'created_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'created_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'PRIMARY KEY (`id`)',
				'KEY `et_ophtrintravitinjection_complicat_lmui_fk` (`last_modified_user_id`)',
				'KEY `et_ophtrintravitinjection_complicat_cui_fk` (`created_user_id`)',
				'KEY `et_ophtrintravitinjection_complicat_ev_fk` (`event_id`)',
				'CONSTRAINT `et_ophtrintravitinjection_complicat_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `et_ophtrintravitinjection_complicat_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `et_ophtrintravitinjection_complicat_ev_fk` FOREIGN KEY (`event_id`) REFERENCES `event` (`id`)',
			), 'ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin');

		$this->createTable('et_ophtrintravitinjection_complicat_complicat_assignment', array(
				'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
				'element_id' => 'int(10) unsigned NOT NULL',
				'et_ophtrintravitinjection_complicat_complicat_id' => 'int(10) unsigned NOT NULL',
				'last_modified_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'last_modified_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'created_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'created_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'PRIMARY KEY (`id`)',
				'KEY `et_ophtrintravitinjection_complicat_complicat_assignment_lmui_fk` (`last_modified_user_id`)',
				'KEY `et_ophtrintravitinjection_complicat_complicat_assignment_cui_fk` (`created_user_id`)',
				'KEY `et_ophtrintravitinjection_complicat_complicat_assignment_ele_fk` (`element_id`)',
				'KEY `et_ophtrintravitinjection_complicat_complicat_assignment_lku_fk` (`et_ophtrintravitinjection_complicat_complicat_id`)',
				'CONSTRAINT `et_ophtrintravitinjection_complicat_complicat_assignment_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `et_ophtrintravitinjection_complicat_complicat_assignment_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `et_ophtrintravitinjection_complicat_complicat_assignment_ele_fk` FOREIGN KEY (`element_id`) REFERENCES `et_ophtrintravitinjection_complicat` (`id`)',
				'CONSTRAINT `et_ophtrintravitinjection_complicat_complicat_assignment_lku_fk` FOREIGN KEY (`et_ophtrintravitinjection_complicat_complicat_id`) REFERENCES `et_ophtrintravitinjection_complicat_complicat` (`id`)',
			), 'ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin');

	}

	public function down() {
		// --- drop any element related tables ---
		// --- drop element tables ---
		$this->dropTable('et_ophtrintravitinjection_treatment');


		$this->dropTable('ophtrintravitinjection_treatment_drug');

		$this->dropTable('et_ophtrintravitinjection_postinject');



		$this->dropTable('et_ophtrintravitinjection_complicat_complicat_assignment');
		$this->dropTable('et_ophtrintravitinjection_complicat');


		$this->dropTable('et_ophtrintravitinjection_complicat_complicat');


		// --- delete event entries ---
		$event_type = $this->dbConnection->createCommand()->select('id')->from('event_type')->where('class_name=:class_name', array(':class_name'=>'OphTrIntravitrealinjection'))->queryRow();

		foreach ($this->dbConnection->createCommand()->select('id')->from('event')->where('event_type_id=:event_type_id', array(':event_type_id'=>$event_type['id']))->queryAll() as $row) {
			$this->delete('audit', 'event_id='.$row['id']);
			$this->delete('event', 'id='.$row['id']);
		}

		// --- delete entries from element_type ---
		$this->delete('element_type', 'event_type_id='.$event_type['id']);

		// --- delete entries from event_type ---
		$this->delete('event_type', 'id='.$event_type['id']);

		// echo "m000000_000001_event_type_OphTrIntravitrealinjection does not support migration down.\n";
		// return false;
		echo "If you are removing this module you may also need to remove references to it in your configuration files\n";
		return true;
	}
}
?>