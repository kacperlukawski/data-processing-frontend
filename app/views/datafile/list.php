<h1>Your lists</h1>
<p>
    <a href="<?php echo URL::action('DataFileController@getCreate'); ?>">Add new file</a>
</p>
<ul>
    <?php foreach ($dataFiles as $dataFile): ?>
        <li><a href="<?php echo URL::action('DataFileController@getShow', array($dataFile->id)); ?>"><?php echo $dataFile->current->name; ?></li>
    <?php endforeach; ?>
</ul>