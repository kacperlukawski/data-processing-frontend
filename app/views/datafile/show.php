<h1>File <?php echo htmlspecialchars($dataFile->current->name); ?></h1>
<p><?php echo nl2br(htmlspecialchars($dataFile->current->description)); ?></p>
<p>File size: <?php echo $dataFile->current->size; ?></p>
<p>Created at: <?php echo $dataFile->current->created_at; ?></p>
<p>
    Options: 
    <a href="<?php echo URL::action('DataFileController@getHistory', array($dataFile->id)); ?>">show file history</a>
    <a href="<?php echo URL::action('DataFileController@getDownload', array($dataFile->current->id)); ?>">download file</a>
</p>
<h2>Transform file</h2>
<?php echo Form::open(array('action' => 'DataFileController@postTransform', 'method' => 'post')); ?>
<?php echo Form::hidden('version_id', $dataFile->current->id); ?>
<?php echo Form::submit('Transform Me!'); ?>
<?php echo Form::close(); ?>