<h1>Inloggen</h1>
<?php if (isset($errors)) echo '<div class="alert alert-error">' . $errors . '</div>'; ?>
<?php echo Form::open('user/login', array('method' => 'post')); ?>
<dl>
    <dt><?php echo Form::label('username', 'Gebruikersnaam') ?></dt>
    <dd><?php echo Form::input('username') ?></dd>
    <dt><?php echo Form::label('password', 'Wachtwoord') ?></dt>
    <dd><?php echo Form::password('password') ?></dd>
</dl>
<p>
    <button type="submit" class="btn btn-info">Inloggen</button>
    <button type="reset" class="btn btn-danger" href="#">Annuleren</button>
</p>
<div class='error-container alert alert-error'></div>

<?php echo Form::close(); ?>


