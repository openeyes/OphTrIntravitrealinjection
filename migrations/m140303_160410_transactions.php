<?php

class m140303_160410_transactions extends CDbMigration
{
	public $tables = array('et_ophtrintravitinjection_anaesthetic','et_ophtrintravitinjection_anteriorseg','et_ophtrintravitinjection_complications','et_ophtrintravitinjection_postinject','et_ophtrintravitinjection_site','et_ophtrintravitinjection_treatment','ophtrintravitinjection_anaestheticagent','ophtrintravitinjection_anaestheticdelivery','ophtrintravitinjection_anaesthetictype','ophtrintravitinjection_antiseptic_allergy_assignment','ophtrintravitinjection_antiseptic_drug','ophtrintravitinjection_complicat_assignment','ophtrintravitinjection_complicat','ophtrintravitinjection_injectionuser','ophtrintravitinjection_ioplowering_assign','ophtrintravitinjection_ioplowering','ophtrintravitinjection_lens_status','ophtrintravitinjection_postinjection_drops','ophtrintravitinjection_skin_drug','ophtrintravitinjection_skindrug_allergy_assignment','ophtrintravitinjection_treatment_drug');

	public function up()
	{
		foreach ($this->tables as $table) {
			$this->addColumn($table,'hash','varchar(40) not null');
			$this->addColumn($table,'transaction_id','int(10) unsigned null');
			$this->createIndex($table.'_tid',$table,'transaction_id');
			$this->addForeignKey($table.'_tid',$table,'transaction_id','transaction','id');
			$this->addColumn($table,'conflicted','tinyint(1) unsigned not null');

			$this->addColumn($table.'_version','hash','varchar(40) not null');
			$this->addColumn($table.'_version','transaction_id','int(10) unsigned null');
			$this->addColumn($table.'_version','deleted_transaction_id','int(10) unsigned null');
			$this->createIndex($table.'_vtid',$table.'_version','transaction_id');
			$this->addForeignKey($table.'_vtid',$table.'_version','transaction_id','transaction','id');
			$this->createIndex($table.'_dtid',$table.'_version','deleted_transaction_id');
			$this->addForeignKey($table.'_dtid',$table.'_version','deleted_transaction_id','transaction','id');
			$this->addColumn($table.'_version','conflicted','tinyint(1) unsigned not null');
		}
	}

	public function down()
	{
		foreach ($this->tables as $table) {
			$this->dropColumn($table,'hash');
			$this->dropForeignKey($table.'_tid',$table);
			$this->dropIndex($table.'_tid',$table);
			$this->dropColumn($table,'transaction_id');
			$this->dropColumn($table,'conflicted');

			$this->dropColumn($table.'_version','hash');
			$this->dropForeignKey($table.'_vtid',$table.'_version');
			$this->dropIndex($table.'_vtid',$table.'_version');
			$this->dropColumn($table.'_version','transaction_id');
			$this->dropForeignKey($table.'_dtid',$table.'_version');
			$this->dropIndex($table.'_dtid',$table.'_version');
			$this->dropColumn($table.'_version','deleted_transaction_id');
			$this->dropColumn($table.'_version','conflicted');
		}
	}
}
