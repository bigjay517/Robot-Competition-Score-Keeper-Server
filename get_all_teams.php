<?php
 
/*
 * Following code will list all the team
 */
 
// array for JSON response
$response = array();
 
// include db connect class
require_once __DIR__ . '/db_connect.php';
 
// connecting to db
$db = new DB_CONNECT();
 
// get all teams from teams table
$result = mysql_query("SELECT *FROM robocomp") or die(mysql_error());
 
// check for empty result
if (mysql_num_rows($result) > 0) {
    // looping through all results
    // teams node
    $response["teams"] = array();
 
    while ($row = mysql_fetch_array($result)) {
        // temp user array
        $team = array();
        $team["id"] = $row["id"];
        $team["team"] = $row["team"];
        $team["yellow_track_time"] = $row["yellow_track_time"];
        $team["yellow_track_touches"] = $row["yellow_track_touches"];
        $team["yellow_track_score"] = $row["yellow_track_score"];
        $team["blue_track_time"] = $row["blue_track_time"];
        $team["blue_track_touches"] = $row["blue_track_touches"];
        $team["blue_track_score"] = $row["blue_track_score"];
        $team["place"] = $row["place"];
        $team["created_at"] = $row["created_at"];
        $team["updated_at"] = $row["updated_at"];
 
        // push single team into final response array
        array_push($response["teams"], $team);
    }
    // success
    $response["success"] = 1;
 
    // echoing JSON response
    echo json_encode($response);
} else {
    // no teams found
    $response["success"] = 0;
    $response["message"] = "No teams found";
 
    // echo no users JSON
    echo json_encode($response);
}
?>