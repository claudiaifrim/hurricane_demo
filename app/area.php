<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  if (isset($_POST['area_name'])) {
    $area_name = $_POST['area_name'];
  } else {
    $area_name = '';
  }

// Connect to the database (host, username, password)
  $conn = new mysqli('127.0.0.1','keystone','Key_16_Stone','keystonedb');

  // Check connection
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  } 
  
  $sql = "select distinct s.hurricaneurl, s.name, s.year, s.season, s.damages, s.fatalities, s.winds, s.started, s.ended, a.country, a.countryurl, a.cuontrypop, a.province, a.provinceurl, a.provincepop from hurricanes s inner join areas a on s.hurricaneurl = a.hurricaneurl where (a.area like '%".$area_name."%' or a.province like '%".$area_name."%' or a.country like '%".$area_name."%' or s.areas like '%".$area_name."%');";

  // Execute query:
  $rows = $conn->query($sql);
   
  $result = array();

  if ($rows->num_rows > 0) {
    // output data of each row
    while($Row = $rows->fetch_assoc()) {
      $x = array('hurricaneurl' => $Row['hurricaneurl'], 'name' => $Row['name'], 'year' =>  $Row['year'], 'country' =>  $Row['country'], 'countryurl' =>  $Row['countryurl'], 'countrypop' =>  $Row['countrypop'], 'province' =>  $Row['province'], 'provinceurl' =>  $Row['provinceurl'], 'provincepop' =>  $Row['provincepop']);
      array_push($result, $x);
    }
  } else {
      $result = array();
  }
   
  $conn->close();

  header('Content-Type: application/json');
  echo json_encode($result);
}
