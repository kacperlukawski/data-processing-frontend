<?php if (Auth::check()): ?>
    <ul>
        <li><a href="<?php echo URL::action('DataFileController@getList'); ?>">Your files</a></li>
        <li><a href="<?php echo URL::action('UserController@anyLogout'); ?>">Logout</a></li>
    </ul>
<?php else: ?>
    <ul>
        <li><a href="<?php echo URL::action('UserController@getRegister'); ?>">Register</a></li>
        <li><a href="<?php echo URL::action('UserController@getLogin'); ?>">Login</a></li>
    </ul>
<?php endif; ?>
