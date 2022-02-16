<?php
include('layout/connection.php');
$sql=$conn->prepare("SELECT categories.category_name as cat_name,subcategories.id as subcat_id,subcategories.subcat_name as subcat_name FROM subcategories RIGHT JOIN categories ON subcategories.cat_id=categories.id WHERE categories.status=1");
	$sql->execute();
	$results = $sql->fetchAll();
	$menus = [];
	foreach($results as $result){
		$menus[$result['cat_name']][$result['subcat_id']] = $result['subcat_name'];
	}
	//print_r($menus);
?>

<div class="col-sm-3">
	<div class="left-sidebar">
		<h2>Category</h2>
		
		<div class="panel-group category-products" id="accordian">
		<!--category-productsr-->
			<?php foreach($menus as $cat=>$subcats){ ?>
			<div class="panel panel-default">
				<div class="panel-heading">
					<h4 class="panel-title">
						<a data-toggle="collapse" data-parent="#accordian" href="#<?php echo $cat ;?>">
							<span class="badge pull-right"><i class="fa fa-plus"></i></span>
							<?php echo $cat ;?>
						</a>

					</h4>
				</div>
				<div id="<?php echo $cat ;?>" class="panel-collapse collapse">
					<div class="panel-body">

						<ul>
						<?php foreach ($subcats as $subcat) {?>
						
							<li><a href="shop.php?category=<?= $cat ?>&subcategory=<?= $subcat ?>"> <?php echo $subcat ;?></a></li>
							<?php } ?>
						</ul>
						
					</div>
				</div>
			</div>
			<?php } ?>
			<div class="panel panel-default">
				<div class="panel-heading">
					<h4 class="panel-title"><a href="#">Kids</a></h4>
				</div>
			</div>
		</div><!--/category-products-->
	

		<div class="brands_products"><!--brands_products-->
			<h2>Brands</h2>
			<div class="brands-name">
				<ul class="nav nav-pills nav-stacked">
					<li><a href="#"> <span class="pull-right">(50)</span>Acne</a></li>
					<li><a href="#"> <span class="pull-right">(56)</span>Grüne Erde</a></li>
					<li><a href="#"> <span class="pull-right">(27)</span>Albiro</a></li>
					<li><a href="#"> <span class="pull-right">(32)</span>Ronhill</a></li>
					<li><a href="#"> <span class="pull-right">(5)</span>Oddmolly</a></li>
					<li><a href="#"> <span class="pull-right">(9)</span>Boudestijn</a></li>
					<li><a href="#"> <span class="pull-right">(4)</span>Rösch creative culture</a></li>
				</ul>
			</div>
		</div><!--/brands_products-->
		
		<div class="price-range"><!--price-range-->
			<h2>Price Range</h2>
			<div class="well text-center">
					<input type="text" class="span2" value="" data-slider-min="0" data-slider-max="600" data-slider-step="5" data-slider-value="[250,450]" id="sl2" ><br />
					<b class="pull-left">$ 0</b> <b class="pull-right">$ 600</b>
			</div>
		</div><!--/price-range-->
	
	</div>
</div>