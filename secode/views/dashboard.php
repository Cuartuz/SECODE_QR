<?php
if(isset($_SESSION["Ndocumeto"])){

}else{
	header('Location: index.html');
}

//apis de generacion del qr

'https://quickchart.io/qr?text=jkdhkfjhdskfjhsdkfjhsdkjfhsdlkfjhsdkfjhsdklfjhsdkjfhsdkfjhsd%27s%20my%20text&centerImageUrl=https://raw.githubusercontent.com/luis-fer993/Pineapple-editor/master/img-pineappple.png&dark=a06800&light=f52fff&size=300&ecLevel=H&centerImageWidth=30&centerImageHeight=30';


?>




<!DOCTYPE html>
<html lang="en">

<head>
	<title>dashboard</title>
<?php
include('./templates/header.php');
?>
</head>
<body>

	<!--PreLoader-->
    <div class="loader">
		<div class="inner"></div>
		<div class="inner"></div>
		<div class="inner"></div>
		<div class="inner"></div>
		<div class="inner"></div>
	</div>
    <!--PreLoader Ends--> 
    <div class=container">

        <header>
			<?php
				include('./templates/navBar.php');
			?>
		
        </header>
        <main class="container">.,.,       
<!-- product section -->
<div class="product-section mt-150 mb-150 pt-4">
<div class="container pt-4 mb-5 center">
                <h1>
                    Mis codigos QR
                </h1>
            </div>
		<div class="container">
		

<?
foreach($code as $codes){

?>



			<div class="roww">
				<div class="col-lg-4 col-md-6 text-center">
					<div class="single-product-item">
						<div class="product-image">
							<a href="single-product.html"><img src="<?php //echo $code['url'] ?>" alt=""></a>
						</div>
						<h3><?php // echo $code['title'] ?></h3>
						<p class="product-price"><span><?php // echo $code['description'] ?></span> </p>
						<a href="cart.html" class="cart-btn"><i class="fas fa-pen"></i> opciones</a>
					</div>
				</div>
			</div>

<?   };?>   

		</div>
	</div>
	<!-- end product section -->

        </main>

<?php

include('./templates/footerWebUser.php')
?>
        
    </div>
</body>

</html>





?>