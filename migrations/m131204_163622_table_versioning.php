<?php

class m131204_163622_table_versioning extends CDbMigration
{
	public function up()
	{
		$this->execute("
CREATE TABLE `et_ophtrintravitinjection_anaesthetic_version` (
	`id` int(10) unsigned NOT NULL AUTO_INCREMENT,
	`event_id` int(10) unsigned NOT NULL,
	`eye_id` int(10) unsigned NOT NULL DEFAULT '3',
	`left_anaesthetictype_id` int(10) unsigned DEFAULT NULL,
	`left_anaestheticdelivery_id` int(10) unsigned DEFAULT NULL,
	`left_anaestheticagent_id` int(10) unsigned DEFAULT NULL,
	`right_anaesthetictype_id` int(10) unsigned DEFAULT NULL,
	`right_anaestheticdelivery_id` int(10) unsigned DEFAULT NULL,
	`right_anaestheticagent_id` int(10) unsigned DEFAULT NULL,
	`last_modified_user_id` int(10) unsigned NOT NULL DEFAULT '1',
	`last_modified_date` datetime NOT NULL DEFAULT '1901-01-01 00:00:00',
	`created_user_id` int(10) unsigned NOT NULL DEFAULT '1',
	`created_date` datetime NOT NULL DEFAULT '1901-01-01 00:00:00',
	PRIMARY KEY (`id`),
	KEY `acv_et_ophtrintravitinjection_anaesthetic_lmui_fk` (`last_modified_user_id`),
	KEY `acv_et_ophtrintravitinjection_anaesthetic_cui_fk` (`created_user_id`),
	KEY `acv_et_ophtrintravitinjection_anaesthetic_ev_fk` (`event_id`),
	KEY `acv_et_ophtrintravitinjection_anaesthetic_eye_id_fk` (`eye_id`),
	KEY `acv_et_ophtrintravitinjection_anaesthetic_lat_id_fk` (`left_anaesthetictype_id`),
	KEY `acv_et_ophtrintravitinjection_anaesthetic_lad_id_fk` (`left_anaestheticdelivery_id`),
	KEY `acv_et_ophtrintravitinjection_anaesthetic_laa_id_fk` (`left_anaestheticagent_id`),
	KEY `acv_et_ophtrintravitinjection_anaesthetic_rat_id_fk` (`right_anaesthetictype_id`),
	KEY `acv_et_ophtrintravitinjection_anaesthetic_rad_id_fk` (`right_anaestheticdelivery_id`),
	KEY `acv_et_ophtrintravitinjection_anaesthetic_raa_id_fk` (`right_anaestheticagent_id`),
	CONSTRAINT `acv_et_ophtrintravitinjection_anaesthetic_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`),
	CONSTRAINT `acv_et_ophtrintravitinjection_anaesthetic_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`),
	CONSTRAINT `acv_et_ophtrintravitinjection_anaesthetic_ev_fk` FOREIGN KEY (`event_id`) REFERENCES `event` (`id`),
	CONSTRAINT `acv_et_ophtrintravitinjection_anaesthetic_eye_id_fk` FOREIGN KEY (`eye_id`) REFERENCES `eye` (`id`),
	CONSTRAINT `acv_et_ophtrintravitinjection_anaesthetic_lat_id_fk` FOREIGN KEY (`left_anaesthetictype_id`) REFERENCES `anaesthetic_type` (`id`),
	CONSTRAINT `acv_et_ophtrintravitinjection_anaesthetic_lad_id_fk` FOREIGN KEY (`left_anaestheticdelivery_id`) REFERENCES `anaesthetic_delivery` (`id`),
	CONSTRAINT `acv_et_ophtrintravitinjection_anaesthetic_laa_id_fk` FOREIGN KEY (`left_anaestheticagent_id`) REFERENCES `anaesthetic_agent` (`id`),
	CONSTRAINT `acv_et_ophtrintravitinjection_anaesthetic_rat_id_fk` FOREIGN KEY (`right_anaesthetictype_id`) REFERENCES `anaesthetic_type` (`id`),
	CONSTRAINT `acv_et_ophtrintravitinjection_anaesthetic_rad_id_fk` FOREIGN KEY (`right_anaestheticdelivery_id`) REFERENCES `anaesthetic_delivery` (`id`),
	CONSTRAINT `acv_et_ophtrintravitinjection_anaesthetic_raa_id_fk` FOREIGN KEY (`right_anaestheticagent_id`) REFERENCES `anaesthetic_agent` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci
		");

		$this->alterColumn('et_ophtrintravitinjection_anaesthetic_version','id','int(10) unsigned NOT NULL');
		$this->dropPrimaryKey('id','et_ophtrintravitinjection_anaesthetic_version');

		$this->createIndex('et_ophtrintravitinjection_anaesthetic_aid_fk','et_ophtrintravitinjection_anaesthetic_version','id');
		$this->addForeignKey('et_ophtrintravitinjection_anaesthetic_aid_fk','et_ophtrintravitinjection_anaesthetic_version','id','et_ophtrintravitinjection_anaesthetic','id');

		$this->addColumn('et_ophtrintravitinjection_anaesthetic_version','version_date',"datetime not null default '1900-01-01 00:00:00'");

		$this->addColumn('et_ophtrintravitinjection_anaesthetic_version','version_id','int(10) unsigned NOT NULL');
		$this->addPrimaryKey('version_id','et_ophtrintravitinjection_anaesthetic_version','version_id');
		$this->alterColumn('et_ophtrintravitinjection_anaesthetic_version','version_id','int(10) unsigned NOT NULL AUTO_INCREMENT');

		$this->execute("
CREATE TABLE `et_ophtrintravitinjection_anteriorseg_version` (
	`id` int(10) unsigned NOT NULL AUTO_INCREMENT,
	`event_id` int(10) unsigned NOT NULL,
	`eye_id` int(10) unsigned NOT NULL DEFAULT '3',
	`left_eyedraw` text,
	`right_eyedraw` text,
	`left_lens_status_id` int(10) unsigned DEFAULT NULL,
	`right_lens_status_id` int(10) unsigned DEFAULT NULL,
	`last_modified_user_id` int(10) unsigned NOT NULL DEFAULT '1',
	`last_modified_date` datetime NOT NULL DEFAULT '1901-01-01 00:00:00',
	`created_user_id` int(10) unsigned NOT NULL DEFAULT '1',
	`created_date` datetime NOT NULL DEFAULT '1901-01-01 00:00:00',
	PRIMARY KEY (`id`),
	KEY `acv_et_ophtrintravitinjection_anteriorseg_lmui_fk` (`last_modified_user_id`),
	KEY `acv_et_ophtrintravitinjection_anteriorseg_cui_fk` (`created_user_id`),
	KEY `acv_et_ophtrintravitinjection_anteriorseg_ei_fk` (`eye_id`),
	KEY `acv_et_ophtrintravitinjection_anteriorseg_llsi_fk` (`left_lens_status_id`),
	KEY `acv_et_ophtrintravitinjection_anteriorseg_rlsi_fk` (`right_lens_status_id`),
	CONSTRAINT `acv_et_ophtrintravitinjection_anteriorseg_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`),
	CONSTRAINT `acv_et_ophtrintravitinjection_anteriorseg_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`),
	CONSTRAINT `acv_et_ophtrintravitinjection_anteriorseg_ei_fk` FOREIGN KEY (`eye_id`) REFERENCES `eye` (`id`),
	CONSTRAINT `acv_et_ophtrintravitinjection_anteriorseg_llsi_fk` FOREIGN KEY (`left_lens_status_id`) REFERENCES `ophtrintravitinjection_lens_status` (`id`),
	CONSTRAINT `acv_et_ophtrintravitinjection_anteriorseg_rlsi_fk` FOREIGN KEY (`right_lens_status_id`) REFERENCES `ophtrintravitinjection_lens_status` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci
		");

		$this->alterColumn('et_ophtrintravitinjection_anteriorseg_version','id','int(10) unsigned NOT NULL');
		$this->dropPrimaryKey('id','et_ophtrintravitinjection_anteriorseg_version');

		$this->createIndex('et_ophtrintravitinjection_anteriorseg_aid_fk','et_ophtrintravitinjection_anteriorseg_version','id');
		$this->addForeignKey('et_ophtrintravitinjection_anteriorseg_aid_fk','et_ophtrintravitinjection_anteriorseg_version','id','et_ophtrintravitinjection_anteriorseg','id');

		$this->addColumn('et_ophtrintravitinjection_anteriorseg_version','version_date',"datetime not null default '1900-01-01 00:00:00'");

		$this->addColumn('et_ophtrintravitinjection_anteriorseg_version','version_id','int(10) unsigned NOT NULL');
		$this->addPrimaryKey('version_id','et_ophtrintravitinjection_anteriorseg_version','version_id');
		$this->alterColumn('et_ophtrintravitinjection_anteriorseg_version','version_id','int(10) unsigned NOT NULL AUTO_INCREMENT');

		$this->execute("
CREATE TABLE `et_ophtrintravitinjection_complications_version` (
	`id` int(10) unsigned NOT NULL AUTO_INCREMENT,
	`event_id` int(10) unsigned NOT NULL,
	`eye_id` int(10) unsigned NOT NULL DEFAULT '3',
	`left_oth_descrip` text,
	`right_oth_descrip` text,
	`last_modified_user_id` int(10) unsigned NOT NULL DEFAULT '1',
	`last_modified_date` datetime NOT NULL DEFAULT '1901-01-01 00:00:00',
	`created_user_id` int(10) unsigned NOT NULL DEFAULT '1',
	`created_date` datetime NOT NULL DEFAULT '1901-01-01 00:00:00',
	PRIMARY KEY (`id`),
	KEY `acv_et_ophtrintravitinjection_complicat_lmui_fk` (`last_modified_user_id`),
	KEY `acv_et_ophtrintravitinjection_complicat_cui_fk` (`created_user_id`),
	KEY `acv_et_ophtrintravitinjection_complicat_ev_fk` (`event_id`),
	KEY `acv_et_ophtrintravitinjection_complicat_eye_id_fk` (`eye_id`),
	CONSTRAINT `acv_et_ophtrintravitinjection_complicat_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`),
	CONSTRAINT `acv_et_ophtrintravitinjection_complicat_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`),
	CONSTRAINT `acv_et_ophtrintravitinjection_complicat_ev_fk` FOREIGN KEY (`event_id`) REFERENCES `event` (`id`),
	CONSTRAINT `acv_et_ophtrintravitinjection_complicat_eye_id_fk` FOREIGN KEY (`eye_id`) REFERENCES `eye` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci
		");

		$this->alterColumn('et_ophtrintravitinjection_complications_version','id','int(10) unsigned NOT NULL');
		$this->dropPrimaryKey('id','et_ophtrintravitinjection_complications_version');

		$this->createIndex('et_ophtrintravitinjection_complications_aid_fk','et_ophtrintravitinjection_complications_version','id');
		$this->addForeignKey('et_ophtrintravitinjection_complications_aid_fk','et_ophtrintravitinjection_complications_version','id','et_ophtrintravitinjection_complications','id');

		$this->addColumn('et_ophtrintravitinjection_complications_version','version_date',"datetime not null default '1900-01-01 00:00:00'");

		$this->addColumn('et_ophtrintravitinjection_complications_version','version_id','int(10) unsigned NOT NULL');
		$this->addPrimaryKey('version_id','et_ophtrintravitinjection_complications_version','version_id');
		$this->alterColumn('et_ophtrintravitinjection_complications_version','version_id','int(10) unsigned NOT NULL AUTO_INCREMENT');

		$this->execute("
CREATE TABLE `et_ophtrintravitinjection_postinject_version` (
	`id` int(10) unsigned NOT NULL AUTO_INCREMENT,
	`event_id` int(10) unsigned NOT NULL,
	`eye_id` int(10) unsigned DEFAULT '3',
	`left_finger_count` tinyint(1) unsigned DEFAULT '0',
	`right_finger_count` tinyint(1) unsigned DEFAULT '0',
	`left_iop_check` tinyint(1) unsigned DEFAULT '0',
	`right_iop_check` tinyint(1) unsigned DEFAULT '0',
	`left_drops_id` int(10) unsigned DEFAULT NULL,
	`right_drops_id` int(10) unsigned DEFAULT NULL,
	`last_modified_user_id` int(10) unsigned NOT NULL DEFAULT '1',
	`last_modified_date` datetime NOT NULL DEFAULT '1901-01-01 00:00:00',
	`created_user_id` int(10) unsigned NOT NULL DEFAULT '1',
	`created_date` datetime NOT NULL DEFAULT '1901-01-01 00:00:00',
	PRIMARY KEY (`id`),
	KEY `acv_et_ophtrintravitinjection_postinject_lmui_fk` (`last_modified_user_id`),
	KEY `acv_et_ophtrintravitinjection_postinject_cui_fk` (`created_user_id`),
	KEY `acv_et_ophtrintravitinjection_postinject_ev_fk` (`event_id`),
	KEY `acv_et_ophtrintravitinjection_postinject_eye_id_fk` (`eye_id`),
	KEY `acv_et_ophtrintravitinjection_postinject_ldrops_id_fk` (`left_drops_id`),
	KEY `acv_et_ophtrintravitinjection_postinject_rdrops_id_fk` (`right_drops_id`),
	CONSTRAINT `acv_et_ophtrintravitinjection_postinject_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`),
	CONSTRAINT `acv_et_ophtrintravitinjection_postinject_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`),
	CONSTRAINT `acv_et_ophtrintravitinjection_postinject_ev_fk` FOREIGN KEY (`event_id`) REFERENCES `event` (`id`),
	CONSTRAINT `acv_et_ophtrintravitinjection_postinject_eye_id_fk` FOREIGN KEY (`eye_id`) REFERENCES `eye` (`id`),
	CONSTRAINT `acv_et_ophtrintravitinjection_postinject_ldrops_id_fk` FOREIGN KEY (`left_drops_id`) REFERENCES `ophtrintravitinjection_postinjection_drops` (`id`),
	CONSTRAINT `acv_et_ophtrintravitinjection_postinject_rdrops_id_fk` FOREIGN KEY (`right_drops_id`) REFERENCES `ophtrintravitinjection_postinjection_drops` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci
		");

		$this->alterColumn('et_ophtrintravitinjection_postinject_version','id','int(10) unsigned NOT NULL');
		$this->dropPrimaryKey('id','et_ophtrintravitinjection_postinject_version');

		$this->createIndex('et_ophtrintravitinjection_postinject_aid_fk','et_ophtrintravitinjection_postinject_version','id');
		$this->addForeignKey('et_ophtrintravitinjection_postinject_aid_fk','et_ophtrintravitinjection_postinject_version','id','et_ophtrintravitinjection_postinject','id');

		$this->addColumn('et_ophtrintravitinjection_postinject_version','version_date',"datetime not null default '1900-01-01 00:00:00'");

		$this->addColumn('et_ophtrintravitinjection_postinject_version','version_id','int(10) unsigned NOT NULL');
		$this->addPrimaryKey('version_id','et_ophtrintravitinjection_postinject_version','version_id');
		$this->alterColumn('et_ophtrintravitinjection_postinject_version','version_id','int(10) unsigned NOT NULL AUTO_INCREMENT');

		$this->execute("
CREATE TABLE `et_ophtrintravitinjection_site_version` (
	`id` int(10) unsigned NOT NULL AUTO_INCREMENT,
	`event_id` int(10) unsigned NOT NULL,
	`site_id` int(10) unsigned NOT NULL,
	`last_modified_user_id` int(10) unsigned NOT NULL DEFAULT '1',
	`last_modified_date` datetime NOT NULL DEFAULT '1901-01-01 00:00:00',
	`created_user_id` int(10) unsigned NOT NULL DEFAULT '1',
	`created_date` datetime NOT NULL DEFAULT '1901-01-01 00:00:00',
	PRIMARY KEY (`id`),
	KEY `acv_et_ophtrintravitinjection_site_lmui_fk` (`last_modified_user_id`),
	KEY `acv_et_ophtrintravitinjection_site_cui_fk` (`created_user_id`),
	KEY `acv_et_ophtrintravitinjection_site_ev_fk` (`event_id`),
	KEY `acv_et_ophtrintravitinjection_site_site_id_fk` (`site_id`),
	CONSTRAINT `acv_et_ophtrintravitinjection_site_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`),
	CONSTRAINT `acv_et_ophtrintravitinjection_site_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`),
	CONSTRAINT `acv_et_ophtrintravitinjection_site_ev_fk` FOREIGN KEY (`event_id`) REFERENCES `event` (`id`),
	CONSTRAINT `acv_et_ophtrintravitinjection_site_site_id_fk` FOREIGN KEY (`site_id`) REFERENCES `site` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci
		");

		$this->alterColumn('et_ophtrintravitinjection_site_version','id','int(10) unsigned NOT NULL');
		$this->dropPrimaryKey('id','et_ophtrintravitinjection_site_version');

		$this->createIndex('et_ophtrintravitinjection_site_aid_fk','et_ophtrintravitinjection_site_version','id');
		$this->addForeignKey('et_ophtrintravitinjection_site_aid_fk','et_ophtrintravitinjection_site_version','id','et_ophtrintravitinjection_site','id');

		$this->addColumn('et_ophtrintravitinjection_site_version','version_date',"datetime not null default '1900-01-01 00:00:00'");

		$this->addColumn('et_ophtrintravitinjection_site_version','version_id','int(10) unsigned NOT NULL');
		$this->addPrimaryKey('version_id','et_ophtrintravitinjection_site_version','version_id');
		$this->alterColumn('et_ophtrintravitinjection_site_version','version_id','int(10) unsigned NOT NULL AUTO_INCREMENT');

		$this->execute("
CREATE TABLE `et_ophtrintravitinjection_treatment_version` (
	`id` int(10) unsigned NOT NULL AUTO_INCREMENT,
	`event_id` int(10) unsigned NOT NULL,
	`eye_id` int(10) unsigned NOT NULL DEFAULT '3',
	`left_pre_antisept_drug_id` int(10) unsigned DEFAULT NULL,
	`left_pre_skin_drug_id` int(10) unsigned DEFAULT NULL,
	`left_pre_ioplowering_required` tinyint(1) DEFAULT NULL,
	`left_drug_id` int(10) unsigned DEFAULT NULL,
	`right_drug_id` int(10) unsigned DEFAULT NULL,
	`left_number` int(10) unsigned DEFAULT NULL,
	`left_batch_number` varchar(255) DEFAULT '',
	`left_batch_expiry_date` date DEFAULT NULL,
	`left_injection_given_by_id` int(10) unsigned DEFAULT NULL,
	`left_injection_time` time DEFAULT NULL,
	`left_post_ioplowering_required` tinyint(1) DEFAULT NULL,
	`right_pre_antisept_drug_id` int(10) unsigned DEFAULT NULL,
	`right_pre_skin_drug_id` int(10) unsigned DEFAULT NULL,
	`right_pre_ioplowering_required` tinyint(1) DEFAULT NULL,
	`right_number` int(10) unsigned DEFAULT NULL,
	`right_batch_number` varchar(255) DEFAULT '',
	`right_batch_expiry_date` date DEFAULT NULL,
	`right_injection_given_by_id` int(10) unsigned DEFAULT NULL,
	`right_injection_time` time DEFAULT NULL,
	`right_post_ioplowering_required` tinyint(1) DEFAULT NULL,
	`last_modified_user_id` int(10) unsigned NOT NULL DEFAULT '1',
	`last_modified_date` datetime NOT NULL DEFAULT '1901-01-01 00:00:00',
	`created_user_id` int(10) unsigned NOT NULL DEFAULT '1',
	`created_date` datetime NOT NULL DEFAULT '1901-01-01 00:00:00',
	PRIMARY KEY (`id`),
	KEY `acv_et_ophtrintravitinjection_treatment_lmui_fk` (`last_modified_user_id`),
	KEY `acv_et_ophtrintravitinjection_treatment_cui_fk` (`created_user_id`),
	KEY `acv_et_ophtrintravitinjection_treatment_ev_fk` (`event_id`),
	KEY `acv_et_ophtrintravitinjection_treatment_eye_id_fk` (`eye_id`),
	KEY `acv_et_ophtrintravitinjection_treatment_lprad_id_fk` (`left_pre_antisept_drug_id`),
	KEY `acv_et_ophtrintravitinjection_treatment_lprsd_id_fk` (`left_pre_skin_drug_id`),
	KEY `acv_ophtrintravitinjection_treatment_ldrug_fk` (`left_drug_id`),
	KEY `acv_phtrintravitinjection_treatment_linjection_given_by_id_fk` (`left_injection_given_by_id`),
	KEY `acv_et_ophtrintravitinjection_treatment_rprad_id_fk` (`right_pre_antisept_drug_id`),
	KEY `acv_et_ophtrintravitinjection_treatment_rprsd_id_fk` (`right_pre_skin_drug_id`),
	KEY `acv_ophtrintravitinjection_treatment_rdrug_fk` (`right_drug_id`),
	KEY `acv_phtrintravitinjection_treatment_rinjection_given_by_id_fk` (`right_injection_given_by_id`),
	CONSTRAINT `acv_et_ophtrintravitinjection_treatment_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`),
	CONSTRAINT `acv_et_ophtrintravitinjection_treatment_ev_fk` FOREIGN KEY (`event_id`) REFERENCES `event` (`id`),
	CONSTRAINT `acv_et_ophtrintravitinjection_treatment_eye_id_fk` FOREIGN KEY (`eye_id`) REFERENCES `eye` (`id`),
	CONSTRAINT `acv_phtrintravitinjection_treatment_linjection_given_by_id_fk` FOREIGN KEY (`left_injection_given_by_id`) REFERENCES `user` (`id`),
	CONSTRAINT `acv_et_ophtrintravitinjection_treatment_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`),
	CONSTRAINT `acv_et_ophtrintravitinjection_treatment_lprad_id_fk` FOREIGN KEY (`left_pre_antisept_drug_id`) REFERENCES `ophtrintravitinjection_antiseptic_drug` (`id`),
	CONSTRAINT `acv_et_ophtrintravitinjection_treatment_lprsd_id_fk` FOREIGN KEY (`left_pre_skin_drug_id`) REFERENCES `ophtrintravitinjection_skin_drug` (`id`),
	CONSTRAINT `acv_phtrintravitinjection_treatment_rinjection_given_by_id_fk` FOREIGN KEY (`right_injection_given_by_id`) REFERENCES `user` (`id`),
	CONSTRAINT `acv_et_ophtrintravitinjection_treatment_rprad_id_fk` FOREIGN KEY (`right_pre_antisept_drug_id`) REFERENCES `ophtrintravitinjection_antiseptic_drug` (`id`),
	CONSTRAINT `acv_et_ophtrintravitinjection_treatment_rprsd_id_fk` FOREIGN KEY (`right_pre_skin_drug_id`) REFERENCES `ophtrintravitinjection_skin_drug` (`id`),
	CONSTRAINT `acv_ophtrintravitinjection_treatment_ldrug_fk` FOREIGN KEY (`left_drug_id`) REFERENCES `ophtrintravitinjection_treatment_drug` (`id`),
	CONSTRAINT `acv_ophtrintravitinjection_treatment_rdrug_fk` FOREIGN KEY (`right_drug_id`) REFERENCES `ophtrintravitinjection_treatment_drug` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci
		");

		$this->alterColumn('et_ophtrintravitinjection_treatment_version','id','int(10) unsigned NOT NULL');
		$this->dropPrimaryKey('id','et_ophtrintravitinjection_treatment_version');

		$this->createIndex('et_ophtrintravitinjection_treatment_aid_fk','et_ophtrintravitinjection_treatment_version','id');
		$this->addForeignKey('et_ophtrintravitinjection_treatment_aid_fk','et_ophtrintravitinjection_treatment_version','id','et_ophtrintravitinjection_treatment','id');

		$this->addColumn('et_ophtrintravitinjection_treatment_version','version_date',"datetime not null default '1900-01-01 00:00:00'");

		$this->addColumn('et_ophtrintravitinjection_treatment_version','version_id','int(10) unsigned NOT NULL');
		$this->addPrimaryKey('version_id','et_ophtrintravitinjection_treatment_version','version_id');
		$this->alterColumn('et_ophtrintravitinjection_treatment_version','version_id','int(10) unsigned NOT NULL AUTO_INCREMENT');

		$this->execute("
CREATE TABLE `ophtrintravitinjection_anaestheticagent_version` (
	`id` int(10) unsigned NOT NULL AUTO_INCREMENT,
	`anaesthetic_agent_id` int(10) unsigned NOT NULL,
	`display_order` int(10) unsigned NOT NULL,
	`created_user_id` int(10) unsigned NOT NULL DEFAULT '1',
	`last_modified_user_id` int(10) unsigned NOT NULL DEFAULT '1',
	`created_date` datetime NOT NULL DEFAULT '1900-01-01 00:00:00',
	`last_modified_date` datetime NOT NULL DEFAULT '1900-01-01 00:00:00',
	`is_default` tinyint(1) DEFAULT '0',
	PRIMARY KEY (`id`),
	KEY `acv_ophtrintravitinjection_anaestheticagent_ti_fk` (`anaesthetic_agent_id`),
	KEY `acv_ophtrintravitinjection_anaestheticagent_cui_fk` (`created_user_id`),
	KEY `acv_ophtrintravitinjection_anaestheticagent_lmui_fk` (`last_modified_user_id`),
	CONSTRAINT `acv_ophtrintravitinjection_anaestheticagent_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`),
	CONSTRAINT `acv_ophtrintravitinjection_anaestheticagent_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`),
	CONSTRAINT `acv_ophtrintravitinjection_anaestheticagent_ti_fk` FOREIGN KEY (`anaesthetic_agent_id`) REFERENCES `anaesthetic_agent` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci
		");

		$this->alterColumn('ophtrintravitinjection_anaestheticagent_version','id','int(10) unsigned NOT NULL');
		$this->dropPrimaryKey('id','ophtrintravitinjection_anaestheticagent_version');

		$this->createIndex('ophtrintravitinjection_anaestheticagent_aid_fk','ophtrintravitinjection_anaestheticagent_version','id');
		$this->addForeignKey('ophtrintravitinjection_anaestheticagent_aid_fk','ophtrintravitinjection_anaestheticagent_version','id','ophtrintravitinjection_anaestheticagent','id');

		$this->addColumn('ophtrintravitinjection_anaestheticagent_version','version_date',"datetime not null default '1900-01-01 00:00:00'");

		$this->addColumn('ophtrintravitinjection_anaestheticagent_version','version_id','int(10) unsigned NOT NULL');
		$this->addPrimaryKey('version_id','ophtrintravitinjection_anaestheticagent_version','version_id');
		$this->alterColumn('ophtrintravitinjection_anaestheticagent_version','version_id','int(10) unsigned NOT NULL AUTO_INCREMENT');

		$this->execute("
CREATE TABLE `ophtrintravitinjection_anaestheticdelivery_version` (
	`id` int(10) unsigned NOT NULL AUTO_INCREMENT,
	`anaesthetic_delivery_id` int(10) unsigned NOT NULL,
	`display_order` int(10) unsigned NOT NULL,
	`created_user_id` int(10) unsigned NOT NULL DEFAULT '1',
	`last_modified_user_id` int(10) unsigned NOT NULL DEFAULT '1',
	`created_date` datetime NOT NULL DEFAULT '1900-01-01 00:00:00',
	`last_modified_date` datetime NOT NULL DEFAULT '1900-01-01 00:00:00',
	PRIMARY KEY (`id`),
	KEY `acv_ophtrintravitinjection_anaestheticdelivery_di_fk` (`anaesthetic_delivery_id`),
	KEY `acv_ophtrintravitinjection_anaestheticdelivery_cui_fk` (`created_user_id`),
	KEY `acv_ophtrintravitinjection_anaestheticdelivery_lmui_fk` (`last_modified_user_id`),
	CONSTRAINT `acv_ophtrintravitinjection_anaestheticdelivery_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`),
	CONSTRAINT `acv_ophtrintravitinjection_anaestheticdelivery_di_fk` FOREIGN KEY (`anaesthetic_delivery_id`) REFERENCES `anaesthetic_delivery` (`id`),
	CONSTRAINT `acv_ophtrintravitinjection_anaestheticdelivery_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci
		");

		$this->alterColumn('ophtrintravitinjection_anaestheticdelivery_version','id','int(10) unsigned NOT NULL');
		$this->dropPrimaryKey('id','ophtrintravitinjection_anaestheticdelivery_version');

		$this->createIndex('ophtrintravitinjection_anaestheticdelivery_aid_fk','ophtrintravitinjection_anaestheticdelivery_version','id');
		$this->addForeignKey('ophtrintravitinjection_anaestheticdelivery_aid_fk','ophtrintravitinjection_anaestheticdelivery_version','id','ophtrintravitinjection_anaestheticdelivery','id');

		$this->addColumn('ophtrintravitinjection_anaestheticdelivery_version','version_date',"datetime not null default '1900-01-01 00:00:00'");

		$this->addColumn('ophtrintravitinjection_anaestheticdelivery_version','version_id','int(10) unsigned NOT NULL');
		$this->addPrimaryKey('version_id','ophtrintravitinjection_anaestheticdelivery_version','version_id');
		$this->alterColumn('ophtrintravitinjection_anaestheticdelivery_version','version_id','int(10) unsigned NOT NULL AUTO_INCREMENT');

		$this->execute("
CREATE TABLE `ophtrintravitinjection_anaesthetictype_version` (
	`id` int(10) unsigned NOT NULL AUTO_INCREMENT,
	`anaesthetic_type_id` int(10) unsigned NOT NULL,
	`display_order` int(10) unsigned NOT NULL,
	`created_user_id` int(10) unsigned NOT NULL DEFAULT '1',
	`last_modified_user_id` int(10) unsigned NOT NULL DEFAULT '1',
	`created_date` datetime NOT NULL DEFAULT '1900-01-01 00:00:00',
	`last_modified_date` datetime NOT NULL DEFAULT '1900-01-01 00:00:00',
	`is_default` tinyint(1) DEFAULT '0',
	PRIMARY KEY (`id`),
	KEY `acv_ophtrintravitinjection_anaesthetictype_ti_fk` (`anaesthetic_type_id`),
	KEY `acv_ophtrintravitinjection_anaesthetictype_cui_fk` (`created_user_id`),
	KEY `acv_ophtrintravitinjection_anaesthetictype_lmui_fk` (`last_modified_user_id`),
	CONSTRAINT `acv_ophtrintravitinjection_anaesthetictype_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`),
	CONSTRAINT `acv_ophtrintravitinjection_anaesthetictype_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`),
	CONSTRAINT `acv_ophtrintravitinjection_anaesthetictype_ti_fk` FOREIGN KEY (`anaesthetic_type_id`) REFERENCES `anaesthetic_type` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci
		");

		$this->alterColumn('ophtrintravitinjection_anaesthetictype_version','id','int(10) unsigned NOT NULL');
		$this->dropPrimaryKey('id','ophtrintravitinjection_anaesthetictype_version');

		$this->createIndex('ophtrintravitinjection_anaesthetictype_aid_fk','ophtrintravitinjection_anaesthetictype_version','id');
		$this->addForeignKey('ophtrintravitinjection_anaesthetictype_aid_fk','ophtrintravitinjection_anaesthetictype_version','id','ophtrintravitinjection_anaesthetictype','id');

		$this->addColumn('ophtrintravitinjection_anaesthetictype_version','version_date',"datetime not null default '1900-01-01 00:00:00'");

		$this->addColumn('ophtrintravitinjection_anaesthetictype_version','version_id','int(10) unsigned NOT NULL');
		$this->addPrimaryKey('version_id','ophtrintravitinjection_anaesthetictype_version','version_id');
		$this->alterColumn('ophtrintravitinjection_anaesthetictype_version','version_id','int(10) unsigned NOT NULL AUTO_INCREMENT');

		$this->execute("
CREATE TABLE `ophtrintravitinjection_antiseptic_allergy_assignment_version` (
	`id` int(10) unsigned NOT NULL AUTO_INCREMENT,
	`antisepticdrug_id` int(10) unsigned NOT NULL,
	`allergy_id` int(10) unsigned NOT NULL,
	`last_modified_user_id` int(10) unsigned NOT NULL DEFAULT '1',
	`last_modified_date` datetime NOT NULL DEFAULT '1901-01-01 00:00:00',
	`created_user_id` int(10) unsigned NOT NULL DEFAULT '1',
	`created_date` datetime NOT NULL DEFAULT '1901-01-01 00:00:00',
	PRIMARY KEY (`id`),
	KEY `acv_ophtrintravitinjection_antiseptic_allergy_assign_lmui_fk` (`last_modified_user_id`),
	KEY `acv_ophtrintravitinjection_antiseptic_allergy_assign_cui_fk` (`created_user_id`),
	KEY `acv_ophtrintravitinjection_antiseptic_allergy_assign_iopi_fk` (`antisepticdrug_id`),
	KEY `acv_ophtrintravitinjection_antiseptic_allergy_assign_allergyi_fk` (`allergy_id`),
	CONSTRAINT `acv_ophtrintravitinjection_antiseptic_allergy_assign_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`),
	CONSTRAINT `acv_ophtrintravitinjection_antiseptic_allergy_assign_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`),
	CONSTRAINT `acv_ophtrintravitinjection_antiseptic_allergy_assign_iopi_fk` FOREIGN KEY (`antisepticdrug_id`) REFERENCES `ophtrintravitinjection_antiseptic_drug` (`id`),
	CONSTRAINT `acv_ophtrintravitinjection_antiseptic_allergy_assign_allergyi_fk` FOREIGN KEY (`allergy_id`) REFERENCES `allergy` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci
		");

		$this->alterColumn('ophtrintravitinjection_antiseptic_allergy_assignment_version','id','int(10) unsigned NOT NULL');
		$this->dropPrimaryKey('id','ophtrintravitinjection_antiseptic_allergy_assignment_version');

		$this->createIndex('ophtrintravitinjection_antiseptic_allergy_assignment_aid_fk','ophtrintravitinjection_antiseptic_allergy_assignment_version','id');
		$this->addForeignKey('ophtrintravitinjection_antiseptic_allergy_assignment_aid_fk','ophtrintravitinjection_antiseptic_allergy_assignment_version','id','ophtrintravitinjection_antiseptic_allergy_assignment','id');

		$this->addColumn('ophtrintravitinjection_antiseptic_allergy_assignment_version','version_date',"datetime not null default '1900-01-01 00:00:00'");

		$this->addColumn('ophtrintravitinjection_antiseptic_allergy_assignment_version','version_id','int(10) unsigned NOT NULL');
		$this->addPrimaryKey('version_id','ophtrintravitinjection_antiseptic_allergy_assignment_version','version_id');
		$this->alterColumn('ophtrintravitinjection_antiseptic_allergy_assignment_version','version_id','int(10) unsigned NOT NULL AUTO_INCREMENT');

		$this->execute("
CREATE TABLE `ophtrintravitinjection_antiseptic_drug_version` (
	`id` int(10) unsigned NOT NULL AUTO_INCREMENT,
	`name` varchar(128) NOT NULL,
	`display_order` int(10) unsigned NOT NULL DEFAULT '1',
	`last_modified_user_id` int(10) unsigned NOT NULL DEFAULT '1',
	`last_modified_date` datetime NOT NULL DEFAULT '1901-01-01 00:00:00',
	`created_user_id` int(10) unsigned NOT NULL DEFAULT '1',
	`created_date` datetime NOT NULL DEFAULT '1901-01-01 00:00:00',
	`is_default` tinyint(1) DEFAULT '0',
	PRIMARY KEY (`id`),
	KEY `acv_ophtrintravitinjection_antiseptic_drug_lmui_fk` (`last_modified_user_id`),
	KEY `acv_ophtrintravitinjection_antiseptic_drug_cui_fk` (`created_user_id`),
	CONSTRAINT `acv_ophtrintravitinjection_antiseptic_drug_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`),
	CONSTRAINT `acv_ophtrintravitinjection_antiseptic_drug_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci
		");

		$this->alterColumn('ophtrintravitinjection_antiseptic_drug_version','id','int(10) unsigned NOT NULL');
		$this->dropPrimaryKey('id','ophtrintravitinjection_antiseptic_drug_version');

		$this->createIndex('ophtrintravitinjection_antiseptic_drug_aid_fk','ophtrintravitinjection_antiseptic_drug_version','id');
		$this->addForeignKey('ophtrintravitinjection_antiseptic_drug_aid_fk','ophtrintravitinjection_antiseptic_drug_version','id','ophtrintravitinjection_antiseptic_drug','id');

		$this->addColumn('ophtrintravitinjection_antiseptic_drug_version','version_date',"datetime not null default '1900-01-01 00:00:00'");

		$this->addColumn('ophtrintravitinjection_antiseptic_drug_version','version_id','int(10) unsigned NOT NULL');
		$this->addPrimaryKey('version_id','ophtrintravitinjection_antiseptic_drug_version','version_id');
		$this->alterColumn('ophtrintravitinjection_antiseptic_drug_version','version_id','int(10) unsigned NOT NULL AUTO_INCREMENT');

		$this->execute("
CREATE TABLE `ophtrintravitinjection_complicat_version` (
	`id` int(10) unsigned NOT NULL AUTO_INCREMENT,
	`name` varchar(128) NOT NULL,
	`display_order` int(10) unsigned NOT NULL DEFAULT '1',
	`default` tinyint(1) unsigned NOT NULL DEFAULT '0',
	`description_required` tinyint(1) NOT NULL DEFAULT '0',
	`last_modified_user_id` int(10) unsigned NOT NULL DEFAULT '1',
	`last_modified_date` datetime NOT NULL DEFAULT '1901-01-01 00:00:00',
	`created_user_id` int(10) unsigned NOT NULL DEFAULT '1',
	`created_date` datetime NOT NULL DEFAULT '1901-01-01 00:00:00',
	PRIMARY KEY (`id`),
	KEY `acv_ophtrintravitinjection_complicat_lmui_fk` (`last_modified_user_id`),
	KEY `acv_ophtrintravitinjection_complicat_cui_fk` (`created_user_id`),
	CONSTRAINT `acv_ophtrintravitinjection_complicat_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`),
	CONSTRAINT `acv_ophtrintravitinjection_complicat_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci
		");

		$this->alterColumn('ophtrintravitinjection_complicat_version','id','int(10) unsigned NOT NULL');
		$this->dropPrimaryKey('id','ophtrintravitinjection_complicat_version');

		$this->createIndex('ophtrintravitinjection_complicat_aid_fk','ophtrintravitinjection_complicat_version','id');
		$this->addForeignKey('ophtrintravitinjection_complicat_aid_fk','ophtrintravitinjection_complicat_version','id','ophtrintravitinjection_complicat','id');

		$this->addColumn('ophtrintravitinjection_complicat_version','version_date',"datetime not null default '1900-01-01 00:00:00'");

		$this->addColumn('ophtrintravitinjection_complicat_version','version_id','int(10) unsigned NOT NULL');
		$this->addPrimaryKey('version_id','ophtrintravitinjection_complicat_version','version_id');
		$this->alterColumn('ophtrintravitinjection_complicat_version','version_id','int(10) unsigned NOT NULL AUTO_INCREMENT');

		$this->execute("
CREATE TABLE `ophtrintravitinjection_complicat_assignment_version` (
	`id` int(10) unsigned NOT NULL AUTO_INCREMENT,
	`element_id` int(10) unsigned NOT NULL,
	`eye_id` int(10) unsigned NOT NULL DEFAULT '3',
	`complication_id` int(10) unsigned NOT NULL,
	`last_modified_user_id` int(10) unsigned NOT NULL DEFAULT '1',
	`last_modified_date` datetime NOT NULL DEFAULT '1901-01-01 00:00:00',
	`created_user_id` int(10) unsigned NOT NULL DEFAULT '1',
	`created_date` datetime NOT NULL DEFAULT '1901-01-01 00:00:00',
	PRIMARY KEY (`id`),
	KEY `acv_ophtrintravitinjection_complicat_assignment_lmui_fk` (`last_modified_user_id`),
	KEY `acv_ophtrintravitinjection_complicat_assignment_cui_fk` (`created_user_id`),
	KEY `acv_ophtrintravitinjection_complicat_assignment_ele_fk` (`element_id`),
	KEY `acv_ophtrintravitinjection_complicat_assign_eye_id_fk` (`eye_id`),
	KEY `acv_ophtrintravitinjection_complicat_assignment_lku_fk` (`complication_id`),
	CONSTRAINT `acv_ophtrintravitinjection_complicat_assignment_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`),
	CONSTRAINT `acv_ophtrintravitinjection_complicat_assignment_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`),
	CONSTRAINT `acv_ophtrintravitinjection_complicat_assignment_ele_fk` FOREIGN KEY (`element_id`) REFERENCES `et_ophtrintravitinjection_complications` (`id`),
	CONSTRAINT `acv_ophtrintravitinjection_complicat_assign_eye_id_fk` FOREIGN KEY (`eye_id`) REFERENCES `eye` (`id`),
	CONSTRAINT `acv_ophtrintravitinjection_complicat_assignment_lku_fk` FOREIGN KEY (`complication_id`) REFERENCES `ophtrintravitinjection_complicat` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci
		");

		$this->alterColumn('ophtrintravitinjection_complicat_assignment_version','id','int(10) unsigned NOT NULL');
		$this->dropPrimaryKey('id','ophtrintravitinjection_complicat_assignment_version');

		$this->createIndex('ophtrintravitinjection_complicat_assignment_aid_fk','ophtrintravitinjection_complicat_assignment_version','id');
		$this->addForeignKey('ophtrintravitinjection_complicat_assignment_aid_fk','ophtrintravitinjection_complicat_assignment_version','id','ophtrintravitinjection_complicat_assignment','id');

		$this->addColumn('ophtrintravitinjection_complicat_assignment_version','version_date',"datetime not null default '1900-01-01 00:00:00'");

		$this->addColumn('ophtrintravitinjection_complicat_assignment_version','version_id','int(10) unsigned NOT NULL');
		$this->addPrimaryKey('version_id','ophtrintravitinjection_complicat_assignment_version','version_id');
		$this->alterColumn('ophtrintravitinjection_complicat_assignment_version','version_id','int(10) unsigned NOT NULL AUTO_INCREMENT');

		$this->execute("
CREATE TABLE `ophtrintravitinjection_injectionuser_version` (
	`id` int(10) unsigned NOT NULL AUTO_INCREMENT,
	`user_id` int(10) unsigned NOT NULL,
	`created_user_id` int(10) unsigned NOT NULL DEFAULT '1',
	`last_modified_user_id` int(10) unsigned NOT NULL DEFAULT '1',
	`created_date` datetime NOT NULL DEFAULT '1900-01-01 00:00:00',
	`last_modified_date` datetime NOT NULL DEFAULT '1900-01-01 00:00:00',
	PRIMARY KEY (`id`),
	KEY `acv_ophtrintravitinjection_injectionuser_ui_fk` (`user_id`),
	KEY `acv_ophtrintravitinjection_injectionuser_cui_fk` (`created_user_id`),
	KEY `acv_ophtrintravitinjection_injectionuser_lmui_fk` (`last_modified_user_id`),
	CONSTRAINT `acv_ophtrintravitinjection_injectionuser_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`),
	CONSTRAINT `acv_ophtrintravitinjection_injectionuser_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`),
	CONSTRAINT `acv_ophtrintravitinjection_injectionuser_ui_fk` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci
		");

		$this->alterColumn('ophtrintravitinjection_injectionuser_version','id','int(10) unsigned NOT NULL');
		$this->dropPrimaryKey('id','ophtrintravitinjection_injectionuser_version');

		$this->createIndex('ophtrintravitinjection_injectionuser_aid_fk','ophtrintravitinjection_injectionuser_version','id');
		$this->addForeignKey('ophtrintravitinjection_injectionuser_aid_fk','ophtrintravitinjection_injectionuser_version','id','ophtrintravitinjection_injectionuser','id');

		$this->addColumn('ophtrintravitinjection_injectionuser_version','version_date',"datetime not null default '1900-01-01 00:00:00'");

		$this->addColumn('ophtrintravitinjection_injectionuser_version','version_id','int(10) unsigned NOT NULL');
		$this->addPrimaryKey('version_id','ophtrintravitinjection_injectionuser_version','version_id');
		$this->alterColumn('ophtrintravitinjection_injectionuser_version','version_id','int(10) unsigned NOT NULL AUTO_INCREMENT');

		$this->execute("
CREATE TABLE `ophtrintravitinjection_ioplowering_version` (
	`id` int(10) unsigned NOT NULL AUTO_INCREMENT,
	`name` varchar(128) NOT NULL,
	`display_order` int(10) unsigned NOT NULL DEFAULT '1',
	`last_modified_user_id` int(10) unsigned NOT NULL DEFAULT '1',
	`last_modified_date` datetime NOT NULL DEFAULT '1901-01-01 00:00:00',
	`created_user_id` int(10) unsigned NOT NULL DEFAULT '1',
	`created_date` datetime NOT NULL DEFAULT '1901-01-01 00:00:00',
	PRIMARY KEY (`id`),
	KEY `acv_ophtrintravitinjection_ioplowering_lmui_fk` (`last_modified_user_id`),
	KEY `acv_ophtrintravitinjection_ioplowering_cui_fk` (`created_user_id`),
	CONSTRAINT `acv_ophtrintravitinjection_ioplowering_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`),
	CONSTRAINT `acv_ophtrintravitinjection_ioplowering_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci
		");

		$this->alterColumn('ophtrintravitinjection_ioplowering_version','id','int(10) unsigned NOT NULL');
		$this->dropPrimaryKey('id','ophtrintravitinjection_ioplowering_version');

		$this->createIndex('ophtrintravitinjection_ioplowering_aid_fk','ophtrintravitinjection_ioplowering_version','id');
		$this->addForeignKey('ophtrintravitinjection_ioplowering_aid_fk','ophtrintravitinjection_ioplowering_version','id','ophtrintravitinjection_ioplowering','id');

		$this->addColumn('ophtrintravitinjection_ioplowering_version','version_date',"datetime not null default '1900-01-01 00:00:00'");

		$this->addColumn('ophtrintravitinjection_ioplowering_version','version_id','int(10) unsigned NOT NULL');
		$this->addPrimaryKey('version_id','ophtrintravitinjection_ioplowering_version','version_id');
		$this->alterColumn('ophtrintravitinjection_ioplowering_version','version_id','int(10) unsigned NOT NULL AUTO_INCREMENT');

		$this->execute("
CREATE TABLE `ophtrintravitinjection_ioplowering_assign_version` (
	`id` int(10) unsigned NOT NULL AUTO_INCREMENT,
	`element_id` int(10) unsigned NOT NULL,
	`eye_id` int(10) unsigned NOT NULL DEFAULT '3',
	`ioplowering_id` int(10) unsigned NOT NULL,
	`is_pre` tinyint(1) NOT NULL,
	`last_modified_user_id` int(10) unsigned NOT NULL DEFAULT '1',
	`last_modified_date` datetime NOT NULL DEFAULT '1901-01-01 00:00:00',
	`created_user_id` int(10) unsigned NOT NULL DEFAULT '1',
	`created_date` datetime NOT NULL DEFAULT '1901-01-01 00:00:00',
	PRIMARY KEY (`id`),
	KEY `acv_ophtrintravitinjection_ioplowering_assign_lmui_fk` (`last_modified_user_id`),
	KEY `acv_ophtrintravitinjection_ioplowering_assign_cui_fk` (`created_user_id`),
	KEY `acv_ophtrintravitinjection_ioplowering_assign_ele_fk` (`element_id`),
	KEY `acv_ophtrintravitinjection_ioplowering_assign_eye_id_fk` (`eye_id`),
	KEY `acv_ophtrintravitinjection_ioplowering_assign_lku_fk` (`ioplowering_id`),
	CONSTRAINT `acv_ophtrintravitinjection_ioplowering_assign_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`),
	CONSTRAINT `acv_ophtrintravitinjection_ioplowering_assign_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`),
	CONSTRAINT `acv_ophtrintravitinjection_ioplowering_assign_ele_fk` FOREIGN KEY (`element_id`) REFERENCES `et_ophtrintravitinjection_treatment` (`id`),
	CONSTRAINT `acv_ophtrintravitinjection_ioplowering_assign_eye_id_fk` FOREIGN KEY (`eye_id`) REFERENCES `eye` (`id`),
	CONSTRAINT `acv_ophtrintravitinjection_ioplowering_assign_lku_fk` FOREIGN KEY (`ioplowering_id`) REFERENCES `ophtrintravitinjection_ioplowering` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci
		");

		$this->alterColumn('ophtrintravitinjection_ioplowering_assign_version','id','int(10) unsigned NOT NULL');
		$this->dropPrimaryKey('id','ophtrintravitinjection_ioplowering_assign_version');

		$this->createIndex('ophtrintravitinjection_ioplowering_assign_aid_fk','ophtrintravitinjection_ioplowering_assign_version','id');
		$this->addForeignKey('ophtrintravitinjection_ioplowering_assign_aid_fk','ophtrintravitinjection_ioplowering_assign_version','id','ophtrintravitinjection_ioplowering_assign','id');

		$this->addColumn('ophtrintravitinjection_ioplowering_assign_version','version_date',"datetime not null default '1900-01-01 00:00:00'");

		$this->addColumn('ophtrintravitinjection_ioplowering_assign_version','version_id','int(10) unsigned NOT NULL');
		$this->addPrimaryKey('version_id','ophtrintravitinjection_ioplowering_assign_version','version_id');
		$this->alterColumn('ophtrintravitinjection_ioplowering_assign_version','version_id','int(10) unsigned NOT NULL AUTO_INCREMENT');

		$this->execute("
CREATE TABLE `ophtrintravitinjection_lens_status_version` (
	`id` int(10) unsigned NOT NULL AUTO_INCREMENT,
	`name` varchar(128) NOT NULL,
	`display_order` int(10) unsigned NOT NULL DEFAULT '1',
	`default_distance` decimal(2,1) NOT NULL,
	`last_modified_user_id` int(10) unsigned NOT NULL DEFAULT '1',
	`last_modified_date` datetime NOT NULL DEFAULT '1901-01-01 00:00:00',
	`created_user_id` int(10) unsigned NOT NULL DEFAULT '1',
	`created_date` datetime NOT NULL DEFAULT '1901-01-01 00:00:00',
	PRIMARY KEY (`id`),
	KEY `acv_ophtrintravitinjection_lens_status_lmui_fk` (`last_modified_user_id`),
	KEY `acv_ophtrintravitinjection_lens_status_cui_fk` (`created_user_id`),
	CONSTRAINT `acv_ophtrintravitinjection_lens_status_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`),
	CONSTRAINT `acv_ophtrintravitinjection_lens_status_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci
		");

		$this->alterColumn('ophtrintravitinjection_lens_status_version','id','int(10) unsigned NOT NULL');
		$this->dropPrimaryKey('id','ophtrintravitinjection_lens_status_version');

		$this->createIndex('ophtrintravitinjection_lens_status_aid_fk','ophtrintravitinjection_lens_status_version','id');
		$this->addForeignKey('ophtrintravitinjection_lens_status_aid_fk','ophtrintravitinjection_lens_status_version','id','ophtrintravitinjection_lens_status','id');

		$this->addColumn('ophtrintravitinjection_lens_status_version','version_date',"datetime not null default '1900-01-01 00:00:00'");

		$this->addColumn('ophtrintravitinjection_lens_status_version','version_id','int(10) unsigned NOT NULL');
		$this->addPrimaryKey('version_id','ophtrintravitinjection_lens_status_version','version_id');
		$this->alterColumn('ophtrintravitinjection_lens_status_version','version_id','int(10) unsigned NOT NULL AUTO_INCREMENT');

		$this->execute("
CREATE TABLE `ophtrintravitinjection_postinjection_drops_version` (
	`id` int(10) unsigned NOT NULL AUTO_INCREMENT,
	`name` varchar(128) NOT NULL,
	`display_order` int(10) unsigned NOT NULL DEFAULT '1',
	`last_modified_user_id` int(10) unsigned NOT NULL DEFAULT '1',
	`last_modified_date` datetime NOT NULL DEFAULT '1901-01-01 00:00:00',
	`created_user_id` int(10) unsigned NOT NULL DEFAULT '1',
	`created_date` datetime NOT NULL DEFAULT '1901-01-01 00:00:00',
	PRIMARY KEY (`id`),
	KEY `acv_ophtrintravitinjection_postinjection_drops_lmui_fk` (`last_modified_user_id`),
	KEY `acv_ophtrintravitinjection_postinjection_drops_cui_fk` (`created_user_id`),
	CONSTRAINT `acv_ophtrintravitinjection_postinjection_drops_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`),
	CONSTRAINT `acv_ophtrintravitinjection_postinjection_drops_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci
		");

		$this->alterColumn('ophtrintravitinjection_postinjection_drops_version','id','int(10) unsigned NOT NULL');
		$this->dropPrimaryKey('id','ophtrintravitinjection_postinjection_drops_version');

		$this->createIndex('ophtrintravitinjection_postinjection_drops_aid_fk','ophtrintravitinjection_postinjection_drops_version','id');
		$this->addForeignKey('ophtrintravitinjection_postinjection_drops_aid_fk','ophtrintravitinjection_postinjection_drops_version','id','ophtrintravitinjection_postinjection_drops','id');

		$this->addColumn('ophtrintravitinjection_postinjection_drops_version','version_date',"datetime not null default '1900-01-01 00:00:00'");

		$this->addColumn('ophtrintravitinjection_postinjection_drops_version','version_id','int(10) unsigned NOT NULL');
		$this->addPrimaryKey('version_id','ophtrintravitinjection_postinjection_drops_version','version_id');
		$this->alterColumn('ophtrintravitinjection_postinjection_drops_version','version_id','int(10) unsigned NOT NULL AUTO_INCREMENT');

		$this->execute("
CREATE TABLE `ophtrintravitinjection_skin_drug_version` (
	`id` int(10) unsigned NOT NULL AUTO_INCREMENT,
	`name` varchar(128) NOT NULL,
	`display_order` int(10) unsigned NOT NULL DEFAULT '1',
	`last_modified_user_id` int(10) unsigned NOT NULL DEFAULT '1',
	`last_modified_date` datetime NOT NULL DEFAULT '1901-01-01 00:00:00',
	`created_user_id` int(10) unsigned NOT NULL DEFAULT '1',
	`created_date` datetime NOT NULL DEFAULT '1901-01-01 00:00:00',
	`is_default` tinyint(1) DEFAULT '0',
	PRIMARY KEY (`id`),
	KEY `acv_ophtrintravitinjection_skin_drug_lmui_fk` (`last_modified_user_id`),
	KEY `acv_ophtrintravitinjection_skin_drug_cui_fk` (`created_user_id`),
	CONSTRAINT `acv_ophtrintravitinjection_skin_drug_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`),
	CONSTRAINT `acv_ophtrintravitinjection_skin_drug_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci
		");

		$this->alterColumn('ophtrintravitinjection_skin_drug_version','id','int(10) unsigned NOT NULL');
		$this->dropPrimaryKey('id','ophtrintravitinjection_skin_drug_version');

		$this->createIndex('ophtrintravitinjection_skin_drug_aid_fk','ophtrintravitinjection_skin_drug_version','id');
		$this->addForeignKey('ophtrintravitinjection_skin_drug_aid_fk','ophtrintravitinjection_skin_drug_version','id','ophtrintravitinjection_skin_drug','id');

		$this->addColumn('ophtrintravitinjection_skin_drug_version','version_date',"datetime not null default '1900-01-01 00:00:00'");

		$this->addColumn('ophtrintravitinjection_skin_drug_version','version_id','int(10) unsigned NOT NULL');
		$this->addPrimaryKey('version_id','ophtrintravitinjection_skin_drug_version','version_id');
		$this->alterColumn('ophtrintravitinjection_skin_drug_version','version_id','int(10) unsigned NOT NULL AUTO_INCREMENT');

		$this->execute("
CREATE TABLE `ophtrintravitinjection_skindrug_allergy_assignment_version` (
	`id` int(10) unsigned NOT NULL AUTO_INCREMENT,
	`skindrug_id` int(10) unsigned NOT NULL,
	`allergy_id` int(10) unsigned NOT NULL,
	`last_modified_user_id` int(10) unsigned NOT NULL DEFAULT '1',
	`last_modified_date` datetime NOT NULL DEFAULT '1901-01-01 00:00:00',
	`created_user_id` int(10) unsigned NOT NULL DEFAULT '1',
	`created_date` datetime NOT NULL DEFAULT '1901-01-01 00:00:00',
	PRIMARY KEY (`id`),
	KEY `acv_ophtrintravitinjection_skindrug_allergy_assign_lmui_fk` (`last_modified_user_id`),
	KEY `acv_ophtrintravitinjection_skindrug_allergy_assign_cui_fk` (`created_user_id`),
	KEY `acv_ophtrintravitinjection_skindrug_allergy_assign_iopi_fk` (`skindrug_id`),
	KEY `acv_ophtrintravitinjection_skindrug_allergy_assign_allergyi_fk` (`allergy_id`),
	CONSTRAINT `acv_ophtrintravitinjection_skindrug_allergy_assign_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`),
	CONSTRAINT `acv_ophtrintravitinjection_skindrug_allergy_assign_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`),
	CONSTRAINT `acv_ophtrintravitinjection_skindrug_allergy_assign_iopi_fk` FOREIGN KEY (`skindrug_id`) REFERENCES `ophtrintravitinjection_skin_drug` (`id`),
	CONSTRAINT `acv_ophtrintravitinjection_skindrug_allergy_assign_allergyi_fk` FOREIGN KEY (`allergy_id`) REFERENCES `allergy` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci
		");

		$this->alterColumn('ophtrintravitinjection_skindrug_allergy_assignment_version','id','int(10) unsigned NOT NULL');
		$this->dropPrimaryKey('id','ophtrintravitinjection_skindrug_allergy_assignment_version');

		$this->createIndex('ophtrintravitinjection_skindrug_allergy_assignment_aid_fk','ophtrintravitinjection_skindrug_allergy_assignment_version','id');
		$this->addForeignKey('ophtrintravitinjection_skindrug_allergy_assignment_aid_fk','ophtrintravitinjection_skindrug_allergy_assignment_version','id','ophtrintravitinjection_skindrug_allergy_assignment','id');

		$this->addColumn('ophtrintravitinjection_skindrug_allergy_assignment_version','version_date',"datetime not null default '1900-01-01 00:00:00'");

		$this->addColumn('ophtrintravitinjection_skindrug_allergy_assignment_version','version_id','int(10) unsigned NOT NULL');
		$this->addPrimaryKey('version_id','ophtrintravitinjection_skindrug_allergy_assignment_version','version_id');
		$this->alterColumn('ophtrintravitinjection_skindrug_allergy_assignment_version','version_id','int(10) unsigned NOT NULL AUTO_INCREMENT');

		$this->execute("
CREATE TABLE `ophtrintravitinjection_treatment_drug_version` (
	`id` int(10) unsigned NOT NULL AUTO_INCREMENT,
	`name` varchar(128) NOT NULL,
	`display_order` int(10) unsigned NOT NULL DEFAULT '1',
	`available` tinyint(1) NOT NULL DEFAULT '1',
	`last_modified_user_id` int(10) unsigned NOT NULL DEFAULT '1',
	`last_modified_date` datetime NOT NULL DEFAULT '1901-01-01 00:00:00',
	`created_user_id` int(10) unsigned NOT NULL DEFAULT '1',
	`created_date` datetime NOT NULL DEFAULT '1901-01-01 00:00:00',
	PRIMARY KEY (`id`),
	KEY `acv_ophtrintravitinjection_treatment_drug_lmui_fk` (`last_modified_user_id`),
	KEY `acv_ophtrintravitinjection_treatment_drug_cui_fk` (`created_user_id`),
	CONSTRAINT `acv_ophtrintravitinjection_treatment_drug_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`),
	CONSTRAINT `acv_ophtrintravitinjection_treatment_drug_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci
		");

		$this->alterColumn('ophtrintravitinjection_treatment_drug_version','id','int(10) unsigned NOT NULL');
		$this->dropPrimaryKey('id','ophtrintravitinjection_treatment_drug_version');

		$this->createIndex('ophtrintravitinjection_treatment_drug_aid_fk','ophtrintravitinjection_treatment_drug_version','id');
		$this->addForeignKey('ophtrintravitinjection_treatment_drug_aid_fk','ophtrintravitinjection_treatment_drug_version','id','ophtrintravitinjection_treatment_drug','id');

		$this->addColumn('ophtrintravitinjection_treatment_drug_version','version_date',"datetime not null default '1900-01-01 00:00:00'");

		$this->addColumn('ophtrintravitinjection_treatment_drug_version','version_id','int(10) unsigned NOT NULL');
		$this->addPrimaryKey('version_id','ophtrintravitinjection_treatment_drug_version','version_id');
		$this->alterColumn('ophtrintravitinjection_treatment_drug_version','version_id','int(10) unsigned NOT NULL AUTO_INCREMENT');

		$this->addColumn('et_ophtrintravitinjection_anaesthetic','deleted','tinyint(1) unsigned not null');
		$this->addColumn('et_ophtrintravitinjection_anaesthetic_version','deleted','tinyint(1) unsigned not null');
		$this->addColumn('et_ophtrintravitinjection_anteriorseg','deleted','tinyint(1) unsigned not null');
		$this->addColumn('et_ophtrintravitinjection_anteriorseg_version','deleted','tinyint(1) unsigned not null');
		$this->addColumn('et_ophtrintravitinjection_complications','deleted','tinyint(1) unsigned not null');
		$this->addColumn('et_ophtrintravitinjection_complications_version','deleted','tinyint(1) unsigned not null');
		$this->addColumn('et_ophtrintravitinjection_postinject','deleted','tinyint(1) unsigned not null');
		$this->addColumn('et_ophtrintravitinjection_postinject_version','deleted','tinyint(1) unsigned not null');
		$this->addColumn('et_ophtrintravitinjection_site','deleted','tinyint(1) unsigned not null');
		$this->addColumn('et_ophtrintravitinjection_site_version','deleted','tinyint(1) unsigned not null');
		$this->addColumn('et_ophtrintravitinjection_treatment','deleted','tinyint(1) unsigned not null');
		$this->addColumn('et_ophtrintravitinjection_treatment_version','deleted','tinyint(1) unsigned not null');

		$this->addColumn('ophtrintravitinjection_anaestheticagent','deleted','tinyint(1) unsigned not null');
		$this->addColumn('ophtrintravitinjection_anaestheticagent_version','deleted','tinyint(1) unsigned not null');
		$this->addColumn('ophtrintravitinjection_anaestheticdelivery','deleted','tinyint(1) unsigned not null');
		$this->addColumn('ophtrintravitinjection_anaestheticdelivery_version','deleted','tinyint(1) unsigned not null');
		$this->addColumn('ophtrintravitinjection_anaesthetictype','deleted','tinyint(1) unsigned not null');
		$this->addColumn('ophtrintravitinjection_anaesthetictype_version','deleted','tinyint(1) unsigned not null');
		$this->addColumn('ophtrintravitinjection_antiseptic_allergy_assignment','deleted','tinyint(1) unsigned not null');
		$this->addColumn('ophtrintravitinjection_antiseptic_allergy_assignment_version','deleted','tinyint(1) unsigned not null');
		$this->addColumn('ophtrintravitinjection_antiseptic_drug','deleted','tinyint(1) unsigned not null');
		$this->addColumn('ophtrintravitinjection_antiseptic_drug_version','deleted','tinyint(1) unsigned not null');
		$this->addColumn('ophtrintravitinjection_complicat','deleted','tinyint(1) unsigned not null');
		$this->addColumn('ophtrintravitinjection_complicat_version','deleted','tinyint(1) unsigned not null');
		$this->addColumn('ophtrintravitinjection_complicat_assignment','deleted','tinyint(1) unsigned not null');
		$this->addColumn('ophtrintravitinjection_complicat_assignment_version','deleted','tinyint(1) unsigned not null');
		$this->addColumn('ophtrintravitinjection_injectionuser','deleted','tinyint(1) unsigned not null');
		$this->addColumn('ophtrintravitinjection_injectionuser_version','deleted','tinyint(1) unsigned not null');
		$this->addColumn('ophtrintravitinjection_ioplowering','deleted','tinyint(1) unsigned not null');
		$this->addColumn('ophtrintravitinjection_ioplowering_version','deleted','tinyint(1) unsigned not null');
		$this->addColumn('ophtrintravitinjection_ioplowering_assign','deleted','tinyint(1) unsigned not null');
		$this->addColumn('ophtrintravitinjection_ioplowering_assign_version','deleted','tinyint(1) unsigned not null');
		$this->addColumn('ophtrintravitinjection_lens_status','deleted','tinyint(1) unsigned not null');
		$this->addColumn('ophtrintravitinjection_lens_status_version','deleted','tinyint(1) unsigned not null');
		$this->addColumn('ophtrintravitinjection_postinjection_drops','deleted','tinyint(1) unsigned not null');
		$this->addColumn('ophtrintravitinjection_postinjection_drops_version','deleted','tinyint(1) unsigned not null');
		$this->addColumn('ophtrintravitinjection_skin_drug','deleted','tinyint(1) unsigned not null');
		$this->addColumn('ophtrintravitinjection_skin_drug_version','deleted','tinyint(1) unsigned not null');
		$this->addColumn('ophtrintravitinjection_skindrug_allergy_assignment','deleted','tinyint(1) unsigned not null');
		$this->addColumn('ophtrintravitinjection_skindrug_allergy_assignment_version','deleted','tinyint(1) unsigned not null');
		$this->addColumn('ophtrintravitinjection_treatment_drug','deleted','tinyint(1) unsigned not null');
		$this->addColumn('ophtrintravitinjection_treatment_drug_version','deleted','tinyint(1) unsigned not null');
	}

	public function down()
	{
		$this->dropColumn('et_ophtrintravitinjection_anaesthetic','deleted');
		$this->dropColumn('et_ophtrintravitinjection_anteriorseg','deleted');
		$this->dropColumn('et_ophtrintravitinjection_complications','deleted');
		$this->dropColumn('et_ophtrintravitinjection_postinject','deleted');
		$this->dropColumn('et_ophtrintravitinjection_site','deleted');
		$this->dropColumn('et_ophtrintravitinjection_treatment','deleted');

		$this->dropColumn('ophtrintravitinjection_anaestheticagent','deleted');
		$this->dropColumn('ophtrintravitinjection_anaestheticdelivery','deleted');
		$this->dropColumn('ophtrintravitinjection_anaesthetictype','deleted');
		$this->dropColumn('ophtrintravitinjection_antiseptic_allergy_assignment','deleted');
		$this->dropColumn('ophtrintravitinjection_antiseptic_drug','deleted');
		$this->dropColumn('ophtrintravitinjection_complicat','deleted');
		$this->dropColumn('ophtrintravitinjection_complicat_assignment','deleted');
		$this->dropColumn('ophtrintravitinjection_injectionuser','deleted');
		$this->dropColumn('ophtrintravitinjection_ioplowering','deleted');
		$this->dropColumn('ophtrintravitinjection_ioplowering_assign','deleted');
		$this->dropColumn('ophtrintravitinjection_lens_status','deleted');
		$this->dropColumn('ophtrintravitinjection_postinjection_drops','deleted');
		$this->dropColumn('ophtrintravitinjection_skin_drug','deleted');
		$this->dropColumn('ophtrintravitinjection_skindrug_allergy_assignment','deleted');
		$this->dropColumn('ophtrintravitinjection_treatment_drug','deleted');

		$this->dropTable('et_ophtrintravitinjection_anaesthetic_version');
		$this->dropTable('et_ophtrintravitinjection_anteriorseg_version');
		$this->dropTable('et_ophtrintravitinjection_complications_version');
		$this->dropTable('et_ophtrintravitinjection_postinject_version');
		$this->dropTable('et_ophtrintravitinjection_site_version');
		$this->dropTable('et_ophtrintravitinjection_treatment_version');
		$this->dropTable('ophtrintravitinjection_anaestheticagent_version');
		$this->dropTable('ophtrintravitinjection_anaestheticdelivery_version');
		$this->dropTable('ophtrintravitinjection_anaesthetictype_version');
		$this->dropTable('ophtrintravitinjection_antiseptic_allergy_assignment_version');
		$this->dropTable('ophtrintravitinjection_antiseptic_drug_version');
		$this->dropTable('ophtrintravitinjection_complicat_version');
		$this->dropTable('ophtrintravitinjection_complicat_assignment_version');
		$this->dropTable('ophtrintravitinjection_injectionuser_version');
		$this->dropTable('ophtrintravitinjection_ioplowering_version');
		$this->dropTable('ophtrintravitinjection_ioplowering_assign_version');
		$this->dropTable('ophtrintravitinjection_lens_status_version');
		$this->dropTable('ophtrintravitinjection_postinjection_drops_version');
		$this->dropTable('ophtrintravitinjection_skin_drug_version');
		$this->dropTable('ophtrintravitinjection_skindrug_allergy_assignment_version');
		$this->dropTable('ophtrintravitinjection_treatment_drug_version');
	}
}
