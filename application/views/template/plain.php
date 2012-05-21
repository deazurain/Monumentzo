<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> 

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo substr(I18n::$lang, 0, 2); ?>" lang="<?php echo substr(I18n::$lang, 0, 2); ?>"> 
    <head> 
        <meta http-equiv="Content-Type" content="text/html;charset=utf-8" /> 
        <meta name="language" content="<?php echo I18n::$lang ?>" /> 
        <title><?php echo $title ?></title>
        <?php foreach ($styles as $file => $type) { echo HTML::style($file, array('media' => $type)); } ?>
    </head>

    <body data-base="<?php echo url::base(); ?>">

				<?php echo $content ?>

				<div class="scripts">
					<!-- add the scripts last to make the page load faster -->
					<?php foreach ($scripts as $file) { echo HTML::script($file), PHP_EOL; } ?>
				</div>

    </body>
</html>
