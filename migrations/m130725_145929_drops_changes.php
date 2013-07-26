<?php

class m130725_145929_drops_changes extends CDbMigration
{
	public function up()
	{
		
		$this->insert('ophtrintravitinjection_ioplowering',array('name'=>'Diamox 250mg','display_order'=>3));
		$this->insert('ophtrintravitinjection_ioplowering',array('name'=>'Diamox 500mg','display_order'=>4));
		
		// earlier versions of the initial migration had a spelling mistake, this is a one way migration to fix this:
		$this->update('ophtrintravitinjection_lens_status', array('name' => 'Pseudophakic'), 'name = :oname', array(':oname' => 'Psuedophakic'));
		
		$this->createTable('ophtrintravitinjection_ioplowering_assign', array(
				'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
				'element_id' => 'int(10) unsigned NOT NULL',
				'eye_id' => 'int(10) unsigned NOT NULL DEFAULT ' . Eye::BOTH,
				'ioplowering_id' => 'int(10) unsigned NOT NULL',
				'is_pre' => 'boolean NOT NULL',
				'last_modified_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'last_modified_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'created_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'created_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'PRIMARY KEY (`id`)',
				'KEY `ophtrintravitinjection_ioplowering_assign_lmui_fk` (`last_modified_user_id`)',
				'KEY `ophtrintravitinjection_ioplowering_assign_cui_fk` (`created_user_id`)',
				'KEY `ophtrintravitinjection_ioplowering_assign_ele_fk` (`element_id`)',
				'KEY `ophtrintravitinjection_ioplowering_assign_eye_id_fk` (`eye_id`)',
				'KEY `ophtrintravitinjection_ioplowering_assign_lku_fk` (`ioplowering_id`)',
				'CONSTRAINT `ophtrintravitinjection_ioplowering_assign_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `ophtrintravitinjection_ioplowering_assign_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `ophtrintravitinjection_ioplowering_assign_ele_fk` FOREIGN KEY (`element_id`) REFERENCES `et_ophtrintravitinjection_treatment` (`id`)',
				'CONSTRAINT `ophtrintravitinjection_ioplowering_assign_eye_id_fk` FOREIGN KEY (`eye_id`) REFERENCES `eye` (`id`)',
				'CONSTRAINT `ophtrintravitinjection_ioplowering_assign_lku_fk` FOREIGN KEY (`ioplowering_id`) REFERENCES `ophtrintravitinjection_ioplowering` (`id`)',
		), 'ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin');
		
		$this->dropForeignKey('et_ophtrintravitinjection_treatment_lpriop_id_fk', 'et_ophtrintravitinjection_treatment');
		$this->dropForeignKey('et_ophtrintravitinjection_treatment_lpoiop_id_fk', 'et_ophtrintravitinjection_treatment');
		$this->dropForeignKey('et_ophtrintravitinjection_treatment_rpriop_id_fk', 'et_ophtrintravitinjection_treatment');
		$this->dropForeignKey('et_ophtrintravitinjection_treatment_rpoiop_id_fk', 'et_ophtrintravitinjection_treatment');
		$this->dropColumn('et_ophtrintravitinjection_treatment', 'left_pre_ioplowering_id');
		$this->dropColumn('et_ophtrintravitinjection_treatment', 'right_pre_ioplowering_id');
		$this->dropColumn('et_ophtrintravitinjection_treatment', 'left_post_ioplowering_id');
		$this->dropColumn('et_ophtrintravitinjection_treatment', 'right_post_ioplowering_id');
		
		$this->insert('ophtrintravitinjection_postinjection_drops',array('name'=>'None','display_order'=>3));
	}

	public function down()
	{
		$this->delete('ophtrintravitinjection_postinjection_drops', "name = 'None'");
		
		$this->dropTable('ophtrintravitinjection_ioplowering_assign');
		
		$this->delete('ophtrintravitinjection_ioplowering', "name = 'Diamox 250mg'");
		$this->delete('ophtrintravitinjection_ioplowering', "name = 'Diamox 500mg'");
		
		$this->addColumn('et_ophtrintravitinjection_treatment', 'left_pre_ioplowering_id', 'int(10) unsigned');
		$this->addForeignKey('et_ophtrintravitinjection_treatment_lpriop_id_fk', 'et_ophtrintravitinjection_treatment', 'left_pre_ioplowering_id', 'ophtrintravitinjection_ioplowering', 'id');
		$this->addColumn('et_ophtrintravitinjection_treatment', 'left_post_ioplowering_id', 'int(10) unsigned');
		$this->addForeignKey('et_ophtrintravitinjection_treatment_lpoiop_id_fk', 'et_ophtrintravitinjection_treatment', 'left_post_ioplowering_id', 'ophtrintravitinjection_ioplowering', 'id');
		$this->addColumn('et_ophtrintravitinjection_treatment', 'right_pre_ioplowering_id', 'int(10) unsigned');
		$this->addForeignKey('et_ophtrintravitinjection_treatment_rpriop_id_fk', 'et_ophtrintravitinjection_treatment', 'right_pre_ioplowering_id', 'ophtrintravitinjection_ioplowering', 'id');
		$this->addColumn('et_ophtrintravitinjection_treatment', 'right_post_ioplowering_id', 'int(10) unsigned');
		$this->addForeignKey('et_ophtrintravitinjection_treatment_rpoiop_id_fk', 'et_ophtrintravitinjection_treatment', 'right_post_ioplowering_id', 'ophtrintravitinjection_ioplowering', 'id');
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