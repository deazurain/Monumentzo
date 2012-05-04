<h1>Registreren</h1>
<?php echo Form::open('user/register', array('method' => 'post')); ?>
<dl>
    <dt><?php echo Form::label('username', 'Gebruikersnaam') ?></dt>
    <dd><?php echo Form::input('username') ?></dd>
    <dt><?php echo Form::label('email', 'E-mailadres') ?></dt>
    <dd><?php echo Form::input('email') ?></dd>
    <dt><?php echo Form::label('password', 'Wachtwoord') ?></dt>
    <dd><?php echo Form::password('password') ?></dd>
    <dt><?php echo Form::label('password2', 'Herhaal wachtwoord') ?></dt>
    <dd><?php echo Form::password('password2') ?></dd>
</dl>
<p>
    <?php echo Form::submit(NULL, 'Registeren'); ?>
    <input type="button" value="Annuleren" class="fancybox" href="#close">
</p>
<?php if (isset($errors)) echo '<div class="alert alert-error">' .$errors. '</div>'; ?>

<?php echo Form::close(); ?>

