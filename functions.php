<?php
$conn = mysqli_connect("localhost", "root", "", "rating") or die("Không thể kết nối CSDL");
mysqli_set_charset($conn, "utf8");

function getRatingInfo($id){
    global $conn;
    $query = "SELECT * FROM rating_info WHERE product_id=".$id;
    $result = mysqli_query($conn, $query);
    $return = 'Đánh giá:<br /><ul>';
    if(mysqli_num_rows($result) > 0){
        $row = mysqli_fetch_array($result);
        for($i=5; $i>=1; $i--){
            $return .= "<li><strong>$i Sao</strong>: ".$row['rate_'.$i]."</li>";
        }
    }
    $return .= "</ul>";
    return $return;
}

function setRatingInfo($id, $rate){
    global $conn;
    $query = "SELECT rate_".$rate." FROM rating_info WHERE product_id=".$id;
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_array($result);
    $i = $row['rate_'.$rate] + 1;
    mysqli_query($conn, "UPDATE rating_info SET rate_".$rate."=".$i." WHERE product_id=".$id);
}

function listProduct(){
    global $conn;
    $query = "SELECT * FROM products";
    $result = mysqli_query($conn, $query);
    $return = "";
    while($row = mysqli_fetch_array($result)){
        $return .= '<div style="border-bottom:1px solid #ccc; margin-bottom:10px;">
            <h2><a href="index.php?id='.$row['id'].'">'.$row['title'].'</a></h2>
            '.getRatingInfo($row['id']).'
        </div>';
    }
    return $return;
}
?>