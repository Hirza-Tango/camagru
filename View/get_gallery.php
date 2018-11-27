<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/init.php');
function get_gallery(int $start = 0, int $size = 5){
	global $sql_get_gallery_page;
	$user = isset($_SESSION['user']) ? $_SESSION['user']['uuid'] : NULL;
	try {
		$sql_get_gallery_page->execute(Array(":start"=>$start, ":page_size"=>$size, ":user"=>$user));
		$page = $sql_get_gallery_page->fetchAll(PDO::FETCH_ASSOC);
	} catch (PDOException $e) {
		http_response_code(500);
	}
	foreach ($page as $p) {
?>
<div class="card mb-3 mt-3 mx-auto" id=<?php echo $p['uuid'];?>>
	<div class="card-header">
		<img src=<?php echo '"http://loyalkng.com/wp-content/uploads/2010/01/facebook-art-no-photo-image-batman-mickey-mouse-spock-elvis-rick-roll.jpg"'?> height="30" width="30">
		<?php echo $p['username']?>
	</div>
	<div class="card-body">
		<img src=<?php echo '"/Image/', $p['uuid'], '.png"'; ?>>
	</div>
	<div class="card-footer">
		<div class="row">
			<div class="col text-center" <?php if (isset($_SESSION['user'])) echo 'onclick="update_likes(this)"'?>>
				<span class="heart" style=<?php if (!$p['is_liked']) echo '"display:inline-block"'; else echo '"display:none"';?>>❤️</span>
				<span class="unheart" style=<?php if ($p['is_liked']) echo '"display:inline-block"'; else echo '"display:none"';?>>💔</span>
				<span class="text"><?php echo $p['like_count'];?></span>
			</div>
			<div class="col text-center">
				<a href=<?php echo '"/image.php?image=' . $p['uuid'] . '"'; ?>>
					<img src="https://static.thenounproject.com/png/3766-200.png" height="30" width="30">
					<?php echo $p['comment_count'];?>
				</a>
			</div>
			<div class="col text-center">
				<img src="https://static.thenounproject.com/png/3132-200.png" height="30" width="30">
				Share
			</div>
		</div>
	</div>
</div>

	<?php
	}
}
function count_gallery($size){
	//TODO: check
	$sql_get_gallery_size->execute();
	$value = $sql_get_gallery_size->fetchAll(PDO::FETCH_ASSOC)[0]['count'];
	return (intval($count/$size));
}
?>