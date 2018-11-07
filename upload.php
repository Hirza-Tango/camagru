<?php include($_SERVER['DOCUMENT_ROOT']."/page_top.php");?>
<?php if (!isset($_SESSION['user'])) {header("Location: /");} ?>
<div class="container">
	<div class="row">
		<div class="col-8 bg-light">
			<div class="d-block mx-auto text-center">
				<div id="display">
					<video autoplay="true" id="webcam" style="object-fit: scale-down; height=100%; display: none;"></video>
					<img id="upload" style="object-fit: scale-down; display: none;">
				</div>
				<br>
				<button class="btn btn-primary" onclick="open_webcam()">Use Webcam</button>
				<br>
				OR
				<br>	
				<input type="file" accept="image/*" name="image" id="file" onchange="open_image(event)" style="display: none;">
				<button class="btn btn-secondary">
					<label for="file" style="cursor: pointer;">Upload Image</label>
				</button>
				<br>
			</div>
		</div>
		<div class="col-4 bg-secondary">
			<img>
		</div>
	</div>
</div>
<script>

function open_webcam() {
	let cam = document.querySelector("#webcam");
	let image = document.querySelector("#upload");
	cam.style.display="block";
	image.style.display="none";
	image.removeAttribute("src");
	document.querySelector("#file").value = "";
	if (navigator.mediaDevices.getUserMedia) {      
		navigator.mediaDevices.getUserMedia({video: true})
		.then(function(stream) {
			cam.srcObject = stream;
		})
		.catch(function(e) {
			console.log("Something went wrong!");
		});
	}
}

let open_image = function (event) {
	let cam = document.querySelector("#webcam");
	let image = document.querySelector("#upload");
	image.style.display="block";
	cam.srcObject = null;
	cam.style.display = "none";
	image.style.width="100%";
	image.style.height="auto";
	image.src = URL.createObjectURL(event.target.files[0]);
};
</script>
<?php include($_SERVER['DOCUMENT_ROOT']."/page_bottom.php");?>