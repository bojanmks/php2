<div id="slider" class="carousel slide vh-100 position-relative" data-bs-ride="carousel">
  <div class="carousel-inner h-100">
    <?php
        require_once('models/slider/functions.php');
        $sliderImages = getSliderImages();
        foreach($sliderImages as $key=>$i):
    ?>
        <div class="carousel-item slider-image <?php if($key == 0) echo('active'); ?> h-100" style="background-image: url('assets/img/slider/<?= $i->href ?>');">
        </div>
    <?php
        endforeach;
    ?>
  </div>
  <div id="sliderText" class="position-absolute cover">
    <div class="container d-flex flex-column align-items-center align-items-md-start justify-content-center h-100">
        <h2 class="font-xxl">All New Phones</h2>
        <p class="font-medium text-center mt-2">Special deals on the latest cell phones and smartphones. Stay connected in style, we've got you covered.</p>
        <a href="index.php?p=phones" class="font-small d-block mt-2 p-2 rounded">Shop now</a>
    </div>
  </div>
</div>
<div id="about">
    <div class="container py-5">
        <div class="row align-items-center">
            <div class="col-12 col-lg-4">
                <div id="aboutUsImage" class="mx-auto mb-4 mb-lg-0">
                    <img src="assets/img/other/aboutUsImage.png" alt="Phone" class="img-fluid"/>
                </div>
            </div>
            <div class="col-12 col-lg-8 text-center text-lg-end">
                <h3 class="font-large">About us</h3>
                <h4 class="font-xl fw-bold">Mobishop</h4>
                <p class="font-small">
                    Mobi Shop gives you a chance to quickly and easily find the phone you want and have it delivered to your home in no time, regardless of your location, as long as it is in one of the countries of the EU.
                </p>
                <p class="font-small">
                    We have been in the business for quite a while now, and it that time we have not only managed to make close relationships with numerous suppliers all over the world, but also to recognize what people need.
                </p>
            </div>
        </div>
    </div>
</div>