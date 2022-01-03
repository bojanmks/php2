</main>
<footer id="footer">
    <div class="container py-2 d-flex align-items-center justify-content-center flex-column">
        <div id="footerLinks">
            <ul class="d-flex m-0 p-0">
                <?php
                    require_once('models/footer/functions.php');
                    $links = getFooterLinks();
                    foreach($links as $l):
                ?>
                    <li>
                        <a href="<?= $l->href ?>" target="_blank" class="p-1 font-small"><i class="<?= $l->icon ?>"></i></a>
                    </li>
                <?php
                    endforeach;
                ?>
            </ul>
        </div>
        <div class="footerSeparator my-2">
        </div>
        <span class="font-xs">&copy; Bojan Maksimović 92/19</span>
    </div>
</footer>
<a href="#" id="toTop" class="position-fixed p-3 rounded-circle shadow">
    <div id="toTopArrow" class="position-relative m-1"></div>
</a>