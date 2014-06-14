<h1>Create new data file</h1>
<?php echo Form::model($datafile, array('action' => 'DataFileController@postCreate', 'method' => 'post', 'files' => true)); ?>
<ul>
    <li><?php echo Form::label('File'); ?> <?php echo Form::file('file'); ?> <?php echo $errors->first('file'); ?></li>
    <li><?php echo Form::label('name', 'Filename'); ?> <?php echo Form::text('name'); ?> <?php echo $errors->first('name'); ?></li>
    <li><?php echo Form::label('description', 'Description'); ?> <?php echo Form::textarea('description'); ?> <?php echo $errors->first('description'); ?></li>
    <li><?php echo Form::submit('Create New File!'); ?></li>
</ul>
<?php echo Form::close(); ?>