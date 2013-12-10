<?php

class m131210_144549_soft_deletion extends CDbMigration
{
	public function up()
	{
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
		$this->dropColumn('ophtrintravitinjection_anaestheticagent','deleted');
		$this->dropColumn('ophtrintravitinjection_anaestheticagent_version','deleted');
		$this->dropColumn('ophtrintravitinjection_anaestheticdelivery','deleted');
		$this->dropColumn('ophtrintravitinjection_anaestheticdelivery_version','deleted');
		$this->dropColumn('ophtrintravitinjection_anaesthetictype','deleted');
		$this->dropColumn('ophtrintravitinjection_anaesthetictype_version','deleted');
		$this->dropColumn('ophtrintravitinjection_antiseptic_allergy_assignment','deleted');
		$this->dropColumn('ophtrintravitinjection_antiseptic_allergy_assignment_version','deleted');
		$this->dropColumn('ophtrintravitinjection_antiseptic_drug','deleted');
		$this->dropColumn('ophtrintravitinjection_antiseptic_drug_version','deleted');
		$this->dropColumn('ophtrintravitinjection_complicat','deleted');
		$this->dropColumn('ophtrintravitinjection_complicat_version','deleted');
		$this->dropColumn('ophtrintravitinjection_complicat_assignment','deleted');
		$this->dropColumn('ophtrintravitinjection_complicat_assignment_version','deleted');
		$this->dropColumn('ophtrintravitinjection_injectionuser','deleted');
		$this->dropColumn('ophtrintravitinjection_injectionuser_version','deleted');
		$this->dropColumn('ophtrintravitinjection_ioplowering','deleted');
		$this->dropColumn('ophtrintravitinjection_ioplowering_version','deleted');
		$this->dropColumn('ophtrintravitinjection_ioplowering_assign','deleted');
		$this->dropColumn('ophtrintravitinjection_ioplowering_assign_version','deleted');
		$this->dropColumn('ophtrintravitinjection_lens_status','deleted');
		$this->dropColumn('ophtrintravitinjection_lens_status_version','deleted');
		$this->dropColumn('ophtrintravitinjection_postinjection_drops','deleted');
		$this->dropColumn('ophtrintravitinjection_postinjection_drops_version','deleted');
		$this->dropColumn('ophtrintravitinjection_skin_drug','deleted');
		$this->dropColumn('ophtrintravitinjection_skin_drug_version','deleted');
		$this->dropColumn('ophtrintravitinjection_skindrug_allergy_assignment','deleted');
		$this->dropColumn('ophtrintravitinjection_skindrug_allergy_assignment_version','deleted');
		$this->dropColumn('ophtrintravitinjection_treatment_drug','deleted');
		$this->dropColumn('ophtrintravitinjection_treatment_drug_version','deleted');
	}
}
