
function OphTrIntravitrealinjection_setInjectionNumber(side) {
	var el = $('#Element_OphTrIntravitrealinjection_Treatment_' + side + '_drug_id');
	var drug_id = el.val();
	var count = 0;
	if (drug_id) {
		// work out the number of injections (previous plus one)
		count++;
		
		// get the previous count of this drug for this side
		el.find('option').each(function() {
			if ($(this).val() == drug_id) {
				if ($(this).data('original-count')) {
					count = $(this).data('original-count');
				}
				else {
					count += $(this).data('previous');
				}
				return false;
			}
		});
	}
	
	$('#Element_OphTrIntravitrealinjection_Treatment_'+side+'_number').val(count);
}

function OphTrIntravitrealinjection_hide(side) {
	hideSplitElementSide('Element_OphTrIntravitrealinjection_Anaesthetic', side);
	hideSplitElementSide('Element_OphTrIntravitrealinjection_AnteriorSegment', side);
	hideSplitElementSide('Element_OphTrIntravitrealinjection_PostInjectionExamination', side);
	hideSplitElementSide('Element_OphTrIntravitrealinjection_Complications', side);
}

function OphTrIntravitrealinjection_show(side) {
	showSplitElementSide('Element_OphTrIntravitrealinjection_Anaesthetic', side);
	showSplitElementSide('Element_OphTrIntravitrealinjection_AnteriorSegment', side);
	showSplitElementSide('Element_OphTrIntravitrealinjection_PostInjectionExamination', side);
	showSplitElementSide('Element_OphTrIntravitrealinjection_Complications', side);
}

// check whether the description field should be shown for the complications on the given side
function OphTrIntravitrealinjection_otherComplicationsCheck(side) {
	var show = false;
	$('#Element_OphTrIntravitrealinjection_Complications_'+side+'_complications').find('input').each(function(e) {
		if ($(this).data('description_required')) {
			show = true;
			return false;
		}
	});
	var el = $('#div_Element_OphTrIntravitrealinjection_Complications_'+side+'_oth_descrip');
	var input = el.find('textarea');
	
	if (show) {
		el.show();
		if (el.data('store-value') && el.data('store-value').length) {
			input.val(el.data('store-value'));
		}
	}
	else {
		$('#div_Element_OphTrIntravitrealinjection_Complications_'+side+'_oth_descrip').hide();
		if (input.val()) {
			el.data('store-value', input.val());
			input.val('');
		}
		
	}
}

$(document).ready(function() {
			handleButton($('#et_save'),function() {
					});
	
	handleButton($('#et_cancel'),function(e) {
		if (m = window.location.href.match(/\/update\/[0-9]+/)) {
			window.location.href = window.location.href.replace('/update/','/view/');
		} else {
			window.location.href = baseUrl+'/patient/episodes/'+et_patient_id;
		}
		e.preventDefault();
	});

	handleButton($('#et_deleteevent'));

	handleButton($('#et_canceldelete'),function(e) {
		if (m = window.location.href.match(/\/delete\/[0-9]+/)) {
			window.location.href = window.location.href.replace('/delete/','/view/');
		} else {
			window.location.href = baseUrl+'/patient/episodes/'+et_patient_id;
		}
		e.preventDefault();
	});

	$('select.populate_textarea').unbind('change').change(function() {
		if ($(this).val() != '') {
			var cLass = $(this).parent().parent().parent().attr('class').match(/Element.*/);
			var el = $('#'+cLass+'_'+$(this).attr('id'));
			var currentText = el.text();
			var newText = $(this).children('option:selected').text();

			if (currentText.length == 0) {
				el.text(ucfirst(newText));
			} else {
				el.text(currentText+', '+newText);
			}
		}
	});
	
	// live checking of the drug selection for treatment to determine if the other elements should be shown or not
	$('.Element_OphTrIntravitrealinjection_Treatment').delegate('#Element_OphTrIntravitrealinjection_Treatment_right_drug_id, ' +
			'#Element_OphTrIntravitrealinjection_Treatment_left_drug_id', 'change', function() {
		var side = getSplitElementSide($(this));

		OphTrIntravitrealinjection_setInjectionNumber(side);
	});
	
	// deal with the ioplowering show/hide
	$('.Element_OphTrIntravitrealinjection_Treatment').delegate(
			'#Element_OphTrIntravitrealinjection_Treatment_right_pre_ioplowering_required, ' +
			'#Element_OphTrIntravitrealinjection_Treatment_left_pre_ioplowering_required', 'change', function() {
		var side = getSplitElementSide($(this));
		if ($(this).attr('checked')) {
			$('#div_Element_OphTrIntravitrealinjection_Treatment_'+side+'_pre_ioplowering_id').removeClass('hidden');
			$('#Element_OphTrIntravitrealinjection_Treatment_'+side+'_pre_ioplowering_id').removeAttr('disabled');
		} else {
			$('#div_Element_OphTrIntravitrealinjection_Treatment_'+side+'_pre_ioplowering_id').addClass('hidden');
			$('#Element_OphTrIntravitrealinjection_Treatment_'+side+'_pre_ioplowering_id').attr('disabled', 'disabled');
		}
	});
	
	$('.Element_OphTrIntravitrealinjection_Treatment').delegate(
			'#Element_OphTrIntravitrealinjection_Treatment_right_post_ioplowering_required, ' +
			'#Element_OphTrIntravitrealinjection_Treatment_left_post_ioplowering_required', 'change', function() {
		var side = getSplitElementSide($(this));
		if ($(this).attr('checked')) {
			$('#div_Element_OphTrIntravitrealinjection_Treatment_'+side+'_post_ioplowering_id').removeClass('hidden');
			$('#Element_OphTrIntravitrealinjection_Treatment_'+side+'_post_ioplowering_id').removeAttr('disabled');
		} else {
			$('#div_Element_OphTrIntravitrealinjection_Treatment_'+side+'_post_ioplowering_id').addClass('hidden');
			$('#Element_OphTrIntravitrealinjection_Treatment_'+side+'_post_ioplowering_id').attr('disabled', 'disabled');
		}
	});
	
	// extend the removal behaviour for treatment drug to affect the dependent elements
	$(this).delegate('#event_content .side .activeForm a.removeSide', 'click', function(e) {
		side = getSplitElementSide($(this));
		var other_side = 'left';
		if (side == 'left') {
			other_side = 'right';
		}
		OphTrIntravitrealinjection_hide(side);
		OphTrIntravitrealinjection_show(other_side);
		
	});

	// extend the adding behaviour for treatment drug to affect dependent elements
	$(this).delegate('#event_content .side .inactiveForm a', 'click', function(e) {
		side = getSplitElementSide($(this));
		OphTrIntravitrealinjection_show(side);
	});
	
	$('.Element_OphTrIntravitrealinjection_Complications').delegate('select.MultiSelectList', 'MultiSelectChanged', function(e) {
		var side = getSplitElementSide($(this));
		OphTrIntravitrealinjection_otherComplicationsCheck(side);
	});
	
	OphTrIntravitrealinjection_setInjectionNumber('left');
	OphTrIntravitrealinjection_setInjectionNumber('right');
	
	// ensure we are only displaying the 'other' description if its required
	OphTrIntravitrealinjection_otherComplicationsCheck('left');
	OphTrIntravitrealinjection_otherComplicationsCheck('right');
		
});

function ucfirst(str) { str += ''; var f = str.charAt(0).toUpperCase(); return f + str.substr(1); }

function eDparameterListener(_drawing) {
	if (_drawing.selectedDoodle != null) {
		// handle event
	}
}
