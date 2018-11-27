<?php
$_SERVER['DOCUMENT_ROOT'] = ".";
include_once($_SERVER['DOCUMENT_ROOT']."/page_top.php");
include_once($_SERVER['DOCUMENT_ROOT'].'/init.php');
if (!isset($_GET['image'])) display_error("Image not found");
if (!is_uuid($_GET['image'])) display_error("Image not found");
$user = isset($_SESSION['user']) ? $_SESSION['user']['uuid'] : NULL;
try {
	$sql_get_image->execute(Array(":user"=>$user, ":uuid"=>$_GET['image']));
	$image = $sql_get_image->fetchAll(PDO::FETCH_ASSOC)[0];
	$sql_get_upload_comments->execute(Array(":upload"=>$_GET['image']));
	$comments = $sql_get_upload_comments->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
	http_response_code(500);
}
?>
<div class="container">
	<div class="row justify-content-center">
		<div class="container-fluid col-lg">
			<div class="card mb-3 mt-3 mx-auto" id=<?php echo $image['uuid'];?>>
				<div class="card-header">
					<img src=<?php echo '"http://loyalkng.com/wp-content/uploads/2010/01/facebook-art-no-photo-image-batman-mickey-mouse-spock-elvis-rick-roll.jpg"'?> height="30" width="30">
					<?php echo $image['username']?>
				</div>
				<div class="card-body">
					<img src=<?php echo '"/Image/', $image['uuid'], '.png"'; ?>>
				</div>
				<div class="card-footer">
					<div class="row">
						<div class="col text-center" <?php if (isset($_SESSION['user'])) echo 'onclick="update_likes(this)"'?>>
							<span class="heart" style=<?php if (!$image['is_liked']) echo '"display:inline-block"'; else echo '"display:none"';?>>❤️</span>
							<span class="unheart" style=<?php if ($image['is_liked']) echo '"display:inline-block"'; else echo '"display:none"';?>>💔</span>
							<span class="text"><?php echo $image['like_count'];?></span>
						</div>
						<div class="col text-center">
							<a href=<?php echo '"/image.php?image=' . $image['uuid'] . '"'; ?>>
								<img src="https://static.thenounproject.com/png/3766-200.png" height="30" width="30">
								<?php echo $image['comment_count'];?>
							</a>
						</div>
						<div class="col text-center">
							<img src="https://static.thenounproject.com/png/3132-200.png" height="30" width="30">
							Share
						</div>
					</div>
				</div>
				<div id="comment-list">
				<?php foreach ($comments as $c) {?>
					<span><b><?php echo $c['username'];?></b></span>
					<span style="float:right"><?php echo $c['created'];?></span>
					<br>
					<span><?php echo $c['text']?></span>
					<hr/>
					<?php if ($c['created'] != $c['updated']) {
						echo '<span style="color:#808080">(edited)</span>';
					}?>
				<?php } ?>
				<?php if (isset($_SESSION['user'])) {?>
					<form action="/Controller/create_comment.php" class="container" method="post">
						<div class="row">
							<input type="text" style="display:none" name="image" value=<?php echo '"'.$image['uuid'].'"'?>></p>
							<div class="col-sm-10">
								<input class="form-control" type="text" name="comment" required placeholder="Write your comment here...">
							</div>
							<div>
								<button class="btn btn-primary" type="submit" name="send">Send</button>
							</div>
						</div>
					</form>	
				<?php } ?>
				</div>
			</div>
		</div>
	</div>
</div>