var variables = {
    base: this.base,
    user: this.user
};

$(document).ready(function() {
    
	$("#loginlink").fancybox({
		width : '35%',
		height : 'auto',
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
        width		: '35%',
        height		: 'auto',
        autoSize        : false,
        closeClick	: false,
        openEffect      : 'none',
        closeEffect	: 'none'
    };
    
    $('.fancybox').fancybox(fancy_options);

    /*
	dropdown menu
    */
    $('.dropdown-toggle').dropdown()
	
});
