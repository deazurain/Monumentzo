$(document).ready(function() {
    var login_options = {
        width		: '60%',
        height		: '60%',
        autoSize         : false,
        closeClick	: false,
        openEffect       : 'none',
        closeEffect	: 'none'
    };
   
    $('.fancybox').live('click', function(event) {
        event.preventDefault();
        var src = $(this);
       
        switch(src.attr('href')) {
            case '#login':
                $.fancybox($(fancy_login), login_options);
                break;
            case '#register':
                $.fancybox($(fancy_register), login_options);
                break;
            case '#close':
                $.fancybox.close();
                break;
        }
    }); 
});