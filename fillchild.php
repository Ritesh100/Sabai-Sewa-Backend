<?php 
require 'include/dbconfig.php';

$pid = $_POST['cid'];
if($_POST['status'] == 'child')
{
$sub = $mysqli->query("select * from tbl_child where cid=".$pid."");
?>
<label>Service Child Category</label>
									<select name="child" class="form-control" required>
									<option value="">Select Service Child Category</option>
<?php 
while($row = $sub->fetch_assoc())
{
	?>
	<option value="<?php echo $row['id'];?>"><?php echo $row['title'];?></option>
	<?php 
}
?>
</select>
<?php } else if($_POST['status'] == 'sub')
{
$sub = $mysqli->query("select * from g_subcategory where cid=".$pid."");
?>
<label>Service Sub Category</label>
									<select name="subcat" class="form-control subcat" required>
									<option value="">Select Service Sub Category</option>
<?php 
while($row = $sub->fetch_assoc())
{
	?>
	<option value="<?php echo $row['id'];?>"><?php echo $row['title'];?></option>
	<?php 
}
?>
</select>
<?php }else if($_POST['status'] == 'submain')
{
	
	$sub = $mysqli->query("select * from tbl_child where sid=".$pid."");
?>
<label>Service Child Category</label>
									<select name="child" class="form-control" required>
									<option value="">Select Service Child Category</option>
<?php 
while($row = $sub->fetch_assoc())
{
	?>
	<option value="<?php echo $row['id'];?>"><?php echo $row['title'];?></option>
	<?php 
}
?>
</select>
	<?php 
}	else 
{
}?>