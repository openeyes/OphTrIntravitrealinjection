<?php

class m131204_163622_table_versioning extends OEMigration
{
	public function up()
	{
		$this->addColumn('ophtrintravitinjection_antiseptic_drug', 'active', 'boolean not null default true');
		$this->addColumn('ophtrintravitinjection_complicat', 'active', 'boolean not null default true');
		$this->addColumn('ophtrintravitinjection_ioplowering', 'active', 'boolean not null default true');
		$this->addColumn('ophtrintravitinjection_lens_status', 'active', 'boolean not null default true');
		$this->addColumn('ophtrintravitinjection_postinjection_drops', 'active', 'boolean not null default true');
		$this->addColumn('ophtrintravitinjection_skin_drug', 'active', 'boolean not null default true');

		$this->renameColumn('ophtrintravitinjection_treatment_drug', 'available', 'active');
	}

	public function down()
	{
		$this->renameColumn('ophtrintravitinjection_treatment_drug', 'active', 'available');

		$this->dropColumn('ophtrintravitinjection_antiseptic_drug', 'active');
		$this->dropColumn('ophtrintravitinjection_complicat', 'active');
		$this->dropColumn('ophtrintravitinjection_ioplowering', 'active');
		$this->dropColumn('ophtrintravitinjection_lens_status', 'active');
		$this->dropColumn('ophtrintravitinjection_postinjection_drops', 'active');
		$this->dropColumn('ophtrintravitinjection_skin_drug', 'active');
	}
}
