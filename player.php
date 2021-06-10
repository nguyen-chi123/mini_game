<?php
$host="localhost";
$username="root";
$password="";
$database="number";
$conn=mysqli_connect($host,$username,$password,$database);
mysqli_query($conn,"SET NAMES 'utf8'");

if(isset($_POST['username']) && isset($_POST['score'])){
    $username = $_POST['username'];
    $score = $_POST['score'];
    $player = "INSERT INTO player(username, score) VALUES('$username', $score)";
    if(mysqli_query($conn, $player)) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $player . "<br>" . mysqli_error($conn);
    }
    // mysqli_close($conn);
}
$query_data = "SELECT * FROM player ORDER BY score DESC";
$result = mysqli_query($conn, $query_data);
$data = array();
while($u = mysqli_fetch_assoc($result)){
    array_push($data, ["id"=>$u["id"], "username"=>$u["username"], "score"=>$u["score"]]);
}
mysqli_close($conn);
echo json_encode($data);
?>