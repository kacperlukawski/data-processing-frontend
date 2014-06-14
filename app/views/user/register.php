<h1>Register page</h1>
<?php echo Form::model($user, array('action' => 'UserController@postRegister', 'method' => 'post')); ?>
<ul>
    <li><?php echo Form::label('email', 'E-mail address'); ?> <?php echo Form::text('email'); ?> <?php echo $errors->first('email'); ?></li>
    <li><?php echo Form::label('password', 'Password'); ?> <?php echo Form::password('password'); ?> <?php echo $errors->first('password'); ?></li>
    <li><?php echo Form::label('password_confirmation', 'Confirm password'); ?> <?php echo Form::password('password_confirmation'); ?> <?php echo $errors->first('password_confirmation'); ?></li>
    <li><?php echo Form::submit('Register Me!'); ?></li>
</ul>
<?php echo Form::close(); ?>