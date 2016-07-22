<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  if (isset($_POST['hurricane_name'])) {
    $hurricane_name = $_POST['hurricane_name'];
  } else {
    $hurricane_name = '';
  }

  if (isset($_POST['season_range'])) {
    $season_range = $_POST['season_range'];
  } else {
    $season_range = '';
  }

  header('Content-Type: application/json');
  echo json_encode(array('foo' => 'bar'));

//   $new_course = array(
//     "nume" => $name,
//     "credite" => $credit,
//     "descriere" => $description,
//   );

//   $courses_json = file_get_contents('data/cursuri.json');
//   $courses = json_decode($courses_json,true);
// //  var_dump($courses);

//   $courses[] = $new_course;
//   $json = json_encode($courses, JSON_PRETTY_PRINT);
//   file_put_contents('data/cursuri.json', $json);

//   header('Location: /');
//   exit;
}
