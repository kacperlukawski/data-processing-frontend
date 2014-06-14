<h1>Login page</h1>
<?php echo Form::model($user, array('action' => 'UserController@postLogin', 'method' => 'post')); ?>
<ul>
    <li><?php echo Form::label('email', 'E-mail address'); ?> <?php echo Form::text('email'); ?> <?php echo $errors->first('email'); ?></li>
    <li><?php echo Form::label('password', 'Password'); ?> <?php echo Form::password('password'); ?> <?php echo $errors->first('password'); ?></li>
    <li><?php echo Form::submit('Login Me!'); ?></li>
</ul>
<?php echo Form::close(); ?>