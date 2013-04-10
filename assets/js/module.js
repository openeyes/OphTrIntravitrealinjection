
// check whether the patient suitability elements should be shown for the given eye side
function OphTrIntravitrealinjection_side_check(side) {
	if ($('#Element_OphTrIntravitrealinjection_Treatment_' + side + '_drug_id').is(":visible") &&
			$('#Element_OphTrIntravitrealinjection_Treatment_' + side + '_drug_id').val()) {
		showSplitElementSide('Element_OphTrIntravitrealinjection_PostInjectionExamination', side);
		showSplitElementSide('Element_OphTrIntravitrealinjection_Complications', side);
	}
	else {
		hideSplitElementSide('Element_OphTrIntravitrealinjection_PostInjectionExamination', side);
		hideSplitElementSide('Element_OphTrIntravitrealinjection_Complications', side);
	}
}

// check whether the description field should be shown for the complications on the given side
function OphTrIntravitrealinjection_othercomplications_check(side) {
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
		
		OphTrIntravitrealinjection_side_check(side);
	});
	
	// extend the removal behaviour for treatment drug to affect the dependent elements
	$(this).delegate('#event_content .side .activeForm a.removeSide', 'click', function(e) {
		side = getSplitElementSide($(this));
		var other_side = 'left';
		if (side == 'left') {
			other_side = 'right';
		}
		hideSplitElementSide('Element_OphTrIntravitrealinjection_PostInjectionExamination', side);
		hideSplitElementSide('Element_OphTrIntravitrealinjection_Complications', side);
		// if the other side has been revealed by this, need to check whether the dependent elements should also be shown.
		OphTrIntravitrealinjection_side_check(other_side);
	});

	// extend the adding behaviour for treatment drug to affect dependent elements
	$(this).delegate('#event_content .side .inactiveForm a', 'click', function(e) {
		side = getSplitElementSide($(this));
		OphTrIntravitrealinjection_side_check(side);
	});
	
	$('.Element_OphTrIntravitrealinjection_Complications').delegate('select.MultiSelectList', 'MultiSelectChanged', function(e) {
		var side = getSplitElementSide($(this));
		console.log(side);
		OphTrIntravitrealinjection_othercomplications_check(side);
	});
	
	// check the form is showing correctly when loaded
	OphTrIntravitrealinjection_side_check('left');
	OphTrIntravitrealinjection_side_check('right');
	// ensure we are only displaying the 'other' description if its required
	OphTrIntravitrealinjection_othercomplications_check('left');
	OphTrIntravitrealinjection_othercomplications_check('right');
		
});

function ucfirst(str) { str += ''; var f = str.charAt(0).toUpperCase(); return f + str.substr(1); }

function eDparameterListener(_drawing) {
	if (_drawing.selectedDoodle != null) {
		// handle event
	}
}
