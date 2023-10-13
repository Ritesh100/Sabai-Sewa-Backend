<?php 
require 'dbconfig.php';
$GLOBALS['mysqli'] = $mysqli;
class Common {
 

	function Login($username,$password,$tblname) {
		
		
		$q = "select * from ".$tblname." where username='".$username."' and password='".$password."'";
	return $GLOBALS['mysqli']->query($q)->num_rows;
		
	}
	
	function Insertdata($field,$data,$table){

    $field_values= implode(',',$field);
    $data_values=implode("','",$data);

    $sql = "INSERT INTO $table($field_values)VALUES('$data_values')";
    $result=$GLOBALS['mysqli']->query($sql);
  return $result;
  }
  
  function Insertdata_id($field,$data,$table){

    $field_values= implode(',',$field);
    $data_values=implode("','",$data);

    $sql = "INSERT INTO $table($field_values)VALUES('$data_values')";
    $result=$GLOBALS['mysqli']->query($sql);
  return $GLOBALS['mysqli']->insert_id;
  }
  
  function InsertData_Api($field,$data,$table){

    $field_values= implode(',',$field);
    $data_values=implode("','",$data);

    $sql = "INSERT INTO $table($field_values)VALUES('$data_values')";
    $result=$GLOBALS['mysqli']->query($sql);
  return $result;
  }
  
  function InsertData_Api_Id($field,$data,$table){

    $field_values= implode(',',$field);
    $data_values=implode("','",$data);

    $sql = "INSERT INTO $table($field_values)VALUES('$data_values')";
    $result=$GLOBALS['mysqli']->query($sql);
  return $GLOBALS['mysqli']->insert_id;
  }
  
  function UpdateData($field,$table,$where){
$cols = array();

    foreach($field as $key=>$val) {
        if($val != NULL) // check if value is not null then only add that colunm to array
        {
           $cols[] = "$key = '$val'"; 
        }
    }
    $sql = "UPDATE $table SET " . implode(', ', $cols) . " $where";
$result=$GLOBALS['mysqli']->query($sql);
    return $result;
  }
  
   function UpdateData_Api($field,$table,$where){
$cols = array();

    foreach($field as $key=>$val) {
        if($val != NULL) // check if value is not null then only add that colunm to array
        {
           $cols[] = "$key = '$val'"; 
        }
    }
    $sql = "UPDATE $table SET " . implode(', ', $cols) . " $where";
$result=$GLOBALS['mysqli']->query($sql);
    return $result;
  }
  
  
  
  
  function UpdateData_single($field,$table,$where){
$query = "UPDATE $table SET $field";

$sql =  $query.' '.$where;
$result=$GLOBALS['mysqli']->query($sql);
  return $result;
  }
  
  function Deletedata($where,$table){

    $sql = "Delete From $table $where";
    $result=$GLOBALS['mysqli']->query($sql);
  return $result;
  }
 
}
?>