<?php



if(!isset($_GET['rt']))
{
  $controllerName = 'users';
  $action = 'index';
}

else
{

  $parts = explode('/', $_GET['rt']);
  print_r($parts);

  if(isset($parts[0]) && preg_match('/^[a-zA-Z0-9]+$/',$parts[0]))
    $controllerName = $parts[0];

  else
    $controllerName = 'users';


  if(isset($parts[1]) && preg_match('/^[a-zA-Z0-9]+$/',$parts[1]))
    $acion = $parts[1];

  else
   $action = 'index';


}

$controllerName = $controllerName.'Controller';
require_once __DIR__. '/controller/'.$controllerName.'.php';

$controller = new $controllerName();
$controller->$action();




  ?>
