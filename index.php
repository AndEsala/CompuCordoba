<?php 
	include 'includes/funciones/functions.php';
	include 'includes/templates/header.php'; 
?>

<!-- Inicio de Banners -->
<div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
 	<ol class="carousel-indicators">
    	<li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
    	<li data-target="#carouselExampleCaptions" data-slide-to="1"></li>
    	<li data-target="#carouselExampleCaptions" data-slide-to="2"></li>
  	</ol>

  	<div class="carousel-inner">
    	<div class="carousel-item active">
      		<img src="css/img/banner2.jpg" class="d-block w-100" alt="...">
   		</div>

    	<div class="carousel-item">
      		<img src="css/img/banner3.jpg" class="d-block w-100" alt="...">
    	</div>

   		<div class="carousel-item">
      		<img src="css/img/banner4.jpg" class="d-block w-100" alt="...">
    	</div>
  	</div>

  	<a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
    	<span class="carousel-control-prev-icon" aria-hidden="true"></span>
    	<span class="sr-only">Previous</span>
  	</a>

  	<a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
    	<span class="carousel-control-next-icon" aria-hidden="true"></span>
    	<span class="sr-only">Next</span>
 	</a>
</div>
<!-- Fin de Banners -->

<?php include 'includes/templates/productos.php'; ?>

<?php include 'includes/templates/footer.php'; ?>