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
    <button type="submit" class="btn btn-info">Registreren</button>
    <button type="button" class="btn btn-danger" href="#">Annuleren</button>
</p>
<div class='error-container alert alert-error'></div>
<?php if (isset($errors)) echo '<div class="alert alert-error">' .$errors. '</div>'; ?>

<?php echo Form::close(); ?>

