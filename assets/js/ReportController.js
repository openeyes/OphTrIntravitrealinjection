$(document).ready(function() {
	$(this).on('change', '#summary', function() {
		if ($(this).is(":checked")) {
			$('.non-summary').find('input').each(function() {
				$(this).prop('disabled', true);
			});
		} else {
			$('.non-summary').find('input').each(function() {
				$(this).prop('disabled', false);
			});
		}
	});
});