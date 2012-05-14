$(document).ready(function() {
    

	/*
	Fancybox
	*/
    var fancy_options = {
        width		: '35%',
        height		: '60%',
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