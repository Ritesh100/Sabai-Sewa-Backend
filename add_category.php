<?php
require 'include/navbar.php';
require 'include/sidebar.php';
?>
<!-- Start main left sidebar menu -->

<?php
if (isset($_POST['icat'])) {
	$dname = mysqli_real_escape_string($mysqli, $_POST['cname']);

	$okey = mysqli_real_escape_string($mysqli, $_POST['status']);
	$stitle = mysqli_real_escape_string($mysqli, $_POST['stitle']);
	$target_dir = "assets/category/catimg/";
	$temp = explode(".", $_FILES["cat_img"]["name"]);
	$temps = explode(".", $_FILES["cat_video"]["name"]);
	$vname = uniqid() . '.' . end($temps);
	$newfilename = uniqid() . '.' . end($temp);
	$target_file = $target_dir . basename($newfilename);
	$target_files = $target_dir . basename($vname);

	move_uploaded_file($_FILES["cat_img"]["tmp_name"], $target_file);
	move_uploaded_file($_FILES["cat_video"]["tmp_name"], $target_files);

	$table = "category";
	$field_values = array("cat_name", "cat_img", "cat_status", "cat_video", "cat_subtitle");
	$data_values = array("$dname", "$target_file", "$okey", "$target_files", "$stitle");

	$h = new Common();
	$check = $h->InsertData($field_values, $data_values, $table);
	if ($check == 1) {
		$msg = 'Category Insert Successfully!!';
		echo "<meta http-equiv='refresh' content='3'>";
	}
}
?>

<?php
if (isset($_POST['ucat'])) {
	$dname = mysqli_real_escape_string($mysqli, $_POST['cname']);
	$okey = mysqli_real_escape_string($mysqli, $_POST['status']);
	$stitle = mysqli_real_escape_string($mysqli, $_POST['stitle']);
	$target_dir = "assets/category/catimg/";
	$temp = explode(".", $_FILES["cat_img"]["name"]);
	$temps = explode(".", $_FILES["cat_video"]["name"]);
	$vname = uniqid() . '.' . end($temps);
	$newfilename = uniqid() . '.' . end($temp);
	$target_file = $target_dir . basename($newfilename);
	$target_files = $target_dir . basename($vname);

	if ($_FILES["cat_img"]["name"] != '' and $_FILES["cat_video"]["name"] == '') {


		move_uploaded_file($_FILES["cat_img"]["tmp_name"], $target_file);

		$table = "category";
		$field = array('cat_name' => $dname, 'cat_subtitle' => $stitle, 'cat_status' => $okey, 'cat_img' => $target_file);
		$where = "where id=" . $_GET['id'] . "";
		$h = new Common();
		$check = $h->UpdateData($field, $table, $where);

		if ($check == 1) {
			$msg = 'Category Update Successfully!!';
			echo "<meta http-equiv='refresh' content='3'>";
		}
	} else if ($_FILES["cat_img"]["name"] == '' and $_FILES["cat_video"]["name"] != '') {


		move_uploaded_file($_FILES["cat_video"]["tmp_name"], $target_files);

		$table = "category";
		$field = array('cat_name' => $dname, 'cat_subtitle' => $stitle, 'cat_status' => $okey, 'cat_video' => $target_files);
		$where = "where id=" . $_GET['id'] . "";
		$h = new Common();
		$check = $h->UpdateData($field, $table, $where);

		if ($check == 1) {
			$msg = 'Category Update Successfully!!';
			echo "<meta http-equiv='refresh' content='3'>";
		}
	} else if ($_FILES["cat_img"]["name"] != '' and $_FILES["cat_video"]["name"] != '') {


		move_uploaded_file($_FILES["cat_img"]["tmp_name"], $target_file);
		move_uploaded_file($_FILES["cat_video"]["tmp_name"], $target_files);

		$table = "category";
		$field = array('cat_name' => $dname, 'cat_subtitle' => $stitle, 'cat_status' => $okey, 'cat_video' => $target_files, 'cat_img' => $target_file);
		$where = "where id=" . $_GET['id'] . "";
		$h = new Common();
		$check = $h->UpdateData($field, $table, $where);

		if ($check == 1) {
			$msg = 'Category Update Successfully!!';
			echo "<meta http-equiv='refresh' content='3'>";
		}
	} else {

		$table = "category";
		$field = array('cat_name' => $dname, 'cat_subtitle' => $stitle, 'cat_status' => $okey);
		$where = "where id=" . $_GET['id'] . "";
		$h = new Common();
		$check = $h->UpdateData($field, $table, $where);
		if ($check == 1) {
			$msg = 'Category Update Successfully!!';
			echo "<meta http-equiv='refresh' content='3'>";
		}
	}
}
?>

