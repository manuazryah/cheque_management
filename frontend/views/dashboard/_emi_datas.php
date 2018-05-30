<?php

use yii\jui\DatePicker;
?>
<style>
	/* The Modal (background) */
	.modal {
		display: none; /* Hidden by default */
		position: fixed; /* Stay in place */
		z-index: 1; /* Sit on top */
		padding-top: 100px; /* Location of the box */
		left: 0;
		top: 0;
		width: 100%; /* Full width */
		height: 100%; /* Full height */
		overflow: auto; /* Enable scroll if needed */
		background-color: rgb(0,0,0); /* Fallback color */
		background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
	}

	/* Modal Content */
	.modal-content {
		background-color: #fefefe;
		margin: auto;
		padding: 20px;
		border: 1px solid #888;
		width: 80%;
	}

	/* The Close Button */
	.close {
		color: #aaaaaa;
		float: right;
		font-size: 28px;
		font-weight: bold;
	}

	.close:hover,
	.close:focus {
		color: #000;
		text-decoration: none;
		cursor: pointer;
	}
</style>
<div class="form-group"  style="visibility: hidden" id="emi_cheq">
	<label>No Of EMI Cheques</label>
	<input type="number" id="emi_cheques" class="form-control" name="emi_cheques"  step="1" value="1">


</div>
<div id="myModal" class="modal">

	<!-- Modal content -->
	<div class="modal-content" id="datas_new">

	</div>

</div>
<script>

	$(document).ready(function () {
		$('#emi_cheq').change(function () {
			var numbers = $("#emi_cheques").val();
			$.ajax({
				type: "POST",
				url: "<?= Yii::$app->homeUrl; ?>/dashboard/emi-cheques",
				data: {num: numbers},
				cache: false,
				success: function (data) {
					alert(data);
					$("#datas_new").html(data);
				}
			});
			modal.style.display = "block";
		});


	});
</script>

<script>
// Get the modal
	var modal = document.getElementById('myModal');

// Get the button that opens the modal
	var btn = document.getElementById("myBtn");

// Get the <span> element that closes the modal
	var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal
	//btn.onclick = function () {
	//modal.style.display = "block";
//	}

// When the user clicks on <span> (x), close the modal
	span.onclick = function () {

		modal.style.display = "none";
	}

// When the user clicks anywhere outside of the modal, close it
	window.onclick = function (event) {
		if (event.target == modal) {
			modal.style.display = "none";
		}
	}
</script>