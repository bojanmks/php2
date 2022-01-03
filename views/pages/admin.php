<?php
    if(isset($_SESSION['user'])) {
        if($_SESSION['user']->role_name != 'admin') {
            header('Location: index.php?p=home');
            exit();
        }
    } else {
        header('Location: index.php?p=home');
        exit();
    }
?>
<div class="d-flex min-vh-100 py-5">
    <div class="container mt-5">
        <div class="mt-0 mt-md-3">
            <div class="row">
                <div class="col-12 col-md-4">
                    <ul class="p-0 font-medium">
                        <?php
                            require_once('models/admin/functions.php');
                            $links = getAdminLinks();
                            foreach($links as $l):
                        ?>
                        <li>
                            <a href="index.php?p=admin&ap=<?= $l->href ?>"><?= $l->page_name ?></a>
                        </li>
                        <?php
                            endforeach;
                        ?>
                    </ul>
                </div>
                <div class="col-12 col-md-8">
                    <?php
                        if(isset($_GET['ap'])) {
                            switch($_GET['ap']) {
                                case 'page-stats':
                                    require_once('admin/page-stats.php');
                                    break;
                                case 'logins':
                                    require_once('admin/logins.php');
                                    break;
                                case 'users':
                                    require_once('admin/users.php');
                                    break;
                                case 'add-user':
                                    require_once('admin/users/add-user-form.php');
                                    break;
                                case 'edit-user':
                                    require_once('admin/users/edit-user-form.php');
                                    break;
                                case 'phones':
                                    require_once('admin/phones.php');
                                    break;
                                case 'add-phone':
                                    require_once('admin/phones/add-phone-form.php');
                                    break;
                                case 'edit-phone':
                                    require_once('admin/phones/edit-phone-form.php');
                                    break;
                                case 'brands':
                                    require_once('admin/brands.php');
                                    break;
                                case 'add-brand':
                                    require_once('admin/brands/add-brand-form.php');
                                    break;
                                case 'edit-brand':
                                    require_once('admin/brands/edit-brand-form.php');
                                    break;
                                case 'operating-systems':
                                    require_once('admin/operating-systems.php');
                                    break;
                                case 'add-os':
                                    require_once('admin/os/add-os-form.php');
                                    break;
                                case 'edit-os':
                                    require_once('admin/os/edit-os-form.php');
                                    break;
                                case 'orders':
                                    require_once('admin/orders.php');
                                    break;
                                case 'edit-order':
                                    require_once('admin/orders/edit-order-form.php');
                                    break;
                                case 'messages':
                                    require_once('admin/messages.php');
                                    break;
                                default:
                                    require_once('admin/page-stats.php');
                            }
                        } else {
                            require_once('admin/page-stats.php');
                        }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>