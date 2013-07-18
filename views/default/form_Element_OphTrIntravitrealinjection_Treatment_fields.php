<?php
/**
 * OpenEyes
 *
 * (C) Moorfields Eye Hospital NHS Foundation Trust, 2008-2011
 * (C) OpenEyes Foundation, 2011-2013
 * This file is part of OpenEyes.
 * OpenEyes is free software: you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation, either version 3 of the License, or (at your option) any later version.
 * OpenEyes is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details.
 * You should have received a copy of the GNU General Public License along with OpenEyes in a file titled COPYING. If not, see <http://www.gnu.org/licenses/>.
 *
 * @package OpenEyes
 * @link http://www.openeyes.org.uk
 * @author OpenEyes <info@openeyes.org.uk>
 * @copyright Copyright (c) 2008-2011, Moorfields Eye Hospital NHS Foundation Trust
 * @copyright Copyright (c) 2011-2013, OpenEyes Foundation
 * @license http://www.gnu.org/licenses/gpl-3.0.html The GNU General Public License V3.0
 */
?>

<?php echo $form->dropDownList($element, $side . '_pre_antisept_drug_id', CHtml::listData(OphTrIntravitrealinjection_AntiSepticDrug::model()->findAll(array('order' => 'display_order asc')), 'id', 'name'), array('empty' => '- Please select -')); ?>

<?php echo $form->dropDownList($element, $side . '_pre_skin_drug_id', CHtml::listData(OphTrIntravitrealinjection_SkinDrug::model()->findAll(array('order' => 'display_order asc')), 'id', 'name'), array('empty' => '- Please select -')); ?>

<div id="div_<?php echo get_class($element)?>_<?php echo $side ?>_pre_ioplowering_required"
	class="eventDetail">
	<div class="label">
		<?php echo $element->getAttributeLabel($side . '_pre_ioplowering_required') ?>:
	</div>
	<div class="data">
		<?php
			echo $form->checkbox($element, $side . '_pre_ioplowering_required', array('nowrapper' => true));
		?>
	</div>
</div>

<?php
$show = $element->{ $side . '_pre_ioplowering_required'};
if (isset($_POST[get_class($element)])) {
	$show = $_POST[get_class($element)][$side . '_pre_ioplowering_required'];
}
?>


<div id="div_<?php echo get_class($element)?>_<?php echo $side ?>_pre_ioplowering_id"
	class="eventDetail<?php if (!$show) { echo " hidden"; } ?>">
	<div class="label">
		<?php echo $element->getAttributeLabel($side . '_pre_ioplowering_id') ?>:
	</div>
	<div class="data">
		<?php echo $form->dropDownList($element, $side . '_pre_ioplowering_id',
				CHtml::listData(OphTrIntravitrealinjection_IOPLoweringDrug::model()->findAll(array('order' => 'display_order asc')), 'id', 'name'),
				array('empty' => '- Please select -', 'nowrapper' => true)); ?>
	</div>
</div>

<?php

$drugs = OphTrIntravitrealinjection_Treatment_Drug::model()->findAll(array('order'=> 'display_order asc'));
$html_options = array(
	'empty' => '- Please select -',
	'options' => array(),
);
// get the previous injection counts for each of the drug options for this eye
foreach ($drugs as $drug) {
	$previous = $injection_api->previousInjections($this->patient, $episode, $side, $drug);
	$count = 0;
	if (sizeof($previous)) {
		$count = $previous[0][$side . '_number'];
	}
 	$html_options['options'][$drug->id] = array(
		'data-previous' => $count,
		'data-history' => CJSON::encode($previous),
	);
	// if this is an edit, we want to know what the original count was so that we don't replace it
	if ($element->{$side . '_drug_id'} && $element->{$side . '_drug_id'} == $drug->id) {
		$html_options['options'][$drug->id]['data-original-count'] = $element->{$side . '_number'};
	}
}

echo $form->dropDownList($element, $side . '_drug_id', CHtml::listData($drugs,'id','name'),$html_options)
?>

<?php echo $form->textField($element, $side . '_number', array('size' => '10'))?>
<?php echo $form->textField($element, $side . '_batch_number', array('size' => '32'))?>
<?php
if ($element->created_date) {
	$expiry_date_params = array('minDate' => Helper::convertDate2NHS($element->created_date) );
} else {
	$expiry_date_params = array('minDate' => 'yesterday');
}
?>

<?php echo $form->datePicker($element, $side . '_batch_expiry_date', $expiry_date_params, array('style'=>'width: 110px;'))?>

<?php echo $form->dropDownList($element, $side . '_injection_given_by_id', CHtml::listData(OphTrIntravitrealinjection_InjectionUser::model()->getUsers(),'id','ReversedFullName'),array('empty'=>'- Please select -'))?>

<div id="div_<?php echo get_class($element)?>_<?php echo $side ?>_injection_time"
	class="eventDetail">
	<div class="label">
		<?php echo $element->getAttributeLabel($side . '_injection_time') ?>:
	</div>
	<div class="data">
		<?php
			$val = date('H:i',strtotime($element->{$side . '_injection_time'}));
			if (isset($_POST[get_class($element)])) {
				$val = $_POST[get_class($element)][$side . '_injection_time'];
			}
			echo CHtml::textField(get_class($element) . "[".$side."_injection_time]", $val, array('size' => 6));
		?>
	</div>
</div>

<div id="div_<?php echo get_class($element)?>_<?php echo $side ?>_post_ioplowering_required"
	class="eventDetail">
	<div class="label">
		<?php echo $element->getAttributeLabel($side . '_post_ioplowering_required') ?>:
	</div>
	<div class="data">
		<?php
			echo $form->checkbox($element, $side . '_post_ioplowering_required', array('nowrapper' => true));
		?>
	</div>
</div>

<?php
$show = $element->{ $side . '_post_ioplowering_required'};
if (isset($_POST[get_class($element)])) {
	$show = $_POST[get_class($element)][$side . '_post_ioplowering_required'];
}
?>

<div id="div_<?php echo get_class($element)?>_<?php echo $side ?>_post_ioplowering_id"
	class="eventDetail
	<?php if (!$show) { echo " hidden"; } ?>">
	<div class="label">
		<?php echo $element->getAttributeLabel($side . '_post_ioplowering_id') ?>:
	</div>
	<div class="data">
		<?php echo $form->dropDownList($element, $side . '_post_ioplowering_id',
				CHtml::listData(OphTrIntravitrealinjection_IOPLoweringDrug::model()->findAll(array('order' => 'display_order asc')), 'id', 'name'),
				array('empty' => '- Please select -', 'nowrapper' => true)); ?>
	</div>
</div>
