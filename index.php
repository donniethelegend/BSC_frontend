<?php

 include_once './copyright/license.php';
   

 if($lock){


 include_once './CONFIGURATION/config.php';
     ob_start();
   $hostname = $_SERVER['HTTP_HOST'];
   if(isset($_SESSION['username'])){
      $userid  = $_SESSION['username'];
   }else{
       
       $userid = null;
   }
      
   
     $config = Config::getConfig("auth_key");
    $ser_u = $config['user'];
    $ser_p = $config['pass'];


   $user_agent = $_SERVER['HTTP_USER_AGENT'];

$isRedirect = false;
  if(strpos( $user_agent,"Chrome")){
      $isRedirect =true;
  }
 else if(strpos( $user_agent,"Edge")){
     $isRedirect =true;
 }
 else if(strpos( $user_agent,"Opera")){
     $isRedirect =true;
 }
    
include_once './includes/http.php';


?>

<!DOCTYPE html>
<!--
This Web was made by donnie.  June 2017
-->
<html>
    <head>
        <meta charset="UTF-8">
        
         <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
   

        
<meta name="description" content="This is Property of Department Of Science and Technology Region Office 1">

  <meta name="author" content="Donnie">
  
        <link rel="shortcut icon" href="./fonts/logo.jpg" type="image/x-icon" />

        <title><?php 
        if(isset($_REQUEST['form']))
        {
         echo "eBalance Scorecard System (".$_REQUEST['form'].")";
        }
        else
        {
         echo "eBalance Scorecard System ";
        }
        ?> 
        </title>
      
         <script src="js/jquery.js" type="text/javascript"></script>
         <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script>
         <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script>
        
         <script src="js/popper.min.js" type="text/javascript"></script>
         <script src="js/bootstrap.bundle.min.js" type="text/javascript"></script>
         <script src="js/bootstrap-notify.js" type="text/javascript"></script>
         <script src="js/jquery.cookie.js" type="text/javascript"></script>
         
         <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
         <link href="css/dashboard.css" rel="stylesheet" type="text/css"/>
         <link href="css/bootstrap-css.css" rel="stylesheet" type="text/css"/>
         
    </head>
    <body>
        
        
 
      
          
               
            <?php 
          
            
if( $isRedirect){
 if(isset($_SESSION[base64_encode('username')])){
     
   
     
     
  if($_GET){
       $query= base64_decode( $_SERVER['QUERY_STRING']);
     $_getParam = array();
     foreach(explode("&",$query) as $v){
         $kv = explode("=", $v);
        $_getParam[$kv[0]]=$kv[1];
         
     }
     }
     else{
         $_getParam = null;
         $query ="no data";
     }
   
   
     function is_base64($str){
    if ( base64_encode(base64_decode($str, true)) === $str){
       return true;
    } else {
       return false;
    }
}
     
     
     
     
          echo "<script> console.log('This is located in index line 115');   console.log('".  $query."');</script>";
       
          
          
   include_once './js/dynamic.id.php';
      include_once './js/data.controller.jscript.php';
      include_once './js/form.controller.jscript.php';
      include_once './js/links.controller.ajaxscript.php';
      
      
      include_once './includes/header-navigator.php';
      
      include_once './includes/left-navigator.php';
  
     
     echo '<div class="container-fluid">
  <div class="row">';
    


     $userid  = $_SESSION[base64_encode('username')];
   
    
   
     
     
                        if(isset($_getParam['form'])){
                            
                            
                                
                                
                                $page = $_getParam['form'];
                            
                            if($page!='login'){
                             
                            if(file_exists('./forms/'.$page.'.php')){
                                
                                include_once './forms/'.$page.'.php';
                               
                            }
                            else{
                                 include_once './forms/404.php';
                            }
                            }else{
                                 include_once './forms/default.php';
                            }
                        
                            
                        }  else{
                            include_once './forms/default.php';
                         
                        }
                        
                        
                      
                        
                    echo "<main/>";    
                    echo "<div/>";    
                    echo "<div/>";    
                        }
                        
                        
                        
                        
                        
                        else{
                    include_once './js/login.controller.jscript.php';
                            include_once './forms/login.php';
                        }
                        }
                        else{
                            include_once './forms/browserwarn.php';  
                        }
                        
                        ?>
       
      <script>
          (function () {
  'use strict'

  feather.replace()
          })();
          
          </script>
       
    </body>
    
</html>
 <?php } 
 
 else{
   include_once './forms/404.html';
  }?>