<h1 class="badge">Reports</h1>
<div class="row">
	<div class="large-11 small-11 small-centered large-centered column">
		<div class="panel">
			<h2>Intravitreal Injection Report</h2>
			<form>
				<div class="row field-row">
					<div class="large-2 column">
						<?php echo CHtml::label('Date From', 'date_from') ?>
					</div>
					<div class="large-4 column end">
						<?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
										'name'=>'date_from',
										'id'=>'date_from',
										'options'=>array(
												'showAnim'=>'fold',
												'dateFormat'=>Helper::NHS_DATE_FORMAT_JS,
												'maxDate'=> 0,
												'defaultDate' => "-1y"
										),
										'value'=> $date_from
								))?>
					</div>
				</div>
				<div class="row field-row">
					<div class="large-2 column">
						<?php echo CHtml::label('Date To', 'date_to') ?>
					</div>
					<div class="large-4 column end">
						<?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
										'name'=>'date_to',
										'id'=>'date_to',
										'options'=>array(
												'showAnim'=>'fold',
												'dateFormat'=>Helper::NHS_DATE_FORMAT_JS,
												'maxDate'=> 0,
												'defaultDate' => 0
										),
										'value'=> $date_to
								))?>
					</div>
				</div>

				<div class="row field-row">
					<div class="large-2 column">
						<?php echo CHtml::label('Injection User(s)', 'injection_user_ids') ?>
					</div>
					<div class="large-4 column end">
						<?php $this->widget('application.widgets.MultiSelectList', array(
										'field' => 'injection_user_ids',
										'default_options' => @$_GET['injection_user_ids'],
										'options' => CHtml::listData($injection_users, 'id','fullName'),
										'htmlOptions' => array('empty' => '- Please Select -', 'nowrapper' => true),
										'noSelectionsMessage' => 'All Injectors')
						); ?>
					</div>
				</div>

				<div class="row field-row">
					<div class="large-2 column">
						<?php echo CHtml::label('Summarise patient data', 'summary') ?>
					</div>
					<div class="large-4 column end">
						<?php echo CHtml::checkBox('summary'); ?>
					</div>
				</div>


				<div class="row field-row non-summary">
					<div class="large-2 column">
						<?php echo CHtml::label('Complications', 'complications') ?>
					</div>
					<div class="large-4 column end">
						<?php echo CHtml::checkBox('complications'); ?>
					</div>
				</div>

				<div class="row field-row non-summary">
					<div class="large-2 column">
						<?php echo CHtml::label('Lens Status', 'lens_status') ?>
					</div>
					<div class="large-4 column end">
						<?php echo CHtml::checkBox('lens_status'); ?>
					</div>
				</div>

				<h3>Examination Information</h3>
				<div class="row field-row non-summary">
					<div class="large-2 column">
						<?php echo CHtml::label('Pre injection VA', 'pre_va') ?>
					</div>
					<div class="large-4 column end">
						<?php echo CHtml::checkBox('pre_va'); ?>
					</div>
				</div>
				<div class="row field-row non-summary">
					<div class="large-2 column">
						<?php echo CHtml::label('Post injection VA', 'post_va') ?>
					</div>
					<div class="large-4 column end">
						<?php echo CHtml::checkBox('post_va'); ?>
					</div>
				</div>
				<div class="row field-row non-summary">
					<div class="large-2 column">
						<?php echo CHtml::label('Injection Management Diagnoses', 'diagnoses') ?>
					</div>
					<div class="large-4 column end">
						<?php echo CHtml::checkBox('diagnoses'); ?>
					</div>
				</div>
				<div class="row field-row">
					<div class="large-2 column">
						&nbsp;
					</div>
					<div class="large-4 column end">
						<?php echo CHtml::submitButton('Generate Report') ?>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
