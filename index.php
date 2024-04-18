<?php
//328/pets2/index.php
//This represents as the controller

//Turn on reporting
ini_set('display_errors',1);
error_reporting(E_ALL);

// Require the autoload file
require('vendor/autoload.php');

// Create F3 base class
$F3 = Base::instance();

// Define default route
$F3->route('GET /', function(){
    $view = new Template();
    echo $view->render('views/home.html');
});

// order route
$F3->route('GET|POST /order', function($F3){
    if($_SERVER['REQUEST_METHOD']=='POST'){
        $pet = $_POST['pet'];
        $color = $_POST['color'];

        if(!empty($pet)&&$color != 'default') {
            echo "Please supply a pet type";
            $F3->set('SESSION.pet',$pet);
            $F3->set('SESSION.color',$color);
            $F3->reroute("summary");
        } else{
            echo '<p>Error</p>';
        }
    }
    $view = new Template();
    echo $view->render('views/pet-order.html');
});

//summary route
$F3->route('GET|POST /summary', function($F3){
    var_dump($F3->get('SESSION'));
    $view = new Template();
    echo $view->render('views/summary.html');
});
$F3->run();