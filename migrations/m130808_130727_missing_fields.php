<?php

class m130808_130727_missing_fields extends CDbMigration
{
	public function up()
	{
		$this->addColumn('ophtrintravitinjection_anaestheticagent','created_user_id','int(10) unsigned NOT NULL DEFAULT 1');
		$this->addForeignKey('ophtrintravitinjection_anaestheticagent_cui_fk','ophtrintravitinjection_anaestheticagent','created_user_id','user','id');
		$this->addColumn('ophtrintravitinjection_anaestheticagent','last_modified_user_id','int(10) unsigned NOT NULL DEFAULT 1');
		$this->addForeignKey('ophtrintravitinjection_anaestheticagent_lmui_fk','ophtrintravitinjection_anaestheticagent','last_modified_user_id','user','id');
		$this->addColumn('ophtrintravitinjection_anaestheticagent','created_date',"datetime NOT NULL DEFAULT '1900-01-01 00:00:00'");
		$this->addColumn('ophtrintravitinjection_anaestheticagent','last_modified_date',"datetime NOT NULL DEFAULT '1900-01-01 00:00:00'");

		$this->addColumn('ophtrintravitinjection_anaestheticdelivery','created_user_id','int(10) unsigned NOT NULL DEFAULT 1');
		$this->addForeignKey('ophtrintravitinjection_anaestheticdelivery_cui_fk','ophtrintravitinjection_anaestheticdelivery','created_user_id','user','id');
		$this->addColumn('ophtrintravitinjection_anaestheticdelivery','last_modified_user_id','int(10) unsigned NOT NULL DEFAULT 1');
		$this->addForeignKey('ophtrintravitinjection_anaestheticdelivery_lmui_fk','ophtrintravitinjection_anaestheticdelivery','last_modified_user_id','user','id');
		$this->addColumn('ophtrintravitinjection_anaestheticdelivery','created_date',"datetime NOT NULL DEFAULT '1900-01-01 00:00:00'");
		$this->addColumn('ophtrintravitinjection_anaestheticdelivery','last_modified_date',"datetime NOT NULL DEFAULT '1900-01-01 00:00:00'");

		$this->addColumn('ophtrintravitinjection_anaesthetictype','created_user_id','int(10) unsigned NOT NULL DEFAULT 1');
		$this->addForeignKey('ophtrintravitinjection_anaesthetictype_cui_fk','ophtrintravitinjection_anaesthetictype','created_user_id','user','id');
		$this->addColumn('ophtrintravitinjection_anaesthetictype','last_modified_user_id','int(10) unsigned NOT NULL DEFAULT 1');
		$this->addForeignKey('ophtrintravitinjection_anaesthetictype_lmui_fk','ophtrintravitinjection_anaesthetictype','last_modified_user_id','user','id');
		$this->addColumn('ophtrintravitinjection_anaesthetictype','created_date',"datetime NOT NULL DEFAULT '1900-01-01 00:00:00'");
		$this->addColumn('ophtrintravitinjection_anaesthetictype','last_modified_date',"datetime NOT NULL DEFAULT '1900-01-01 00:00:00'");

		$this->addColumn('ophtrintravitinjection_injectionuser','created_user_id','int(10) unsigned NOT NULL DEFAULT 1');
		$this->addForeignKey('ophtrintravitinjection_injectionuser_cui_fk','ophtrintravitinjection_injectionuser','created_user_id','user','id');
		$this->addColumn('ophtrintravitinjection_injectionuser','last_modified_user_id','int(10) unsigned NOT NULL DEFAULT 1');
		$this->addForeignKey('ophtrintravitinjection_injectionuser_lmui_fk','ophtrintravitinjection_injectionuser','last_modified_user_id','user','id');
		$this->addColumn('ophtrintravitinjection_injectionuser','created_date',"datetime NOT NULL DEFAULT '1900-01-01 00:00:00'");
		$this->addColumn('ophtrintravitinjection_injectionuser','last_modified_date',"datetime NOT NULL DEFAULT '1900-01-01 00:00:00'");
	}

	public function down()
	{
		$this->dropForeignKey('ophtrintravitinjection_anaestheticagent_cui_fk','ophtrintravitinjection_anaestheticagent');
		$this->dropColumn('ophtrintravitinjection_anaestheticagent','created_user_id');
		$this->dropForeignKey('ophtrintravitinjection_anaestheticagent_lmui_fk','ophtrintravitinjection_anaestheticagent');
		$this->dropColumn('ophtrintravitinjection_anaestheticagent','last_modified_user_id');
		$this->dropColumn('ophtrintravitinjection_anaestheticagent','created_date');
		$this->dropColumn('ophtrintravitinjection_anaestheticagent','last_modified_date');

		$this->dropForeignKey('ophtrintravitinjection_anaestheticdelivery_cui_fk','ophtrintravitinjection_anaestheticdelivery');
		$this->dropColumn('ophtrintravitinjection_anaestheticdelivery','created_user_id');
		$this->dropForeignKey('ophtrintravitinjection_anaestheticdelivery_lmui_fk','ophtrintravitinjection_anaestheticdelivery');
		$this->dropColumn('ophtrintravitinjection_anaestheticdelivery','last_modified_user_id');
		$this->dropColumn('ophtrintravitinjection_anaestheticdelivery','created_date');
		$this->dropColumn('ophtrintravitinjection_anaestheticdelivery','last_modified_date');

		$this->dropForeignKey('ophtrintravitinjection_anaesthetictype_cui_fk','ophtrintravitinjection_anaesthetictype');
		$this->dropColumn('ophtrintravitinjection_anaesthetictype','created_user_id');
		$this->dropForeignKey('ophtrintravitinjection_anaesthetictype_lmui_fk','ophtrintravitinjection_anaesthetictype');
		$this->dropColumn('ophtrintravitinjection_anaesthetictype','last_modified_user_id');
		$this->dropColumn('ophtrintravitinjection_anaesthetictype','created_date');
		$this->dropColumn('ophtrintravitinjection_anaesthetictype','last_modified_date');

		$this->dropForeignKey('ophtrintravitinjection_injectionuser_cui_fk','ophtrintravitinjection_injectionuser');
		$this->dropColumn('ophtrintravitinjection_injectionuser','created_user_id');
		$this->dropForeignKey('ophtrintravitinjection_injectionuser_lmui_fk','ophtrintravitinjection_injectionuser');
		$this->dropColumn('ophtrintravitinjection_injectionuser','last_modified_user_id');
		$this->dropColumn('ophtrintravitinjection_injectionuser','created_date');
		$this->dropColumn('ophtrintravitinjection_injectionuser','last_modified_date');
	}
}
