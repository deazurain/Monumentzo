<h1>Uitloggen</h1>
<?php echo Form::open('user/logout', array('method' => 'post')); ?>
<p>
    <?php echo Form::submit(NULL, 'Uitloggen'); ?>
    <input type="button" value="Annuleren" class="fancybox" href="#close">
</p>
<?php if (isset($errors)) echo $errors; ?>

<?php echo Form::close(); ?>


