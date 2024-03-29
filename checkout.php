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

                                    <a href="#" class="block1-icon flex-c-m wrap-pic-max-w js-addcart-b1">
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
    $sql = "SELECT * FROM addCart WHERE address = '$ip'";
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
									<button class="lh-10">
										<img src="images/icons/icon-close.png" alt="CLOSE">
									</button>
								</div>
							</div>
            ';
        }
    } else {
    }
    return $outputGenres;

}

//fillCart2 table
function fillCart2 ($conn){
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
    $sql = "SELECT * FROM addCart WHERE address = '$ip'";
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
            
						<!--  -->
						<div class="flex-w flex-sb-m txt-s-101 cl6 bo-b-1 bocl15 p-b-21 p-t-18">
							<span>
								'.$row["p_name"].' 
								<img class="m-rl-3" src="images/icons/icon-multiply.png" alt="icon">
								'.$row["quantity"].'
							</span>

                            <span>
                                &#8358
                                <span>
                                    '.$row["price"].'
                                </span>
                            </span>
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
    $sqlBeat = "SELECT count(p_name) FROM addCart WHERE address = '$ip'";
    $resultBeat = $conn->query($sqlBeat);
    while ($row = mysqli_fetch_array($resultBeat)){
        $output .= $row["count(p_name)"];
    }
    return $output;
}
?>

<!-- Login PHP Script -->
<?php
 

/*
// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: dashboard/examples/dashboard.php");
    exit;
}
// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin2"]) && $_SESSION["loggedin2"] === true){
    header("location: dashboard/examples/standard.php");
    exit;
}

*/
 
// Include config file
//require_once "config.php";
 
// Define variables and initialize with empty values
$email = $password = "";
$emailErr = $password_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Check if email is empty
    if (empty($_POST["email"])) {
    $emailErr = "* Email is required";
    } else {
    $email = test_input($_POST["email"]);
    // check if e-mail address is well-formed
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $emailErr = "* Invalid email format";
    }
    }
    
    // Check if password is empty
    if(empty(trim($_POST["password"]))){
        $password_err = "* Please enter your password.";
    } else{
        if(strlen($_POST["password"]) <= 8){
            $password_err = "Password characters must be more than 8";
        }else{
            $password = trim($_POST["password"]);
        }
        
    }
    
    // Validate credentials
    if(empty($emailErr) && empty($password_err)){
        if(empty($_POST["creatacc"])){
            // Prepare a select statement
            $sqlLogin = "SELECT name, email, password, user_id FROM customers WHERE email = ?";

            if($stmt = mysqli_prepare($conn, $sqlLogin)){
                // Bind variables to the prepared statement as parameters
                mysqli_stmt_bind_param($stmt, "s", $param_email);

                // Set parameters
                $param_email = $email;

                // Attempt to execute the prepared statement
                if(mysqli_stmt_execute($stmt)){
                    // Store result
                    mysqli_stmt_store_result($stmt);

                    // Check if email exists, if yes then verify password
                    if(mysqli_stmt_num_rows($stmt) == 1){                    
                        // Bind result variables
                        mysqli_stmt_bind_result($stmt, $name, $email, $hashed_password, $user_id);
                        if(mysqli_stmt_fetch($stmt)){
                            if(password_verify($password, $hashed_password)){
                                // Password is correct, so start a new session

                                // Store data in session variables

                                $_SESSION["loggedin"] = true;
                                $_SESSION["user_id"] = $user_id;
                                $_SESSION["userName"] = $name;
                                $_SESSION["email"] = $email;                            

                                // Redirect user to welcome page
                                header("location: checkout.php");
                            } else{
                                // Display an error message if password is not valid
                                $password_err = "The password you entered was not valid.";
                            }
                        }
                    } else{
                        // Display an error message if email doesn't exist
                        $password_err= "No account found with that email.";
                    }
                } else{
                    $password_err = "Oops! Something went wrong. Please try again later.";
                }
            }else{
                $password_err = "Oops! Something went wrong. Please try again later.";
            }

        }else{
            $password2 = test_input($_POST["password"]);
            $email2 = test_input($_POST["email"]);
            $sqlCheck = "SELECT * FROM customers WHERE email = '$email2'";

            $resultCheck = $conn->query($sqlCheck);
            if ($resultCheck->num_rows > 0) {
                // output data of each row
                $emailErr = "* Email has been used";
            } elseif ($resultCheck->num_rows <= 0) {
                        $password_err ="";
                        $password = test_input($_POST["password"]);
                        $hashedpwd = password_hash($password, PASSWORD_DEFAULT);
                        if ($emailErr == "" && $password_err == ""){
                            $user_id = uniqid();

                            date_default_timezone_set("Africa/Lagos");
                            $time = date("h:i:sa");
                            $date = date("Y.m.d");
                            $_SESSION["email"] = $email;
                            $_SESSION["hashedpwd"] = $hashedpwd;
                            $_SESSION["user_id_verify"] = $user_id;
                            $_SESSION["date"] = $date;
                            $_SESSION["time"] = $time;

                            // send otp code to email
                            $rndno=rand(100000, 999999);//OTP generate
                            $_SESSION['otp']=$rndno;
                            $message = urlencode("otp number.".$rndno);
                            /*
                            $to = $email;
                            $subject = "ElbaMarket OTP verification email";
                            $txt = "This is your One Time Password, OTP: ".$rndno."";
                            $headers = "From: info@elbamarket.com";
                                if (mail($to,$subject,$txt,$headers)) {
                                    $_SESSION["email"] = $email;
                                    $_SESSION["hashedpwd"] = $hashedpwd;
                                    $_SESSION["user_id"] = $user_id;
                                    $_SESSION["date"] = $date;
                                    $_SESSION["time"] = $time;
                                    $_SESSION['otp']=$rndno;
                                    header("Location:email-verification.php");
                                } else {
                                    $password_err = "Oops! Something went wrong. Please try again later.";
                                }
                            */
                            header("Location:checkout.php");
                        }else{
                            $password_err = "Oops! Something went wrong. Please try again later.";
                        }


            }else{
                echo "0 results";
            }
        }
        
    }
    
}


