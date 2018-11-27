<?php require_once($_SERVER['DOCUMENT_ROOT']."/page_top.php");?>
<div class="container">
	<div class="row justify-content-center">
		<div class="container-fluid col-lg">
			<!--TODO: pagination -->
			<?php
				$start = isset($_GET['start']) ? intval($_GET['start']) : 0;
				$size = isset($_GET['size']) ? intval($_GET['size']) : 0;
				include($_SERVER['DOCUMENT_ROOT']."/View/get_gallery.php");
				if (!$start)
					get_gallery();
				else if (!$size)
					get_gallery($start);
				else
					get_gallery($start, $size);	
			?>
		</div>
	</div>
</div>
<nav>
	<ul class="pagination">
		<li class="page-item"><a class="page-link" href="#" <?php if (!$start) echo "disabled"?>>Previous</a></li>
		<?php
			$page_size = count_gallery($size);
			for($i = 1; $i <= $page_size; $i++){
		?>
		<li class="page-item"><a class="page-link" href=<?php echo '"/index.php?start='. string(($i - 1) * $size) . '&size=' . $size . '"' ?>><?php echo $i; ?></a></li>
		<?php } ?>
		<li class="page-item"><a class="page-link" href="#" >Next</a></li>
	</ul>
</nav>
<?php include($_SERVER['DOCUMENT_ROOT']."/page_bottom.php");?>