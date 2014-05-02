<?php
 
/*
 * Following code will update a team information
 * A product is identified by team id (id)
 */
 
// array for JSON response
$response = array();
 
// check for required fields
if (isset($_POST['id']) && isset($_POST['score']) && isset($_POST['touches'])) {
 
    $id = $_POST['id'];
    $score = $_POST['score'];
    $touches = $_POST['touches'];
    $track = $_POST['track'];
    $time = $_POST['time'];
 
    // include db connect class
    require_once __DIR__ . '/db_connect.php';
 
    // connecting to db
    $db = new DB_CONNECT();
    $updated_at = date('Y-m-d H:i:s');
    if($track == 0) {
        // mysql update row with matched id
        $result = mysql_query("UPDATE robocomp SET yellow_track_time = '$time', yellow_track_touches = '$touches', yellow_track_score = '$score', updated_at = '$updated_at' WHERE id = '$id'");
    } else if ($track == 1) {
        $result = mysql_query("UPDATE robocomp SET blue_track_time = '$time', blue_track_touches = '$touches', blue_track_score = '$score', updated_at = '$updated_at' WHERE id = '$id'");
    } else {
        // default to failure
        $result = 0;
    }    
 
    // check if row inserted or not
    if ($result) {
        // successfully updated
        $response["success"] = 1;
        $response["message"] = "Team successfully updated.";
 
        // echoing JSON response
        echo json_encode($response);
    } else {
 
    }
} else {
    // required field is missing
    $response["success"] = 0;
    $response["message"] = "Required field(s) is missing";
 
    // echoing JSON response
    echo json_encode($response);
}
?>