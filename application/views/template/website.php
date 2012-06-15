<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> 

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo substr(I18n::$lang, 0, 2); ?>" lang="<?php echo substr(I18n::$lang, 0, 2); ?>"> 
    <head> 
        <meta http-equiv="Content-Type" content="text/html;charset=utf-8" /> 
        <meta name="language" content="<?php echo I18n::$lang ?>" /> 
        <title><?php echo $title ?></title>
        <?php foreach ($styles as $file => $type) echo HTML::style($file, array('media' => $type)), PHP_EOL ?>
        <?php foreach ($scripts as $file) echo HTML::script($file), PHP_EOL ?>
    </head>

    <body data-base="<?php echo url::base(); ?>">

        <div class="navbar navbar-fixed-top">
            <div class="navbar-inner">
                <div class="container">
                    <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </a>
                    <?php echo HTML::anchor('/home', 'Monumentzo', array('class' => 'brand')); ?>
                    <div class="nav-collapse">
                        <ul class="nav">					
							<li><?php echo HTML::anchor('/browse/index', 'Bladeren'); ?></li>
                        </ul>
                    </div>
                    <?php echo Form::open('search/query', array('method' => 'post', 'class' => 'navbar-search pull-right')); ?>
                    <?php echo Form::input('q', NULL, array('type' => 'text', 'class' => 'search-query', 'placeholder' => 'Zoeken')); ?>
		    		<?php echo Form::hidden('rsz', '20'); ?>
                    <?php echo Form::close(); ?>
                
                    
                    <ul class="nav pull-right">
                        <?php if(isset($user)) :?>
                        <li id="fat-menu" class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="icon-user icon-white"></i> <?= $user->Name ?> <b class="caret"></b>
                            </a>
                            <ul class="dropdown-menu">
                                <li><?php echo HTML::anchor('/list/view', 'Mijn monumenten'); ?></li>
                                <li><?php echo HTML::anchor('/list/read/view', 'Leeslijst'); ?></li>
                                <li class="divider"></li>
                                <li><a class='fancybox' href='#logout'>Uitloggen</a></li>
                            </ul>
                        </li>
                         <? endif; ?>
                         <?php if (isset($login)) : ?>
                         <li id="fat-menu" class="dropdown">
                             <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                 <i class="icon-user icon-white"></i> Inloggen <b class="caret"></b>
                             </a>
                             <ul class="dropdown-menu">
                                 <li><a class='fancybox' href='#login'>Inloggen</a></li>
                                 <li><a class='fancybox' href='#register'>Registreren</a></li>
                             </ul>
                         </li>
                         <? endif; ?>
                    </ul>
                    
                   
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

        <div id="content" class="container">
            <?php echo $content ?>
        </div>

		<?php echo HTML::script('assets/js/monumentzo.js'), PHP_EOL ?>
    </body>
</html>
