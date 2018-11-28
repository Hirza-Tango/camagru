<?php require_once($_SERVER['DOCUMENT_ROOT']."/page_top.php");?>
<div class="container">
	<div class="row justify-content-center">
		<div class="container-fluid col-lg">
			<?php
				$start = isset($_GET['start']) ? intval($_GET['start']) : 0;
				$size = isset($_GET['size']) ? intval($_GET['size']) : 5;
				include($_SERVER['DOCUMENT_ROOT']."/View/get_gallery.php");
				if (!$start)
					get_gallery();
				else if (!$size)
					get_gallery($start);
				else
					get_gallery($start, $size);	
					?>
			<nav>
				<ul class="pagination justify-content-center">
					<li class=<?php
						echo '"page-item';
						if (!$start) echo " disabled";
						echo '"';
						?>><a class="page-link" href=<?php echo '"/index.php?start='. ($start - 5) . '&size=' . $size . '"' ?>>Previous</a></li>
					<?php
						$page_size = count_gallery($size);
						for($i = 1; $i <= $page_size; $i++){
					?>
					<li class="page-item"><a class="page-link" href=<?php echo '"/index.php?start='. strval(($i - 1) * $size) . '&size=' . $size . '"' ?>><?php echo $i; ?></a></li>
					<?php } ?>
					<li class=<?php
						echo '"page-item';
						if ($page_size * $size - $size <= $start) echo " disabled";
						echo '"';
						?>><a class="page-link" href=<?php echo '"/index.php?start='. ($start + 5) . '&size=' . $size . '"' ?>>Next</a></li>
				</ul>
			</nav>
			<br>
		</div>
	</div>
</div>
<?php include($_SERVER['DOCUMENT_ROOT']."/page_bottom.php");?>