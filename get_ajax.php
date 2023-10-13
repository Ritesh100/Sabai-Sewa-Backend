<?php 
require 'include/dbconfig.php';

$pid = $_POST['cid'];
$sub = $mysqli->query("select * from g_subcategory where cid=".$pid."");
?>
<option value="0">Select A Sub Category</option>
<?php 
while($row = $sub->fetch_assoc())
{
	?>
	<option value="<?php echo $row['id'];?>"><?php echo $row['title'];?></option>
	<?php 
}
?>