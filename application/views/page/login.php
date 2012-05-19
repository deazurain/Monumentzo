<h1>Inloggen</h1>
<?php echo Form::open('user/login', array('method' => 'post')); ?>
<dl>
    <dt><?php echo Form::label('username', 'Gebruikersnaam') ?></dt>
    <dd><?php echo Form::input('username') ?></dd>
    <dt><?php echo Form::label('password', 'Wachtwoord') ?></dt>
    <dd><?php echo Form::password('password') ?></dd>
</dl>
<p>
    <button type="submit" class="btn btn-info">Inloggen</button>
    <button type="button" class="btn btn-danger fancybox" href="#close">Annuleren</button>
</p>
<?php if (isset($errors)) echo $errors; ?>

<?php echo Form::close(); ?>


