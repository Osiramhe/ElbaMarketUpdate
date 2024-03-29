<?php
require "db-conn.php";
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
if(empty($_SESSION)){ // if the session not yet started
   session_start();
}

//Changing ip address into user_id
if(!isset($_SESSION['user_id'])) { //if not yet logged in
   header("Location:login.php?Not logged in");// send to login page
   exit;
}
if(isset($_SESSION['user_id'])) { //if not yet logged in
    $user_id = $_SESSION['user_id'];
    if(!empty($_SERVER['HTTP_CLIENT_IP'])){
        //ip from share internet
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    }elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
        //ip pass from proxy
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }else{

        $ip = $_SERVER['REMOTE_ADDR'];
    }
    $sql = "UPDATE addcart SET address='$user_id' WHERE address='$ip'";

    if (mysqli_query($conn, $sql)) {
        //echo "Record updated successfully";
    } else {
        //echo "Error updating record: " . mysqli_error($conn);
    }
}

//Refill category database
$sqlGenre1 = "SELECT * FROM farmproduce";
$resultGenre1 = $conn->query($sqlGenre1);

if ($resultGenre1->num_rows > 0) {
    // output data of each row
    while($rowGenre1 = $resultGenre1->fetch_assoc()) {
        $genre1 = $rowGenre1["category"];
        // check if the category already exist in category database
        $sqlGenre1New = "SELECT * FROM category WHERE category_name = '$genre1'";
        $resultGenre1New = $conn->query($sqlGenre1New);
        if ($resultGenre1New->num_rows > 0) {
            
        }else{
            $sqlInsertGenre1 = "INSERT INTO category (category_name,category_value)
            VALUES ('$genre1','$genre1')";

            if ($conn->query($sqlInsertGenre1) === TRUE) {
            } else {
            }
        }
    }
} else {
}

/* fillCategory */
function fillCategory ($conn){
    $outputGenres = '';
    $sql = "SELECT * FROM category ORDER BY category_name ASC";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // output data of each row
        $incr =2;
        $outputGenres .= '
            <button class="txt-m-104 cl9 hov2 trans-04 p-rl-27 p-b-10 how-active1" data-filter="*">
                All Products
            </button>
        ';
        while($row = $result->fetch_assoc()) {

            $outputGenres .= '
                <button class="txt-m-104 cl9 hov2 trans-04 p-rl-27 p-b-10" data-filter=".'.$row["category_value"].'">
                    '.$row["category_name"].'
                </button>
            ';
            $incr ++;
        }
    } else {
    }
    return $outputGenres;
}


/* fillproduct */
function fillProduct ($conn){
    $outputGenres = '';
    $sql = "SELECT * FROM farmproduce LIMIT 8";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // output data of each row
        $incr =2;
        while($row = $result->fetch_assoc()) {

            $outputGenres .= '
                <div class="col-sm-6 col-md-4 col-lg-3 p-b-75 isotope-item fruit-juic-fill '.$row["category"].'">
                    <!-- Block1 -->
                    <div class="block1">
                        <div class="block1-bg wrap-pic-w bo-all-1 bocl12 hov3 trans-04">
                            <img src="admin/pages/uploads/'.$row["image"].'" alt="IMG" class="p-img">

                            <div class="block1-content flex-col-c-m p-b-46">
                                <a href="product-single.php?id='.$row['product_id'].'" class="txt-m-103 cl3 txt-center hov-cl10 trans-04 js-name-b1">
                                    '.$row["name"].'
                                </a>

                                <span class="block1-content-more txt-m-104 cl9 p-t-21 trans-04" style="font-weight:600;color:white">
                                    &#8358 '.$row['price'].' per '.$row['packaging'].'kg
                                </span>

                                <div class="block1-wrap-icon flex-c-m flex-w trans-05">
                                    <a href="product-single.php?id='.$row['product_id'].'" class="block1-icon flex-c-m wrap-pic-max-w">
                                        <img src="images/icons/icon-view.png" alt="ICON">
                                    </a>

                                    <a href="index.php?id='.$row['product_id'].'" class="block1-icon flex-c-m wrap-pic-max-w js-addcart2-b1">
                                        <img src="images/icons/icon-cart.png" alt="ICON">
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>	
                </div>
            ';
            $incr ++;
        }
    } else {
    }
    return $outputGenres;
}

