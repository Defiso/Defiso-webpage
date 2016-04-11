<?php
  /*
    Autoloader
  */

if( ! ini_get('date.timezone') )
{
    date_default_timezone_set('UTC');
}

  spl_autoload_register(function ($class) {
    include $class . '.php';
  });
?>
