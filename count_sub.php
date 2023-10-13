 <?php 
require 'include/dbconfig.php';

$pid = $_POST['cid'];
echo $mysqli->query("select * from g_subcategory where cid=".$pid."")->num_rows;
?>