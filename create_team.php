<?php
 
/*
 * Following code will create a new team row
 * All team details are read from HTTP Post Request
 */
 
// array for JSON response
$response = array();
 
// check for required fields
if (isset($_POST['team']) && isset($_POST['time']) && isset($_POST['touches'])) {
 
    $team = $_POST['team'];
    $time = $_POST['time'];
    $touches = $_POST['touches'];
    $track = $_POST['track'];
    $score = $_POST['score'];
 
    // include db connect class
    require_once __DIR__ . '/db_connect.php';
 
    // connecting to db
    $db = new DB_CONNECT();
    
    if($track == 0) {
        // mysql inserting a new row
        $result = mysql_query("INSERT INTO robocomp(team, yellow_track_time, yellow_track_touches, yellow_track_score, blue_track_time, blue_track_touches, blue_track_score) VALUES('$team', '$time', '$touches', '$score', '0', '0', '0')");
    } else if ($track == 1) {
        $result = mysql_query("INSERT INTO robocomp(team, blue_track_time, blue_track_touches, blue_track_score, yellow_track_time, yellow_track_touches, yellow_track_score) VALUES('$team', '$time', '$touches', '$score', '0', '0', '0')");
    } else {
        // default to failure
        $result = 0;
    }
               
    // check if row inserted or not
    if ($result) {
        // successfully inserted into database
        $response["success"] = 1;
        $response["message"] = "Team successfully created.";
 
        // echoing JSON response
        echo json_encode($response);
    } else {
        // failed to insert row
        $response["success"] = 0;
        $response["message"] = "Oops! An error occurred.";
 
        // echoing JSON response
        echo json_encode($response);
    }
} else {
    // required field is missing
    $response["success"] = 0;
    $response["message"] = "Required field(s) is missing";
 
    // echoing JSON response
    echo json_encode($response);
}
?>