var PlayersEdit = {

	validateTournament: function(){
		var thisForm = $('#tournament-form');

		thisForm.validate({
			errorElement: 'span', //default input error message container
			errorClass: 'help-block', // default input error message class
			focusInvalid: false, // do not focus the last invalid input
			rules: {
				ValidationRules,
			},

			invalidHandler: function(event, validator) { //display error alert on form submit
				//$('.alert-danger', $('.login-form')).show();
			},

			highlight: function(element) { // hightlight error inputs
				$(element)
					.closest('.form-group').addClass('has-error'); // set error class to the control group
			},

			success: function(label) {
				label.closest('.form-group').removeClass('has-error');
				label.remove();
			},

			errorPlacement: function(error, element) {
				if (element.attr('id') == 'profile_picture') {
					error.insertAfter('.fileinput.fileinput-exists');
				} else {
					error.insertAfter(element);
				}
			},

			submitHandler: function(form) {
				$('#PlayerBirthday').val($('#PlayerBirthday').val().split('/').reverse().join('-'))

				if(!isNaN($('#PlayerBirthday').val())){
					form.submit();
				}
			}
		});

		//Make for submitable by press enter
		thisForm.find('input').keypress(function(e) {
			if (e.which == 13) {
				if (thisForm.validate().form()) {
					thisForm.submit();
				}
				return false;
			}
		});
	},

	handleDatePicker: function(){
		if (jQuery().datepicker) {
			$('.datepicker').datepicker({
				rtl: Metrobox.isRTL(),
				language: 'es',
				format: 'yyyy-mm-dd',
				orientation: "left",
				autoclose: true
			});
		}
	},

	init: function(){
		PlayersEdit.handleDatePicker();
		PlayersEdit.validateTournament();
	},
}