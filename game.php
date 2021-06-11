
<?php
    $filename = "./data.txt";
    $fp = fopen($filename, "r");//mở file ở chế độ đọc
    $old = fread($fp, filesize($filename));//đọc file
    $choose = null;
    $check = null;
    if(isset($_POST['choose'])){
        $choose = $_POST['choose'];
        if($choose == $old || $old==null){
            $check = true; 
        }
        else{
            $check = false;
        }
    }

    $min = 0;
    $max = 100;
    $time = 30;
    $win = 10;
    $a = random_int($min, $max);
    $b = random_int($min, $max);
    $operator = random_int(1, 3);
    $re = null;

    switch($operator){
        case 1: 
            $re = $a + $b;
            $operator = "+";
            break;
        case 2: 
            $re = $a - $b;
            $operator = "-";
            break;
        case 3: 
            $re = $a * $b;
            $operator = "x";
            break;
        default:
            echo "error";
            break;
    }
    // ghi file
    $fw = fopen($filename, "w+");//ghi đè
    fwrite($fw, $re);
    //

    $w_1 = random_int(0, 200);
    $w_2 = random_int(0, 200);
    $w_3 = random_int(0, 200);
    while($w_1 == $re){
        $w_1 = random_int(0, 200);
    }
    while($w_2 == $re){
        $w_2 = random_int(0, 200);
    }
    while($w_3 == $re){
        $w_3 = random_int(0, 200);
    }

    $kq = array($w_1, $w_2, $w_3, $re);
    shuffle($kq); // trộn kq;

    $hehe = array("a"=>$a, "b"=>$b, "o"=>$operator, "kq"=>$kq, "time"=>$time, "win"=>$win, "check"=>$check);
    echo json_encode($hehe);
  





















   
    /// version2 
// $host="localhost";
// $username="root";
// $password="";
// $database="number";
// $conn=mysqli_connect($host,$username,$password,$database);
// mysqli_query($conn,"SET NAMES 'utf8'");
// // if (mysqli_connect_error())
// // {
// // echo "Failed to connect to MySQL: " . mysqli_connect_error();
// // }
// // else
// // { echo "Success to connect to MySQL"; }

// $query_data = "SELECT * FROM question";
// $result = mysqli_query($conn, $query_data);
// $data = array();
// while($row = mysqli_fetch_assoc($result)){
//     array_push($data, $row["old"]);
// }


// echo json_encode($data);
?>
   
    