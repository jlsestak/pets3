<?php
//this is my controller

ini_set('display_errors',1);
error_reporting(E_ALL);

//Start a session
session_start();

//require the autoload file
require_once('vendor/autoload.php');

//create an instance of the base class
$f3 = Base::instance();
$f3->set('DEBUG', 3);

//default root
$f3->route('GET /', function(){
    //echo "My Pets";
    $view = new Template();
    echo $view->render('views/pet-home.html');

});

//order route
$f3->route('GET /order', function(){
    //echo "Order Page";
    $view = new Template();
    echo $view->render('views/pet-order.html');
});

//order2 route
$f3->route('POST /order2', function(){
    //echo "Order Page 2";
    //var_dump($_POST);
    //add data from order page to session array
    if(isset($_POST['typeOfPet'])){
        $_SESSION['typeOfPet'] = $_POST['typeOfPet'];
    }
    if(isset($_POST['colors'])){
        $_SESSION['colors'] = $_POST['colors'];
    }

    //display a view
    $view = new Template();
    echo $view->render('views/pet-order2.html');
});

//order3 route
$f3->route('POST /order3', function(){

    //add data from form 2 to session array
    if(isset($_POST['petName'])){
        $_SESSION['petName'] = $_POST['petName'];
    }

    if(isset($_POST['accessory'])){
        $_SESSION['accessory'] = $_POST['accessory'];
    }

    //display a view
    $view = new Template();
    echo $view->render('views/pet-order3.html');
});

//summary route
$f3->route('POST /summary', function(){

    //add data from form 3 to session array
    if(isset($_POST['accessory'])){
        $_SESSION['accessory'] = $_POST['accessory'];
    }

    //display a view
    $view = new Template();
    echo $view->render('views/order-summary.html');
    //var_dump($_POST);
});


//run fat free
$f3->run();