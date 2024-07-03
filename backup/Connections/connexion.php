<?php

  $host_name = 'db5007399484.hosting-data.io';
  $database = 'dbs6097793';
  $user_name = 'dbu1824151';
  $password = 'db_2403/pk_22';

  $con = new mysqli($host_name, $user_name, $password, $database);

  if ($con->connect_error) {
    die('<p>La connexion au serveur MySQL a échoué: '. $con->connect_error .'</p>');
  } 

  // $host_name = 'db5007399484.hosting-data.io';
  // $database = 'dbs6097793';
  // $user_name = 'dbu1824151';
  // $password = 'db_2403/pk_22';
  // $con = mysqli_connnect($hostname_con, $username_con, $password_con, $database_con);
  // mysqli_set_charset($con, 'utf8');
if (!function_exists("GetSQLValueString")) {
    function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
    {
      if (PHP_VERSION < 6) {
        $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
      }
      global $con;
      $theValue = function_exists("mysqli_real_escape_string") ? mysqli_real_escape_string($con, $theValue) : mysqli_escape_string($con,$theValue);
    
      switch ($theType) {
        case "text":
          $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
          break;    
        case "long":
        case "int":
          $theValue = ($theValue != "") ? intval($theValue) : "NULL";
          break;
        case "double":
          $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
          break;
        case "date":
          $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
          break;
        case "defined":
          $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
          break;
      }
      return $theValue;
    }
    }
?>