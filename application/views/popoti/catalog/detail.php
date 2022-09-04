<?php $foto = json_decode($rows->detail_picture,true) ?>
<div class="row">
	<div class="col">
		<div class="card">
			<div class="card-body">
				<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
				  <ol class="carousel-indicators">
				    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
				    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
				    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
				  </ol>
				  <div class="carousel-inner">
				  	<?php foreach ($foto as $key => $value): ?>
					    <div class="carousel-item <?php echo ($key == 0) ? 'active' : '' ?>	">
					      <img class="d-block w-100" src="<?php echo base_url('upload/files/'.$value['foto-'.($key + 1)]) ?>" alt="<?php echo $key + 1 ?> slide">
					    </div>
				  	<?php endforeach ?>
				  <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
				    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
				    <span class="sr-only">Previous</span>
				  </a>
				  <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
				    <span class="carousel-control-next-icon" aria-hidden="true"></span>
				    <span class="sr-only">Next</span>
				  </a>
				</div>
				<a href="<?php echo base_url('catalog') ?>" class="btn btn-primary mt-3"><span class="fa fa-arrow-left mr-2"></span>Back</a>
			</div>
		</div>
	</div>
</div>