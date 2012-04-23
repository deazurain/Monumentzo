<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>
	<?php echo isset($title) ? $title : 'Register' ?>
</title>
</head>

<body>

<?php echo Form::open(NULL, array('method' => 'post')); ?>
<dl>
    <dt><?php echo Form::label('username', 'User') ?></dt>
    <dd><?php echo Form::input('username') ?></dd>
    <dt><?php echo Form::label('password', 'Pwd') ?></dt>
    <dd><?php echo Form::password('password') ?></dd>
    <dt><?php echo Form::label('password2', 'Pwd2') ?></dt>
    <dd><?php echo Form::password('password2') ?></dd>
</dl>
<p><?php echo Form::submit(NULL, 'register'); ?></p>
<?php echo Form::close(); ?>

<?php if(isset($errors)) echo $errors; ?>

</body>
</html>