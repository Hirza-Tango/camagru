<?php require_once($_SERVER['DOCUMENT_ROOT']."/page_top.php");?>
<div class="container">
	<div class="row justify-content-center">
		<div class="container-fluid col-lg">
			<!--TODO: pagination -->
			<?php
				include($_SERVER['DOCUMENT_ROOT']."/View/get_gallery.php");
				if (isset($_GET['start']) && intval($_GET['start']) <= 0)
					unset($_GET['start']);
				if (isset($_GET['size']) && intval($_GET['size']) <= 0)
					unset($_GET['size']);
				if (!isset($_GET['start']))
					get_gallery();
				else if (!isset($_GET['size']))
					get_gallery(intval($_GET['start']));
				else
					get_gallery(intval($_GET['start']), intval($_GET['size']));	
			?>
		</div>
	</div>
</div>
<?php include($_SERVER['DOCUMENT_ROOT']."/page_bottom.php");?>