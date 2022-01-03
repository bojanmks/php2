<?php
    require_once("../../config/connection.php");

    // creating the file
    $word = new COM("word.application") or die("Unable to instantiate Word.");

    $word->Visible = 1;

    $word->Documents->Add();

    $word->Selection->TypeText("My name is Bojan and I am an aspiring front-end web developer. My approach to website design is to create a website that strengthens your company's brand while ensuring ease of use and simplicity for your audience.\nThe way I look at it, a front-end developer's role is to combine design and business logic to achieve a user-facing product. To do this successfully, a wide skill set is necessary to produce a quality user experience that leads to meeting business goals, and I guarantee I've got exactly what's needed.");

    $location = ABSOLUTE_PATH . "data/author.doc";
    $word->Documents[1]->SaveAs($location);

    $word->Quit();

    $word = null;

    // download
    $file = file_get_contents($location);
    header("Content-type: application/vnd.ms-word");
    header("Content-Disposition: attachment;filename=author.doc");
    echo($file);

    // delete
    if(file_exists($location)) {
        unlink($location);
    }
?>