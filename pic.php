<?php
    require_once 'config.php';
 class al
 {

  function __autoload($class_name) 
    {
        require_once 'lib/' . strtolower($class_name) . '.php';
    }

  function pic()
  {

  }
 }
    
?>


