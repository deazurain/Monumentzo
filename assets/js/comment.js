/**
 * comment javascript
 */

$(document).ready(function () {

	var cancelOnClick = function() {

        var form = $(this).closest("form");

        form.find('.error-container').hide();
        form.find('.success-container').hide();

		parent.$.fancybox.close();

	}

	$('form#create-comment .btn-danger').click(cancelOnClick);

	$('form#create-comment').submit(function(e) {

        e.preventDefault();

		var form = $(this);

		$.ajax({   
			type: "POST",
			data : form.serialize(),
			dataType : 'json',
			cache: false,  
			url: "/ajax/comment/create",
			success: function(data) {
				if(data.status == "success") {
					// successfully logged in
					form.find('.success-container').html('Uw commentaar is succesvol geplaatst').show();
                    console.log($('#comment-container'));
                    $('#comment-container').append(data.result);
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
                    alert('Unknown status in json response: \'' + data.status + '\'');
				}
			}   
		});   
		return false;   
	});


});

