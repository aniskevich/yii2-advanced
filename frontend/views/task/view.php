<h3>Task name: <?=$task['name']?></h3>
<p>Task description: <?=$task['description']?></p>
<p>Task author: <?=$task['author']?></p>
<p>Task reporter: <?=$task['reporter']?></p>
<p> Task status: <?=$task['status']?></p>

<p>Task tags:</p>
<?php foreach ($task['tags'] as $tag) : ?>
<p><?=$tag?></p>
<?php endforeach; ?>

<p>Task priority: <?=$task['priority']?></p>

<p>Comments:</p>
<?php foreach ($comments as $comment) : ?>
    <p><?=$comment?></p>
<?php endforeach; ?>