<h1>File <?php echo htmlspecialchars($dataFile->current->name); ?></h1>
<p>
    <a href="<?php echo URL::action('DataFileController@getList'); ?>">Return to list</a>
</p>
<p><?php echo nl2br(htmlspecialchars($dataFile->current->description)); ?></p>
<p>File size: <?php echo $dataFile->current->size; ?></p>
<p>Created at: <?php echo $dataFile->created_at; ?></p>
<p>Updated at: <?php echo $dataFile->updated_at; ?></p>
<p>Number of versions: <?php echo $dataFile->versions()->count(); ?></p>
<p>
    Options: 
    <a href="<?php echo URL::action('DataFileController@getEdit', array($dataFile->current->id)); ?>">edit file options</a>
    <a href="<?php echo URL::action('DataFileController@getHistory', array($dataFile->id)); ?>">show file history</a>
    <a href="<?php echo URL::action('DataFileController@getDownload', array($dataFile->current->id)); ?>">download file</a>
</p>
<h2>Transform file</h2>
<?php echo Form::open(array('action' => 'DataFileController@postTransform', 'method' => 'post')); ?>
<ul>
    <li><?php echo Form::hidden('version_id', $dataFile->current->id); ?><?php echo Form::label('Transform type'); ?> <?php echo Form::select('transform', TransformHelper::getAvailableTransforms()); ?></li>
    <li><?php echo Form::label('Key column'); ?> <?php echo Form::select('key_column', TransformHelper::getFileHeaders($dataFile->current->path)); ?></li>
    <li><?php echo Form::submit('Transform Me!'); ?></li>
</ul>
<?php echo Form::close(); ?>