/* fillVegetableSpecial */
function fillVegSpecial ($conn){
    $outputGenres = '';
    $sql = "SELECT * FROM farmproduce WHERE category = 'Vegetables' LIMIT 3";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // output data of each row
        $incr =2;
        while($row = $result->fetch_assoc()) {

            $outputGenres .= '
                <!-- item product2 -->
                <a href="product-single.php?id='.$row['product_id'].'" class="flex-w flex-str size-h-1 bo-all-1 bocl12 hov3 trans-04 m-b-30">
                    <div class="size-w-6 flex-c-m wrap-pic-max-s">
                        <img src="admin/pages/uploads/'.$row["image"].'" alt="IMG" class="ps-img">
                    </div>

                    <div class="size-w-7 flex-col-m p-l-30 p-tb-15 p-r-15 p-l-0-ssm">
                        <span class="txt-m-103 cl3">
                            '.$row["name"].'
                        </span>

                        <div class="how-line1 m-t-14 m-b-19"></div>

                        <span class="txt-m-104 cl9">
                            &#8358 '.$row['price'].' per '.$row['packaging'].'kg
                        </span>
                    </div>
                </a>
            ';
            $incr ++;
        }
    } else {
    }
    return $outputGenres;
}

/* fillTuberSpecial */
function fillTubSpecial ($conn){
    $outputGenres = '';
    $sql = "SELECT * FROM farmproduce WHERE category = 'Tubers' LIMIT 3";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // output data of each row
        $incr =2;
        while($row = $result->fetch_assoc()) {

            $outputGenres .= '
                <!-- item product2 -->
                <a href="product-single.php?id='.$row['product_id'].'" class="flex-w flex-str size-h-1 bo-all-1 bocl12 hov3 trans-04 m-b-30">
                    <div class="size-w-6 flex-c-m wrap-pic-max-s">
                        <img src="admin/pages/uploads/'.$row["image"].'" alt="IMG" class="ps-img">
                    </div>

                    <div class="size-w-7 flex-col-m p-l-30 p-tb-15 p-r-15 p-l-0-ssm">
                        <span class="txt-m-103 cl3">
                            '.$row["name"].'
                        </span>

                        <div class="how-line1 m-t-14 m-b-19"></div>

                        <span class="txt-m-104 cl9">
                            &#8358 '.$row['price'].' per '.$row['packaging'].'kg
                        </span>
                    </div>
                </a>
            ';
            $incr ++;
        }
    } else {
    }
    return $outputGenres;
}

/* fillGrainsSpecial */
function fillGrainsSpecial ($conn){
    $outputGenres = '';
    $sql = "SELECT * FROM farmproduce WHERE category = 'Grains' LIMIT 3";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // output data of each row
        $incr =2;
        while($row = $result->fetch_assoc()) {

            $outputGenres .= '
                <!-- item product2 -->
                <a href="product-single.php?id='.$row['product_id'].'" class="flex-w flex-str size-h-1 bo-all-1 bocl12 hov3 trans-04 m-b-30">
                    <div class="size-w-6 flex-c-m wrap-pic-max-s">
                        <img src="admin/pages/uploads/'.$row["image"].'" alt="IMG" class="ps-img">
                    </div>

                    <div class="size-w-7 flex-col-m p-l-30 p-tb-15 p-r-15 p-l-0-ssm">
                        <span class="txt-m-103 cl3">
                            '.$row["name"].'
                        </span>

                        <div class="how-line1 m-t-14 m-b-19"></div>

                        <span class="txt-m-104 cl9">
                            &#8358 '.$row['price'].' per '.$row['packaging'].'kg
                        </span>
                    </div>
                </a>
            ';
            $incr ++;
        }
    } else {
    }
    return $outputGenres;
}

//Count vegetables
function count_veg ($conn){
    $output = '';
    //$user_id = $_SESSION["user_id"];
    $sqlUpload = "SELECT count(category) FROM farmproduce WHERE category = 'Vegetables'";
    $resultUpload = $conn->query($sqlUpload);
    while ($row = mysqli_fetch_array($resultUpload)){
        $output .= $row["count(category)"];
    }
    return $output;
}

