<?php

class Controller {

  function loadModel($model = '') {
    require_once('model/Model.model.php');
    require_once('model/' . $model . '.model.php');
    return new $model;
  }

function loadView($view = '', $data = []) {
  foreach($data as $key => $val)
    $$key = $val;
  include 'view/'.$view.'/index.php';
}
}