<?php

class m130412_095132_eye_id_null extends CDbMigration
{
	public function up()
	{
		$this->alterColumn('et_ophtrintravitinjection_postinject','eye_id','int(10) unsigned null');
	}

	public function down()
	{
		$this->alterColumn('et_ophtrintravitinjection_postinject','eye_id','int(10) unsigned not null');
	}
}
