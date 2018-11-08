<?php include($_SERVER['DOCUMENT_ROOT']."/page_top.php");?>
<?php if (!isset($_SESSION['user'])) {header("Location: /");} ?>
<div class="container">
	<div class="row">
		<div class="col-10 bg-light">
			<div class="mx-auto text-center"  style="max-height: 80vh">
				<div id="display" style="position: relative;">
					<video autoplay="true" id="webcam" style="object-fit: contain; width:100%; display: none;"></video>
					<img id="select" style="object-fit: contain; width:100%; display: none;">
				</div>
				<br>
				<button id="button-webcam" class="btn btn-primary" onclick="open_webcam()">Use Webcam</button>
				<span id="or" style="margin:0;">OR</span>
				<input type="file" accept="image/*" name="image" id="file" onchange="open_image(event)" style="display: none;">
				<button id="button-select" class="btn btn-secondary">
					<label for="file" style="cursor: pointer;margin:0">Select Image</label>
				</button>
				<br>
				<br>
				<button id="button-confirm" class="btn btn-success" disabled style="display: none">Upload</button>
				<br>
				<br>
			</div>
		</div>
		<div class="col-2 bg-secondary" style="overflow-y: scroll; height:90vh">
			<img src="https://openclipart.org/download/265907/boc_puppy_sitting.svg" style="object-fit: contain; width:100%;" id="sticker-1" onclick="layer(this)">
			<img src="https://openclipart.org/download/267208/Border-43--Arvin61r58.svg" style="object-fit: contain; width:100%;" id="sticker-2" onclick="layer(this)">
			<img src="https://techflourish.com/images/fancy-crown-border-clipart-5.png" style="object-fit: contain; width:100%;" id="sticker-3" onclick="layer(this)">
		</div>
	</div>
</div>
<script>

function open_webcam() {
	let cam = document.getElementById("webcam");
	let image = document.getElementById("select");

	//hide buttons
	document.getElementById("or").style.display="none";
	document.getElementById("button-webcam").style.display="none";

	//show button
	document.getElementById("button-confirm").style.display="inline-block";

	//hide image
	image.style.display="none";
	image.removeAttribute("src");

	//reset file upload
	document.getElementById("file").value = "";
	//enable camera
	cam.style.display="block";
	if (navigator.mediaDevices.getUserMedia) {      
		navigator.mediaDevices.getUserMedia({audio: false, video: true})
		.then(function(stream) {
			cam.srcObject = stream;
		})
		.catch(function(e) {
			cam.textContent = "Could not load camera";
		});
	}
}

function open_image(event) {
	let cam = document.getElementById("webcam");
	let image = document.getElementById("select");
	image.style.display="block";

	//hide buttons
	document.getElementById("or").style.display="inline-block";
	document.getElementById("button-webcam").style.display="inline-block";

	//show button
	document.getElementById("button-confirm").style.display="inline-block";

	//Turn off camera
	if (navigator.mediaDevices.getUserMedia) {      
		navigator.mediaDevices.getUserMedia({audio: false, video: true})
		.then(function(stream) {
			stream.getTracks().forEach(element => {
				element.stop();
				console.log(element);
			});
		})
		.catch(function(error) {
			console.log("Could not disable camera");
		});
	}
	cam.srcObject = null;
	cam.style.display = "none";

	image.style.maxHeight="100%";
	image.src = URL.createObjectURL(event.target.files[0]);
}

function layer(element) {
	//check if already overlaid
	let dup = document.getElementById(element.id + '-dup');
	if (typeof(dup) != 'undefined' && dup != null)
	{
		dup.remove();
		//grey button
		console.log(document.getElementsByClassName('overlay'));
		if (document.getElementsByClassName('overlay').length === 0)
			document.getElementById("button-confirm").setAttribute("disabled","");
	}
	else
	{
		//element don't exists
		dup = element.cloneNode();
		dup.id = element.id + "-dup";
		dup.removeAttribute("onclick");
		dup.style.position = "absolute";
		dup.style.top = 0;
		dup.style.left = 0;
		dup.style.maxHeight = "100%";
		dup.setAttribute("class", "overlay");
		document.getElementById('display').appendChild(dup);
		
		//ungrey button
		document.getElementById("button-confirm").removeAttribute("disabled");
	}
}

function upload_overlay(){

	/* TODO: resolve params from overlaid images, uploaded image and/or snapshot*/
	let params = {};
	

    var form = document.createElement("form");
    form.setAttribute("method", "post");
    form.setAttribute("action", "/Controller/upload_image.php");

    for(var key in params) {
        if(params.hasOwnProperty(key)) {
            var hiddenField = document.createElement("input");
            hiddenField.setAttribute("type", "hidden");
            hiddenField.setAttribute("name", key);
            hiddenField.setAttribute("value", params[key]);

            form.appendChild(hiddenField);
        }
    }

    document.body.appendChild(form);
    form.submit();
}
</script>
<?php include($_SERVER['DOCUMENT_ROOT']."/page_bottom.php");?>