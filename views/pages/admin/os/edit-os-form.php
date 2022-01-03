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

    if(!isset($_GET['id'])) {
        http_response_code(400);
        exit();
    }

    $os = getOS('id', $_GET['id']);
?>
<form action="models/admin/os/edit-os.php" method="POST">
    <input type="hidden" name="id" value="<?= $os->id ?>"/>
    <div class="mb-2">
        <label for="tbEditOSName">Name:</label>
        <input type="text" name="name" id="tbEditOSName" class="form-control" value="<?= $os->name ?>"/>
        <label class="font-small error-message text-danger">OS name cannot contain special characters or numbers</label>
    </div>
    <div class="text-center mb-3">
        <button id="btnEditOS" name="btnEditOS" class="py-1 px-3 rounded btn-primary font-small">Edit OS</button>
    </div>
    <?php
        require_once('models/forms/functions.php');
        displayMessages();
    ?>
</form>