<h1>Create Comment</h1>

<?php if(!$user) { die('Need to be logged in if you want to place a comment'); } ?>

<?php echo Form::open('comment/create', array('id' => 'create-comment', 'method' => 'post')); ?>

<dl>
    <dt><?php echo Form::label('MonumentID', 'Monument ID'); ?></dt>
    <dd><?php echo Form::input('MonumentID'); ?></dd>
    <dt><?php echo Form::label('Comment', 'Commentaar'); ?></dt>
    <dd><?php echo Form::textarea('Comment'); ?></dd>
</dl>
<p>
    <button type="submit" class="btn btn-info">Plaats Commentaar</button>
    <button type="reset" class="btn btn-danger" href="#">Annuleer</button>
</p>
<div class='error-container alert alert-error'></div>
<div class='success-container alert alert-success'></div>

<?php echo Form::close(); ?>


