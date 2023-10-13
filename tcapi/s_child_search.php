 <?php 
require dirname( dirname(__FILE__) ).'/include/dbconfig.php';
header('Content-type: text/json');
ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);
$data = json_decode(file_get_contents('php://input'), true);
 
$keyword = $data['keyword'];
$uid = $data['uid'];

if($keyword == '' or $uid == '')
{
	$returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"Something Went wrong  try again !");
}
else 
{
	$vps = array();
	$polists = array();
	$sel = $mysqli->query("select * from tbl_child where  title like '%".$keyword."%' and status=1");
	while($kol = $sel->fetch_assoc())
	{
		$vps['childcat_id'] = $kol['id'];
		$vps['category_id'] = $kol['cid'];
		$vps['subcat_id'] = $kol['sid'];
		$vps['img'] = $kol['img'];
		$vps['title'] = $kol['title'];
		$vps['item_count'] = $mysqli->query("select * from tbl_partner_service where cid=".$kol['id']."")->num_rows;
		$polists[] = $vps;
	}
	$returnArr = array("ResponseCode"=>"200","Result"=>"true","ResponseMsg"=>"Search Data Get Successfully!","SearchChildcatdata"=>$polists);
}
echo json_encode($returnArr);