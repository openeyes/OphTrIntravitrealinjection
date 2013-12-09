<?php

class m131206_150664_soft_deletion extends CDbMigration
{
	public function up()
	{
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
	}

	public function down()
	{
		$this->dropColumn('et_ophtrintravitinjection_anaesthetic','deleted');
		$this->dropColumn('et_ophtrintravitinjection_anaesthetic_version','deleted');
		$this->dropColumn('et_ophtrintravitinjection_anteriorseg','deleted');
		$this->dropColumn('et_ophtrintravitinjection_anteriorseg_version','deleted');
		$this->dropColumn('et_ophtrintravitinjection_complications','deleted');
		$this->dropColumn('et_ophtrintravitinjection_complications_version','deleted');
		$this->dropColumn('et_ophtrintravitinjection_postinject','deleted');
		$this->dropColumn('et_ophtrintravitinjection_postinject_version','deleted');
		$this->dropColumn('et_ophtrintravitinjection_site','deleted');
		$this->dropColumn('et_ophtrintravitinjection_site_version','deleted');
		$this->dropColumn('et_ophtrintravitinjection_treatment','deleted');
		$this->dropColumn('et_ophtrintravitinjection_treatment_version','deleted');
	}
}
