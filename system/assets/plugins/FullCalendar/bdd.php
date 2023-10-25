<?php
include_once ('../config.php');
try {
    $bdd = new PDO('mysql:host='.$host_db.';dbname='.$base_db.';charset=utf8', $usuario_db, $pass_db);
    // set the PDO error mode to exception
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //echo "Connected successfully";
    }
catch(PDOException $e)
    {
    echo "Connection failed: " . $e->getMessage();
    }

// try {

// 	include_once ('../config.php');
	
// 	$bdd = new PDO('mysql:host='.$host_db.';dbname='.$base_db.';charset=utf8', $usuario_db, $pass_db);
// 	//$bdd = new PDO('mysql:host=localhost;dbname=duncanyz_hhs_db;charset=utf8', 'root', '123456');
// 	$mbd = new PDO('mysql:host=localhost;dbname=duncanyz_hhs_db','root', '123456');

// } catch(Exception $e) {

//         die('Error : '.$e->getMessage());

// }

// try {
//     $mbd = new PDO('mysql:host=localhost;dbname=duncanyz_hhs_db','root', '123456');

//     foreach($mbd->query('SELECT * from ad_6_reservas') as $fila) {
//         print_r($fila);
//     }
//     $mbd = null;
// } catch (PDOException $e) {
//     print "¡Error!: " . $e->getMessage() . "<br/>";
//     die();
// }
// 
// $mbd = new PDO('mysql:host=localhost;dbname=duncanyz_hhs_db;charset=utf8', 'root', '123456', array(
//     PDO::ATTR_PERSISTENT => true
// ));