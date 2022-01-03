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
                <td class="text-center">Page</td>
                <td class="text-center">%</td>
                <td class="text-center">24h</td>
            </tr>
        </thead>
        <tbody>
            <?php
                $file = file(LOG_FILE);
                $totalVisits = 0;
                $pages = [];
                $visits = [];
                $visits24h = [];
                foreach($file as $row) {
                    $values = explode(SEPARATOR, $row);
                    $pageName = $values[2];
                    $dateAndTime = trim($values[4]);

                    if($pageName == '') continue;

                    if(!in_array($pageName, $pages)) {
                        array_push($pages, $pageName);
                        array_push($visits, 1);
                        if(time() - getTime($dateAndTime) <= 60*60*24) {
                            array_push($visits24h, 1);
                        } else {
                            array_push($visits24h, 0);
                        }
                    } else {
                        foreach($pages as $key=>$p) {
                            if($p == $pageName) {
                                $index = $key;
                                break;
                            }
                        }
                        $visits[$index]++;
                        if(time() - getTime($dateAndTime) <= 60*60*24) {
                            $visits24h[$index]++;
                        }
                    }
                    $totalVisits++;
                }

                foreach($pages as $key=>$p):
                    $percentage = round($visits[$key] * 100 / $totalVisits, 2);
            ?>
                <tr>
                    <td class="text-center"><?= $p ?></td>
                    <td class="text-center"><?= $percentage ?>%</td>
                    <td class="text-center"><?= $visits24h[$key] ?></td>
                </tr>
            <?php
                endforeach;
            ?>
        </tbody>
    </table>
</div>