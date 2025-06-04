<?php

class Controller {

    
 function loadModel($model = '', $params = []) {
  require_once('model/Model.class.php');

  // Load either .model.php or .class.php
  if (file_exists('model/' . $model . '.model.php')) {
    require_once('model/' . $model . '.model.php');
  } else {
    require_once('model/' . $model . '.class.php');
  }

  // Instantiate the model with arguments if provided
  $reflection = new ReflectionClass($model);
  return $reflection->newInstanceArgs($params);
}

public function confirmation()
{
    if (isset($_SESSION['product_temp'])) {
        $product = $_SESSION['product_temp'];
        $this->loadView('confirmation', ['product' => $product]);
    } else {
        echo "No product data to confirm.";
    }
}




function loadView($view = '', $data = []) {
  foreach ($data as $key => $val)
    $$key = $val;

  if (file_exists('views/'.$view.'/index.php')) {
    include 'views/'.$view.'/index.php';
  } elseif (file_exists('views/'.$view.'.php')) {
    include 'views/'.$view.'.php';
  } else {
    echo "View not found: $view";
  }
}

}