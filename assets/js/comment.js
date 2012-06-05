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

	var removeCommentAction = function(element) {

		var comment = $(this).closest(".comment");

		var model_id = comment.attr('model-id');

		$.ajax({
			type: "POST",
			data : {
				'CommentID' : model_id,
			},
			dataType : 'json',
			cache: false,
			url: "/ajax/comment/remove",
			success: function(data) {
				if(data.status == "success") {

					comment.remove();

				}
				else if(data.status == "fail") {
					// failed to remove

					// silently ignore because the button to delete should not even appear
					// when you are not the owner of the comment.
				}
				else {
					// unknown status
					alert('Unknown status in json response: \'' + data.status + '\'');
				}
			}

		});

	}

	var comment_initialize = function(key, comment) {

		comment = $(comment);

		var hideCommentActions = function(element) {
			$(this).find('.actions').hide();
		}
		var showCommentActions = function(element) {
			console.log(this);
			$(this).find('.actions').show();
		}

		comment.hover(showCommentActions, hideCommentActions);

		var actions = comment.find('.actions');

		actions.find('.btn-danger').click(removeCommentAction);

	}

	// apply comment button registering to all comments on the page.
	$('#comment-list .comment').each(comment_initialize);

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

					var comment_list = $('#comment-list');
					var comments = comment_list.find('.comment');
					var comment = $(data.result);

					if(comments.length === 0) {
						comment_list.empty();
					}

					comment_list.append(data.result);
					comment_initialize(null, comment);
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

