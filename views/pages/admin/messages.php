<?php
    if(isset($_SESSION['user'])) {
        if($_SESSION['user']->role_name != 'admin') {
            http_response_code(404);
            exit();
        }
    } else {
        http_response_code(404);
        exit();
    }

    require_once('models/forms/functions.php');
    displayMessages();
?>
<div class="messagesDiv overflow-auto">
<?php
    $messages = getAllMessages();

    foreach($messages as $m):
?>
<div class="messageDiv">
    <hr/>
        <label class="font-small">
            <span class="fw-bold">Username: </span><?= $m->username ?>
        </label>
        <br/>
        <label class="font-small">
            <span class="fw-bold">Name: </span><?= $m->name ?>
        </label>
        <br/>
        <label class="font-small">
            <span class="fw-bold">Email: </span><?= $m->email ?>
        </label>
        <br/>
        <label class="font-small">
            <span class="fw-bold">Message: </span>
        </label>
        <br/>
        <span class="text-break d-block mb-2"><?= $m->message ?></span>
        <a href="models/admin/delete.php?id=<?= $m->message_id ?>&ap=<?= $_GET['ap'] ?>" class="font-small btn-primary px-2 py-1 rounded">Delete</a>
</div>
<?php
    endforeach;
?>
</div>