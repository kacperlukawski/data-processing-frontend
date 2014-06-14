<h1>History of <?php echo htmlspecialchars($dataFile->current->name); ?> file</h1>
<p>
    <a href="<?php echo URL::action('DataFileController@getShow', array($dataFile->id)); ?>">Return to file</a>
</p>
<table>
    <thead>
        <tr>
            <th>Name</th>
            <th>Description</th>
            <th>Size</th>
            <th>Options</th>
            <th>Created at</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($dataFile->versions as $dataFileVersion): ?>
        <tr>
            <td><?php echo htmlspecialchars($dataFileVersion->name); ?></td>
            <td><?php echo htmlspecialchars($dataFileVersion->description); ?></td>
            <td><?php echo htmlspecialchars($dataFileVersion->size); ?></td>
            <td>
                <a href="<?php echo URL::action('DataFileController@getDownload', array($dataFileVersion->id)); ?>">download file</a>
            </td>
            <td><?php echo htmlspecialchars($dataFileVersion->created_at); ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>