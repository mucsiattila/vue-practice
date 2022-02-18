<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Headers: *');
header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');

$tasks = file_get_contents('./tasks.json');
$tasks = json_decode($tasks);

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
  echo json_encode(($tasks));
}

if ($_SERVER['REQUEST_METHOD'] == 'PUT') {
  $task = file_get_contents('php://input');
  $task = json_decode($task);
  //melyik task módosult
  foreach($tasks as $i => $t) {
    if ($t -> id == $task -> id) {
      $tasks[$i] = $task;
      break;
    }
  }
  //mentsük el
  file_put_contents('./tasks.json', json_encode($tasks));
  echo json_encode(($task));
}

if ($_SERVER['REQUEST_METHOD'] == 'DELETE') {
  $task = file_get_contents('php://input');
  $task = json_decode($task);
  //melyik taskot töröljük
  foreach($tasks as $i => $t) {
    if ($t -> id == $task -> id) {
      array_splice($tasks, $i, 1);
      break;
    }
  }
  //írjuk felül
  file_put_contents('./tasks.json', json_encode($tasks));
  echo json_encode(($tasks));
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $task = file_get_contents('php://input');
  $task = json_decode($task);
  $task -> id = uniqid();
  $task -> created = date('Y-m-d');
  array_push($tasks, $task);
  file_put_contents('./tasks.json', json_encode($tasks));
  echo json_encode(($task));
}