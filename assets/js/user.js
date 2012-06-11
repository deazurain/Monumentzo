/**
 * login, register and logout forms through javascript using fancybox
 */

$(document).ready(function () {

	var cancelOnClick = function() {

        var form = $(this).parent().parent();
        console.log(form.find('.error-container'));
        form.find('.error-container').hide();

		parent.$.fancybox.close();
	}

	$('#login form .btn-danger').click(cancelOnClick);
	$('#logout form .btn-danger').click(cancelOnClick);
	$('#register form .btn-danger').click(cancelOnClick);

	$('#login form').submit(function() {
		var form = $(this);
		$.ajax({   
			type: "POST",
			data : form.serialize(),
			dataType : 'json',
			cache: false,  
			url: $('body').attr('data-base') + "user/login",   
			success: function(data) {
				if(data.status == "success") {
					// successfully logged in
					window.location.replace('');
				}
				else if(data.status == "fail") {
					// failed to log in
	
					var errors = data.result;
					var errorhtml = '<h4 class="alert-heading">Gelieve de volgende velden geldig in te vullen:</h4>';

                    errorhtml += '<ul>';
                    for(var i = 0, length = errors.length; i < length; i++) {
                        errorhtml += '<li>' + errors[i] + '</li>';
                    }
                    errorhtml += '</ul>';

					form.find('.error-container').html(errorhtml).show();
				}
				else {
					// unknown status
				}
			}   
		});   
		return false;   
	});

	$('#register form').submit(function() {
		var form = $(this);
		$.ajax({   
			type: "POST",
			data : form.serialize(),
			dataType : 'json',
			cache: false,  
			url: $('body').attr('data-base') + "user/register",   
			success: function(data) {
				if(data.status == "success") {
					// successfully registered
					form.html('Je bent succesvol geregistreerd onder de gebruikersnaam "' + data.result.username + '"');
					//window.location.replace('');
				}
				else if(data.status == "fail") {
					// failed to register

					var errors = data.result;
					var errorhtml = '<h4 class="alert-heading">Gelieve de volgende velden geldig in te vullen:</h4>';

                    errorhtml += '<ul>';
                    for(var i = 0, length = errors.length; i < length; i++) {
                        errorhtml += '<li>' + errors[i] + '</li>';
                    }
                    errorhtml += '</ul>';

                    form.find('.error-container').html(errorhtml).show();

				}
				else {
					// unknown status
				}
			}   
		});   
		return false;   
	});

	$('#logout form').submit(function() {
		//return false;
	});

});

