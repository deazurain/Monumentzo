<h1>Inloggen</h1>
<?php echo Form::open('user/login', array('method' => 'post')); ?>
<dl>
    <dt><?php echo Form::label('username', 'Gebruikersnaam') ?></dt>
    <dd><?php echo Form::input('username') ?></dd>
    <dt><?php echo Form::label('password', 'Wachtwoord') ?></dt>
    <dd><?php echo Form::password('password') ?></dd>
</dl>
<p>
    <?php echo Form::submit(NULL, 'Inloggen'); ?>
    <input type="button" value="Annuleren" class="fancybox" href="#close">
</p>
<?php if (isset($errors)) echo $errors; ?>

<?php echo Form::close(); ?>


