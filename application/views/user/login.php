<?php echo Form::open(NULL, array('method' => 'post')); ?>
<dl>
    <dt><?php echo Form::label('username', 'Gebruikersnaam') ?></dt>
    <dd><?php echo Form::input('username') ?></dd>
    <dt><?php echo Form::label('password', 'Wachtwoord') ?></dt>
    <dd><?php echo Form::password('password') ?></dd>
</dl>
<p><?php echo Form::submit(NULL, 'Inloggen'); ?></p>
<?php echo Form::close(); ?>

<?php if(isset($errors)) echo $errors; ?>
