var variables = {
    base: this.base,
    user: this.user
};

$(document).ready(function() {

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
