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
