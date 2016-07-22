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

  // Connect to the database (host, username, password)
  $conn = new mysqli('127.0.0.1','keystone','Key_16_Stone','keystonedb');

  // Check connection
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  } 
  
  $sql = "select s.hurricaneurl, s.name, s.year, s.hurType, s.season, s.damages, s.fatalities, s.winds, s.started, s.ended, a.country, a.countryurl, a.cuontrypop, a.province, a.provinceurl, a.provincepop from hurricanes s inner join areas a on s.hurricaneurl = a.hurricaneurl where s.name like '%" . $hurricane_name . "%';";

  if (!empty($hurricane_name) && !empty($season_range)) {
    $sql = "select s.hurricaneurl, s.name, s.year, s.hurType, s.season, s.damages, s.fatalities, s.winds, s.started, s.ended, a.country, a.countryurl, a.cuontrypop, a.province, a.provinceurl, a.provincepop from hurricanes s inner join areas a on s.hurricaneurl = a.hurricaneurl where s.name like '%" . $hurricane_name . "%' and s.year like '%" . $season_range . "%';";
  }

  // Execute query:
	$rows = $conn->query($sql);
	 
  $result = array();

	if ($rows->num_rows > 0) {
    // output data of each row
    while($Row = $rows->fetch_assoc()) {
      $x = array('hurricaneurl' => $Row['hurricaneurl'], 'name' => $Row['name'], 'year' =>  $Row['year'], 'country' =>  $Row['country'], 'province' =>  $Row['province']);
      array_push($result, $x);
    }
  } else {
      $result = array();
  }
	 
	$conn->close();

  header('Content-Type: application/json');
  echo json_encode($result);
}
