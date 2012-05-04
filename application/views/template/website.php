<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo substr(I18n::$lang, 0, 2); ?>" lang="<?php echo substr(I18n::$lang, 0, 2); ?>"> 
    <head> 
        <meta http-equiv="Content-Type" content="text/html;charset=utf-8" /> 
        <meta name="language" content="<?php echo I18n::$lang ?>" /> 
        <title><?php echo $title ?></title>
        <?php foreach ($styles as $file => $type) echo HTML::style($file, array('media' => $type)), PHP_EOL ?>
        <?php foreach ($scripts as $file) echo HTML::script($file), PHP_EOL ?>
    </head>

    <body>

        <div class="navbar navbar-fixed-top">
            <div class="navbar-inner">
                <div class="container">
                    <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </a>
                    <?php echo html::anchor("home", "Monumentzo", array("class" =>"brand")); ?>
                    <div class="nav-collapse">
                        <ul class="nav">
                            <li class="active"></li>
                            <li><a class="fancybox" href="#login">Inloggen</a></li>
                            <li><a class="fancybox" href="#register">Registreren</a></li>
                        </ul>
                    </div><!--/.nav-collapse -->
                </div>
            </div>
        </div>

        <div id="fancy_login" style="display:none">
            <?php echo View::factory('user/login'); ?>
        </div>

        <div id="fancy_register" style="display:none">
            <?php echo View::factory('user/register'); ?>
        </div>


        <div class="container">
            <?php echo $content ?>
        </div>

        <script type="text/javascript" src="/assets/js/monumentzo.js"></script>
    </body>
</html>
