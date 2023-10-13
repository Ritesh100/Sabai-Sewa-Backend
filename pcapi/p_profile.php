<?php 
require dirname( dirname(__FILE__) ).'/include/dbconfig.php';
require dirname( dirname(__FILE__) ).'/include/Common.php';
header('Content-type: text/json');

if($_POST['name'] == ''    or $_POST['password'] == '' or $_POST['uid'] == '' or $_POST['address'] == '')
{
    $returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"Something Went Wrong!");
}
else
{
    
    $name = strip_tags(mysqli_real_escape_string($mysqli,$data['name']));
   
    
     $password = strip_tags(mysqli_real_escape_string($mysqli,$_POST['password']));
	 $address = strip_tags(mysqli_real_escape_string($mysqli,$_POST['address']));
	 $bio = strip_tags(mysqli_real_escape_string($mysqli,$_POST['bio']));
$uid =  strip_tags(mysqli_real_escape_string($mysqli,$_POST['uid']));
$checkimei = $mysqli->query("select * from partner where  `id`=".$uid."")->num_rows;

if($checkimei == 0)
    {
		     $returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"User Not Exist!!!!");  
	}

else 
{	

$target_path = dirname( dirname(__FILE__) ).'/assets/partner/';

$url = 'assets/partner/';


$size = $_POST['size'];
if($size == 0)
{
	 $table="partner";
  $field = array('name'=>$name,'password'=>$password,'address'=>$address,'bio'=>$bio);
  $where = "where id=".$uid."";
$h = new Common();
	  $check = $h->UpdateData_Api($field,$table,$where);
}
else 
{
$v = array();
    for ($x = 0; $x < $size; $x++) {
       
            $newname = date('YmdHis',time()).mt_rand().'.jpg';
			$v[] =  $url.$newname;
            // Throws exception incase file is not being moved
            move_uploaded_file($_FILES['image'.$x]['tmp_name'], $target_path .$newname);
    }
$multifile = implode('$;',$v);

	   $table="partner";
  $field = array('name'=>$name,'password'=>$password,'address'=>$address,'bio'=>$bio,'pimg'=>$multifile);
  $where = "where id=".$uid."";
$h = new Common();
	  $check = $h->UpdateData_Api($field,$table,$where);
} 
            $c = $mysqli->query("select * from partner where  `id`=".$uid."")->fetch_assoc();
			$cat = $mysqli->query("select cat_name from category where id =".$c['category_id']."")->fetch_assoc();
			if($cat['cat_name'] == '')
			{
				$cat['cat_name'] = '';
			}
			else 
			{
				$cname = $cat['cat_name'];
			}
        $returnArr = array("PartnerLogin"=>$c,"category"=>$cname,"ResponseCode"=>"200","Result"=>"true","ResponseMsg"=>"Profile Update successfully!");
        
    
	}
    
}

echo json_encode($returnArr);