//Changing ip address into user_id
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
?>



<?php

function fill_state($conn){
    $outstate .= "";
    $sqlState = "SELECT * FROM states ORDER BY name ASC";
    $resultState = mysqli_query($conn,$sqlState);
    while ($rowState = mysqli_fetch_array($resultState)){
        $outstate .='
            <option value="'.$rowState["name"].'">
                '.$rowState["name"].'
            </option>
        ';
    }
    return $outstate;
    
}



if (isset($_POST['checkoutSubmit'])) {
     $d_nameErr = $d_homeErr = $d_townErr = $d_phoneErr = $d_stateErr = $d_cityErr = "";
    // Form validation
    if (empty($_POST["name"])) {
        $d_nameErr = "Name is required";
    } else {
        $d_name1 = test_input($_POST["name"]);
        if (!preg_match("/^[a-zA-Z ]*$/",$d_name1)) { 
            $d_nameErr = "Only letters and white space allowed";
        }else{
            $d_name = test_input($_POST["name"]);
        }
        
    }
    if (empty($_POST["street"])) {
        $d_homeErr = "Street address is required";
    } else {
        $d_home = test_input($_POST["street"]);
        
    }
    if (empty($_POST["delivery_town"])) {
        $d_townErr = "Town is required";
    } else {
        $d_town = test_input($_POST["delivery_town"]);
        
    }
    if (empty($_POST["delivery_state"])) {
        $d_stateErr = "State is required";
    } else {
        $d_state = test_input($_POST["delivery_state"]);
        
    }
    if (empty($_POST["phone"])) {
        $d_phoneErr = "Phone is required";
    } else {
        $d_phone = test_input($_POST["phone"]);
        
    }
    
    if (empty($_POST["email"])) {
        $d_emailErr = "Email is required";
    } else {
        $d_email = test_input($_POST["email"]);
        
    }
    
    // Inserting data into the database
    if ($d_nameErr == ""  && $d_homeErr == ""  && $d_townErr == ""  && $d_phoneErr == ""  && $d_stateErr == ""  && $d_cityErr == ""){
        date_default_timezone_set("Africa/Lagos");
        $date = date("y/m/d");
        $time = date("h:i:sa");
        $_SESSION["date"] = $date;
        $_SESSION["delivery_id"] = uniqid();
        $_SESSION["d_name"] = $d_name;
        $_SESSION["d_home"] = $d_home;
        $_SESSION["d_town"] = $d_town;
        $_SESSION["d_state"] = $d_state;
        $_SESSION["d_phone"] = $d_phone;
        $_SESSION["d_email"] = $d_email;
        header("Location:payment.php");

    }else{
        echo "Unsuccessful";
    }
    // --Inserting data into the database
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
	<title>Checkout</title>
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
	<?php include"header.php" ?>

	<!-- content page -->
	<div class="bg0 p-t-95 p-b-50">
		<div class="container">


<!-- Check if user is already logged in -->
<?php
  
if(isset($_SESSION['user_id'])) { 
    
//Getting user's data
$user = $_SESSION['user_id'];
$sqlData = "SELECT * FROM customers WHERE user_id = '$user'";
$resultData = mysqli_query($conn,$sqlData);
while ($rowData = mysqli_fetch_array($resultData)){
    $Useremail = $rowData["email"];
    $_SESSION['Useremail'] = $rowData["email"];
    $Username = $rowData["name"];
}
    echo '
    <form class="validate-form" method="post" enctype="multipart/form-data" action="">
			<div class="row">
				<div class="col-md-7 col-lg-8 p-b-50">
					<div>
						<h4 class="txt-m-124 cl3 p-b-28">
							Billing details
						</h4>

						<div class="row p-b-50">
							<div class="col-sm-12 p-b-23">
								<div>
									<div class="txt-s-101 cl6 p-b-10">
										Name <span class="cl12">*</span>
									</div>

									<input class="txt-s-120 cl3 size-a-21 bo-all-1 bocl15 p-rl-20 focus1" type="text" name="name" value="';echo $Username;echo'" required>
								</div>
							</div>

							<div class="col-12 p-b-23">
								<div>
									<div class="txt-s-101 cl6 p-b-10">
										State <span class="cl12">*</span>
									</div>

									<div class="rs1-select2 rs2-select2 bg0 w-full bo-all-1 bocl15 m-tb-7 m-r-15">
                                        <select name="delivery_state" class="js-select2" id="state" onchange="refresh()" required>
                                            <option value="">State</option>
                                            '; echo fill_state($conn);echo' ?>
                                            <option value="Outside Nigeria">Outside Nigeria</option>
                                        </select>
										<div class="dropDownSelect2"></div>
									</div>
								</div>
							</div>

							<div class="col-12 p-b-23">
								<div>
									<div class="txt-s-101 cl6 p-b-10">
										Address <span class="cl12">*</span>
									</div>

									<input class="plh2 txt-s-120 cl3 size-a-21 bo-all-1 bocl15 p-rl-20 focus1 m-b-20" type="text" name="street" placeholder="Street address" required>
									<div class="rs1-select2 rs2-select2 bg0 w-full bo-all-1 bocl15 m-tb-7 m-r-15">
                                        <select name="delivery_town" id="local" class="js-select2" required>
                                           <option value="">Select LGA</option> 
                                        </select>
										<div class="dropDownSelect2"></div>
									</div>
								</div>
							</div>

							<div class="col-sm-6 p-b-23">
								<div>
									<div class="txt-s-101 cl6 p-b-10">
										Phone <span class="cl12">*</span>
									</div>

									<input class="txt-s-120 cl3 size-a-21 bo-all-1 bocl15 p-rl-20 focus1" type="text" name="phone" required>
								</div>
							</div>

							<div class="col-sm-6 p-b-23">
								<div>
									<div class="txt-s-101 cl6 p-b-10">
										Email Address <span class="cl12">*</span>
									</div>

									<input class="txt-s-120 cl3 size-a-21 bo-all-1 bocl15 p-rl-20 focus1" type="text" name="email" value="';echo $Useremail;echo'" required readonly>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="col-md-5 col-lg-4 p-b-50">
					<div class="how-bor4 p-t-35 p-b-40 p-rl-30 m-t-5">
						<h4 class="txt-m-124 cl3 p-b-11">
							Your order
						</h4>

						<div class="flex-w flex-sb-m txt-m-103 cl6 bo-b-1 bocl15 p-b-21 p-t-18">
							<span>
								Product
							</span>

							<span>
								Total
							</span>
						</div>
						
						<!-- fill cart orders -->';
                        echo fillCart2($conn) ;

				   echo '<div class="flex-w flex-m txt-m-103 p-tb-23">
							<span class="size-w-61 cl6">
								Total
							</span>

							<span class="size-w-62 cl10">
                                <!-- fill cart orders -->
                                &#8358 '; echo total($conn) ;
				       echo '</span>
						</div>

						<div class="bo-all-1 bocl15 p-b-25 m-b-30">

							<div class="flex-w flex-m p-rl-20 p-t-17 p-b-10">
								<label class="txt-m-103 cl6">
									Paypal
								</label>

								<div class="w-full p-l-29 p-t-16">
									<a href="#"><img src="images/icons/paypal.png" alt="IMG"></a>
								</div>
							</div>

							<div class="content-paypal bo-tb-1 bocl15 p-rl-20 p-tb-15 m-tb-10 dis-none">
								<p class="txt-s-120 cl9">
									Pay via PayPal; you can pay with your credit card if you don’t have a PayPal account.
								</p>
							</div>								
						</div>

						<button type="submit" name="checkoutSubmit" class="flex-c-m txt-s-105 cl0 bg10 size-a-21 hov-btn2 trans-04 p-rl-10">
							Place order
						</button>
					</div>
				</div>
			</div>
            </form>
    ';
}else{
    echo '
			<!-- Login -->
			<div>
				<div class="txt-s-101 txt-center">
					<span class="cl3">
						Returning customer?
					</span>

					<span class="cl10 hov12 js-toggle-panel1">
						Click here to login
					</span>
				</div>              
                
				<div class="how-bor3 p-rl-15 p-tb-28 m-tb-33 dis-none js-panel1">
					<form class="size-w-60 m-rl-auto" method="post" action="'; echo htmlspecialchars($_SERVER["PHP_SELF"]);echo'">
						<p class="txt-s-120 cl9 txt-center p-b-26">
							If you have shopped with us before, please enter your details in the boxes below. If you are a new customer, please check the create account checkbox.
						</p>

						<div class="row">
							<div class="col-sm-6 p-b-20">
								<div>
									<div class="txt-s-101 cl6 p-b-10">
										Email <span class="cl12">*</span>
									</div>

									<input class="txt-s-120 cl3 size-a-21 bo-all-1 bocl15 p-rl-15 focus1" type="email" name="email" required placeholder="Your email">
                                    <span class="error">'; echo $emailErr;echo'</span>
								</div>
							</div>

							<div class="col-sm-6 p-b-20">
								<div>
									<div class="txt-s-101 cl6 p-b-10">
										Password <span class="cl12">*</span>
									</div>

                                    <input class="txt-s-120 cl3 size-a-21 bo-all-1 bocl15 p-rl-15 focus1" required type="password" name="password" placeholder="Your Password">
                                    <span class="error">'; echo $password_err;
                                    echo'</span>
								</div>
							</div>

							<div class="col-12">
								<button type="submit" name="login" class="flex-c-m txt-s-105 cl0 bg10 size-a-39 hov-btn2 trans-04 p-rl-10 m-r-18">
									Submit
								</button>

								<div class="flex-w flex-m p-tb-8">
									<input id="check-creatacc" class="size-a-35 m-r-10" type="checkbox" name="creatacc">
									<label for="check-creatacc" class="txt-s-101 cl9">
										Create an account?
									</label>
								</div>

								<a href="#" class="txt-s-101 cl9 hov-cl10 trans-04">
									Lost your password?
								</a>
							</div>
						</div>
					</form>
				</div>
			</div>
    ';
}
    
?>
<!-- Insert Comment Here -->  
		</div>
	</div>


	<?php include"footer.php" ?>
	

	<!-- Back to top -->
	<div class="btn-back-to-top bg0-hov" id="myBtn">
		<span class="symbol-btn-back-to-top">
			<span class="fa fa-chevron-up"></span>
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
    
    <script>
        $(document).ready(function(){
            $('#state').change(function(){
                var state = $(this).val();
                $.ajax({
                    url: "refresh.php",
                    method:"POST",
                    data:{state:state},
                    success: function(data){
                        $("#cost").html(data);
                    }
                });
                $.ajax({
                    url: "local.php",
                    method:"POST",
                    data:{state:state},
                    success: function(data){
                        $("#local").html(data);
                    }
                });
            });
        });
    </script>

</body>
</html>