//Count fruits
function count_fruits ($conn){
    $output = '';
    //$user_id = $_SESSION["user_id"];
    $sqlUpload = "SELECT count(category) FROM farmproduce WHERE category = 'Fruits'";
    $resultUpload = $conn->query($sqlUpload);
    while ($row = mysqli_fetch_array($resultUpload)){
        $output .= $row["count(category)"];
    }
    return $output;
}

//Count tubers
function count_tub ($conn){
    $output = '';
    //$user_id = $_SESSION["user_id"];
    $sqlUpload = "SELECT count(category) FROM farmproduce WHERE category = 'Tubers'";
    $resultUpload = $conn->query($sqlUpload);
    while ($row = mysqli_fetch_array($resultUpload)){
        $output .= $row["count(category)"];
    }
    return $output;
}

//Count spices
function count_spices ($conn){
    $output = '';
    //$user_id = $_SESSION["user_id"];
    $sqlUpload = "SELECT count(category) FROM farmproduce WHERE category = 'Spices'";
    $resultUpload = $conn->query($sqlUpload);
    while ($row = mysqli_fetch_array($resultUpload)){
        $output .= $row["count(category)"];
    }
    return $output;
}


/* End PHP Script */
?>

<!-- Cart PHP Script -->
<?php
function fillCart ($conn){
    $outputGenres = '';
    // -- Get ip details
    if(!isset($_SESSION['user_id'])) { //if not yet logged in
        if(!empty($_SERVER['HTTP_CLIENT_IP'])){
            //ip from share internet
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        }elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
            //ip pass from proxy
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        }else{

            $ip = $_SERVER['REMOTE_ADDR'];
        }
    }else{
        $ip = $_SESSION['user_id'];
    }
    $sql = "SELECT * FROM addcart WHERE address = '$ip'";
    $result = $conn->query($sql);
    $total =0;
    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            $beat_id = $row["p_id"];
            $sqlImage = "SELECT * FROM farmproduce WHERE product_id = '$beat_id'";
            $resultImage = $conn->query($sqlImage);

            if ($resultImage->num_rows > 0) {
                // output data of each row
                while($rowImage = $resultImage->fetch_assoc()) {
                    $image = $rowImage["image"];
                }
            }
            $outputGenres .= '
							<div class="flex-w flex-str m-b-25">
								<div class="size-w-15 flex-w flex-t">
									<a href="product-single.php" class="wrap-pic-w bo-all-1 bocl12 size-w-16 hov3 trans-04 m-r-14">
										<img src="admin/pages/uploads/'.$image.'" alt="PRODUCT">
									</a>

									<div class="size-w-17 flex-col-l">
										<a href="product-single.php" class="txt-s-108 cl3 hov-cl10 trans-04">
											'.$row["p_name"].'
										</a>

										<span class="txt-s-101 cl9">
											&#8358 '.$row["price"].'
										</span>

										<span class="txt-s-109 cl12">
											x'.$row["quantity"].'
										</span>
									</div>
								</div>

								<div class="size-w-14 flex-b">
									<a href="deleteHomeCart.php?id='.$row["id"].'" class="lh-10">
										<img src="images/icons/icon-close.png" alt="CLOSE">
									</a>
								</div>
							</div>
            ';
        }
    } else {
    }
    return $outputGenres;

}
//Total prices
function total ($conn){
    $outputGenres = '';
    // -- Get ip details
    if(!isset($_SESSION['user_id'])) { //if not yet logged in
        if(!empty($_SERVER['HTTP_CLIENT_IP'])){
            //ip from share internet
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        }elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
            //ip pass from proxy
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        }else{

            $ip = $_SERVER['REMOTE_ADDR'];
        }
    }else{
        $ip = $_SESSION['user_id'];
    }
    $sql = "SELECT SUM(price) FROM addCart WHERE address = '$ip'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            $outputGenres .= $row["SUM(price)"];
        }
    } else {
    }
    return $outputGenres;

}
//Count all cart
function count_cart ($conn){
    $output = '';
    // -- Get ip details
    if(!isset($_SESSION['user_id'])) { //if not yet logged in
        if(!empty($_SERVER['HTTP_CLIENT_IP'])){
            //ip from share internet
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        }elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
            //ip pass from proxy
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        }else{

            $ip = $_SERVER['REMOTE_ADDR'];
        }
    }else{
        $ip = $_SESSION['user_id'];
    }
    $sqlBeat = "SELECT count(p_name) FROM addcart WHERE address = '$ip'";
    $resultBeat = $conn->query($sqlBeat);
    while ($row = mysqli_fetch_array($resultBeat)){
        $output .= $row["count(p_name)"];
    }
    return $output;
}
?>

