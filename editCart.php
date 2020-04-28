<?php
require"db-conn.php";
$id=mysqli_real_escape_string($conn,$_POST["id"]);
$num=mysqli_real_escape_string($conn,$_POST["num-product1"]);
echo $id;
echo $num;
$sql = "UPDATE addcart SET quantity = '$num' WHERE id = '$id'";

if ($conn->query($sql) === TRUE) {
    //header("Location:shop-cart.php?Updated successfully");
} else {
    echo "Error updating record: " . $conn->error;
}


?>