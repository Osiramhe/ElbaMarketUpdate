<style>
</style>
<!-- Footer -->
	<footer class="bg12">
		<div class="container">
			<div class="wrap-footer flex-w p-t-60 p-b-62">
				<div class="footer-col1">
					<div class="footer-col-title">
						<a href="#">
							<img src="images/icons/elba.png" alt="LOGO" width="120px" height="120px">
						</a>
					</div>

					<p class="txt-s-101 cl6 size-w-10 p-b-16">
						We are an ecommerce company operating in the agriculture NICHE. We are Nigeria's disruptive fast growing agro-commerce with an innovative approach in solving Africa's food crises by bridging the gap between farmers and consumers.
					</p>

					<ul>
						<li class="txt-s-101 cl6 flex-t p-b-10">
							<span class="size-w-11">
								<img src="images/icons/icon-mail.png" alt="ICON-MAIL">
							</span>
							
							<span class="size-w-12 p-t-1">
								markrussell@example.com
							</span>
						</li>

						<li class="txt-s-101 cl6 flex-t p-b-10">
							<span class="size-w-11">
								<img src="images/icons/icon-pin.png" alt="ICON-MAIL">
							</span>
							
							<span class="size-w-12 p-t-1">
								Office 008, Furniture Plaza, AB, 2 Constitution Rd, Kaduna State, Nigeria.
							</span>
						</li>

						<li class="txt-s-101 cl6 flex-t p-b-10">
							<span class="size-w-11">
								<img src="images/icons/icon-phone.png" alt="ICON-MAIL">
							</span>
							
							<span class="size-w-12 p-t-1">
                                +234 8185324897, +234 8174265864
							</span>
						</li>
					</ul>
				</div>
				<div class="footer-col2">
				</div>
				<div class="footer-col3">
					<div class="footer-col-title flex-m">
						<span class="txt-m-109 cl3">
							Our Company
						</span>
					</div>

					<ul>
						<li class="p-b-16">
							<a href="index.php" class="txt-s-101 cl6 hov-cl10 trans-04 p-tb-5">
								Home
							</a>
						</li>

						<li class="p-b-16">
							<a href="about.php" class="txt-s-101 cl6 hov-cl10 trans-04 p-tb-5">
								Who are we?
							</a>
						</li>

						<li class="p-b-16">
							<a href="shop.php" class="txt-s-101 cl6 hov-cl10 trans-04 p-tb-5">
								Shop
							</a>
						</li>

						<li class="p-b-16">
							<a href="index.php#WhatWeOffer" class="txt-s-101 cl6 hov-cl10 trans-04 p-tb-5">
								What we offer?
							</a>
						</li>

						<li class="p-b-16">
							<a href="contact.php" class="txt-s-101 cl6 hov-cl10 trans-04 p-tb-5">
								Contact Us
							</a>
						</li>

						<li class="p-b-16">
							<a href="account.php" class="txt-s-101 cl6 hov-cl10 trans-04 p-tb-5">
								Account
							</a>
						</li>
					</ul>
				</div>

				<div class="footer-col4">
					<div class="footer-col-title flex-m">
						<span class="txt-m-109 cl3">
							Products
						</span>
					</div>
					<div class="flex-w flex-sb p-t-6">
<?php
    $sql = "SELECT * FROM farmproduce LIMIT 6";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // output data of each row
        $incr =2;
        while($row = $result->fetch_assoc()) {

            echo '
                <div class="size-w-13 m-b-10">
                    <a href="#" class="dis-block size-a-7 bg-img1 hov4"
                    style="background-image: url(admin/pages/uploads/'.$row["image"].');"></a>
                </div>
            ';
            $incr ++;
        }
    } else {
    }  
    
?>
					</div>
				</div>
			</div>

			<div class="flex-w flex-sb-m bo-t-1 bocl14 p-tb-14 text-center">
				<span class="txt-s-101 cl9 p-tb-10 p-r-29">
					Copyright © 2020 Elba Market. All rights reserved.
				</span>
			</div>
		</div>
	</footer>