<?php

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>My Account</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="images/icons/elba.png"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/linearicons-v1.0.0/icon-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/slick/slick.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/lightbox2/css/lightbox.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/perfect-scrollbar/perfect-scrollbar.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
<!--===============================================================================================-->
</head>
<body class="animsition">

	<!-- Header -->
	<?php include "header.php" ?>

	<!-- content page -->
	<div class="bg0 p-t-95 p-b-70">
		<div class="container">
			<!-- Tab03 -->
			<div class="tab03">
				<div class="row">
					<div class="col-md-3 col-lg-2 p-b-30">
						<!-- Nav tabs -->
						<ul class="nav nav-tabs" role="tablist">
							<li class="nav-item p-b-16">
								<a class="nav-link active" data-toggle="tab" href="#dashboard" role="tab">Dashboard</a>
							</li>
                            <!-- Insert Comment Here -
							<li class="nav-item p-b-16">
								<a class="nav-link" data-toggle="tab" href="#account-details" role="tab">Account details</a>
							</li>
                            <!-- Insert Comment Here -->

							<li class="nav-item p-b-16">
								<a class="nav-link" href="logout.php">Logout</a>
							</li>
						</ul>
					</div>
						
					<div class="col-md-9 col-lg-10 p-b-30">
						<!-- Tab panes -->
						<div class="tab-content p-l-70 p-l-0-lg">
							<!-- - -->
							<div class="tab-pane fade show active" id="dashboard" role="tabpanel">
								<p class="txt-s-101 cl6 p-b-18">
									Hello <span class="txt-s-108"><?php echo $_SESSION['userName']; ?></span>
								</p>

								<p>
									From your account dashboard you can view your recent orders, manage your shipping and billing addresses and edit your password and account details.
								</p>
								<div class="bo-all-1 bocl15 flex-w flex-sb-m p-rl-30 p-tb-10 p-rl-15-ssm">
                                    
<?php
    $user_id = $_SESSION["user_id"];
    $sql = "SELECT * FROM delivery WHERE user_id = '$user_id'";
    $result = $conn->query($sql);
    $total =0;
    if ($result->num_rows > 0) {
        // output data of each row
        
        echo '
            <div class="wrap-table-shopping-cart">
                <table class="table-shopping-cart">
                    <tr class="table_head bg12">
                        <th class="column-1 p-l-30">Product</th>
                        <th class="column-2">Price</th>
                        <th class="column-3">Quantity</th>
                        <th class="column-4">Total</th>
                    </tr>
                </table>
            </div>
        ';
        
        while($row = $result->fetch_assoc()) {
            echo '
                <tr>
                    <td>
                        '.$row["product_name"].'
                    </td>
                    <td>
                        '.$row["price"] / $row["quantity"].'
                    </td>
                    
                    <td>
                        '.$row["quantity"].'
                    </td>
                    <td>
                        '.$row["price"].'
                    </td>
                </tr>
            ';
        }
    }else{
        echo '
            <div class="flex-t p-tb-8 m-r-30">
                <img class="m-t-6 m-r-10" src="images/icons/icon-list.png" alt="IMG">
                <span class="size-w-53 txt-s-101 cl6">
                    No order has been made yet.
                </span>
            </div>

            <a href="shop.php" class="flex-c-m txt-s-105 cl0 bg10 size-a-42 hov-btn2 trans-04 p-rl-10 m-tb-8">
                go shop
            </a>
            <div class="wrap-table-shopping-cart">
                <table class="table-shopping-cart">
                    <tr class="table_head bg12">
                        <th class="column-1 p-l-30">Product</th>
                        <th class="column-2">Price</th>
                        <th class="column-3">Quantity</th>
                        <th class="column-4">Total</th>
                    </tr>
                </table>
            </div>
        ';
    }                                  
