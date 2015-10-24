<?php
    include('../include/header.php');
    include('../include/dashboardNavbar.php');
?>
<link href="/css/dashboard.css" rel="stylesheet">

<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
    <h1 class="page-header">Add Location</h1>
    <div class="col-xs-6 col-sm-6 placeholder">
	<h2 class="sub-header">Resteraunt Information</h2>

	<label for="">Name:</label>
	<div class="input-group">
		<input type="text" class="form-control" size="40">
	</div>
	
	<label for="">Address:</label>
	<div class="input-group">
		<input type="text" class="form-control" size="40">
	</div>

	<label for="">Description:</label>
	<div class="input-group">
		<input type="text" class="form-control" size="40">
	</div>

	<label for="">Picture:</label>
	<div class="input-group">
		<input type="text" class="form-control" size="40">
	</div>

	<label for="">Type:</label>
	<div class="input-group">
		<select class="form-control" width="40">
			<option>Pizzaria</option>
			<option>Grill</option>
			<option>Deli</option>
			<option>Resteraunt</option>
		</select>	
	</div>
	<br>	
	<button type="button" class="btn btn-default">Submit</button>
	</div>
</div>
</div>
<?php include('../include/footer.php');?>
