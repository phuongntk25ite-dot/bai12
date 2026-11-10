<?php
include("functions.php");

if(isset($_GET['id'])){
    $id = $_GET['id'];
    if(isset($_POST['rate_submit'])){
        if(isset($_POST['rate'])){
            setRatingInfo($id, $_POST['rate']);
        }
    }
    
    $query = "SELECT * FROM products WHERE id=".$id;
    $result = mysqli_query($conn, $query);
    $product = mysqli_fetch_array($result);
    ?>
    <h2><?php echo $product['title']; ?></h2>
    <?php echo getRatingInfo($id); ?>
    <form action="" method="POST">
        <h3>Gửi đánh giá:</h3>
        <input type="radio" name="rate" value="5" checked> 5 
        <input type="radio" name="rate" value="4"> 4 
        <input type="radio" name="rate" value="3"> 3 
        <input type="radio" name="rate" value="2"> 2 
        <input type="radio" name="rate" value="1"> 1<br/><br/>
        <input type="submit" name="rate_submit" value="Đánh giá">
    </form>
    <br><a href="index.php">Quay lại danh sách</a>
    <?php
} else {
    echo "<h1>DANH SÁCH SẢN PHẨM</h1>";
    echo listProduct();
}
?>