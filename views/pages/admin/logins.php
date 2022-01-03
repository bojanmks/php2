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
?>
<div class="table-responsive">
    <table class="font-small table table-striped table-hover align-middle" cellspacing="0">
        <thead>
            <tr>
                <td class="text-center">ID</td>
                <td class="text-center">Username</td>
                <td class="text-center">Email</td>
            </tr>
        </thead>
        <tbody>
            <?php
                require_once('models/users/functions.php');
                $file = file(LOGIN_LOG);
                $userIds = [];
                foreach($file as $row) {
                    $values = explode(SEPARATOR, $row);
                    $userId = $values[0];
                    $dateAndTime = $values[2];
                    $result = trim($values[3]);
                    if(!in_array($userId, $userIds) && time() - getTime($dateAndTime) <= 60*60*24 && $result == '1') {
                        array_push($userIds, $userId);
                    }
                }

                $numberOfUsers = 0;
                foreach($userIds as $u):
                    $user = getUser('id', $u);
                        if($user):
                            $numberOfUsers++;
            ?>
                <tr>
                    <td class="text-center"><?= $user->id ?></td>
                    <td class="text-center"><?= $user->username ?></td>
                    <td class="text-center"><?= $user->email ?></td>
                </tr>
            <?php
                    endif;
                endforeach;
            ?>
        </tbody>
    </table>
</div>
<label class="mt-3 font-medium">Unique users: <span class="fw-bold"><?= $numberOfUsers ?></span></label>