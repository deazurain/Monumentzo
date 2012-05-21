<h1>Uitloggen</h1>
<?php echo Form::open('user/logout', array('method' => 'post')); ?>
<p>
    <button type="submit" class="btn btn-info">Uitloggen</button>
    <button type="button" class="btn btn-danger" href="#">Annuleren</button>
</p>
<?php if (isset($errors)) echo '<div class="alert alert-error">' . $errors . '</div>'; ?>

<?php echo Form::close(); ?>


