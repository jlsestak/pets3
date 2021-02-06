<?php
//this is my controller

ini_set('display_errors',1);
error_reporting(E_ALL);

//Start a session
session_start();

//Require the autoload file
require_once('vendor/autoload.php');
require_once('model/data-layer.php');


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
$f3->route('GET|POST /order', function($f3){
    //echo "Order Page";
    //Check if the form has been posted
    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        //Validate the data
        if (empty($_POST['typeOfPet'])) {
            //...
        } else {
            //...
        }
    }

    //if it doesnt work with conditional
    $f3->set('colors', getColors());

    $view = new Template();
    echo $view->render('views/pet-order.html');
});

//order2 route
$f3->route('GET|POST /order2', function($f3){
    //echo "Order Page 2";
    //var_dump($_POST);
    //add data from order page to session array
    if(isset($_POST['typeOfPet'])){
        $_SESSION['typeOfPet'] = $_POST['typeOfPet'];
    }
    if(isset($_POST['colors'])){
        $_SESSION['colors'] = $_POST['colors'];
    }

    $f3 ->set('sizes', getSizes());
    $f3 ->set('accessories', getAccessories());

    //display a view
    $view = new Template();
    echo $view->render('views/pet-order2.html');
});

//summary route
$f3->route('POST /summary', function(){
    //add data from form 2 to session array
    if(isset($_POST['petName'])){
        $_SESSION['petName'] = $_POST['petName'];
    }

    if(isset($_POST['sizes'])){
        $_SESSION['sizes'] = $_POST['sizes'];
    }

    if(isset($_POST['accessory'])) {
        $_SESSION['accessory'] = implode(", ", $_POST['accessory']);
    }

    //display a view
    $view = new Template();
    echo $view->render('views/order-summary.html');
    //var_dump($_POST);
});


//run fat free
$f3->run();