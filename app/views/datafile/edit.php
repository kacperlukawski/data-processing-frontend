<h1>Editing </h1>
<p>
    <a href="<?php echo URL::action('DataFileController@getList'); ?>">Return to list</a>
</p>
<?php echo Form::model($dataFileVersion, array('action' => 'DataFileController@postEdit', 'method' => 'post')); ?>
<ul>
    <li><?php echo Form::hidden('id', $dataFileVersion->id) ?><?php echo Form::label('name', 'Filename'); ?> <?php echo Form::text('name'); ?> <?php echo $errors->first('name'); ?></li>
    <li><?php echo Form::label('description', 'Description'); ?> <?php echo Form::textarea('description'); ?> <?php echo $errors->first('description'); ?></li>
    <li><?php echo Form::submit('Save Changes!'); ?></li>
</ul>
<?php echo Form::close(); ?>