?>
								</div>
							</div>

							<!-- - -->
							<div class="tab-pane fade" id="addresses" role="tabpanel">
								<p class="txt-s-101 cl6">
									The following addresses will be used on the checkout page by default.
								</p>

								<div class="flex-w flex-sb p-t-37">
									<div class="size-w-63 flex-t w-full-sm p-b-35">
										<div class="size-w-53 p-r-30">
											<h5 class="txt-m-109 cl3 p-b-7">
												Billing address
											</h5>

											<p class="txt-s-101 cl6">
												You have not set up this type of address yet.
											</p>
										</div>

										<a href="#" class="txt-s-115 cl10 hov12 hov-cl10 p-t-6">
											Edit
										</a>
									</div>

									<div class="size-w-63 flex-t w-full-sm p-b-35">
										<div class="size-w-53 p-r-30">
											<h5 class="txt-m-109 cl3 p-b-7">
												Shipping address
											</h5>

											<p class="txt-s-101 cl6">
												You have not set up this type of address yet.
											</p>
										</div>

										<a href="#" class="txt-s-115 cl10 hov12 hov-cl10 p-t-6">
											Edit
										</a>
									</div>
								</div>
							</div>

							<!-- - -->
							<div class="tab-pane fade" id="account-details" role="tabpanel">
								<form>
									<div class="row">
										<div class="col-sm-6 p-b-23">
											<div>
												<div class="txt-s-101 cl6 p-b-10">
													First Name <span class="cl12">*</span>
												</div>

												<input class="txt-s-120 cl3 size-a-21 bo-all-1 bocl15 p-rl-20 focus1" type="text" name="first-name">
											</div>
										</div>

										<div class="col-sm-6 p-b-23">
											<div>
												<div class="txt-s-101 cl6 p-b-10">
													Last Name <span class="cl12">*</span>
												</div>

												<input class="txt-s-120 cl3 size-a-21 bo-all-1 bocl15 p-rl-20 focus1" type="text" name="last-name">
											</div>
										</div>

										<div class="col-12 p-b-23">
											<div>
												<div class="txt-s-101 cl6 p-b-10">
													Email address <span class="cl12">*</span>
												</div>

												<input class="txt-s-120 cl3 size-a-21 bo-all-1 bocl15 p-rl-20 focus1" type="text" name="email" placeholder="example@abc.xyz">
											</div>
										</div>

										<h5 class="txt-m-109 cl3 p-rl-15 p-t-10 p-b-17">
											Password change
										</h5>

										<div class="col-12 p-b-23">
											<div>
												<div class="txt-s-101 cl6 p-b-10">
													Current password (leave blank to leave unchanged)
												</div>

												<input class="txt-s-120 cl3 size-a-21 bo-all-1 bocl15 p-rl-20 focus1" type="text" name="current-pw">
											</div>
										</div>

										<div class="col-12 p-b-23">
											<div>
												<div class="txt-s-101 cl6 p-b-10">
													New password (leave blank to leave unchanged)
												</div>

												<input class="txt-s-120 cl3 size-a-21 bo-all-1 bocl15 p-rl-20 focus1" type="text" name="new-pw">
											</div>
										</div>

										<div class="col-12 p-b-23">
											<div>
												<div class="txt-s-101 cl6 p-b-10">
													Confirm new password
												</div>

												<input class="txt-s-120 cl3 size-a-21 bo-all-1 bocl15 p-rl-20 focus1" type="text" name="cf-new-pw">
											</div>
										</div>

										<div class="flex-w p-rl-15 p-t-17">
											<button class="flex-c-m txt-s-105 cl0 bg10 size-a-43 hov-btn2 trans-04 p-rl-10">
												Save address
											</button>
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<?php include"footer.php" ?>
	

	<!-- Back to top -->
	<div class="btn-back-to-top bg0-hov" id="myBtn">
		<span class="symbol-btn-back-to-top">
			<span class="lnr lnr-chevron-up"></span>
		</span>
	</div>

	

<!--===============================================================================================-->	
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/daterangepicker/moment.min.js"></script>
	<script src="vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="vendor/slick/slick.min.js"></script>
	<script src="js/slick-custom.js"></script>
<!--===============================================================================================-->
	<script src="vendor/parallax100/parallax100.js"></script>
<!--===============================================================================================-->
	<script src="vendor/lightbox2/js/lightbox.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/isotope/isotope.pkgd.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/sweetalert/sweetalert.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/perfect-scrollbar/perfect-scrollbar.min.js"></script>
<!--===============================================================================================-->
	<script src="js/main.js"></script>

</body>
</html>