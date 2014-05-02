<?php
 
/*
 * Following code will get single team details
 * A team is identified by team id (id)
 */
 
// array for JSON response
$response = array();
 
// include db connect class
require_once __DIR__ . '/db_connect.php';
 
// connecting to db
$db = new DB_CONNECT();
 
// check for post data
if (isset($_GET["id"])) {
    $id = $_GET['id'];
 
    // get a product from teams table
    $result = mysql_query("SELECT *FROM robocomp WHERE id = $id");
 
    if (!empty($result)) {
        // check for empty result
        if (mysql_num_rows($result) > 0) {
 
            $result = mysql_fetch_array($result);
 
            $team = array();
            $team["id"] = $result["id"];
            $team["team"] = $result["team"];
            $team["yellow_track_time"] = $result["yellow_track_time"];
            $team["yellow_track_touches"] = $result["yellow_track_touches"];
            $team["yellow_track_score"] = $result["yellow_track_score"];
            $team["blue_track_time"] = $result["blue_track_time"];
            $team["blue_track_touches"] = $result["blue_track_touches"];
            $team["blue_track_score"] = $result["blue_track_score"];
            $team["place"] = $result["place"];
            $team["created_at"] = $result["created_at"];
            $team["updated_at"] = $result["updated_at"];
            // success
            $response["success"] = 1;
 
            // user node
            $response["team"] = array();
 
            array_push($response["team"], $team);
 
            // echoing JSON response
            echo json_encode($response);
        } else {
            // no team found
            $response["success"] = 0;
            $response["message"] = "No team found";
 
            // echo no users JSON
            echo json_encode($response);
        }
    } else {
        // no team found
        $response["success"] = 0;
        $response["message"] = "No product found";
 
        // echo no users JSON
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