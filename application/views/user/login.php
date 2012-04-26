<?php echo Form::open(NULL, array('method' => 'post')); ?>
<dl>
    <dt><?php echo Form::label('username', 'User') ?></dt>
    <dd><?php echo Form::input('username') ?></dd>
    <dt><?php echo Form::label('password', 'Pwd') ?></dt>
    <dd><?php echo Form::password('password') ?></dd>
</dl>
<p><?php echo Form::submit(NULL, 'Log in'); ?></p>
<?php echo Form::close(); ?>

<?php if(isset($errors)) echo $errors; ?>
