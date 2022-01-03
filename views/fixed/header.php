<header class="fixed-top">
    <div id="loginbar">
        <div class="container d-flex align-items-center justify-content-end">
        <ul class="d-flex align-items-center m-0">
            <?php
                if(!isset($_SESSION['user'])): // checks if user is logged in
            ?>
                <li>
                    <a href="index.php?p=login" class="px-2 right-border font-xs d-block my-1">Log in</a>
                </li>
                <li>
                    <a href="index.php?p=register" class="px-2 font-xs d-block my-1">Register</a>
                </li>
            <?php
                else:
                    $user = $_SESSION['user'];
                    if($user->role_name == 'admin'): // checks if user is an admin
            ?>
                <li>
                    <a href="index.php?p=admin" class="px-2 font-xs d-block my-1">Admin panel</a>
                </li>
                <?php 
                    endif;
                ?>
                <li class="px-2 right-border font-xs d-block my-1"><label>Welcome <span class="fw-bold"><?= $user->username ?></span>!</label></li>
                <li>
                    <a href="models/users/logout.php" class="px-2 font-xs d-block my-1">Log out</a>
                </li>
            <?php
                endif;
            ?>
        </ul>
        </div>
    </div>
    <nav id="navbar" class="shadow">
        <div class="container d-flex justify-content-between align-items-center">
            <div id="logo">
                <h1 class="m-0">
                    <a href="index.php?p=home" class="font-xl p-1 d-block">MS</a>
                </h1>
            </div>
            <div id="navAndCart" class="d-flex align-items-center">
                <div id="nav" class="d-none d-md-block me-2">
                    <ul class="d-flex m-0">
                        <?php
                            require_once('models/nav/functions.php');
                            $links = getNavLinks();
                            foreach($links as $l):
                        ?>
                            <li class="px-2">
                                <a href="index.php?p=<?= $l->href ?>" class="py-1 font-small"><?= $l->page_name ?></a>
                            </li>
                        <?php
                            endforeach;
                        ?>
                    </ul>
                </div>
                <a href="index.php?p=cart" id="cart" class="font-medium p-2 position-relative">
                    <i class="fas fa-shopping-cart"></i>
                    <span id="cartQuantity" class="position-absolute font-xs rounded-circle d-flex align-items-center justify-content-center"></span>
                </a>
                <a href="#" id="hamburgerMenu" class="font-medium d-block d-md-none ms-1 p-2">
                    <i class="fas fa-bars"></i>
                </a>
            </div>
        </div>
    </nav>
    <div id="sidenav" class="cover">
        <div id="sidenavContent"><ul class="d-flex m-0 d-flex flex-column p-0 py-2"><?php foreach($links as $l):?><li><a href='index.php?p=<?= $l->href ?>' class='py-1 font-small d-block p-2'><?= $l->page_name ?></a></li><?php endforeach;?></ul></div>
    </div>
</header>
<main id="main" class="min-vh-100">