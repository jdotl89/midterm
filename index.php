<?php
// turn on error reporting
ini_set('display_errors',1);
error_reporting(E_ALL);

// require the autoload file
require_once('vendor/autoload.php');

//Start a session AFTER requiring autoload.php
session_start();

// create an instance of the base class
$f3 = Base::instance();
$controller = new Controller();

// define a default route
$f3->route('GET /', function(){
    echo '<h1>Midterm Survey</h1>';
    echo '<a href="survey">Take my Midterm Survey</a>';
});

// breakfast route
$f3->route('GET|POST /survey', function($f3){

    $checkbox = $GLOBALS['controller']->getCheckbox();

    echo '<h1>Midterm Survey</h1>';
    echo '<pre>';
    echo '<form action="#" method="post"><label for="first"><strong>Name</strong></label> ';
    echo '<input type="text" id="first" name="name" value="';
    if (isset($_POST['name'])) {
        echo $_POST['name'];
    }
    echo '"><br><br>';
    echo'<label ><strong>Check all that apply</strong></label><br><br>';
    for($i = 0; $i < sizeof($checkbox); $i++) {
        echo '<input  type="checkbox" name= "check[]" value="'.$checkbox[$i].' ">' . " ".$checkbox[$i].'</input>';
        echo '<br><br>';
    }
    echo '<button type="submit">Submit</button></form>';
    echo '</pre>';
    echo '';

    if($_SERVER['REQUEST_METHOD'] == 'POST') {

        //Store the data in the session array
        $_SESSION['name'] = $_POST['name'];
        $_SESSION['checkbox'] = $_POST['check'];

        //Redirect to Order 2 page
        $f3->reroute('/summary');
    }

    /*    $view = new Template();
        echo $view->render('views/home.html');*/
});

$f3->route('GET /summary', function(){

    echo '<h1>Midterm Survey</h1>';
    echo '<pre>';
    echo '<p>Thank you for taking the survey, '.$_SESSION['name'].'!</p>';
    echo '<p><strong>Your Answers:</strong></p>';
    echo '<p>'.implode($_SESSION['checkbox'], ", ").'</p>';
    echo '</pre>';
/*

    echo '<h1>Midterm Survey</h1>';

    echo '<form></form><label for="first"><strong>Name</strong></label> ';
    echo '<input type="text" id="first" name="first">';
    echo '<br><br>';
    echo'<label ><strong>Check all that apply</strong></label><br><br>';
    for($i = 0; $i < sizeof($checkbox); $i++) {
        echo '<input  type="checkbox" name= "check[]" value="'.$checkbox[$i].' ">' . " ".$checkbox[$i].'</input>';
        echo '<br><br>';
    }
    echo '<button type="submit">Submit</button></form>';
    echo '</pre>';
    echo '';*/

    /*    $view = new Template();
        echo $view->render('views/home.html');*/
    session_destroy();
});

// run fat free
$f3->run();