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
  $con = mssql_connect('127.0.0.1','keystone','Key_16_Stone') or die('Could not connect to the server!');
  // Select a database:
  mssql_select_db('keystonedb') or die('Could not select a database.');

  $SQL = "select s.hurricaneurl, s.name, s.year, s.hurType, s.season, s.damages, s.fatalities, s.winds, s.started, s.ended, a.country, a.countryurl, a.cuontrypop, a.province, a.provinceurl, a.provincepop from hurricanes s inner join areas a on s.hurricaneurl = a.hurricaneurl where s.name like '%" . $hurricane_name . "%';";

  // if (!empty($hurricane_name) && !empty($season_range)) {
  //   $SQL = "select * from hurricanes where name like '%" . $hurricane_name . "%' and season like '%" . $season_range . "%';"
  // }

  // Execute query:
	$result = mssql_query($SQL) or die('A error occured: ' . mysql_error());
	 
	// Get result count:
	$Count = mssql_num_rows($result);
	// print "Showing $count rows:<hr/>\n\n";
	 
	$result = array();
	// Fetch rows:
	while ($Row = mssql_fetch_assoc($result)) {
    $x = array('hurricaneurl' => $Row['hurricaneurl'], 'name' => $Row['name'], 'year' =>  $Row['year'], 'country' =>  $Row['country'], 'province' =>  $Row['province']);
	 	array_push($result, $x);	
	}
	 
	mssql_close($con);

  die($result);

  header('Content-Type: application/json');
  echo json_encode($result);

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
