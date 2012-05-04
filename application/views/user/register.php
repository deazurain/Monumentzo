<?php echo Form::open('user/register', array('method' => 'post')); ?>
<dl>
    <dt><?php echo Form::label('username', 'Gebruikersnaam') ?></dt>
    <dd><?php echo Form::input('username') ?></dd>
    <dt><?php echo Form::label('password', 'Wachtwoord') ?></dt>
    <dd><?php echo Form::password('password') ?></dd>
    <dt><?php echo Form::label('password2', 'Herhaal wachtwoord') ?></dt>
    <dd><?php echo Form::password('password2') ?></dd>
</dl>
<p><?php echo Form::submit(NULL, 'Registeren'); ?></p>
<?php echo Form::close(); ?>

<?php if(isset($errors)) echo $errors; ?>
