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
                    <a class="brand" href="/home">Monumentzo</a>
                    <div class="nav-collapse">
                        <ul class="nav">
                            <?php if (isset($login)) echo "<li><a class='fancybox' href='#login'>Inloggen</a></li>" ?>
                            <?php if (isset($register)) echo "<li><a class='fancybox' href='#register'>Registreren</a></li>" ?>
                            <?php if (isset($logout)) echo "<li><a class='fancybox' href='#logout'>Uitloggen</a></li>" ?>
														
							<li><?php echo HTML::anchor('/browse/index', 'Browse'); ?></li>
                        </ul>
                    </div>
                    <?php echo Form::open('search/query', array('method' => 'post', 'class' => 'navbar-search pull-right')); ?>
                    <?php echo Form::input('q', NULL, array('type' => 'text', 'class' => 'search-query', 'placeholder' => 'Search')); ?>
		    		<?php echo Form::hidden('rsz', '10'); ?>
                    <?php echo Form::close(); ?>
                </div>
            </div>
        </div>

        <?php
            if (isset($login)) {
                echo "<div id='login' style='display:none'>" . $login . "</div>";
            }
        ?>
        
        <?php
            if (isset($register)) {
                echo "<div id='register' style='display:none'>" . $register . "</div>";
            }
        ?>
 
        <?php
            if (isset($logout)) {
                echo "<div id='logout' style='display:none'>" . $logout . "</div>";
            }
        ?>


        <div class="container">
            <?php echo $content ?>
        </div>

        <script type="text/javascript" src="/assets/js/monumentzo.js"></script>
    </body>
</html>