<!-- Start app main Content -->
<div class="main-content">
	<section class="section">
		<div class="section-header">
			<?php
			if (isset($_GET['id'])) {
			?>
				<h1>Edit Category</h1>
			<?php
			} else {
			?>
				<h1>Add Category</h1>
			<?php } ?>
		</div>

		<div class="card">
			<?php
			if ($msg != '') {
			?>
				<div class="alert alert-success alert-dismissible show fade">
					<div class="alert-body">
						<button class="close" data-dismiss="alert"><span>×</span></button>
						<?php echo $msg; ?>
					</div>
				</div>
			<?php } ?>

			<?php
			if (isset($_GET['id'])) {
				$data = $mysqli->query("select * from category where id=" . $_GET['id'] . "")->fetch_assoc();
			?>
				<form method="post" enctype="multipart/form-data">

					<div class="card-body">
						<div class="form-group">
							<label>Category Name</label>
							<input type="text" class="form-control" placeholder="Enter Category Name" value="<?php echo $data['cat_name']; ?>" name="cname" required="">
						</div>
						<div class="form-group">
							<label>Category Subtitle</label>
							<input type="text" class="form-control" placeholder="Enter Category Subtitle" value="<?php echo $data['cat_subtitle']; ?>" name="stitle" required="">
						</div>

						<div class="form-group">
							<label>Category Image</label>
							<input type="file" class="form-control" name="cat_img">
							<br>
							<img src="<?php echo $data['cat_img'] ?>" width="100px" />
						</div>

						<div class="form-group">
							<label>Category Video</label>
							<input type="file" class="form-control" name="cat_video">
							<br>
							<video width="120" height="140" controls>
								<source src="<?php echo $data['cat_video'] ?>" type="video/mp4">

							</video>
						</div>

						<div class="form-group">
							<label>Category Status</label>
							<select name="status" class="form-control">
								<option value="1" <?php if ($data['cat_status'] == 1) {
														echo 'selected';
													} ?>>Publish</option>
								<option value="0" <?php if ($data['cat_status'] == 0) {
														echo 'selected';
													} ?>>UnPublish</option>
							</select>
						</div>


					</div>
					<div class="card-footer text-left">
						<button name="ucat" class="btn btn-primary">Update Category</button>
					</div>
				</form>
			<?php
			} else {
			?>
				<form method="post" enctype="multipart/form-data">

					<div class="card-body">
						<div class="form-group">
							<label>Category Name</label>
							<input type="text" class="form-control" placeholder="Enter Category Name" name="cname" required="">
						</div>

						<div class="form-group">
							<label>Category Subtitle</label>
							<input type="text" class="form-control" placeholder="Enter Category Subtitle" name="stitle" required="">
						</div>

						<div class="form-group">
							<label>Category Image</label>
							<input type="file" class="form-control" name="cat_img" required="">
						</div>

						<div class="form-group">
							<label>Category Video</label>
							<input type="file" class="form-control" name="cat_video" required="">
						</div>

						<div class="form-group">
							<label>Category Status</label>
							<select name="status" class="form-control">
								<option value="1">Publish</option>
								<option value="0">UnPublish</option>
							</select>
						</div>


					</div>
					<div class="card-footer text-left">
						<button name="icat" class="btn btn-primary">Add Category</button>
					</div>
				</form>
			<?php } ?>
		</div>
</div>


</section>
</div>


</div>
</div>

<?php require 'include/footer.php'; ?>


</body>


</html>