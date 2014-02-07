<?php

class m140207_085103_remove_soft_deletion_from_models_that_dont_need_it extends CDbMigration
{
	public $tables = array(
		'et_ophtrintravitinjection_anaesthetic',
		'et_ophtrintravitinjection_anteriorseg',
		'et_ophtrintravitinjection_complications',
		'et_ophtrintravitinjection_postinject',
		'et_ophtrintravitinjection_site',
		'et_ophtrintravitinjection_treatment',
		'ophtrintravitinjection_anaestheticagent',
		'ophtrintravitinjection_anaestheticdelivery',
		'ophtrintravitinjection_anaesthetictype',
		'ophtrintravitinjection_antiseptic_allergy_assignment',
		'ophtrintravitinjection_complicat_assignment',
		'ophtrintravitinjection_injectionuser',
		'ophtrintravitinjection_ioplowering_assign',
		'ophtrintravitinjection_skindrug_allergy_assignment',
	);

	public function up()
	{
		foreach ($this->tables as $table) {
			$this->dropColumn($table,'deleted');
			$this->dropColumn($table.'_version','deleted');

			$this->dropForeignKey("{$table}_aid_fk",$table."_version");
		}
	}

	public function down()
	{
		foreach ($this->tables as $table) {
			$this->addColumn($table,'deleted','tinyint(1) unsigned not null');
			$this->addColumn($table."_version",'deleted','tinyint(1) unsigned not null');

			$this->addForeignKey("{$table}_aid_fk",$table."_version","id",$table,"id");
		}
	}
}
