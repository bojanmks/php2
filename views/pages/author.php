<div class="d-flex align-items-center min-vh-100 py-5">
<div class="container">
    <div class="row align-items-center justify-content-between mt-5 mt-md-0">
        <div class="col-12 col-md-4 d-flex flex-column align-items-center justify-content-center">
            <div id="authorImage" class="position-relative rounded-circle overflow-hidden">
                <img src="assets/img/author/author.jpg" alt="Author" class="img-fluid d-block"/>
                <div id="authorSocials" class="position-absolute cover-white align-items-center justify-content-center">
                    <ul class="align-items-center justify-content-center m-0 p-0">
                        <?php
                            require_once("models/author/functions.php");
                            $links = getAuthorSocials();
                            foreach($links as $l):
                        ?>
                        <li>
                            <a href="<?= $l->href ?>" target="_blank" class="p-1 font-medium"><i class="<?= $l->icon ?>" style="color: <?= $l->color ?>;"></i></a>
                        </li>
                        <?php
                            endforeach;
                        ?>
                    </ul>
                </div>
            </div>
            <span class="font-medium fw-bold mt-2 text-center">Bojan Maksimović 92/19</span>
        </div>
        <div class="col-12 col-md-6 text-center text-md-start mt-4 mt-md-0">
            <p class="font-small">My name is Bojan and I am an aspiring front-end web developer. My approach to website design is to create a website that strengthens your company’s brand while ensuring ease of use and simplicity for your audience.</p>
            <p class="font-small">The way I look at it, a front-end developer's role is to combine design and business logic to achieve a user-facing product. To do this successfully, a wide skill set is necessary to produce a quality user experience that leads to meeting business goals, and I guarantee I've got exactly what's needed.</p>
            <a href="https://bokule.github.io/portfolio/" target="_blank" class="font-small rounded py-2 px-3 text-uppercase btn-primary" id="portfolioLink">My portfolio</a>
        </div>
    </div>
    <div class="mt-4 text-center text-md-end">
        <a href="models/author/export-to-word.php" class="font-small rounded py-2 px-3 btn-primary">Export to Word</a>
    </div>
</div>
</div>