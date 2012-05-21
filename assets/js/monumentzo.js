var variables = {
    base: this.base,
    user: this.user
};

$(document).ready(function() {
    
	alert($("#loginlink").href);

	$("#loginlink").fancybox({
		width : '75%',
		height : '75%',
		autoScale : false,
		transitionIn : 'none',
		transitionOut : 'none',
		type : 'iframe'
	}); 

	/*
	Fancybox
	*/
    var fancy_options = {
        type            : 'inline',
        /*href            : '/page/login',*/
        width		: '35%',
        height		: 'auto',
        autoSize        : false,
        closeClick	: false,
        openEffect      : 'none',
        closeEffect	: 'none'
    };
    
    $('.fancybox').fancybox(fancy_options);
    
    $('.fancybox').live('click', function(event){
        event.preventDefault();
        var src = $(this);
        
        switch(src.attr('href')) {
            case '/page/login':
                $.fancybox(fancy_options);
                break;
            case '#close':
                $.fancybox.close();
                break;
        }
    });


	/*
	dropdown menu
	*/
	$('.dropdown-toggle').dropdown()
	
});
