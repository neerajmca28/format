<?php
error_reporting(0);
ob_start();
session_start();
include("../connection.php");

$q=$_GET["user_id"];
$veh_reg=$_GET["veh_reg"];
$row_id=$_GET["row_id"];
$comment=$_GET["comment"];



if(isset($_GET['action']) && $_GET['action']=='devicechangeapprove')
{
	$Updateapprovestatus="update internalsoftware.device_change set approve_status=1, approve_date='".date("Y-m-d H:i:s")."' where id='".$row_id."'";
	select_query($Updateapprovestatus);
	echo "Successfully Approved";
}

if(isset($_GET['action']) && $_GET['action']=='NewAccapprove')
{
	$check_data = select_query("SELECT * FROM internalsoftware.new_account_creation where id=".$row_id);
	$branch_id = $check_data[0]['branch_id'];
	$support_id = $check_data[0]['support_id'];
	
	if($support_id != ''){$support_user = $support_id;}
	else{	
		if($branch_id == 1){$support_user = '17';}
		else if($branch_id == 6){$support_user = '40';}
		else if($branch_id == 2 || $branch_id == 3 || $branch_id == 7){$support_user = '41';}
		else{$support_user = '41';}
	}
	
	$Updateapprovestatus = select_query("update internalsoftware.new_account_creation set approve_status=1,approve_date='".date("Y-m-d H:i:s")."', support_id='".$support_user."' where id=".$row_id);
	//select_query($Updateapprovestatus);
	
	$update_model = array('is_active' => 1);
	$condition = array('new_account_reqid' => $row_id);	
	update_query('internalsoftware.new_account_model_master', $update_model, $condition);
			
	echo "Successfully Approved";
}

if(isset($_GET['action']) && $_GET['action']=='Installationapprove')
{
	$query = "SELECT * FROM internalsoftware.installation_request  where id=".$row_id;
	$row=select_query($query);
	/* if($row[0]["branch_id"]==1){*/
	$Updateapprovestatus="update internalsoftware.installation_request set installation_status=9, approve_status=1, installation_approve='".$comment."', approve_date='".date("Y-m-d H:i:s")."' where id=".$row_id;
	/*}
	else{
	$Updateapprovestatus="update installation set installation_status=1, approve_status=1, installation_approve='".$comment."', approve_date='".date("Y-m-d H:i:s")."' where id=".$row_id;
	}*/
	select_query($Updateapprovestatus);
	//echo "Successfully Approved";
}

if(isset($_GET['action']) && $_GET['action']=='deactivate_simapprove')
{
	$Updateapprovestatus="update internalsoftware.deactivate_sim set approve_status=1, approve_date='".date("Y-m-d H:i:s")."' where id=".$row_id;
	select_query($Updateapprovestatus);
	echo "Successfully Approved";
}


if(isset($_GET['action']) && $_GET['action']=='imei_changeapprove')
{
	$Updateapprovestatus="update internalsoftware.imei_change set approve_status=1, approve_date='".date("Y-m-d H:i:s")."' where id=".$row_id;
	select_query($Updateapprovestatus);
	echo "Successfully Approved";
}

if(isset($_GET['action']) && $_GET['action']=='stop_gpsapprove')
{
	$Updateapprovestatus="update internalsoftware.stop_gps set approve_status=1, approve_date='".date("Y-m-d H:i:s")."' where id=".$row_id;
	select_query($Updateapprovestatus);
	echo "Successfully Approved";
}

if(isset($_GET['action']) && $_GET['action']=='start_gpsapprove')
{
	$Updateapprovestatus="update internalsoftware.start_gps set approve_status=1, approve_date='".date("Y-m-d H:i:s")."' where id=".$row_id;
	select_query($Updateapprovestatus);
	echo "Successfully Approved";
}

if(isset($_GET['action']) && $_GET['action']=='new_device_additionapprove')
{
	$Updateapprovestatus="update internalsoftware.new_device_addition set approve_status=1, approve_date='".date("Y-m-d H:i:s")."' where id=".$row_id;
	select_query($Updateapprovestatus);
	echo "Successfully Approved";
}


if(isset($_GET['action']) && $_GET['action']=='vehicle_no_changeapprove')
{
	$Updateapprovestatus="update internalsoftware.vehicle_no_change set approve_status=1, approve_date='".date("Y-m-d H:i:s")."' where id=".$row_id;
	select_query($Updateapprovestatus);
	echo "Successfully Approved";
}
if(isset($_GET['action']) && $_GET['action']=='sim_changeapprove')
{
	$Updateapprovestatus="update internalsoftware.sim_change set approve_status=1, approve_date='".date("Y-m-d H:i:s")."' where id=".$row_id;
	select_query($Updateapprovestatus);
	echo "Successfully Approved";
}

if(isset($_GET['action']) && $_GET['action']=='device_lostapprove')
{
	$Updateapprovestatus="update internalsoftware.device_lost set approve_status=1, approve_date='".date("Y-m-d H:i:s")."' where id=".$row_id;
	select_query($Updateapprovestatus);
	echo "Successfully Approved";
}

if(isset($_GET['action']) && $_GET['action']=='deletionapprove')
{
	$Updateapprovestatus="update internalsoftware.deletion  set approve_status=1, approve_date='".date("Y-m-d H:i:s")."' where id=".$row_id;
	select_query($Updateapprovestatus);
	echo "Successfully Approved";
}


if(isset($_GET['action']) && $_GET['action']=='sub_user_creationapprove')
{
	$Updateapprovestatus="update internalsoftware.sub_user_creation  set approve_status=1, approve_date='".date("Y-m-d H:i:s")."' where id=".$row_id;
	select_query($Updateapprovestatus);
	echo "Successfully Approved";
}



if(isset($_GET['action']) && $_GET['action']=='deactivation_of_accountapprove')
{
	$Updateapprovestatus="update internalsoftware.deactivation_of_account set approve_status=1, approve_date='".date("Y-m-d H:i:s")."' where id=".$row_id;
	select_query($Updateapprovestatus);
	echo "Successfully Approved";
}

if(isset($_GET['action']) && $_GET['action']=='Reactivation_of_accountapprove')
{
	$Updateapprovestatus="update internalsoftware.reactivation_of_account  set approve_status=1, approve_date='".date("Y-m-d H:i:s")."' where id=".$row_id;
	select_query($Updateapprovestatus);
	echo "Successfully Approved";
}

if(isset($_GET['action']) && $_GET['action']=='del_form_debtorsapprove')
{
	$Updateapprovestatus="update internalsoftware.del_form_debtors  set approve_status=1, approve_date='".date("Y-m-d H:i:s")."' where id=".$row_id;
	select_query($Updateapprovestatus);
	echo "Successfully Approved";
}	


if(isset($_GET['action']) && $_GET['action']=='no_billsapprove')
{
	$Updateapprovestatus="update internalsoftware.no_bills  set approve_status=1, approve_date='".date("Y-m-d H:i:s")."' where id=".$row_id;
	select_query($Updateapprovestatus);
	echo "Successfully Approved";
}	

if(isset($_GET['action']) && $_GET['action']=='discount_detailsapprove')
{
	$Updateapprovestatus="update internalsoftware.discount_details  set approve_status=1, approve_date='".date("Y-m-d H:i:s")."' where id=".$row_id;
	select_query($Updateapprovestatus);
	echo "Successfully Approved";
}	

if(isset($_GET['action']) && $_GET['action']=='software_requestapprove')
{
	$Updateapprovestatus="update internalsoftware.software_request  set approve_status=1, approve_date='".date("Y-m-d H:i:s")."' where id=".$row_id;
	select_query($Updateapprovestatus);
	echo "Successfully Approved";
}

if(isset($_GET['action']) && $_GET['action']=='transfer_the_vehicleapprove')
{
	$Updateapprovestatus="update internalsoftware.transfer_the_vehicle  set approve_status=1, approve_date='".date("Y-m-d H:i:s")."' where id=".$row_id;
	select_query($Updateapprovestatus);
	echo "Successfully Approved";
}	

if(isset($_GET['action']) && $_GET['action']=='dimts_imeiapprove')
{
	$Updateapprovestatus="update internalsoftware.dimts_imei set approve_status=1, approve_date='".date("Y-m-d H:i:s")."' where id=".$row_id;
	select_query($Updateapprovestatus);
	echo "Successfully Approved";
}

if(isset($_GET['action']) && $_GET['action']=='Renew_dimts_imeiapprove')
{
	$Updateapprovestatus="update internalsoftware.renew_dimts_imei set approve_status=1,approve_date='".date("Y-m-d H:i:s")."' where id=".$row_id;
	select_query($Updateapprovestatus);
	echo "Successfully Approved";
}
	
// Add Comment


if(isset($_GET['action']) && $_GET['action']=='devicechangeadminComment')
{
	$query = "SELECT admin_comment FROM internalsoftware.device_change  where id=".$row_id;
	$row=select_query($query);
	
	$Updateapprovestatus="update internalsoftware.device_change set admin_comment='".$row[0]["admin_comment"]."<br/>".date("Y-m-d H:i:s")." - " .$comment."', device_change_status='2' where id=".$row_id;
	select_query($Updateapprovestatus);
	echo "Comment added Successfully";
}

 

if(isset($_GET['action']) && $_GET['action']=='NewAccadminComment')
{
	$query = "SELECT admin_comment FROM internalsoftware.new_account_creation  where id=".$row_id;
	$row=select_query($query);
	
	$Updateapprovestatus="update internalsoftware.new_account_creation set admin_comment='".$row[0]["admin_comment"]."<br/>".date("Y-m-d H:i:s")." - ".$comment."', acc_creation_status='2' where id=".$row_id;
	select_query($Updateapprovestatus);
	echo "Comment added Successfully";
}

if(isset($_GET['action']) && $_GET['action']=='rdconversion_addComment')
{
	$query = "SELECT admin_comment FROM internalsoftware.ad_rd_conversion  where id=".$row_id;
	$row=select_query($query);
	  
	$Updateapprovestatus="update internalsoftware.ad_rd_conversion set admin_comment='".$row[0]["admin_comment"]."<br/>".date("Y-m-d H:i:s")." - ".$comment."', status='1' where id=".$row_id;
	
	select_query($Updateapprovestatus);
	echo "Comment added Successfully";
}

if(isset($_GET['action']) && $_GET['action']=='close_process')
{
	$Updateapprovestatus="update internalsoftware.ad_rd_conversion set close_status=1 ,close_date='".date("Y-m-d H:i:s")."' where id=".$row_id;
	select_query($Updateapprovestatus);
}

if(isset($_GET['action']) && $_GET['action']=='InstallationadminComment')
{

	$query = "SELECT sales_person,user_id,admin_comment FROM internalsoftware.installation_request  where id=".$row_id;
	$row=select_query($query);
	
	$sales_manager=select_query("SELECT phone_no,name FROM internalsoftware.sales_person where id='".$row[0]["sales_person"]."'");
	
	$Updateapprovestatus="update internalsoftware.installation_request set admin_comment='".$row[0]["admin_comment"]."<br/>".date("Y-m-d H:i:s")." - ".$comment."',installation_status='7' where id=".$row_id;
	select_query($Updateapprovestatus);
	//echo "Comment added Successfully";
	
	if($sales_manager[0]["phone_no"]!="")
	{
		$sql = "select Userid,UserName from internalsoftware.addclient  where Userid=".$row[0]["user_id"];
		$rowuser = select_query($sql);
				
		$reactivate_msg = "Your Request of Installation at ".$rowuser[0]["UserName"]." has been Disapproved for Reason - ".$comment.".This is for your information.";
		$MSG="Vehicle : ".$reactivate_msg;
		//$MobileNum='9813235424';
		$MobileNum = $sales_manager[0]["phone_no"];
		
		$msg_query = select_query("INSERT INTO internalsoftware.msg_history_tbl (send_date, client_name, sales_person, sales_mobile_no, msg_comment) VALUES('".date("Y-m-d H:i:s")."','".$rowuser[0]["UserName"]."', '".$sales_manager[0]["name"]."', '".$MobileNum."', '".$MSG."')");
		$msg_id = mysql_insert_id();
	 
		$ch = curl_init();
		$user="gary@itglobalconsulting.com:itgc@123";
		$receipientno=$MobileNum;
		$senderID="GTRACK";
		$msgtxt=$MSG;
		curl_setopt($ch,CURLOPT_URL,  "http://api.mVaayoo.com/mvaayooapi/MessageCompose");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, "user=$user&senderID=$senderID&receipientno=$receipientno&msgtxt=$msgtxt");
		$buffer = curl_exec($ch);
		if(empty ($buffer))
		{ echo " buffer is empty "; }
		else
		{ 
			echo $buffer; echo "Successfully Sent"; 
			$msg_update_query = select_query("UPDATE internalsoftware.msg_history_tbl set msg_status=1 where id='".$msg_id."'");
		}
		curl_close($ch);
	}
	
}

if(isset($_GET['action']) && $_GET['action']=='imei_changeadminComment')
{
	$query = "SELECT admin_comment FROM internalsoftware.imei_change  where id=".$row_id;
	$row=select_query($query);

	$Updateapprovestatus="update internalsoftware.imei_change set admin_comment='".$row[0]["admin_comment"]."<br/>".date("Y-m-d H:i:s")." - ".$comment."' where id=".$row_id;

	select_query($Updateapprovestatus);
	echo "Comment added Successfully";
}

if(isset($_GET['action']) && $_GET['action']=='stop_gpsadminComment')
{
	$query = "SELECT admin_comment FROM internalsoftware.stop_gps  where id=".$row_id;
	$row=select_query($query);
	
	$Updateapprovestatus="update internalsoftware.stop_gps set admin_comment='".$row[0]["admin_comment"]."<br/>".date("Y-m-d H:i:s")." - " .$comment."', stop_gps_status='2' where id=".$row_id;
	
	//$Updateapprovestatus="update stop_gps set admin_comment='".$comment."' where id=".$row_id;
	select_query($Updateapprovestatus);
	echo "Comment added Successfully";
}

if(isset($_GET['action']) && $_GET['action']=='start_gpsadminComment')
{
	$query = "SELECT admin_comment FROM internalsoftware.start_gps  where id=".$row_id;
	$row=select_query($query);
	
	$Updateapprovestatus="update internalsoftware.start_gps set admin_comment='".$row[0]["admin_comment"]."<br/>".date("Y-m-d H:i:s")." - " .$comment."', start_gps_status='2' where id=".$row_id;
	
	select_query($Updateapprovestatus);
	echo "Comment added Successfully";
}

if(isset($_GET['action']) && $_GET['action']=='new_device_additionadminComment')
{
	$query = "SELECT admin_comment FROM internalsoftware.new_device_addition  where id=".$row_id;
	$row=select_query($query);
	
	$Updateapprovestatus="update internalsoftware.new_device_addition set admin_comment='".$row[0]["admin_comment"]."<br/>".date("Y-m-d H:i:s")." - " .$comment."', new_device_status='2' where id=".$row_id;
	
	//$Updateapprovestatus="update new_device_addition set admin_comment='".$comment."' where id=".$row_id;
	select_query($Updateapprovestatus);
	echo "Comment added Successfully";
}


if(isset($_GET['action']) && $_GET['action']=='vehicle_no_changeadminComment')
{
	$query = "SELECT admin_comment FROM internalsoftware.vehicle_no_change  where id=".$row_id;
	$row=select_query($query);
	
	$Updateapprovestatus="update internalsoftware.vehicle_no_change set admin_comment='".$row[0]["admin_comment"]."<br/>".date("Y-m-d H:i:s")." - " .$comment."', vehicle_status='2' where id=".$row_id;
	//$Updateapprovestatus="update vehicle_no_change set admin_comment='".$comment."' where id=".$row_id;
	select_query($Updateapprovestatus);
	echo "Comment added Successfully";
}

if(isset($_GET['action']) && $_GET['action']=='sim_changeadminComment')
{
	$query = "SELECT admin_comment FROM internalsoftware.sim_change  where id=".$row_id;
	$row=select_query($query);
	  
	$Updateapprovestatus="update internalsoftware.sim_change set admin_comment='".$row[0]["admin_comment"]."<br/>".date("Y-m-d H:i:s")." - " .$comment."' where id=".$row_id;

	//$Updateapprovestatus="update sim_change set admin_comment='".$comment."' where id=".$row_id;
	select_query($Updateapprovestatus);
	echo "Comment added Successfully";
}

if(isset($_GET['action']) && $_GET['action']=='device_lostadminComment')
{
	$query = "SELECT admin_comment FROM internalsoftware.device_lost  where id=".$row_id;
	$row=select_query($query);
	  
	$Updateapprovestatus="update internalsoftware.device_lost set admin_comment='".$row[0]["admin_comment"]."<br/>".date("Y-m-d H:i:s")." - " .$comment."', device_lost_status='2' where id=".$row_id;
	
	//$Updateapprovestatus="update device_lost set admin_comment='".$comment."' where id=".$row_id;
	select_query($Updateapprovestatus);
	echo "Comment added Successfully";
}

if(isset($_GET['action']) && $_GET['action']=='deletionadminComment')
{
	$query = "SELECT admin_comment FROM internalsoftware.deletion  where id=".$row_id;
	$row=select_query($query);

	$Updateapprovestatus="update internalsoftware.deletion set admin_comment='".$row[0]["admin_comment"]."<br/>".date("Y-m-d H:i:s")." - " .$comment."', delete_veh_status='2' where id=".$row_id;
	
	//$Updateapprovestatus="update deletion set admin_comment='".$comment."' where id=".$row_id;
	select_query($Updateapprovestatus);
	echo "Comment added Successfully";
}


if(isset($_GET['action']) && $_GET['action']=='sub_user_creationadminComment')
{
	$query = "SELECT admin_comment FROM internalsoftware.sub_user_creation  where id=".$row_id;
	$row=select_query($query);
	  
	$Updateapprovestatus="update internalsoftware.sub_user_creation  set admin_comment='".$row[0]["admin_comment"]."<br/>".date("Y-m-d H:i:s")." - " .$comment."',sub_user_status='2' where id=".$row_id;

	//$Updateapprovestatus="update sub_user_creation  set admin_comment='".$comment."' where id=".$row_id;
	select_query($Updateapprovestatus);
	echo "Comment added Successfully";
}


if(isset($_GET['action']) && $_GET['action']=='deactivation_of_accountadminComment')
{
	
	$query = "SELECT admin_comment FROM internalsoftware.deactivation_of_account  where id=".$row_id;
	$row=select_query($query);
	  
	$Updateapprovestatus="update internalsoftware.deactivation_of_account  set admin_comment='".$row[0]["admin_comment"]."<br/>".date("Y-m-d H:i:s")." - " .$comment."',deactivation_status='2' where id=".$row_id;
	
	//$Updateapprovestatus="update deactivation_of_account  set admin_comment='".$comment."' where id=".$row_id;
	select_query($Updateapprovestatus);
	echo "Comment added Successfully";
}

if(isset($_GET['action']) && $_GET['action']=='Reactivation_of_accountadminComment')
{
	$query = "SELECT admin_comment FROM internalsoftware.reactivation_of_account  where id=".$row_id;
	$row=select_query($query);

	$Updateapprovestatus="update internalsoftware.reactivation_of_account  set admin_comment='".$row[0]["admin_comment"]."<br/>".date("Y-m-d H:i:s")." - " .$comment."',reactivation_status=2 where id=".$row_id;
	
	select_query($Updateapprovestatus);
	/*echo "Comment added Successfully";*/
}

if(isset($_GET['action']) && $_GET['action']=='del_form_debtorsadminComment')
{
	$query = "SELECT admin_comment FROM internalsoftware.del_form_debtors  where id=".$row_id;
	$row=select_query($query);

	$Updateapprovestatus="update internalsoftware.del_form_debtors  set admin_comment='".$row[0]["admin_comment"]."<br/>".date("Y-m-d H:i:s")." - " .$comment."',del_debtors_status='2' where id=".$row_id;
	
	//$Updateapprovestatus="update del_form_debtors  set admin_comment='".$comment."' where id=".$row_id;
	select_query($Updateapprovestatus);
	echo "Comment added Successfully";
}	


if(isset($_GET['action']) && $_GET['action']=='no_billsadminComment')
{
	$query = "SELECT admin_comment FROM internalsoftware.no_bills  where id=".$row_id;
	$row=select_query($query);

	$Updateapprovestatus="update internalsoftware.no_bills  set admin_comment='".$row[0]["admin_comment"]."<br/>".date("Y-m-d H:i:s")." - " .$comment."',no_bill_status='2' where id=".$row_id;
	
	//$Updateapprovestatus="update no_bills  set admin_comment='".$comment."' where id=".$row_id;
	select_query($Updateapprovestatus);
	echo "Comment added Successfully";
}	

if(isset($_GET['action']) && $_GET['action']=='discount_detailsadminComment')
{
	$query = "SELECT admin_comment FROM internalsoftware.discount_details  where id=".$row_id;
	$row=select_query($query);

	$Updateapprovestatus="update internalsoftware.discount_details  set admin_comment='".$row[0]["admin_comment"]."<br/>".date("Y-m-d H:i:s")." - ".$comment."',discount_status='2' where id=".$row_id;
	//$Updateapprovestatus="update discount_details  set admin_comment='".$comment."' where id=".$row_id;
	select_query($Updateapprovestatus);
	echo "Comment added Successfully";
}	

if(isset($_GET['action']) && $_GET['action']=='software_requestadminComment')
{
	$query = "SELECT admin_comment FROM internalsoftware.software_request  where id=".$row_id;
	$row=select_query($query);

	$Updateapprovestatus="update internalsoftware.software_request  set admin_comment='".$row[0]["admin_comment"]."<br/>".date("Y-m-d H:i:s")." - " .$comment."',software_status='2' where id=".$row_id;
	//$Updateapprovestatus="update software_request  set admin_comment='".$comment."' where id=".$row_id;
	select_query($Updateapprovestatus);
	echo "Comment added Successfully";
}

if(isset($_GET['action']) && $_GET['action']=='transfer_the_vehicleadminComment')
{
	$query = "SELECT admin_comment FROM internalsoftware.transfer_the_vehicle  where id=".$row_id;
	$row=select_query($query);

	$Updateapprovestatus="update internalsoftware.transfer_the_vehicle  set admin_comment='".$row[0]["admin_comment"]."<br/>".date("Y-m-d H:i:s")." - " .$comment."',transfer_veh_status='2' where id=".$row_id;

	//$Updateapprovestatus="update transfer_the_vehicle  set admin_comment='".$comment."' where id=".$row_id;
	select_query($Updateapprovestatus);
	echo "Comment added Successfully";
	 
}	

if(isset($_GET['action']) && $_GET['action']=='deactivatesimadminComment')
{
	$query = "SELECT admin_comment FROM internalsoftware.deactivate_sim  where id=".$row_id;
	$row=select_query($query);

	$Updateapprovestatus="update internalsoftware.deactivate_sim  set admin_comment='".$row[0]["admin_comment"]."<br/>".date("Y-m-d H:i:s")." - " .$comment."' where id=".$row_id;

	//$Updateapprovestatus="update deactivate_sim  set admin_comment='".$comment."' where id=".$row_id;
	select_query($Updateapprovestatus);
	echo "Comment added Successfully";
	 
}	

if(isset($_GET['action']) && $_GET['action']=='dimts_imeiadminComment')
{

	$query = "SELECT admin_comment FROM internalsoftware.dimts_imei  where id=".$row_id;
	$row=select_query($query);

	$Updateapprovestatus="update internalsoftware.dimts_imei  set admin_comment='".$row[0]["admin_comment"]."<br/>".date("Y-m-d H:i:s")." - " .$comment."', dimts_status='2' where id=".$row_id;

	//$Updateapprovestatus="update dimts_imei  set admin_comment='".$comment."' where id=".$row_id;
	select_query($Updateapprovestatus);
	echo "Comment added Successfully";
	 
}

if(isset($_GET['action']) && $_GET['action']=='Renewdimts_imeiadminComment')
{
	$query = "SELECT admin_comment FROM internalsoftware.renew_dimts_imei  where id=".$row_id;
	$row=select_query($query);

	$Updateapprovestatus="update internalsoftware.renew_dimts_imei set admin_comment='".$row[0]["admin_comment"]."<br/>".date("Y-m-d H:i:s")." - " .$comment."', renew_dimts_status='2' where id=".$row_id;

	select_query($Updateapprovestatus);
	echo "Comment added Successfully";
	 
}

if(isset($_GET['action']) && $_GET['action']=='adminStockView')
{
	// $branchId = $_GET['branchId'];
	// $query = "SELECT * FROM admin_stock_view";
	// $row=select_query($query);

	//echo count($row);die;

	//echo "12222";
?>

<table cellspacing="2" cellpadding="2">
      <tbody>
        <tr>
        	<td>1</td>
        	<td>2</td>
        	<td>2</td>
        	<td>2</td>
        	<td>2</td>
        	<td>2</td>
        	<td>2</td>
        </tr>
      </tbody>
    </table>

	
<?php
}	

if(isset($_GET['action']) && $_GET['action']=='getrowSales')
{
?>
<style type="text/css">
#databox {
	width:840px;
	height:650px;
	margin: 30px auto auto;
	border:1px solid #bfc0c1;
	font-family:Arial, Helvetica, sans-serif;
	font-size:13px;
	font-weight:normal;
	color:#3f4041;
}
.heading {
	font-family:Arial, Helvetica, sans-serif;
	font-size:30px;
	font-weight:700;
	word-spacing:5px;
	text-align:center;
	color:#3E3E3E;
	background-color:#ECEFE7;
	margin-bottom:10px;
}
.dataleft {
	float:left;
	width:400px;
	height:400px;
	margin-left:10px;
	border-right:1px solid #bfc0c1;
}
.dataright {
	float:right;
	width:400px;
	height:400px;
	margin-left:19px;
}
.dataleft2 {
	float:left;
	width:400px;
	/*height:200px;*/
	margin-left:10px;
	border-right:1px solid #bfc0c1;
}
.dataright2 {
	float:right;
	width:400px;
	/*height:200px;*/
	margin-left:19px;
}
.datacenter {
	margin-top:350px;
	width:800px;
	/*height:200px;*/
	margin-left:10px;
}
td {
	padding-right:20px;
	padding-left:20px;
}
.fix-height {
	max-height: 400px;
	overflow-y: scroll;
}
.fix-height2 {
	max-height: 400px;
	overflow-y: scroll;
}
</style>
<?
	$RowId=$_GET["RowId"];
	$tablename=$_GET["tablename"];
	$devicemodel=$_GET["devModel"];
	//$devicetype=$_GET["devicetype"];	

	If($tablename=="new_account_creation")
		{
			$query = "SELECT *,DATE_FORMAT(date, '%d %M %y %H:%i:%s') FROM ".$tablename." where id=".$RowId;
			$row=select_query($query);
			
			$forward_query9 = select_query("SELECT * FROM forward_req_history where table_name='$tablename' and table_row_id=".$RowId);
			$total_query9 = count($forward_query9);
			
			$ModelData = select_query("select * from new_account_model_master where is_active='0' and new_account_reqid='".$RowId."' ");
			$modelcount = count($ModelData);
			
			$oldModelData = select_query("select * from new_account_model_master where is_active='1' and new_account_reqid='".$RowId."' ");
			$oldmodelcount = count($oldModelData);

	?>
<div id="databox">
  <div class="heading">New account creation</div>
  <div class="dataleft2">
    <table cellspacing="2" cellpadding="2">
      <tbody>
        <tr>
          <td>Date</td>
          <td><?echo date("d-M-Y h:i:s A",strtotime($row[0]["date"]));?></td>
        </tr>
        <tr>
          <td>Request By</td>
          <td><?echo $row[0]["account_manager"];?></td>
        </tr>
        <tr>
          <td>Account Manager</td>
          <td><?echo $row[0]["sales_manager"];?></td>
        </tr>
        <tr>
          <td>Company</td>
          <td><?echo $row[0]["company"];?></td>
        </tr>
        <tr>
          <td>Potential</td>
          <td><?echo $row[0]["potential"];?></td>
        </tr>
        <tr>
          <td>Contact Person</td>
          <td><?echo $row[0]["contact_person"];?></td>
        </tr>
        <tr>
          <td>Contact Number</td>
          <td><?echo $row[0]["contact_number"];?></td>
        </tr>
        <tr>
          <td>Billing Address</td>
          <td><?echo $row[0]["billing_address"];?></td>
        </tr>
        <tr>
          <td>E-Mail ID</td>
          <td><?echo $row[0]["email_id"];?></td>
        </tr>
        <tr>
          <td>User Name</td>
          <td><?echo $row[0]["user_name"];?></td>
        </tr>
        <tr>
          <td>Password</td>
          <td><?echo $row[0]["user_password"];?></td>
        </tr>
        <tr>
          <td>Vehicle type</td>
          <td><?echo $row[0]["vehicle_type"];?></td>
        </tr>
        <tr>
          <td>Dimts</td>
          <td><?echo $row[0]["dimts"];?></td>
        </tr>
        <tr>
          <td>Dimts Fee status </td>
          <td><?echo $row[0]["dimts_fee"];?></td>
        </tr>
        <tr>
          <td>Assign Telecaller</td>
          <td><?echo $row[0]["telecaller_name"];?></td>
        </tr>
        <tr>
          <td>Assign to Support</td>
          <td><? $query_support = select_query("SELECT user_name FROM internalsoftware.login_user WHERE id='".$row[0]["support_id"]."'");
			echo $query_support[0]['user_name'];
			?></td>
        </tr>
      </tbody>
    </table>
  </div>
  <div class="dataright2">
    <table cellspacing="2" cellpadding="2">
      <tbody>
        <tr>
          <td>Type of Organisation</td>
          <td><?echo $row[0]["type_of_org"];?></td>
        </tr>
        <tr>
          <td>PAN No.</td>
          <td><?echo $row[0]["pan_no"];?></td>
        </tr>
        <tr>
          <td>Immobilizer (Y/N)</td>
          <td><?echo $row[0]["immobilizer"];?></td>
        </tr>        
        <tr>
          <td>New Sales Comment</td>
          <td><?echo $row[0]["new_acc_salescomment"];?></td>
        </tr>
        <!-- <tr><td>Admin Approval</td>  <td><?if($row[0]["approve_status"]==1) echo "Approved"; else echo "Pending Approval"?></td></tr>-->
        <tr>
          <td><strong>Process Pending </strong></td>
          <td><strong>
            <?  if($row[0]["acc_creation_status"]==2 || (($row[0]["support_comment"]!="" || $row[0]["admin_comment"]!="") && $row[0]["sales_comment"]==""))
	{echo "Reply Pending at Request Side";}
	elseif($row[0]["approve_status"]==0 && $row[0]["forward_req_user"]!="" && $row[0]["forward_back_comment"]=="" && $row[0]["acc_creation_status"]==1)	
	{echo "Pending Admin Approval (Req Forward to ".$row[0]["forward_req_user"].")";}
	elseif($row[0]["approve_status"]==0 && $row[0]["acc_creation_status"]==1)
	{echo "Pending Admin Approval";}
	elseif($row[0]["approve_status"]==1 && $row[0]["acc_creation_status"]==1 && $row[0]["final_status"]!=1){echo "Pending at Tech Support Team";}
	elseif($row[0]["approve_status"]==1 && $row[0]["final_status"]==1){echo "Process Done";}?>
            </strong></td>
        </tr>
        <tr>
          <td>Account Comment</td>
          <td><?echo $row[0]["account_comment"];?></td>
        </tr>
        <tr>
          <td>Sales Comment</td>
          <td><?echo $row[0]["sales_comment"];?></td>
        </tr>
        <tr>
          <td>Support Comment</td>
          <td><?echo $row[0]["support_comment"];?></td>
        </tr>
        <tr>
          <td>Admin Comment</td>
          <td><?echo $row[0]["admin_comment"];?></td>
        </tr>
        <tr>
          <td>Req Forwarded to</td>
          <td><?echo $row[0]["forward_req_user"];?></td>
        </tr>
        <tr>
          <td>Forward Comment</td>
          <td><?echo $row[0]["forward_comment"];?></td>
        </tr>
        <tr>
          <td>F/W Request Back Comment</td>
          <td><?echo $row[0]["forward_back_comment"];?></td>
        </tr>
        <tr>
          <td>Approval Date</td>
          <td><?
			if($row[0]["approve_status"]==1 && $row[0]["approve_date"]!='')
			{
			echo date("d-M-Y h:i:s A",strtotime($row[0]["approve_date"]));
			}
			else
			{
				echo "";
			}
			
			?></td>
        </tr>
        <tr>
          <td>Closed By</td>
          <td><?echo $row[0]["req_close_by"];?></td>
        </tr>
        <tr>
          <td>Closed Date</td>
          <td><?
			if($row[0]["final_status"]==1 && $row[0]["close_date"]!='')
			{
			echo date("d-M-Y h:i:s A",strtotime($row[0]["close_date"]));
			}
			else
			{
				echo "";
			}
			
			?></td>
        </tr>
          </tr>
        
        <?php if($total_query9>0){?>
        <tr>
          <td colspan="2">-------------------------------------------</td>
        </tr>
        <tr>
          <td colspan="2"><table cellspacing="2" cellpadding="2">
              <tbody>
                <tr>
                  <td align="left">Req Forwarded to</td>
                  <td>Forward Comment</td>
                  <td>F/W Request Back Comment</td>
                </tr>
                <?php for($at=0;$at<count($forward_query9);$at++){?>
                <tr>
                  <td><?php echo $forward_query9[$at]["forward_req_user"];?></td>
                  <td><?php echo $forward_query9[$at]["forward_comment"];?></td>
                  <td><?php echo $forward_query9[$at]["forward_back_comment"];?></td>
                </tr>
                <?php } ?>
              </tbody>
            </table></td>
        </tr>
        <?php } ?>
      </tbody>
    </table>
  </div>
  <div>&nbsp;</div>
  <div class="datacenter">
	<table cellspacing="2" cellpadding="2" border="1">
      <tbody>
		<?php if($modelcount>0){?>
        <tr>
              <th align="left">SrNo.</th>
              <th align="left">DeviceType</th>
              <th align="left">modelType</th>
              <th align="left">AccountType</th>
              <th align="left">PaymentMode</th>
              <th align="left">RentPlan</th>
        </tr>
        <tr>
        	<td colspan="6" style="background-color:#FF6"><font style="color:#000;font-weight:bold;">Pending Model for Approval</font></td>
        </tr>
       <?php for($gm=0;$gm<$modelcount;$gm++){
				
			   if($ModelData[$gm]["rent_month"] == '1'){$plan = 'Monthly';}
			   elseif($ModelData[$gm]["rent_month"] == '3'){$plan = 'Quarterly';}
			   elseif($ModelData[$gm]["rent_month"] == '6'){$plan = 'HalfYearly';}
			   elseif($ModelData[$gm]["rent_month"] == '12'){$plan = 'Yearly';}
			   else{$plan = '--';}
			   
			   $getdevice = select_query("SELECT * FROM internalsoftware.device_type  WHERE id=".$ModelData[$gm]["device_type"]);
		?>
       <tr>
       		  <td><? echo $gm+1;?></td>
              <td><strong><? echo $getdevice[0]["device_type"];?></strong></td>
              <td><strong><? echo $ModelData[$gm]["device_model"];?></strong></td>
              <td><strong><? echo $ModelData[$gm]["account_type"];?></strong></td>
              <td><strong><? echo $ModelData[$gm]["mode_of_payment"];?></strong></td>
              <td><strong><? echo $plan;?></strong></td>
       </tr>
       <?php if($ModelData[$gm]["mode_of_payment"] == 'Billed'){ ?>
       <tr>    
              <td>&nbsp;</td>
              <td>DPrice - <? echo $ModelData[$gm]["device_price"];?></td>
              <td>Status - <? echo $ModelData[$gm]["device_status"];?></td>
              <td>Vat(5%) - <? echo $ModelData[$gm]["device_price_vat"];?></td>
              <td>DTotal - <? echo $ModelData[$gm]["device_price_total"];?></td>
        </tr>
        <tr>    
              <td>&nbsp;</td>
              <td>RPrice - <? echo $ModelData[$gm]["device_rent_Price"];?></td>
              <td>Status - <? echo $ModelData[$gm]["rent_status"];?></td>
              <td>STex(15%) - <? echo $ModelData[$gm]["device_rent_service_tax"];?></td>
              <td>RTotal - <? echo $ModelData[$gm]["DTotalREnt"];?> </td>
        </tr> 
       <?php } elseif($ModelData[$gm]["mode_of_payment"] == 'CashClient'){ ?> 
          <tr>    
              <td>&nbsp;</td>
              <td colspan="2">DPrice - <? echo $ModelData[$gm]["device_price_total"];?></td>
              <td colspan="2">RPrice - <? echo $ModelData[$gm]["DTotalREnt"];?></td>
          </tr>
        <?php } elseif($ModelData[$gm]["account_type"] == 'Foc'){ ?>
		  <tr>    
              <td>&nbsp;</td>
              <td colspan="4">FOC Reason - <? echo $ModelData[$gm]["foc_reason"];?></td>
          </tr>
       <?php } elseif($ModelData[$gm]["account_type"] == 'Demo'){ ?>
		  <tr>    
              <td>&nbsp;</td>
              <td colspan="2">Demo Period - <? echo $ModelData[$gm]["demo_time"]." Days";?></td>
          </tr>
       <?php } elseif($ModelData[$gm]["account_type"] == 'InternalTesting'){ ?>
		  <tr>    
              <td>&nbsp;</td>
              <td colspan="2">Testing Period - <? echo $ModelData[$gm]["testing_time"]." Days";?></td>
          </tr>
       <?php } 
	      } 
	   }
	   if($oldmodelcount>0){ 
	   ?>   
	   <tr>
        	<td colspan="6" style="background-color:#99FF66"><font style="color:#000;font-weight:bold;">Approved Model</font></td>
        </tr>
       <?php for($gd=0;$gd<$oldmodelcount;$gd++){
				
			   if($oldModelData[$gd]["rent_month"] == '1'){$plan = 'Monthly';}
			   elseif($oldModelData[$gd]["rent_month"] == '3'){$plan = 'Quarterly';}
			   elseif($oldModelData[$gd]["rent_month"] == '6'){$plan = 'HalfYearly';}
			   elseif($oldModelData[$gd]["rent_month"] == '12'){$plan = 'Yearly';}
			   else{$plan = '--';}
			   
			   $getdevice = select_query("SELECT * FROM internalsoftware.device_type  WHERE id=".$oldModelData[$gd]["device_type"]);
		?>
       <tr>
       		  <td><? echo $gd+1;?></td>
              <td><strong><? echo $getdevice[0]["device_type"];?></strong></td>
              <td><strong><? echo $oldModelData[$gd]["device_model"];?></strong></td>
              <td><strong><? echo $oldModelData[$gd]["account_type"];?></strong></td>
              <td><strong><? echo $oldModelData[$gd]["mode_of_payment"];?></strong></td>
              <td><strong><? echo $plan;?></strong></td>
       </tr>
       <?php if($oldModelData[$gd]["mode_of_payment"] == 'Billed'){ ?>
       <tr>    
              <td>&nbsp;</td>
              <td>DPrice - <? echo $oldModelData[$gd]["device_price"];?></td>
              <td>Status - <? echo $oldModelData[$gd]["device_status"];?></td>
              <td>Vat(5%) - <? echo $oldModelData[$gd]["device_price_vat"];?></td>
              <td>DTotal - <? echo $oldModelData[$gd]["device_price_total"];?></td>
        </tr>
        <tr>    
              <td>&nbsp;</td>
              <td>RPrice - <? echo $oldModelData[$gd]["device_rent_Price"];?></td>
              <td>Status - <? echo $oldModelData[$gd]["rent_status"];?></td>
              <td>STex(15%) - <? echo $oldModelData[$gd]["device_rent_service_tax"];?></td>
              <td>RTotal - <? echo $oldModelData[$gd]["DTotalREnt"];?> </td>
        </tr> 
       <?php } elseif($oldModelData[$gd]["mode_of_payment"] == 'CashClient'){ ?> 
          <tr>    
              <td>&nbsp;</td>
              <td colspan="2">DPrice - <? echo $oldModelData[$gd]["device_price_total"];?></td>
              <td colspan="2">RPrice - <? echo $oldModelData[$gd]["DTotalREnt"];?></td>
          </tr>
        <?php } elseif($oldModelData[$gd]["account_type"] == 'Foc'){ ?>
		  <tr>    
              <td>&nbsp;</td>
              <td colspan="4">FOC Reason - <? echo $oldModelData[$gd]["foc_reason"];?></td>
          </tr>
       <?php } elseif($oldModelData[$gd]["account_type"] == 'Demo'){ ?>
		  <tr>    
              <td>&nbsp;</td>
              <td colspan="2">Demo Period - <? echo $oldModelData[$gd]["demo_time"]." Days";?></td>
          </tr>
       <?php } elseif($oldModelData[$gd]["account_type"] == 'InternalTesting'){ ?>
		  <tr>    
              <td>&nbsp;</td>
              <td colspan="2">Testing Period - <? echo $oldModelData[$gd]["testing_time"]." Days";?></td>
          </tr>
       <?php } 
	      } 	   
	   }
	   if($modelcount==0 && $oldmodelcount==0)
	   {
	   ?>
       <tr>
              <th align="left">AccountType</th>
              <th align="left">PaymentMode</th>
              <th align="left">DevicePrice</th>
              <th align="left">Total Price</th>
              <th align="left">Rent</th>
              <th align="left">Total Rent</th>
              <th align="left">RentMonth</th>
              <th align="left">RentStatus</th>
              <th align="left">DemoPeriod</th>
              <th align="left">FOCReason</th>
        </tr> 
       <tr>
              <td><strong><? echo $row[0]["account_type"];?></strong></td>
              <td><strong><? echo $row[0]["mode_of_payment"];?></strong></td>
              <td><? echo $row[0]["device_price"];?></td>
              <td><? echo $row[0]["device_price_total"];?></td>
              <td><? echo $row[0]["device_rent_Price"];?></td>
              <td><? echo $row[0]["DTotalREnt"];?></td>
              <td><? if($row[0]["rent_month"]!=""){echo $row[0]["rent_month"]." Month";}?></td>
              <td><? echo $row[0]["rent_status"];?></td>
              <td><? if($row[0]["demo_time"]!=""){echo $row[0]["demo_time"];}?></td>
              <td><? echo $row[0]["foc_reason"];?></td>
       </tr>
       <?php } ?>
       </tbody>
     </table>         
  </div>
</div>
<?php
}
	else If($tablename=="stop_gps")
		{
		    $query = "SELECT * FROM ".$tablename." where id=".$RowId; 
			$row=select_query($query);
			$forward_query10 = select_query("SELECT * FROM forward_req_history where table_name='$tablename' and table_row_id=".$RowId);
			$total_query10 = count($forward_query10);
			
	?>
<div id="databox">
  <div class="heading">Stop Gps</div>
  <div class="dataleft">
    <table cellspacing="2" cellpadding="2">
      <tbody>
        <tr>
          <td>Date </td>
          <td><?echo date("d-M-Y h:i:s A",strtotime($row[0]["date"]));?></td>
        </tr>
        <? /*if($row[0]["acc_manager"]=='saleslogin') {
		$account_manager=$row[0]["sales_manager"]; 
		}
		else {
		$account_manager=$row[0]["acc_manager"]; 
		}*/
		
		?>
        <tr>
          <td>Request By</td>
          <td><?echo $row[0]["acc_manager"];?></td>
        </tr>
        <tr>
          <td>Account Manager</td>
          <td><?echo $row[0]["sales_manager"];?></td>
        </tr>
        <? $sql="SELECT Userid AS id,UserName AS sys_username FROM internalsoftware.addclient  WHERE Userid=".$row[0]["client"];
			$rowuser=select_query($sql);
			?>
        <tr>
          <td>Client User Name </td>
          <td><?echo $rowuser[0]["sys_username"];?></td>
        </tr>
        <tr>
          <td>Company Name </td>
          <td><?echo $row[0]["company"];?></td>
        </tr>
        <tr>
          <td>Total No Of Vehicle </td>
          <td><?echo $row[0]["tot_no_of_vehicle"];?></td>
        </tr>
        <tr>
          <td>Vehicle to Stop GPS </td>
          <td><?echo $row[0]["no_of_vehicle"];?></td>
        </tr>
        <tr>
          <td>Present Status Of</td>
          <td>:---</td>
        </tr>
        <tr>
          <td>Location </td>
          <td><?echo $row[0]["ps_of_location"];?></td>
        </tr>
        <tr>
          <td>Data to display </td>
          <td><?echo $row[0]["data_display"];?></td>
        </tr>
        <tr>
          <td>OwnerShip </td>
          <td><?echo $row[0]["ps_of_ownership"];?></td>
        </tr>
        <tr>
          <td>Reason </td>
          <td><?echo $row[0]["reason"];?></td>
        </tr>
      </tbody>
    </table>
  </div>
  <div class="dataright">
    <table cellspacing="2" cellpadding="2">
      <tbody>
        
        <!--<tr><td>Admin Approval</td>  <td><?if($row[0]["approve_status"]==1) echo "Approved"; else echo "Pending Approval"?></td></tr>-->
        <tr>
          <td><strong>Process Pending </strong></td>
          <td><strong>
            <?  if($row[0]["stop_gps_status"]==2 || (($row[0]["support_comment"]!="" || $row[0]["admin_comment"]!="") && $row[0]["sales_comment"]==""))
	{echo "Reply Pending at Request Side";}
	elseif($row[0]["account_comment"]=="" && $row[0]["total_pending"]=="" && $row[0]["approve_status"]==0 && $row[0]["final_status"]==0){echo "Pending at Accounts";} 
	elseif($row[0]["approve_status"]==0 && ($row[0]["account_comment"]!="" || $row[0]["total_pending"]!="") && $row[0]["forward_req_user"]!="" && $row[0]["forward_back_comment"]=="" && $row[0]["stop_gps_status"]==1)	{echo "Pending Admin Approval (Req Forward to ".$row[0]["forward_req_user"].")";}
	elseif($row[0]["approve_status"]==0 && ($row[0]["account_comment"]!="" || $row[0]["total_pending"]!="") && $row[0]["final_status"]==0 && $row[0]["stop_gps_status"]==1)
	{echo "Pending Admin Approval";}
	elseif($row[0]["approve_status"]==1 && $row[0]["stop_gps_status"]==1 && $row[0]["final_status"]!=1){echo "Pending at Tech Support Team";}
	elseif($row[0]["final_status"]==1){echo "Process Done";}?>
            </strong></td>
        </tr>
        <tr>
          <td>Account Comment</td>
          <td><?echo $row[0]["account_comment"];?></td>
        </tr>
        <tr>
          <td>Payment Pending</td>
          <td><?echo $row[0]["total_pending"];?></td>
        </tr>
        <tr>
          <td>Sales Comment</td>
          <td><?echo $row[0]["sales_comment"];?></td>
        </tr>
        <tr>
          <td>Support Comment</td>
          <td><?echo $row[0]["support_comment"];?></td>
        </tr>
        <tr>
          <td>Admin Comment</td>
          <td><?echo $row[0]["admin_comment"];?></td>
        </tr>
        <tr>
          <td>Req Forwarded to</td>
          <td><?echo $row[0]["forward_req_user"];?></td>
        </tr>
        <tr>
          <td>Forward Comment</td>
          <td><?echo $row[0]["forward_comment"];?></td>
        </tr>
        <tr>
          <td>F/W Request Back Comment</td>
          <td><?echo $row[0]["forward_back_comment"];?></td>
        </tr>
        <tr>
          <td>Approval Date</td>
          <td><?
			if($row[0]["approve_status"]==1 && $row[0]["approve_date"]!='')
			{
			echo date("d-M-Y h:i:s A",strtotime($row[0]["approve_date"]));
			}
			else
			{
				echo "";
			}
			
			?></td>
        </tr>
        <tr>
          <td>Closed By</td>
          <td><?echo $row[0]["req_close_by"];?></td>
        </tr>
        <tr>
          <td>Closed Date</td>
          <td><?
			if($row[0]["final_status"]==1 && $row[0]["close_date"]!='')
			{
			echo date("d-M-Y h:i:s A",strtotime($row[0]["close_date"]));
			}
			else
			{
				echo "";
			}
			
			?></td>
        </tr>
        <?php if($total_query10>0){?>
        <tr>
          <td colspan="2">-------------------------------------------</td>
        </tr>
        <tr>
          <td colspan="2"><table cellspacing="2" cellpadding="2">
              <tbody>
                <tr>
                  <td align="left">Req Forwarded to</td>
                  <td>Forward Comment</td>
                  <td>F/W Request Back Comment</td>
                </tr>
                <?php for($at=0;$at<count($forward_query10);$at++){?>
                <tr>
                  <td><?php echo $forward_query10[$at]["forward_req_user"];?></td>
                  <td><?php echo $forward_query10[$at]["forward_comment"];?></td>
                  <td><?php echo $forward_query10[$at]["forward_back_comment"];?></td>
                </tr>
                <?php } ?>
              </tbody>
            </table></td>
        </tr>
        <?php } ?>
      </tbody>
    </table>
  </div>
</div>
<? }


	else If($tablename=="start_gps")
		{
		    $query = "SELECT * FROM ".$tablename." where id=".$RowId; 
			$row=select_query($query);
			$forward_startgps_query = select_query("SELECT * FROM forward_req_history where table_name='$tablename' and table_row_id=".$RowId);
			$total_startgps_query = count($forward_startgps_query);
	?>
<div id="databox">
  <div class="heading">Start Gps</div>
  <div class="dataleft">
    <table cellspacing="2" cellpadding="2">
      <tbody>
        <tr>
          <td>Date </td>
          <td><?echo date("d-M-Y h:i:s A",strtotime($row[0]["date"]));?></td>
        </tr>
        <tr>
          <td>Request By</td>
          <td><?echo $row[0]["acc_manager"];?></td>
        </tr>
        <tr>
          <td>Account Manager</td>
          <td><?echo $row[0]["sales_manager"];?></td>
        </tr>
        <? $sql="SELECT Userid AS id,UserName AS sys_username FROM internalsoftware.addclient  WHERE Userid=".$row[0]["client"];
		$rowuser=select_query($sql);
		?>
        <tr>
          <td>Client User Name </td>
          <td><?echo $rowuser[0]["sys_username"];?></td>
        </tr>
        <tr>
          <td>Company Name </td>
          <td><?echo $row[0]["company"];?></td>
        </tr>
        <tr>
          <td>Total No Of Vehicle </td>
          <td><?echo $row[0]["tot_no_of_vehicle"];?></td>
        </tr>
        <tr>
          <td>Persent Status Of</td>
          <td>:---</td>
        </tr>
        <tr>
          <td>OwnerShip </td>
          <td><?echo $row[0]["ps_of_ownership"];?></td>
        </tr>
        <tr>
          <td>Reason </td>
          <td><?echo $row[0]["reason"];?></td>
        </tr>
        <tr>
          <td>Vehicle to Start GPS </td>
          <td><?php $vechile_no = explode(",",$row[0]["reg_no"]); 
for($i=0;$i<=count($vechile_no);$i++){ if($i%3!=0){ echo $vechile_no[$i].", ";}else { echo "<br/>".$vechile_no[$i].", ";} }?></td>
        </tr>
      </tbody>
    </table>
  </div>
  <div class="dataright">
    <table cellspacing="2" cellpadding="2">
      <tbody>
        <!--<tr><td>Admin Approval</td>  <td><?if($row[0]["approve_status"]==1) echo "Approved"; else echo "Pending Approval"?></td></tr>-->
        <tr>
          <td><strong>Process Pending </strong></td>
          <td><strong>
            <?  if($row[0]["start_gps_status"]==2 || (($row[0]["support_comment"]!="" || $row[0]["admin_comment"]!="") && $row[0]["sales_comment"]==""))
	{echo "Reply Pending at Request Side";}
	elseif($row[0]["account_comment"]=="" && $row[0]["total_pending"]=="" && $row[0]["approve_status"]==0 && $row[0]["final_status"]==0){echo "Pending at Accounts";} 
	elseif($row[0]["approve_status"]==0 && ($row[0]["account_comment"]!="" || $row[0]["total_pending"]!="") && $row[0]["forward_req_user"]!="" && $row[0]["forward_back_comment"]=="" && $row[0]["start_gps_status"]==1)	{echo "Pending Admin Approval (Req Forward to ".$row[0]["forward_req_user"].")";}
	elseif($row[0]["approve_status"]==0 && ($row[0]["account_comment"]!="" || $row[0]["total_pending"]!="") && $row[0]["final_status"]==0 && $row[0]["start_gps_status"]==1)
	{echo "Pending Admin Approval";}
	elseif($row[0]["approve_status"]==1 && $row[0]["start_gps_status"]==1 && $row[0]["final_status"]!=1){echo "Pending at Tech Support Team";}
	elseif($row[0]["final_status"]==1){echo "Process Done";}?>
            </strong></td>
        </tr>
        <tr>
          <td>Account Comment</td>
          <td><?echo $row[0]["account_comment"];?></td>
        </tr>
        <tr>
          <td>Payment Pending</td>
          <td><?echo $row[0]["total_pending"];?></td>
        </tr>
        <tr>
          <td>Sales Comment</td>
          <td><?echo $row[0]["sales_comment"];?></td>
        </tr>
        <tr>
          <td>Support Comment</td>
          <td><?echo $row[0]["support_comment"];?></td>
        </tr>
        <tr>
          <td>Admin Comment</td>
          <td><?echo $row[0]["admin_comment"];?></td>
        </tr>
        <tr>
          <td>Req Forwarded to</td>
          <td><?echo $row[0]["forward_req_user"];?></td>
        </tr>
        <tr>
          <td>Forward Comment</td>
          <td><?echo $row[0]["forward_comment"];?></td>
        </tr>
        <tr>
          <td>F/W Request Back Comment</td>
          <td><?echo $row[0]["forward_back_comment"];?></td>
        </tr>
        <tr>
          <td>Approval Date</td>
          <td><?
			if($row[0]["approve_status"]==1 && $row[0]["approve_date"]!='')
			{
			echo date("d-M-Y h:i:s A",strtotime($row[0]["approve_date"]));
			}
			else
			{
				echo "";
			}
			
			?></td>
        </tr>
        <tr>
          <td>Closed Date</td>
          <td><?
			if($row[0]["final_status"]==1 && $row[0]["close_date"]!='')
			{
			echo date("d-M-Y h:i:s A",strtotime($row[0]["close_date"]));
			}
			else
			{
				echo "";
			}
			
			?></td>
        </tr>
        <?php if($total_startgps_query>0){?>
        <tr>
          <td colspan="2">-------------------------------------------</td>
        </tr>
        <tr>
          <td colspan="2"><table cellspacing="2" cellpadding="2">
              <tbody>
                <tr>
                  <td align="left">Req Forwarded to</td>
                  <td>Forward Comment</td>
                  <td>F/W Request Back Comment</td>
                </tr>
                <?php for($at=0;$at<count($forward_startgps_query);$at++){?>
                <tr>
                  <td><?php echo $forward_startgps_query[$at]["forward_req_user"];?></td>
                  <td><?php echo $forward_startgps_query[$at]["forward_comment"];?></td>
                  <td><?php echo $forward_startgps_query[$at]["forward_back_comment"];?></td>
                </tr>
                <?php } ?>
              </tbody>
            </table></td>
        </tr>
        <?php } ?>
      </tbody>
    </table>
  </div>
</div>
<? }
	else If($tablename=="no_bills")
		{
		    $query = "SELECT * FROM ".$tablename." where id=".$RowId; 
			$row=select_query($query);
			$forward_query15 = select_query("SELECT * FROM forward_req_history where table_name='$tablename' and table_row_id=".$RowId);
			$total_query15 = count($forward_query15);
             
	?>
<div id="databox">
  <div class="heading">No Bills</div>
  <div class="dataleft">
    <table cellspacing="2" cellpadding="2">
      <tbody>
        <tr>
          <td>Date </td>
          <td><?echo date("d-M-Y h:i:s A",strtotime($row[0]["date"]));?></td>
        </tr>
        <? /*if($row[0]["acc_manager"]=='saleslogin') {
		$account_manager=$row[0]["sales_manager"]; 
		}
		else {
		$account_manager=$row[0]["acc_manager"]; 
		}*/
		
		?>
        <tr>
          <td>Request By</td>
          <td><?echo $row[0]["acc_manager"];?></td>
        </tr>
        <tr>
          <td>Account Manager</td>
          <td><?echo $row[0]["sales_manager"];?></td>
        </tr>
        <? $sql="SELECT Userid AS id,UserName AS sys_username FROM internalsoftware.addclient  WHERE Userid=".$row[0]["client"];
		$rowuser=select_query($sql);
		?>
        <tr>
          <td>Client User Name </td>
          <td><?echo $rowuser[0]["sys_username"];?></td>
        </tr>
        <tr>
          <td>Company Name </td>
          <td><?echo $row[0]["company_name"];?></td>
        </tr>
        <!--<tr><td>Vehicle Num</td><td><?echo $row[0]["reg_no"];?></td></tr>-->
        
        <tr>
          <td>Vehicle Num </td>
          <td><?php $vechile_no = explode(",",$row[0]["reg_no"]); 
for($i=0;$i<=count($vechile_no);$i++){ if($i%3!=0){ echo $vechile_no[$i].", ";}else { echo "<br/>".$vechile_no[$i].", ";} }?></td>
        </tr>
        <tr>
          <td>No Bill For </td>
          <td><?echo $row[0]["rent_device"];?></td>
        </tr>
        <tr>
          <td>Reason </td>
          <td><?echo $row[0]["reason"];?></td>
        </tr>
        <tr>
          <td>Provision Bill </td>
          <td><?echo $row[0]["provision_bill"];?></td>
        </tr>
        <tr>
          <td>Issue for No Bill</td>
          <td><?echo $row[0]["no_bill_issue"];?></td>
        </tr>
        <tr>
          <td>Admin Approval</td>
          <td><?if($row[0]["approve_status"]==1) echo "Approved"; else echo "Pending Approval"?></td>
        </tr>
        <tr>
          <td>Admin Comment</td>
          <td><?echo $row[0]["admin_comment"];?></td>
        </tr>
      </tbody>
    </table>
  </div>
  <div class="dataright">
    <table cellspacing="2" cellpadding="2">
      <tbody>
        <!--<tr><td>Admin Approval</td>  <td><?if($row[0]["approve_status"]==1) echo "Approved"; else echo "Pending Approval"?></td></tr>-->
        <tr>
          <td><strong>Process Pending </strong></td>
          <td><strong>
            <?  if($row[0]["no_bill_status"]==2 || (($row[0]["support_comment"]!="" || $row[0]["admin_comment"]!="") && $row[0]["sales_comment"]==""))
	{echo "Reply Pending at Request Side";}
	elseif(($row[0]["no_bill_issue"]=="Software Issue" && $row[0]["support_comment"]=="") || $row[0]["approve_status"]==1 && $row[0]["no_bill_status"]==1 && $row[0]["final_status"]!=1){echo "Pending at Tech Support Team";}
	elseif($row[0]["no_bill_issue"]=="Service Issue" && $row[0]["no_bill_status"]==1 && $row[0]["approve_status"]!=1 && $row[0]["service_comment"]=="")
	{echo "Pending at Service Team";}
	elseif($row[0]["account_comment"]=="" && $row[0]["total_pending"]=="" && $row[0]["approve_status"]==0 && $row[0]["final_status"]==0){echo "Pending at Accounts";}
	elseif($row[0]["approve_status"]==0 && $row[0]["forward_req_user"]!="" && $row[0]["forward_back_comment"]=="" && $row[0]["no_bill_status"]==1)	
	{echo "Pending Admin Approval (Req Forward to ".$row[0]["forward_req_user"].")";} 
	elseif($row[0]["approve_status"]==0 && ($row[0]["account_comment"]!="" || $row[0]["total_pending"]!="") && $row[0]["final_status"]==0 && $row[0]["no_bill_status"]==1)
	{echo "Pending Admin Approval";}
	elseif($row[0]["final_status"]==1){echo "Process Done";}?>
            </strong></td>
        </tr>
        <tr>
          <td>Account Comment</td>
          <td><?echo $row[0]["account_comment"];?></td>
        </tr>
        <tr>
          <td>Payment Pending</td>
          <td><?echo $row[0]["total_pending"];?></td>
        </tr>
        <tr>
          <td>Sales Comment</td>
          <td><?echo $row[0]["sales_comment"];?></td>
        </tr>
        <tr>
          <td>Service Comment</td>
          <td><?echo $row[0]["service_comment"];?></td>
        </tr>
        <tr>
          <td>Software Comment</td>
          <td><?echo $row[0]["software_comment"];?></td>
        </tr>
        <tr>
          <td>Req Forwarded to</td>
          <td><?echo $row[0]["forward_req_user"];?></td>
        </tr>
        <tr>
          <td>Forward Comment</td>
          <td><?echo $row[0]["forward_comment"];?></td>
        </tr>
        <tr>
          <td>F/W Request Back Comment</td>
          <td><?echo $row[0]["forward_back_comment"];?></td>
        </tr>
        <tr>
          <td>Approval Date</td>
          <td><?
			if($row[0]["approve_status"]==1 && $row[0]["approve_date"]!='')
			{
			echo date("d-M-Y h:i:s A",strtotime($row[0]["approve_date"]));
			}
			else
			{
				echo "";
			}
			
			?></td>
        </tr>
        <tr>
          <td>Closed By</td>
          <td><?echo $row[0]["req_close_by"];?></td>
        </tr>
        <tr>
          <td>Closed Date</td>
          <td><?
			if($row[0]["final_status"]==1 && $row[0]["close_date"]!='')
			{
			echo date("d-M-Y h:i:s A",strtotime($row[0]["close_date"]));
			}
			else
			{
				echo "";
			}
			
			?></td>
        </tr>
        <?php if($total_query15>0){?>
        <tr>
          <td colspan="2">-------------------------------------------</td>
        </tr>
        <tr>
          <td colspan="2"><table cellspacing="2" cellpadding="2">
              <tbody>
                <tr>
                  <td align="left">Req Forwarded to</td>
                  <td>Forward Comment</td>
                  <td>F/W Request Back Comment</td>
                </tr>
                <?php for($at=0;$at<count($forward_query15);$at++){?>
                <tr>
                  <td><?php echo $forward_query15[$at]["forward_req_user"];?></td>
                  <td><?php echo $forward_query15[$at]["forward_comment"];?></td>
                  <td><?php echo $forward_query15[$at]["forward_back_comment"];?></td>
                </tr>
                <?php } ?>
              </tbody>
            </table></td>
        </tr>
        <?php } ?>
      </tbody>
    </table>
  </div>
</div>
<? }
	else If($tablename=="dimts_imei")
	{
		$query = "SELECT * FROM ".$tablename." where id=".$RowId; 
		$row=select_query($query);
		$forward_query8 = select_query("SELECT * FROM forward_req_history where table_name='$tablename' and table_row_id=".$RowId);
		$total_query8 = count($forward_query8); 
  
	?>
<div id="databox">
  <div class="heading">View Dimts IMEI Details</div>
  <div class="dataleft">
    <table cellspacing="2" cellpadding="2">
      <tbody>
        <tr>
          <td>Date </td>
          <td><?echo date("d-M-Y h:i:s A",strtotime($row[0]["date"]));?></td>
        </tr>
        <tr>
          <td>Request By</td>
          <td><?echo $row[0]["acc_manager"];?></td>
        </tr>
        <tr>
          <td>Sales Manager </td>
          <td><?echo $row[0]["sales_manager"];?></td>
        </tr>
        <? $sql="SELECT Userid AS id,UserName AS sys_username FROM internalsoftware.addclient  WHERE Userid=".$row[0]["user_id"];
		$rowuser=select_query($sql);
		?>
        <tr>
          <td>User Name </td>
          <td><?echo $rowuser[0]["sys_username"];?></td>
        </tr>
        <tr>
          <td>Company Name </td>
          <td><?echo $row[0]["client"];?></td>
        </tr>
        <tr>
          <td>Vehicle No</td>
          <td><?echo $row[0]["veh_reg"];?></td>
        </tr>
        <tr>
          <td>7 digit IMEI </td>
          <td><?echo $row[0]["device_imei_7"];?></td>
        </tr>
        <tr>
          <td>15 digit IMEI</td>
          <td><?echo $row[0]["device_imei_15"];?></td>
        </tr>
        <tr>
          <td>Changed to Port</td>
          <td><?echo $row[0]["port_change"];?></td>
        </tr>
        <tr>
          <td>Account Comment</td>
          <td><?echo $row[0]["account_comment"];?></td>
        </tr>
        <tr>
          <td>Payment Pending</td>
          <td><?echo $row[0]["payment_status"];?></td>
        </tr>
        <tr>
          <td>Service Comment</td>
          <td><?echo $row[0]["service_comment"];?></td>
        </tr>
        <tr>
          <td>Support Comment</td>
          <td><?echo $row[0]["support_comment"];?></td>
        </tr>
      </tbody>
    </table>
  </div>
  <div class="dataright">
    <table cellspacing="2" cellpadding="2">
      <tbody>
        <!-- <tr><td>Admin Approval</td>  <td><?if($row[0]["approve_status"]==1) echo "Approved"; else echo "Pending Approval"?></td></tr>-->
        <tr>
          <td><strong>Process Pending </strong></td>
          <td><strong>
            <?  if($row[0]["dimts_status"]==2 || (($row[0]["imei_upload_reason"]!="" || $row[0]["admin_comment"]!="") && $row[0]["support_comment"]=="" && $row[0]["service_comment"]==""))
	{echo "Reply Pending at Request Side";}
	elseif($row[0]["account_comment"]=="" && $row[0]["payment_status"]=="" && $row[0]["approve_status"]==0 && $row[0]["final_status"]==0){echo "Pending at Accounts";} 
	elseif($row[0]["approve_status"]==0 && $row[0]["forward_req_user"]!="" && $row[0]["forward_back_comment"]=="" && $row[0]["dimts_status"]==1)	
	{echo "Pending Admin Approval (Req Forward to ".$row[0]["forward_req_user"].")";}
	elseif($row[0]["approve_status"]==0 && $row[0]["payment_status"]!="" && $row[0]["final_status"]==0 && $row[0]["dimts_status"]==1)
	{echo "Pending Admin Approval";}
	elseif(($row[0]["approve_status"]==1 || $row[0]["account_comment"]!="") && $row[0]["dimts_status"]==1 && $row[0]["support_comment"]=="" && $row[0]["final_status"]!=1){echo "Pending at Tech Support for IMEI Uplode";}
	elseif(($row[0]["approve_status"]==1 || $row[0]["account_comment"]!="") && $row[0]["dimts_status"]==1 && $row[0]["repair_comment"]=="" && $row[0]["final_status"]!=1){echo "Pending at Repair For Port Change";}
	elseif($row[0]["support_comment"]!="" && $row[0]["repair_comment"]!="" && $row[0]["final_status"]!=1){echo "Process Not Closed Request End";}
	elseif($row[0]["final_status"]==1){echo "Process Done";}?>
            </strong></td>
        </tr>
        <tr>
          <td>Admin Comment</td>
          <td><?echo $row[0]["admin_comment"];?></td>
        </tr>
        <tr>
          <td>Reason for Imei not uploading</td>
          <td><?echo $row[0]["imei_upload_reason"];?></td>
        </tr>
        <tr>
          <td>Repair Comment</td>
          <td><?echo $row[0]["repair_comment"];?></td>
        </tr>
        <tr>
          <td>Reason for Port not changing</td>
          <td><?echo $row[0]["port_change_reason"];?></td>
        </tr>
        <tr>
          <td>Req Forwarded to</td>
          <td><?echo $row[0]["forward_req_user"];?></td>
        </tr>
        <tr>
          <td>Forward Comment</td>
          <td><?echo $row[0]["forward_comment"];?></td>
        </tr>
        <tr>
          <td>F/W Request Back Comment</td>
          <td><?echo $row[0]["forward_back_comment"];?></td>
        </tr>
        <tr>
          <td>Approval Date</td>
          <td><?
			if($row[0]["approve_status"]==1 && $row[0]["approve_date"]!='')
			{
			echo date("d-M-Y h:i:s A",strtotime($row[0]["approve_date"]));
			}
			else
			{
				echo "";
			}
			
			?></td>
        </tr>
        <tr>
          <td>Closed Date</td>
          <td><?
			if($row[0]["final_status"]==1 && $row[0]["close_date"]!='')
			{
			echo date("d-M-Y h:i:s A",strtotime($row[0]["close_date"]));
			}
			else
			{
				echo "";
			}
			
			?></td>
        </tr>
        <?php if($total_query8>0){?>
        <tr>
          <td colspan="2">-------------------------------------------</td>
        </tr>
        <tr>
          <td colspan="2"><table cellspacing="2" cellpadding="2">
              <tbody>
                <tr>
                  <td align="left">Req Forwarded to</td>
                  <td>Forward Comment</td>
                  <td>F/W Request Back Comment</td>
                </tr>
                <?php for($at=0;$at<count($forward_query8);$at++){?>
                <tr>
                  <td><?php echo $forward_query8[$at]["forward_req_user"];?></td>
                  <td><?php echo $forward_query8[$at]["forward_comment"];?></td>
                  <td><?php echo $forward_query8[$at]["forward_back_comment"];?></td>
                </tr>
                <?php } ?>
              </tbody>
            </table></td>
        </tr>
        <?php } ?>
      </tbody>
    </table>
  </div>
</div>
<? }
	else If($tablename=="renew_dimts_imei")
		{
		 	$query = "SELECT * FROM ".$tablename." where id=".$RowId; 
			$row=select_query($query);
			$forward_query20 = select_query("SELECT * FROM forward_req_history where table_name='$tablename' and table_row_id=".$RowId);
			$total_query20 = count($forward_query20);
  
	?>
<div id="databox">
  <div class="heading">View Renew Dimts IMEI Details</div>
  <div class="dataleft">
    <table cellspacing="2" cellpadding="2">
      <tbody>
        <tr>
          <td>Date </td>
          <td><?echo date("d-M-Y h:i:s A",strtotime($row[0]["date"]));?></td>
        </tr>
        <tr>
          <td>Request By</td>
          <td><?echo $row[0]["acc_manager"];?></td>
        </tr>
        <tr>
          <td>Sales Manager </td>
          <td><?echo $row[0]["sales_manager"];?></td>
        </tr>
        <? $sql="SELECT Userid AS id,UserName AS sys_username FROM internalsoftware.addclient  WHERE Userid=".$row[0]["user_id"];
			$rowuser=select_query($sql);
			?>
        <tr>
          <td>User Name </td>
          <td><?echo $rowuser[0]["sys_username"];?></td>
        </tr>
        <tr>
          <td>Company Name </td>
          <td><?echo $row[0]["client"];?></td>
        </tr>
        <tr>
          <td>Vehicle No</td>
          <td><?echo $row[0]["veh_reg"];?></td>
        </tr>
        <tr>
          <td>7 digit IMEI </td>
          <td><?echo $row[0]["device_imei_7"];?></td>
        </tr>
        <tr>
          <td>15 digit IMEI</td>
          <td><?echo $row[0]["device_imei_15"];?></td>
        </tr>
        <tr>
          <td>Changed to Port</td>
          <td><?echo $row[0]["port_change"];?></td>
        </tr>
        <tr>
          <td>Account Comment</td>
          <td><?echo $row[0]["account_comment"];?></td>
        </tr>
        <tr>
          <td>Payment Pending</td>
          <td><?echo $row[0]["payment_status"];?></td>
        </tr>
        <tr>
          <td>Service Comment</td>
          <td><?echo $row[0]["service_comment"];?></td>
        </tr>
        <!--<tr><td>Support Comment</td><td><?echo $row[0]["support_comment"];?></td></tr>-->
      </tbody>
    </table>
  </div>
  <div class="dataright">
    <table cellspacing="2" cellpadding="2">
      <tbody>
        <!--<tr><td>Admin Approval</td>  <td><?if($row[0]["approve_status"]==1) echo "Approved"; else echo "Pending Approval"?></td></tr>-->
        <tr>
          <td><strong>Process Pending </strong></td>
          <td><strong>
            <?  if($row[0]["renew_dimts_status"]==2 || ( $row[0]["admin_comment"]!="" && $row[0]["service_comment"]=="")){echo "Reply Pending at Request Side";}
	elseif($row[0]["account_comment"]=="" && $row[0]["payment_status"]=="" && $row[0]["approve_status"]==0 && $row[0]["final_status"]==0){echo "Pending at Accounts";} 
	elseif($row[0]["approve_status"]==0 && $row[0]["forward_req_user"]!="" && $row[0]["forward_back_comment"]=="" && $row[0]["renew_dimts_status"]==1)	
	{echo "Pending Admin Approval (Req Forward to ".$row[0]["forward_req_user"].")";}
	elseif($row[0]["approve_status"]==0 && $row[0]["payment_status"]!="" && $row[0]["final_status"]==0 && $row[0]["renew_dimts_status"]==1)
	{echo "Pending Admin Approval";}
	elseif(($row[0]["approve_status"]==1 || $row[0]["account_comment"]!="") && $row[0]["renew_dimts_status"]==1 && $row[0]["repair_comment"]=="" && $row[0]["port_change_status"]=="Yes" && $row[0]["final_status"]!=1)
	{echo "Pending at Repair For Port Change";}
	elseif(($row[0]["repair_comment"]!="" || ($row[0]["port_change_status"]!="Yes" && ($row[0]["approve_status"]==1 || $row[0]["account_comment"]!="")))&& $row[0]["final_status"]!=1){echo "Process Not Closed Request End";}
	elseif($row[0]["final_status"]==1){echo "Process Done";}?>
            </strong></td>
        </tr>
        <tr>
          <td>Admin Comment</td>
          <td><?echo $row[0]["admin_comment"];?></td>
        </tr>
        <!--<tr><td>Reason for Imei not uploading</td><td><?echo $row[0]["imei_upload_reason"];?></td></tr>-->
        <tr>
          <td>Repair Comment</td>
          <td><?echo $row[0]["repair_comment"];?></td>
        </tr>
        <tr>
          <td>Reason for Port not changing</td>
          <td><?echo $row[0]["port_change_reason"];?></td>
        </tr>
        <tr>
          <td>Req Forwarded to</td>
          <td><?echo $row[0]["forward_req_user"];?></td>
        </tr>
        <tr>
          <td>Forward Comment</td>
          <td><?echo $row[0]["forward_comment"];?></td>
        </tr>
        <tr>
          <td>F/W Request Back Comment</td>
          <td><?echo $row[0]["forward_back_comment"];?></td>
        </tr>
        <tr>
          <td>Approval Date</td>
          <td><?
			if($row[0]["approve_status"]==1 && $row[0]["approve_date"]!='')
			{
			echo date("d-M-Y h:i:s A",strtotime($row[0]["approve_date"]));
			}
			else
			{
				echo "";
			}
			
			?></td>
        </tr>
        <tr>
          <td>Closed Date</td>
          <td><?
			if($row[0]["final_status"]==1 && $row[0]["close_date"]!='')
			{
			echo date("d-M-Y h:i:s A",strtotime($row[0]["close_date"]));
			}
			else
			{
				echo "";
			}
			
			?></td>
        </tr>
        <?php if($total_query20>0){?>
        <tr>
          <td colspan="2">-------------------------------------------</td>
        </tr>
        <tr>
          <td colspan="2"><table cellspacing="2" cellpadding="2">
              <tbody>
                <tr>
                  <td align="left">Req Forwarded to</td>
                  <td>Forward Comment</td>
                  <td>F/W Request Back Comment</td>
                </tr>
                <?php for($at=0;$at<count($forward_query20);$at++){?>
                <tr>
                  <td><?php echo $forward_query20[$at]["forward_req_user"];?></td>
                  <td><?php echo $forward_query20[$at]["forward_comment"];?></td>
                  <td><?php echo $forward_query20[$at]["forward_back_comment"];?></td>
                </tr>
                <?php } ?>
              </tbody>
            </table></td>
        </tr>
        <?php } ?>
      </tbody>
    </table>
  </div>
</div>
<? }
      
 
    else If($tablename=="discount_details")
		{
		    $query = "SELECT * FROM ".$tablename." where id=".$RowId; 
			$row=select_query($query);
			$forward_query14 = select_query("SELECT * FROM forward_req_history where table_name='$tablename' and table_row_id=".$RowId);
			$total_query14 = count($forward_query14);

	?>
<div id="databox">
  <div class="heading">Discount</div>
  <div class="dataleft">
    <table cellspacing="2" cellpadding="2">
      <tbody>
        <tr>
          <td>Date </td>
          <td><?echo date("d-M-Y h:i:s A",strtotime($row[0]["date"]));?></td>
        </tr>
        <? /*if($row[0]["acc_manager"]=='saleslogin') {
		$account_manager=$row[0]["sales_manager"]; 
		}
		else {
		$account_manager=$row[0]["acc_manager"]; 
		}*/
		
		?>
        <tr>
          <td>Request By</td>
          <td><?echo $row[0]["acc_manager"];?></td>
        </tr>
        <tr>
          <td>Account Manager</td>
          <td><?echo $row[0]["sales_manager"];?></td>
        </tr>
        <? $sql="SELECT Userid AS id,UserName AS sys_username FROM internalsoftware.addclient  WHERE Userid=".$row[0]["user"];
		$rowuser=select_query($sql);
		?>
        <tr>
          <td>Client User Name </td>
          <td><?echo $rowuser[0]["sys_username"];?></td>
        </tr>
        <tr>
          <td>Company Name </td>
          <td><?echo $row[0]["client"];?></td>
        </tr>
        <!--<tr><td>Vehicle	for discount</td><td><?echo $row[0]["reg_no"];?></td></tr>-->
        <tr>
          <td>Vehicle	for discount </td>
          <td><?php $vechile_no = explode(",",$row[0]["reg_no"]); 
for($i=0;$i<=count($vechile_no);$i++){ if($i%3!=0){ echo $vechile_no[$i].", ";}else { echo "<br/>".$vechile_no[$i].", ";} }?></td>
        </tr>
        <tr>
          <td>Discount For</td>
          <td><?echo $row[0]["rent_device"];?></td>
        </tr>
        <tr>
          <td>Month</td>
          <td><?echo $row[0]["mon_of_dis_in_case_of_rent"];?></td>
        </tr>
        <tr>
          <td>Before Discount </td>
          <td><?echo $row[0]["amt_before_dis"];?></td>
        </tr>
        <tr>
          <td>Discount Amount </td>
          <td><?echo $row[0]["dis_amt"];?></td>
        </tr>
        <tr>
          <td>After Discount </td>
          <td><?echo $row[0]["amt_rec_after_dis"];?></td>
        </tr>
        <tr>
          <td>Reason </td>
          <td><?echo $row[0]["reason"];?></td>
        </tr>
        <tr>
          <td>Issue for Discountng</td>
          <td><?echo $row[0]["discount_issue"];?></td>
        </tr>
      </tbody>
    </table>
  </div>
  <div class="dataright">
    <table cellspacing="2" cellpadding="2">
      <tbody>
        
        <!--<tr><td>Admin Approval</td>  <td><?if($row[0]["approve_status"]==1) echo "Approved"; else echo "Pending Approval"?></td></tr>-->
        <tr>
          <td><strong>Process Pending </strong></td>
          <td><strong>
            <?  if($row[0]["discount_status"]==2 || (($row[0]["support_comment"]!="" || $row[0]["admin_comment"]!="") && $row[0]["sales_comment"]==""))
	{echo "Reply Pending at Request Side";}
	elseif($row[0]["discount_issue"]=="Software Issue" && $row[0]["approve_status"]==0 && $row[0]["software_comment"]=="" && $row[0]["forward_req_user"]!="" && $row[0]["forward_back_comment"]=="" && $row[0]["discount_status"]==1){echo "Pending at Tech Support Login (Req Forward to ".$row[0]["forward_req_user"].")";}
	elseif($row[0]["discount_issue"]=="Software Issue" && $row[0]["discount_status"]==1 && $row[0]["approve_status"]!=1 && $row[0]["software_comment"]=="")
	{echo "Pending at Tech Support Login";}
	elseif($row[0]["discount_issue"]=="Repair Cost Issue" && $row[0]["discount_status"]==1 && $row[0]["approve_status"]!=1 && $row[0]["repair_comment"]=="")
	{echo "Pending at Repair Login";}
	elseif($row[0]["discount_issue"]=="Service Issue" && $row[0]["discount_status"]==1 && $row[0]["approve_status"]!=1 && $row[0]["service_comment"]=="")
	{echo "Pending at Service Support Login";}	
	elseif($row[0]["discount_status"]==1 && $row[0]["account_comment"]=="" && $row[0]["total_pending"]=="" && $row[0]["approve_status"]!=1){echo "Pending at Account Login";}	
	elseif($row[0]["approve_status"]==0 && $row[0]["forward_req_user"]!="" && $row[0]["forward_back_comment"]=="" && $row[0]["discount_status"]==1)	
	{echo "Pending Admin Approval (Req Forward to ".$row[0]["forward_req_user"].")";}
	elseif($row[0]["approve_status"]==0 && ($row[0]["account_comment"]!="" || $row[0]["total_pending"]!="") && $row[0]["final_status"]==0 && $row[0]["discount_status"]==1)
	{echo "Pending Admin Approval";}		
	elseif($row[0]["approve_status"]==1 && $row[0]["final_status"]==0){echo "Pending at Account For Discounting";} 
	elseif($row[0]["final_status"]==1){echo "Process Done";}?>
            </strong></td>
        </tr>
        <tr>
          <td>Account Comment</td>
          <td><?echo $row[0]["account_comment"];?></td>
        </tr>
        <tr>
          <td>Payment Pending</td>
          <td><?echo $row[0]["total_pending"];?></td>
        </tr>
        <tr>
          <td>Sales Comment</td>
          <td><?echo $row[0]["sales_comment"];?></td>
        </tr>
        <tr>
          <td>Service Comment</td>
          <td><?echo $row[0]["service_comment"];?></td>
        </tr>
        <tr>
          <td>Repair Comment</td>
          <td><?echo $row[0]["repair_comment"];?></td>
        </tr>
        <tr>
          <td>Software Comment</td>
          <td><?echo $row[0]["software_comment"];?></td>
        </tr>
        <tr>
          <td>Support Comment</td>
          <td><?echo $row[0]["support_comment"];?></td>
        </tr>
        <tr>
          <td>Admin Comment</td>
          <td><?echo $row[0]["admin_comment"];?></td>
        </tr>
        <tr>
          <td>Req Forwarded to</td>
          <td><?echo $row[0]["forward_req_user"];?></td>
        </tr>
        <tr>
          <td>Forward Comment</td>
          <td><?echo $row[0]["forward_comment"];?></td>
        </tr>
        <tr>
          <td>F/W Request Back Comment</td>
          <td><?echo $row[0]["forward_back_comment"];?></td>
        </tr>
        <tr>
          <td>Approval Date</td>
          <td><?
			if($row[0]["approve_status"]==1 && $row[0]["approve_date"]!='')
			{
			echo date("d-M-Y h:i:s A",strtotime($row[0]["approve_date"]));
			}
			else
			{
				echo "";
			}
			
			?></td>
        </tr>
        <tr>
          <td>Closed Date</td>
          <td><?
			if($row[0]["final_status"]==1 && $row[0]["close_date"]!='')
			{
			echo date("d-M-Y h:i:s A",strtotime($row[0]["close_date"]));
			}
			else
			{
				echo "";
			}
			
			?></td>
        </tr>
        <?php if($total_query14>0){?>
        <tr>
          <td colspan="2">-------------------------------------------</td>
        </tr>
        <tr>
          <td colspan="2"><table cellspacing="2" cellpadding="2">
              <tbody>
                <tr>
                  <td align="left">Req Forwarded to</td>
                  <td>Forward Comment</td>
                  <td>F/W Request Back Comment</td>
                </tr>
                <?php for($at=0;$at<count($forward_query14);$at++){?>
                <tr>
                  <td><?php echo $forward_query14[$at]["forward_req_user"];?></td>
                  <td><?php echo $forward_query14[$at]["forward_comment"];?></td>
                  <td><?php echo $forward_query14[$at]["forward_back_comment"];?></td>
                </tr>
                <?php } ?>
              </tbody>
            </table></td>
        </tr>
        <?php } ?>
      </tbody>
    </table>
  </div>
</div>
<? }
	elseIf($tablename=="sub_user_creation")
		{
			$query = "SELECT * FROM ".$tablename." where id=".$RowId; 
			$row=select_query($query);
			$forward_query11 = select_query("SELECT * FROM forward_req_history where table_name='$tablename' and table_row_id=".$RowId);
			$total_query11 = count($forward_query11);

	?>
<div id="databox">
  <div class="heading">Sub User Creation</div>
  <div class="dataleft">
    <table cellspacing="2" cellpadding="2">
      <tbody>
        <tr>
          <td>Date </td>
          <td><?echo date("d-M-Y h:i:s A",strtotime($row[0]["date"]));?></td>
        </tr>
        <? /*if($row[0]["acc_manager"]=='saleslogin') {
			$account_manager=$row[0]["sales_manager"]; 
			}
			else {
			$account_manager=$row[0]["acc_manager"]; 
			}*/
			
			?>
        <tr>
          <td>Request By</td>
          <td><?echo $row[0]["acc_manager"];?></td>
        </tr>
        <tr>
          <td>Account Manager</td>
          <td><?echo $row[0]["sales_manager"];?></td>
        </tr>
        <? $sql="SELECT Userid AS id,UserName AS sys_username FROM internalsoftware.addclient  WHERE Userid=".$row[0]["main_user_id"];
		$rowuser=select_query($sql);
		?>
        <tr>
          <td>Client User Name </td>
          <td><?echo $rowuser[0]["sys_username"];?></td>
        </tr>
        <tr>
          <td>Company Name </td>
          <td><?echo $row[0]["company"];?></td>
        </tr>
        <tr>
          <td>Total No Of Vehicle </td>
          <td><?echo $row[0]["tot_no_of_vehicles"];?></td>
        </tr>
        <tr>
          <td>Vehicle to move </td>
          <td><?echo $row[0]["reg_no_of_vehicle_to_move"];?></td>
        </tr>
        <tr>
          <td>Contact Person </td>
          <td><?echo $row[0]["contact_person"];?></td>
        </tr>
        <tr>
          <td>Contact Number </td>
          <td><?echo $row[0]["contact_number"];?></td>
        </tr>
        <tr>
          <td>Sub-User Name </td>
          <td><?echo $row[0]["name"];?></td>
        </tr>
        <tr>
          <td>Password</td>
          <td><?echo $row[0]["req_sub_user_pass"];?></td>
        </tr>
        <tr>
          <td>Main User Separate</td>
          <td><?echo $row[0]["billing_separate"];?></td>
        </tr>
        <tr>
          <td>Billing Name</td>
          <td><?echo $row[0]["billing_name"];?></td>
        </tr>
        <tr>
          <td>Billing Address</td>
          <td><?echo $row[0]["billing_address"];?></td>
        </tr>
      </tbody>
    </table>
  </div>
  <div class="dataright">
    <table cellspacing="2" cellpadding="2">
      <tbody>
        <tr>
          <td>Reason</td>
          <td><?echo $row[0]["reason"];?></td>
        </tr>
        <!--<tr><td>Admin Approval</td>  <td><?if($row[0]["approve_status"]==1) echo "Approved"; else echo "Pending Approval"?></td></tr>-->
        <tr>
          <td><strong>Process Pending </strong></td>
          <td><strong>
            <?  if($row[0]["sub_user_status"]==2 || (($row[0]["support_comment"]!="" || $row[0]["admin_comment"]!="") && $row[0]["sales_comment"]==""))
	{echo "Reply Pending at Request Side";}
	elseif($row[0]["approve_status"]==0 && $row[0]["forward_req_user"]!="" && $row[0]["forward_back_comment"]=="" && $row[0]["sub_user_status"]==1)	
	{echo "Pending Admin Approval (Req Forward to ".$row[0]["forward_req_user"].")";}
	elseif($row[0]["approve_status"]==0 && $row[0]["final_status"]==0 && $row[0]["sub_user_status"]==1){echo "Pending Admin Approval";}
	elseif($row[0]["approve_status"]==1 && $row[0]["sub_user_status"]==1 && $row[0]["final_status"]!=1){echo "Pending at Tech Support Team";}
	elseif($row[0]["final_status"]==1){echo "Process Done";}?>
            </strong></td>
        </tr>
        <tr>
          <td>Account Comment</td>
          <td><?echo $row[0]["account_comment"];?></td>
        </tr>
        <tr>
          <td>Sales Comment</td>
          <td><?echo $row[0]["sales_comment"];?></td>
        </tr>
        <tr>
          <td>Support Comment</td>
          <td><?echo $row[0]["support_comment"];?></td>
        </tr>
        <tr>
          <td>Admin Comment</td>
          <td><?echo $row[0]["admin_comment"];?></td>
        </tr>
        <tr>
          <td>Req Forwarded to</td>
          <td><?echo $row[0]["forward_req_user"];?></td>
        </tr>
        <tr>
          <td>Forward Comment</td>
          <td><?echo $row[0]["forward_comment"];?></td>
        </tr>
        <tr>
          <td>F/W Request Back Comment</td>
          <td><?echo $row[0]["forward_back_comment"];?></td>
        </tr>
        <tr>
          <td>Approval Date</td>
          <td><?
			if($row[0]["approve_status"]==1 && $row[0]["approve_date"]!='')
			{
			echo date("d-M-Y h:i:s A",strtotime($row[0]["approve_date"]));
			}
			else
			{
				echo "";
			}
			
			?></td>
        </tr>
        <tr>
          <td>Closed By</td>
          <td><?echo $row[0]["req_close_by"];?></td>
        </tr>
        <tr>
          <td>Closed Date</td>
          <td><?
			if($row[0]["final_status"]==1 && $row[0]["close_date"]!='')
			{
			echo date("d-M-Y h:i:s A",strtotime($row[0]["close_date"]));
			}
			else
			{
				echo "";
			}
			
			?></td>
        </tr>
        <?php if($total_query11>0){?>
        <tr>
          <td colspan="2">-------------------------------------------</td>
        </tr>
        <tr>
          <td colspan="2"><table cellspacing="2" cellpadding="2">
              <tbody>
                <tr>
                  <td align="left">Req Forwarded to</td>
                  <td>Forward Comment</td>
                  <td>F/W Request Back Comment</td>
                </tr>
                <?php for($at=0;$at<count($forward_query11);$at++){?>
                <tr>
                  <td><?php echo $forward_query11[$at]["forward_req_user"];?></td>
                  <td><?php echo $forward_query11[$at]["forward_comment"];?></td>
                  <td><?php echo $forward_query11[$at]["forward_back_comment"];?></td>
                </tr>
                <?php } ?>
              </tbody>
            </table></td>
        </tr>
        <?php } ?>
      </tbody>
    </table>
  </div>
</div>
<? }

elseIf($tablename=="installation")
		{
	
			$query = "select * from  internalsoftware.installation_request left join internalsoftware.re_city_spr_1 on 
			installation_request.Zone_area =re_city_spr_1.id where installation_request.id=".$RowId;
			$row=select_query($query);
			$toolk=explode('#',$row[0]['accessories_tollkit']);
  			 $tools=array();
  			 $accessory_data=array();
	?>
<div id="databox">
  <div class="heading">Installation</div>
  <div class="dataleft">
    <table cellspacing="2" cellpadding="2">
      <tbody>
        <tr>
          <td> Date: </td>
          <td><?echo $row[0]["req_date"];?></td>
        </tr>
        <tr>
          <td>Request By: </td>
          <td><?echo $row[0]["request_by"];?></td>
        </tr>
        <?  
		$sales=select_query("select name from internalsoftware.sales_person where id='".$row[0]['sales_person']."' ");
		?>
        <tr>
          <td>Sales Person </td>
          <td><?echo $sales[0]['name'];?></td>
        </tr>
        <? $sql="SELECT Userid AS id,UserName AS sys_username FROM internalsoftware.addclient  WHERE Userid=".$row[0]["user_id"];
			$rowuser=select_query($sql);
			?>
        <tr>
          <td>Client User Name </td>
          <td><?echo $rowuser[0]["sys_username"];?></td>
        </tr>
        <tr>
          <td>Company Name </td>
          <td><?echo $row[0]["company_name"];?></td>
        </tr>
        <tr>
          <td>No. Of Vehicles: </td>
          <td><?echo $row[0]["no_of_vehicals"];?></td>
        </tr>
        <tr>
          <td>Approve Installation: </td>
          <td><?echo $row[0]["installation_approve"];?></td>
        </tr>
        <tr>
          <td>Area: </td>
          <td><?echo $row[0]["name"];?></td>
        </tr>
        <?php if($row[0]['location']!=""){?>
        <tr>
          <td>Location: </td>
          <td><?echo $row[0]["location"];?></td>
        </tr>
        <?php }else{ $city= select_query("select * from internalsoftware.tbl_city_name where branch_id='".$row[0]['inter_branch']."'");?>
        <tr>
          <td>Location: </td>
          <td><?echo $city[0]["city"];?></td>
        </tr>
        <?php }?>
       <!--  <tr>
          <td>Model:</td>
          <td><?echo $row[0]["model"];?></td>
        </tr> -->
        <tr>
        <?php $sqlDevice=select_query("SELECT device_type FROM device_type where id='".$row[0]["device_type"]."' ");   ?>
          <td>Device Type:</td>
          <td><?echo $sqlDevice[0]["device_type"];?></td>
        </tr>
        <tr>
        <?php $sqlModel=select_query("SELECT device_model FROM device_model where id='".$row[0]["model"]."' ");   ?>
          <td>Model:</td>
          <td><?echo $sqlModel[0]["device_model"];?></td>
        </tr>
        <tr>
          <td>Available Time Status: </td>
          <td><?echo $row[0]["atime_status"];?></td>
        </tr>
        <tr>
          <td>Time: </td>
          <td><?echo $row[0]["time"];?></td>
        </tr>
        <tr>
          <td>To Time: </td>
          <td><?echo $row[0]["totime"];?></td>
        </tr>
        <tr>
          <td>Contact No.:</td>
          <td><?echo $row[0]["contact_number"];?></td>
        </tr>
        <tr>
          <td>Contact Person: </td>
          <td><?echo $row[0]["contact_person"];?></td>
        </tr>
       <!--  <tr>
          <td>DIMTS: </td>
          <td><?echo $row[0]["dimts"];?></td>
        </tr>
        <tr>
          <td>Demo: </td>
          <td><?echo $row[0]["demo"];?></td>
        </tr> -->
        <tr>
          <td>Vehicle Type: </td>
          <td><?echo $row[0]["veh_type"];?></td>
        </tr>
       <!--  <tr>
          <td>Immobilizer: </td>
          <td><?echo $row[0]["immobilizer_type"];?></td>
        </tr> -->
   <!--      <tr>
          <td>Comment: </td>
          <td><?echo $row[0]["comment"];?></td>
        </tr> -->
 <!--        <tr>
          <td>Payment: </td>
          <td><?echo $row[0]["payment_req"];?></td>
          </tr> -->
            <?php  for($v=0;$v<count($toolk);$v++)
     		 {
		        //$tools[]=$toolk[$v]; 
		         $accessory_data=select_query("SELECT items AS `access_name` FROM toolkit_access where id='".$toolk[$v]."' ORDER BY `access_name` asc");
		         if($accessory_data!="")
		         {?>
	         	<tr>
	          	<td><?php echo $accessory_data[0]['access_name'];?> </td>
	         	 <td>Yes</td>
	        	<tr>
         	<?php }
         	}
   	// echo $accessories_tollkits; die;
   	 ?>
        <!-- <tr>
          <td>Fuel Sensor: </td>
          <td><?echo $row[0]["fuel_sensor"];?></td>
        <tr>
          <td>Bonnet Sensor: </td>
          <td><?echo $row[0]["bonnet_sensor"];?></td>
        <tr>
          <td>RFID Reader: </td>
          <td><?echo $row[0]["rfid_reader"];?></td>
        <tr>
          <td>Speed Alarm: </td>
          <td><?echo $row[0]["speed_alarm"];?></td>
        </tr> -->
       <!--  <tr>
          <td>Rent Status</td>
          <td><?echo $row[0]["rent_status"];?></td>
        </tr>
        <tr>
          <td>Rent Month</td>
          <td><?echo $row[0]["rent_month"];?></td>
        </tr>
        <tr>
          <td>Payment Plan</td>
          <td><? if($row[0]["rent_payment"] == 1){ echo 'Monthly';}
			  else if($row[0]["rent_payment"] == 3){ echo 'Quarterly';}
			  else if($row[0]["rent_payment"] == 6){ echo 'HalfYearly';}
			  else if($row[0]["rent_payment"] == 12){ echo 'Yearly';}?></td>
        </tr>
          </tr> -->
        
      </tbody>
    </table>
  </div>
  <div class="dataright">
    <table cellspacing="2" cellpadding="2">
      <tbody>
        <tr>
          <td>Job: </td>
          <td><?echo $row[0]["instal_reinstall"];?></td>
        </tr>
        <!-- <tr>
          <td>Payment Mode</td>
          <td><?echo $row[0]["mode_of_payment"];?></td>
        </tr>
        <tr>
          <td>Device Price</td>
          <td><?echo $row[0]["device_price"];?></td>
        </tr>
        <tr>
          <td>Vat(5%)</td>
          <td><?echo $row[0]["device_price_vat"];?></td>
        </tr>
        <tr>
          <td>Total Price</td>
          <td><?echo $row[0]["device_price_total"];?></td>
        </tr>
        <tr>
          <td>Rent Price</td>
          <td><?echo $row[0]["device_rent_Price"];?></td>
        </tr>
        <tr>
          <td>Service tax(15%)</td>
          <td><?echo $row[0]["device_rent_service_tax"];?></td>
        </tr>
        <tr>
          <td>Total Rent</td>
          <td><?echo $row[0]["DTotalREnt"];?></td>
        </tr>
        <tr>
          <td>Demo Period</td>
          <td><?echo $row[0]["demo_time"];?></td>
        </tr>
        <tr>
          <td>Amount: </td>
          <td><?echo $row[0]["amount"];?></td>
        <tr>
          <td>Payment Mode: </td>
          <td><?echo $row[0]["pay_mode"];?></td>
        <tr> -->
        <tr>
          <td>Required.:</td>
          <td><?echo $row[0]["required"];?></td>
        </tr>
        <!--  <tr>
          <td>IP Box.: </td>
          <td><?echo $row[0]["IP_Box"];?></td>
        </tr> 
        <tr>
          <td>Door lock/unlock circuit: </td>
          <td><?echo $row[0]["door_lock_unlock"];?></td>
        <tr>
          <td>Temperature Sensor: </td>
          <td><?echo $row[0]["temperature_sensor"];?></td>
        <tr>
          <td>Duty Box: </td>
          <td><?echo $row[0]["duty_box"];?></td>
        <tr>
          <td>Panic Button: </td>
          <td><?echo $row[0]["panic_button"];?></td>
        </tr> -->
        <tr>
          <td>Contact Person No.: </td>
          <td><?echo $row[0]["contact_person_no"];?></td>
        </tr>
        <tr>
          <td>Installation Made: </td>
          <td><?echo $row[0]["installation_made"];?></td>
        </tr>
        <tr>
          <td>Installer Name: </td>
          <td><?echo $row[0]["inst_name"];?></td>
        </tr>
        <tr>
          <td>Installer Current Location: </td>
          <td><?echo $row[0]["inst_cur_location"];?></td>
        </tr>
        <!--<tr><td>Change Installer Name: </td><td><?echo $row[0]["inst_cur_location"];?></td></tr>   
-->
        <tr>
          <td>Installation Done At: </td>
          <td><?echo $row[0]["rtime"];?></td>
        </tr>
        <tr>
          <td>Reason To Back Services:</td>
          <td><?echo $row[0]["back_reason"];?></td>
        </tr>
        <tr>
          <td>Sales Comment</td>
          <td><?echo $row[0]["sales_comment"];?></td>
        </tr>
        <tr>
          <td>Admin Comment</td>
          <td><?echo $row[0]["admin_comment"];?></td>
        </tr>
        <tr>
          <td><strong>Process Pending </strong></td>
          <td><strong>
            <?  if($row[0]["installation_status"]==7 && ($row[0]["admin_comment"]!="" || $row[0]["sales_comment"]=="")){echo "Reply Pending at Request Side";}
	elseif($row[0]["installation_status"]==7 && $row[0]["admin_comment"]=="" ){echo "Pending Saleslogin for Information";}
	elseif($row[0]["approve_status"]==0 && $row[0]["installation_status"]==8 ){echo "Pending Admin Approval";}
	elseif($row[0]["installation_status"]==9 && $row[0]["approve_status"]==1 ){echo "Pending Confirmation at Request Person";}
	elseif($row[0]["installation_status"]==1 ){echo "Pending Dispatch Team";}
	elseif($row[0]["installation_status"]==2 ){echo "Assign To Installer";}
	elseif($row[0]["installation_status"]==11 ){echo "Request Forward to Repair Team";}
	elseif($row[0]["installation_status"]==3 ){echo "Back Installation";}
	elseif($row[0]["installation_status"]==15 ){echo "Pending Remaining Installation";}
	elseif($row[0]["installation_status"]==5 || $row[0]["installation_status"]==6){echo "Installation Closed";}?>
            </strong></td>
        </tr>
        <tr>
          <td>Approval Date</td>
          <td><?
			if($row[0]["approve_status"]==1 && $row[0]["approve_date"]!='')
			{
			echo date("d-M-Y h:i:s A",strtotime($row[0]["approve_date"]));
			}
			else
			{
				echo "";
			}
			
			?></td>
        </tr>
      </tbody>
    </table>
  </div>
</div>

		
<?php }
	elseif($tablename=="deactivation_of_account")
	{
		$query = "SELECT * FROM ".$tablename." where id=".$RowId; 
		$row=select_query($query);
		
		$query1 = select_query("SELECT imei_of_removed_devices,other_imei_removed,client,device_location FROM stock_deactivation_of_account where deactivate_acc_id=".$RowId); 
		$forward_query12 = select_query("SELECT * FROM forward_req_history where table_name='$tablename' and table_row_id=".$RowId);
		$total_query12 = count($forward_query12);
  
	?>
<div id="databox">
  <div class="heading">Deactivation Of Account</div>
  <div class="dataleft">
    <table cellspacing="2" cellpadding="2">
      <tbody>
        <tr>
          <td>Date </td>
          <td><?echo date("d-M-Y h:i:s A",strtotime($row[0]["date"]));?></td>
        </tr>
        <? /*if($row[0]["acc_manager"]=='saleslogin') {
		$account_manager=$row[0]["sales_manager"]; 
		}
		else {
		$account_manager=$row[0]["acc_manager"]; 
		}*/
		
		?>
        <tr>
          <td>Request By</td>
          <td><?echo $row[0]["acc_manager"];?></td>
        </tr>
        <tr>
          <td>Account Manager</td>
          <td><?echo $row[0]["sales_manager"];?></td>
        </tr>
        <? $sql="SELECT Userid AS id,UserName AS sys_username FROM internalsoftware.addclient  WHERE Userid=".$row[0]["user_id"];
		$rowuser=select_query($sql);
		?>
        <tr>
          <td>Client User Name </td>
          <td><?echo $rowuser[0]["sys_username"];?></td>
        </tr>
        <tr>
          <td>Company Name </td>
          <td><?echo $row[0]["company"];?></td>
        </tr>
        <tr>
          <td>Total No Of Vehicle </td>
          <td><?echo $row[0]["total_no_of_vehicles"];?></td>
        </tr>
        <tr>
          <td>Deactivate </td>
          <td><?echo $row[0]["deactivate_temp"];?></td>
        </tr>
        <tr>
          <td>Device Removed Status</td>
          <td><?echo $row[0]["device_remove_status"];?></td>
        </tr>
        <tr>
          <td>No of Removed Device</td>
          <td><?echo $row[0]["no_of_removed_devices"];?></td>
        </tr>
        <tr>
          <td>Alert Date </td>
          <td><?echo $row[0]["alert_date"];?></td>
        </tr>
        <tr>
          <td>Delete From Debtors </td>
          <td><?echo $row[0]["delete_form_debtors"];?></td>
        </tr>
        <tr>
          <td>Reason</td>
          <td><?echo $row[0]["reason"];?></td>
        </tr>
        <tr>
          <td colspan="2">-------------------------------------------</td>
        </tr>
        <tr>
          <td colspan="2"><table cellspacing="2" cellpadding="2">
              <tbody>
                <tr>
                  <td align="left">IMEI No.</td>
                  <td>Client Name</td>
                  <td>Device Location</td>
                </tr>
                <?php for($st=0;$st<count($query1);$st++){?>
                <tr>
                  <?php if($query1[$st]["imei_of_removed_devices"]!=""){ ?>
                  <td><?php echo $query1[$st]["imei_of_removed_devices"];?></td>
                  <?php }else{ ?>
                  <td><?php echo $query1[$st]["other_imei_removed"];?></td>
                  <?php } ?>
                  <td><?php echo $query1[$st]["client"];?></td>
                  <td><?php echo $query1[$st]["device_location"];?></td>
                </tr>
                <?php } ?>
              </tbody>
            </table></td>
        </tr>
      </tbody>
    </table>
  </div>
  <div class="dataright">
    <table cellspacing="2" cellpadding="2">
      <tbody>
        
        <!--<tr><td>Admin Approval</td>  <td><?if($row[0]["approve_status"]==1) echo "Approved"; else echo "Pending Approval"?></td></tr>-->
        <tr>
          <td><strong>Process Pending </strong></td>
          <td><strong>
            <?  if($row[0]["deactivation_status"]==2 || (($row[0]["support_comment"]!="" || $row[0]["admin_comment"]!="") && $row[0]["sales_comment"]==""))
	{echo "Reply Pending at Request Side";}
	elseif($row[0]["device_remove_status"]=="Y" && $row[0]["no_device_removed"]=="" && $row[0]["approve_status"]==0 && $row[0]["final_status"]==0){echo "Pending at Stock";} 
	elseif($row[0]["account_comment"]=="" && $row[0]["pay_pending"]=="" && $row[0]["approve_status"]==0 && $row[0]["final_status"]==0){echo "Pending at Accounts";} 
	elseif($row[0]["approve_status"]==0 && $row[0]["forward_req_user"]!="" && $row[0]["forward_back_comment"]=="" && $row[0]["deactivation_status"]==1)	
	{echo "Pending Admin Approval (Req Forward to ".$row[0]["forward_req_user"].")";}
	elseif($row[0]["approve_status"]==0 && ($row[0]["account_comment"]!="" || $row[0]["pay_pending"]!="") && $row[0]["final_status"]==0 && $row[0]["deactivation_status"]==1)
	{echo "Pending Admin Approval";}
	elseif($row[0]["approve_status"]==1 && $row[0]["deactivation_status"]==1 && $row[0]["final_status"]!=1){echo "Pending at Tech Support Team";}
	elseif($row[0]["final_status"]==1){echo "Process Done";}?>
            </strong></td>
        </tr>
        <tr>
          <td>Payment Pending</td>
          <td><?echo $row[0]["pay_pending"];?></td>
        </tr>
        <tr>
          <td>Account Comment</td>
          <td><?echo $row[0]["account_comment"];?></td>
        </tr>
        <tr>
          <td>Stock Comment</td>
          <td><?echo $row[0]["stock_comment"];?></td>
        </tr>
        <tr>
          <td>Sales Comment</td>
          <td><?echo $row[0]["sales_comment"];?></td>
        </tr>
        <tr>
          <td>Support Comment</td>
          <td><?echo $row[0]["support_comment"];?></td>
        </tr>
        <tr>
          <td>Admin Comment</td>
          <td><?echo $row[0]["admin_comment"];?></td>
        </tr>
        <tr>
          <td>Req Forwarded to</td>
          <td><?echo $row[0]["forward_req_user"];?></td>
        </tr>
        <tr>
          <td>Forward Comment</td>
          <td><?echo $row[0]["forward_comment"];?></td>
        </tr>
        <tr>
          <td>F/W Request Back Comment</td>
          <td><?echo $row[0]["forward_back_comment"];?></td>
        </tr>
        <tr>
          <td>Approval Date</td>
          <td><?
			if($row[0]["approve_status"]==1 && $row[0]["approve_date"]!='')
			{
			echo date("d-M-Y h:i:s A",strtotime($row[0]["approve_date"]));
			}
			else
			{
				echo "";
			}
			
			?></td>
        </tr>
        <tr>
          <td>Closed By</td>
          <td><?echo $row[0]["req_close_by"];?></td>
        </tr>
        <tr>
          <td>Closed Date</td>
          <td><?
			if($row[0]["final_status"]==1 && $row[0]["close_date"]!='')
			{
			echo date("d-M-Y h:i:s A",strtotime($row[0]["close_date"]));
			}
			else
			{
				echo "";
			}
			
			?></td>
        </tr>
        <?php if($total_query12>0){?>
        <tr>
          <td colspan="2">-------------------------------------------</td>
        </tr>
        <tr>
          <td colspan="2"><table cellspacing="2" cellpadding="2">
              <tbody>
                <tr>
                  <td align="left">Req Forwarded to</td>
                  <td>Forward Comment</td>
                  <td>F/W Request Back Comment</td>
                </tr>
                <?php for($at=0;$at<count($forward_query12);$at++){?>
                <tr>
                  <td><?php echo $forward_query12[$at]["forward_req_user"];?></td>
                  <td><?php echo $forward_query12[$at]["forward_comment"];?></td>
                  <td><?php echo $forward_query12[$at]["forward_back_comment"];?></td>
                </tr>
                <?php } ?>
              </tbody>
            </table></td>
        </tr>
        <?php } ?>
      </tbody>
    </table>
  </div>
</div>
<? }
	else If($tablename=="reactivation_of_account")
		{
			$query = "SELECT * FROM ".$tablename." where id=".$RowId; 
			$row=select_query($query);
			$forward_query19 = select_query("SELECT * FROM forward_req_history where table_name='$tablename' and table_row_id=".$RowId);
			$total_query19 = count($forward_query19);
  
	?>
<div id="databox">
  <div class="heading">Reactivation Of Account</div>
  <div class="dataleft">
    <table cellspacing="2" cellpadding="2">
      <tbody>
        <tr>
          <td>Date </td>
          <td><?echo date("d-M-Y h:i:s A",strtotime($row[0]["date"]));?></td>
        </tr>
        <? /*if($row[0]["acc_manager"]=='saleslogin') {
		$account_manager=$row[0]["sales_manager"]; 
		}
		else {
		$account_manager=$row[0]["acc_manager"]; 
		}*/
		
		?>
        <tr>
          <td>Request By</td>
          <td><?echo $row[0]["acc_manager"];?></td>
        </tr>
        <tr>
          <td>Account Manager</td>
          <td><?echo $row[0]["sales_manager"];?></td>
        </tr>
        <? $sql="SELECT Userid AS id,UserName AS sys_username FROM internalsoftware.addclient  WHERE Userid=".$row[0]["user_id"];
		$rowuser=select_query($sql);
		?>
        <tr>
          <td>Client User Name </td>
          <td><?echo $rowuser[0]["sys_username"];?></td>
        </tr>
        <tr>
          <td>Company Name </td>
          <td><?echo $row[0]["company"];?></td>
        </tr>
        <tr>
          <td>Total No Of Vehicle </td>
          <td><?echo $row[0]["total_no_of_vehicles"];?></td>
        </tr>
        <tr>
          <td>Deactivate Account</td>
          <td><?echo $row[0]["deactivate_temp"];?></td>
        </tr>
        <tr>
          <td>Deactivate Reason</td>
          <td><?echo $row[0]["deact_reason"];?></td>
        </tr>
        <tr>
          <td>Deactivate Req Date</td>
          <td><?echo $row[0]["deact_req_date"];?></td>
        </tr>
        <tr>
          <td>Deactivate Close Date</td>
          <td><?echo $row[0]["deact_close_date"];?></td>
        </tr>
        <tr>
          <td>Reactivate Account Status</td>
          <td><?echo $row[0]["reactivate_account_status"];?></td>
        </tr>
        <tr>
          <td>Reactivate Reason</td>
          <td><?echo $row[0]["reason"];?></td>
        </tr>
      </tbody>
    </table>
  </div>
  <div class="dataright">
    <table cellspacing="2" cellpadding="2">
      <tbody>
        
        <!--<tr><td>Admin Approval</td>  <td><?if($row[0]["approve_status"]==1) echo "Approved"; else echo "Pending Approval"?></td></tr>-->
        <tr>
          <td><strong>Process Pending </strong></td>
          <td><strong>
            <?  if($row[0]["reactivation_status"]==2 || (($row[0]["support_comment"]!="" || $row[0]["admin_comment"]!="") && $row[0]["sales_comment"]==""))
	{echo "Reply Pending at Request Side";}
	elseif($row[0]["account_comment"]=="" && $row[0]["pay_pending"]=="" && $row[0]["approve_status"]==0 && $row[0]["final_status"]==0){echo "Pending at Accounts";} 
	elseif($row[0]["approve_status"]==0 && $row[0]["forward_req_user"]!="" && $row[0]["forward_back_comment"]=="" && $row[0]["reactivation_status"]==1)	
	{echo "Pending Admin Approval (Req Forward to ".$row[0]["forward_req_user"].")";}
	elseif($row[0]["approve_status"]==0 && ($row[0]["account_comment"]!="" || $row[0]["pay_pending"]!="") && $row[0]["final_status"]==0 && $row[0]["reactivation_status"]==1)
	{echo "Pending Admin Approval";}
	elseif($row[0]["approve_status"]==1 && $row[0]["reactivation_status"]==1 && $row[0]["final_status"]!=1){echo "Pending at Tech Support Team";}
	elseif($row[0]["final_status"]==1){echo "Process Done";}?>
            </strong></td>
        </tr>
        <tr>
          <td>Pending Amount</td>
          <td><?echo $row[0]["pay_pending"];?></td>
        </tr>
        <tr>
          <td>Account Comment</td>
          <td><?echo $row[0]["account_comment"];?></td>
        </tr>
        <tr>
          <td>Sales Comment</td>
          <td><?echo $row[0]["sales_comment"];?></td>
        </tr>
        <tr>
          <td>Support Comment</td>
          <td><?echo $row[0]["support_comment"];?></td>
        </tr>
        <tr>
          <td>Admin Comment</td>
          <td><?echo $row[0]["admin_comment"];?></td>
        </tr>
        <tr>
          <td>Req Forwarded to</td>
          <td><?echo $row[0]["forward_req_user"];?></td>
        </tr>
        <tr>
          <td>Forward Comment</td>
          <td><?echo $row[0]["forward_comment"];?></td>
        </tr>
        <tr>
          <td>F/W Request Back Comment</td>
          <td><?echo $row[0]["forward_back_comment"];?></td>
        </tr>
        <tr>
          <td>Approval Date</td>
          <td><?
			if($row[0]["approve_status"]==1 && $row[0]["approve_date"]!='')
			{
			echo date("d-M-Y h:i:s A",strtotime($row[0]["approve_date"]));
			}
			else
			{
				echo "";
			}
			
			?></td>
        </tr>
        <tr>
          <td>Closed By</td>
          <td><?echo $row[0]["req_close_by"];?></td>
        </tr>
        <tr>
          <td>Closed Date</td>
          <td><?
			if($row[0]["final_status"]==1 && $row[0]["close_date"]!='')
			{
			echo date("d-M-Y h:i:s A",strtotime($row[0]["close_date"]));
			}
			else
			{
				echo "";
			}
			
			?></td>
        </tr>
        <?php if($total_query19>0){?>
        <tr>
          <td colspan="2">-------------------------------------------</td>
        </tr>
        <tr>
          <td colspan="2"><table cellspacing="2" cellpadding="2">
              <tbody>
                <tr>
                  <td align="left">Req Forwarded to</td>
                  <td>Forward Comment</td>
                  <td>F/W Request Back Comment</td>
                </tr>
                <?php for($at=0;$at<count($forward_query19);$at++){?>
                <tr>
                  <td><?php echo $forward_query19[$at]["forward_req_user"];?></td>
                  <td><?php echo $forward_query19[$at]["forward_comment"];?></td>
                  <td><?php echo $forward_query19[$at]["forward_back_comment"];?></td>
                </tr>
                <?php } ?>
              </tbody>
            </table></td>
        </tr>
        <?php } ?>
      </tbody>
    </table>
  </div>
</div>
<? }
	else If($tablename=="del_form_debtors")
	{
		$query = "SELECT *,DATE_FORMAT(date, '%d %M %y %H:%i:%s') as date FROM ".$tablename." where id=".$RowId; 
		$row = select_query($query);
		$query1 = select_query("SELECT imei_of_removel_devices,other_imei_removed,client,device_location FROM stock_del_form_debtors where del_debtors_id=".$RowId);
		$forward_query13 = select_query("SELECT * FROM forward_req_history where table_name='$tablename' and table_row_id=".$RowId);
		$total_query13 = count($forward_query13);

	?>
<div id="databox">
  <div class="heading">Delete From Debtors</div>
  <div class="dataleft">
    <table cellspacing="2" cellpadding="2">
      <tbody>
        <tr>
          <td>Date </td>
          <td><?echo date("d-M-Y h:i:s A",strtotime($row[0]["date"]));?></td>
        </tr>
        <? /*if($row[0]["acc_manager"]=='saleslogin') {
		$account_manager=$row[0]["sales_manager"]; 
		}
		else {
		$account_manager=$row[0]["acc_manager"]; 
		}*/
		
		?>
        <tr>
          <td>Request By</td>
          <td><?echo $row[0]["acc_manager"];?></td>
        </tr>
        <tr>
          <td>Account Manager</td>
          <td><?echo $row[0]["sales_manager"];?></td>
        </tr>
        <? $sql="SELECT Userid AS id,UserName AS sys_username FROM internalsoftware.addclient  WHERE Userid=".$row[0]["user_id"];
		$rowuser=select_query($sql);
		?>
        <tr>
          <td>Client User Name </td>
          <td><?echo $rowuser[0]["sys_username"];?></td>
        </tr>
        <tr>
          <td>Company Name </td>
          <td><?echo $row[0]["company"];?></td>
        </tr>
        <tr>
          <td>Total No Of Vehicle </td>
          <td><?echo $row[0]["total_no_of_vehicle"];?></td>
        </tr>
        <tr>
          <td>Date Of Creation </td>
          <td><?echo $row[0]["date_of_creation"];?></td>
        </tr>
        <tr>
          <td>Device Removed Status</td>
          <td><?echo $row[0]["device_remove_status"];?></td>
        </tr>
        <tr>
          <td>No of Removed Device</td>
          <td><?echo $row[0]["no_of_devices_removed"];?></td>
        </tr>
        <tr>
          <td>Reason</td>
          <td><?echo $row[0]["reason"];?></td>
        </tr>
        <tr>
          <td colspan="2">-------------------------------------------</td>
        </tr>
        <tr>
          <td colspan="2"><table cellspacing="2" cellpadding="2">
              <tbody>
                <tr>
                  <td align="left">IMEI No.</td>
                  <td>Client Name</td>
                  <td>Device Location</td>
                </tr>
                <?php for($st=0;$st<count($query1);$st++){?>
                <tr>
                  <?php if($query1[$st]["imei_of_removel_devices"]!=""){ ?>
                  <td><?php echo $query1[$st]["imei_of_removel_devices"];?></td>
                  <?php }else{ ?>
                  <td><?php echo $query1[$st]["other_imei_removed"];?></td>
                  <?php } ?>
                  <td><?php echo $query1[$st]["client"];?></td>
                  <td><?php echo $query1[$st]["device_location"];?></td>
                </tr>
                <?php } ?>
              </tbody>
            </table></td>
        </tr>
      </tbody>
    </table>
  </div>
  <div class="dataright">
    <table cellspacing="2" cellpadding="2">
      <tbody>
        <!--<tr><td>Admin Approval</td>  <td><?if($row[0]["approve_status"]==1) echo "Approved"; else echo "Pending Approval"?></td></tr>-->
        <tr>
          <td><strong>Process Pending </strong></td>
          <td><strong>
            <?  if($row[0]["del_debtors_status"]==2 || (($row[0]["support_comment"]!="" || $row[0]["admin_comment"]!="") && $row[0]["sales_comment"]==""))
	{echo "Reply Pending at Request Side";}
	elseif($row[0]["device_remove_status"]=="Y" && $row[0]["no_device_removed"]=="" && $row[0]["approve_status"]==0 && $row[0]["final_status"]==0){echo "Pending at Stock";} 
	elseif($row[0]["account_comment"]=="" && $row[0]["total_pending"]=="" && $row[0]["approve_status"]==0 && $row[0]["final_status"]==0){echo "Pending at Accounts";} 
	elseif($row[0]["approve_status"]==0 && $row[0]["forward_req_user"]!="" && $row[0]["forward_back_comment"]=="" && $row[0]["del_debtors_status"]==1)	
	{echo "Pending Admin Approval (Req Forward to ".$row[0]["forward_req_user"].")";}
	elseif($row[0]["approve_status"]==0 && ($row[0]["account_comment"]!="" || $row[0]["total_pending"]!="") && $row[0]["final_status"]==0 && $row[0]["del_debtors_status"]==1)
	{echo "Pending Admin Approval";}
	elseif($row[0]["approve_status"]==1 && $row[0]["del_debtors_status"]==1 && $row[0]["final_status"]!=1){echo "Pending at Tech Support Team";}
	elseif($row[0]["final_status"]==1){echo "Process Done";}?>
            </strong></td>
        </tr>
        <tr>
          <td>Account Comment</td>
          <td><?echo $row[0]["account_comment"];?></td>
        </tr>
        <tr>
          <td>Payment Pending</td>
          <td><?echo $row[0]["total_pending"];?></td>
        </tr>
        <tr>
          <td>Sales Comment</td>
          <td><?echo $row[0]["sales_comment"];?></td>
        </tr>
        <tr>
          <td>Support Comment</td>
          <td><?echo $row[0]["support_comment"];?></td>
        </tr>
        <tr>
          <td>Admin Comment</td>
          <td><?echo $row[0]["admin_comment"];?></td>
        </tr>
        <tr>
          <td>Req Forwarded to</td>
          <td><?echo $row[0]["forward_req_user"];?></td>
        </tr>
        <tr>
          <td>Forward Comment</td>
          <td><?echo $row[0]["forward_comment"];?></td>
        </tr>
        <tr>
          <td>F/W Request Back Comment</td>
          <td><?echo $row[0]["forward_back_comment"];?></td>
        </tr>
        <tr>
          <td>Approval Date</td>
          <td><?
			if($row[0]["approve_status"]==1 && $row[0]["approve_date"]!='')
			{
			echo date("d-M-Y h:i:s A",strtotime($row[0]["approve_date"]));
			}
			else
			{
				echo "";
			}
			
			?></td>
        </tr>
        <tr>
          <td>Closed By</td>
          <td><?echo $row[0]["req_close_by"];?></td>
        </tr>
        <tr>
          <td>Closed Date</td>
          <td><?
			if($row[0]["final_status"]==1 && $row[0]["close_date"]!='')
			{
			echo date("d-M-Y h:i:s A",strtotime($row[0]["close_date"]));
			}
			else
			{
				echo "";
			}
			
			?></td>
        </tr>
        <?php if($total_query13>0){?>
        <tr>
          <td colspan="2">-------------------------------------------</td>
        </tr>
        <tr>
          <td colspan="2"><table cellspacing="2" cellpadding="2">
              <tbody>
                <tr>
                  <td align="left">Req Forwarded to</td>
                  <td>Forward Comment</td>
                  <td>F/W Request Back Comment</td>
                </tr>
                <?php for($at=0;$at<count($forward_query13);$at++){?>
                <tr>
                  <td><?php echo $forward_query13[$at]["forward_req_user"];?></td>
                  <td><?php echo $forward_query13[$at]["forward_comment"];?></td>
                  <td><?php echo $forward_query13[$at]["forward_back_comment"];?></td>
                </tr>
                <?php } ?>
              </tbody>
            </table></td>
        </tr>
        <?php } ?>
      </tbody>
    </table>
  </div>
</div>
<? } 
	else If($tablename=="software_request")
		{
			$query = "SELECT * FROM ".$tablename." where id=".$RowId; 
			$row=select_query($query);
			$forward_query16 = select_query("SELECT * FROM forward_req_history where table_name='$tablename' and table_row_id=".$RowId);
			$total_query16 = count($forward_query16);

	?>
<div id="databox">
  <div class="heading">Software Request</div>
  <div class="dataleft">
    <table cellspacing="2" cellpadding="2">
      <tbody>
        <tr>
          <td>Date</td>
          <td><?echo date("d-M-Y h:i:s A",strtotime($row[0]["date"]));?></td>
        </tr>
        <? /*if($row[0]["acc_manager"]=='saleslogin') {
		$account_manager=$row[0]["sales_manager"]; 
		}
		else {
		$account_manager=$row[0]["acc_manager"]; 
		}*/
		
		?>
        <tr>
          <td>Request By</td>
          <td><?echo $row[0]["acc_manager"];?></td>
        </tr>
        <tr>
          <td>Account Manager</td>
          <td><?echo $row[0]["sales_manager"];?></td>
        </tr>
        <? $sql="SELECT Userid AS id,UserName AS sys_username FROM internalsoftware.addclient  WHERE Userid=".$row[0]["main_user_id"];
		$rowuser=select_query($sql);
		?>
        <tr>
          <td>Client User Name</td>
          <td><?echo $rowuser[0]["sys_username"];?></td>
        </tr>
        <tr>
          <td>Company Name</td>
          <td><?echo $row[0]["company"];?></td>
        </tr>
        <tr>
          <td>Total No Of Vehicle</td>
          <td><?echo $row[0]["total_no_of_vehicles"];?></td>
        </tr>
        <tr>
          <td>Potential</td>
          <td><?echo $row[0]["potential"];?></td>
        </tr>
        <tr>
          <td>Requested Software:---</td>
          <td></td>
        </tr>
        <tr>
          <td>Google Map</td>
          <td><?echo $row[0]["rs_google_map"];?></td>
        </tr>
        <tr>
          <td>Admin </td>
          <td><?echo $row[0]["rs_admin"];?></td>
        </tr>
        <tr>
          <td>Type Of Alert</td>
          <td><?echo $row[0]["alert"];?></td>
        </tr>
        <tr>
          <td>Alert Contact Number</td>
          <td><?echo $row[0]["alert_contact"];?></td>
        </tr>
        <tr>
          <td>Client Contact Number </td>
          <td><?echo $row[0]["client_contact_num"];?></td>
        </tr>
        <tr>
          <td>Other Alert/ Info</td>
          <td><?echo $row[0]["rs_others"];?></td>
        </tr>
      </tbody>
    </table>
  </div>
  <div class="dataright">
    <table cellspacing="2" cellpadding="2">
      <tbody>
        <tr>
          <td>
        <tr>
          <td>Reports</td>
          <td><?echo $row[0]["reports"];?></td>
        </tr>
        <tr>
          <td>Customize Report </td>
          <td><?echo $row[0]["rs_customize_report"];?></td>
        </tr>
        <!--<tr><td>Admin Approval</td>  <td><?if($row[0]["approve_status"]==1) echo "Approved"; else echo "Pending Approval"?></td></tr>-->
        <tr>
          <td><strong>Process Pending </strong></td>
          <td><strong>
            <?  if($row[0]["software_status"]==2 || (($row[0]["support_comment"]!="" || $row[0]["admin_comment"]!="") && $row[0]["sales_comment"]==""))
	{echo "Reply Pending at Request Side";}
	elseif($row[0]["approve_status"]==0 && $row[0]["forward_req_user"]!="" && $row[0]["forward_back_comment"]=="" && $row[0]["software_status"]==1)	
	{echo "Pending Admin Approval (Req Forward to ".$row[0]["forward_req_user"].")";}
	elseif($row[0]["approve_status"]==0 && $row[0]["final_status"]==0 && $row[0]["software_status"]==1){echo "Pending Admin Approval";}
	elseif($row[0]["approve_status"]==1 && $row[0]["software_status"]==1 && $row[0]["final_status"]!=1){echo "Pending at Tech Support Team";}
	elseif($row[0]["final_status"]==1){echo "Process Done";}?>
            </strong></td>
        </tr>
        <tr>
          <td>Account Comment</td>
          <td><?echo $row[0]["account_comment"];?></td>
        </tr>
        <tr>
          <td>Sales Comment</td>
          <td><?echo $row[0]["sales_comment"];?></td>
        </tr>
        <tr>
          <td>Support Comment</td>
          <td><?echo $row[0]["support_comment"];?></td>
        </tr>
        <tr>
          <td>Admin Comment</td>
          <td><?echo $row[0]["admin_comment"];?></td>
        </tr>
        <tr>
          <td>Req Forwarded to</td>
          <td><?echo $row[0]["forward_req_user"];?></td>
        </tr>
        <tr>
          <td>Forward Comment</td>
          <td><?echo $row[0]["forward_comment"];?></td>
        </tr>
        <tr>
          <td>F/W Request Back Comment</td>
          <td><?echo $row[0]["forward_back_comment"];?></td>
        </tr>
        <tr>
          <td>Approval Date</td>
          <td><?
			if($row[0]["approve_status"]==1 && $row[0]["approve_date"]!='')
			{
			echo date("d-M-Y h:i:s A",strtotime($row[0]["approve_date"]));
			}
			else
			{
				echo "";
			}
			
			?></td>
        </tr>
        <tr>
          <td>Closed Date</td>
          <td><?
			if($row[0]["final_status"]==1 && $row[0]["close_date"]!='')
			{
			echo date("d-M-Y h:i:s A",strtotime($row[0]["close_date"]));
			}
			else
			{
				echo "";
			}
			
			?></td>
        </tr>
        <?php if($total_query16>0){?>
        <tr>
          <td colspan="2">-------------------------------------------</td>
        </tr>
        <tr>
          <td colspan="2"><table cellspacing="2" cellpadding="2">
              <tbody>
                <tr>
                  <td align="left">Req Forwarded to</td>
                  <td>Forward Comment</td>
                  <td>F/W Request Back Comment</td>
                </tr>
                <?php for($at=0;$at<count($forward_query16);$at++){?>
                <tr>
                  <td><?php echo $forward_query16[$at]["forward_req_user"];?></td>
                  <td><?php echo $forward_query16[$at]["forward_comment"];?></td>
                  <td><?php echo $forward_query16[$at]["forward_back_comment"];?></td>
                </tr>
                <?php } ?>
              </tbody>
            </table></td>
        </tr>
        <?php } ?>
      </tbody>
    </table>
  </div>
</div>
<?
	}

	else If($tablename=="transfer_the_vehicle")
		{
			$query = "SELECT * FROM ".$tablename." where id=".$RowId; 
			$row=select_query($query);
			$forward_query17 = select_query("SELECT * FROM forward_req_history where table_name='$tablename' and table_row_id=".$RowId);
			$total_query17 = count($forward_query17);

	?>
<div id="databox">
  <div class="heading">Transfer Vehicle</div>
  <div class="dataleft">
    <table cellspacing="2" cellpadding="2">
      <tbody>
        <tr>
          <td>Date</td>
          <td><?echo date("d-M-Y h:i:s A",strtotime($row[0]["date"]));?></td>
        </tr>
        <? /*if($row[0]["acc_manager"]=='saleslogin') {
		$account_manager=$row[0]["sales_manager"]; 
		}
		else {
		$account_manager=$row[0]["acc_manager"]; 
		}*/
		
		?>
        <tr>
          <td>Request By</td>
          <td><?echo $row[0]["acc_manager"];?></td>
        </tr>
        <tr>
          <td>Account Manager</td>
          <td><?echo $row[0]["sales_manager"];?></td>
        </tr>
        <? $sql="SELECT Userid AS id,UserName AS sys_username FROM internalsoftware.addclient WHERE Userid=".$row[0]["transfer_from_user"];
		$rowuser=select_query($sql);
		?>
        <tr>
          <td>Client User Name </td>
          <td><?echo $rowuser[0]["sys_username"];?></td>
        </tr>
        <tr>
          <td>Company Name </td>
          <td><?echo $row[0]["transfer_from_company"];?></td>
        </tr>
        <tr>
          <td>Total No Of Vehicle </td>
          <td><?echo $row[0]["total_no_of_veh"];?></td>
        </tr>
        <!--<tr><td>Vehicle to move </td><td><?echo $row[0]["transfer_from_reg_no"];?></td></tr> -->
        
        <tr>
          <td>Vehicle to move </td>
          <td><?php $vechile_no = explode(",",$row[0]["transfer_from_reg_no"]); 
for($i=0;$i<=count($vechile_no);$i++){ if($i%3!=0){ echo $vechile_no[$i].", ";}else { echo "<br/>".$vechile_no[$i].", ";} }?></td>
        </tr>
        <tr>
          <td>Transfer To:--</td>
          <td></td>
        </tr>
        <? $sql="SELECT Userid AS id,UserName AS sys_username FROM internalsoftware.addclient  WHERE Userid=".$row[0]["transfer_to_user"];
		$rowuser=select_query($sql);
		?>
        <tr>
          <td>Transfer User Name </td>
          <td><?echo $rowuser[0]["sys_username"];?></td>
        </tr>
        <tr>
          <td>Transfer Company Name </td>
          <td><?echo $row[0]["transfer_to_company"];?></td>
        </tr>
        <tr>
          <td>Billing</td>
          <td><?echo $row[0]["transfer_to_billing"];?></td>
        </tr>
        <tr>
          <td>Billing Name</td>
          <td><?echo $row[0]["billing_name"];?></td>
        </tr>
        <tr>
          <td>Billing Address</td>
          <td><?echo $row[0]["billing_address"];?></td>
        </tr>
        <tr>
          <td>Account Comment Transfer From</td>
          <td><?echo $row[0]["company_from_details"];?></td>
        </tr>
        <tr>
          <td>Account Comment Transfer To</td>
          <td><?echo $row[0]["company_to_details"];?></td>
        </tr>
      </tbody>
    </table>
  </div>
  <div class="dataright">
    <table cellspacing="2" cellpadding="2">
      <tbody>
        <tr>
          <td>Reason</td>
          <td><?echo $row[0]["reason"];?></td>
        </tr>
        <!--<tr><td>Admin Approval</td>  <td><?if($row[0]["approve_status"]==1) echo "Approved"; else echo "Pending Approval"?></td></tr>-->
        <tr>
          <td><strong>Process Pending </strong></td>
          <td><strong>
            <?  if($row[0]["transfer_veh_status"]==2 || (($row[0]["support_comment"]!="" || $row[0]["admin_comment"]!="") && $row[0]["sales_comment"]==""))
	{echo "Reply Pending at Request Side";}
	elseif($row[0]["account_comment"]=="" && $row[0]["total_pending"]=="" && $row[0]["approve_status"]==0 && $row[0]["final_status"]==0){echo "Pending at Accounts";} 
	elseif($row[0]["approve_status"]==0 && $row[0]["forward_req_user"]!="" && $row[0]["forward_back_comment"]=="" && $row[0]["transfer_veh_status"]==1)	
	{echo "Pending Admin Approval (Req Forward to ".$row[0]["forward_req_user"].")";}
	elseif($row[0]["approve_status"]==0 && ($row[0]["account_comment"]!="" || $row[0]["total_pending"]!="") && $row[0]["final_status"]==0 && $row[0]["transfer_veh_status"]==1)
	{echo "Pending Admin Approval";}
	elseif($row[0]["approve_status"]==1 && $row[0]["transfer_veh_status"]==1 && $row[0]["final_status"]!=1){echo "Pending at Tech Support Team";}
	elseif($row[0]["final_status"]==1){echo "Process Done";}?>
            </strong></td>
        </tr>
        <tr>
          <td>Account Comment</td>
          <td><?echo $row[0]["account_comment"];?></td>
        </tr>
        <tr>
          <td>Payment Pending</td>
          <td><?echo $row[0]["total_pending"];?></td>
        </tr>
        <tr>
          <td>Sales Comment</td>
          <td><?echo $row[0]["sales_comment"];?></td>
        </tr>
        <tr>
          <td>Support Comment</td>
          <td><?echo $row[0]["support_comment"];?></td>
        </tr>
        <tr>
          <td>Admin Comment</td>
          <td><?echo $row[0]["admin_comment"];?></td>
        </tr>
        <tr>
          <td>Req Forwarded to</td>
          <td><?echo $row[0]["forward_req_user"];?></td>
        </tr>
        <tr>
          <td>Forward Comment</td>
          <td><?echo $row[0]["forward_comment"];?></td>
        </tr>
        <tr>
          <td>F/W Request Back Comment</td>
          <td><?echo $row[0]["forward_back_comment"];?></td>
        </tr>
        <tr>
          <td>Approval Date</td>
          <td><?
			if($row[0]["approve_status"]==1 && $row[0]["approve_date"]!='')
			{
			echo date("d-M-Y h:i:s A",strtotime($row[0]["approve_date"]));
			}
			else
			{
				echo "";
			}
			
			?></td>
        </tr>
        <tr>
          <td>Closed By</td>
          <td><?echo $row[0]["req_close_by"];?></td>
        </tr>
        <tr>
          <td>Closed Date</td>
          <td><?
			if($row[0]["final_status"]==1 && $row[0]["close_date"]!='')
			{
			echo date("d-M-Y h:i:s A",strtotime($row[0]["close_date"]));
			}
			else
			{
				echo "";
			}
			
			?></td>
        </tr>
        <?php if($total_query17>0){?>
        <tr>
          <td colspan="2">-------------------------------------------</td>
        </tr>
        <tr>
          <td colspan="2"><table cellspacing="2" cellpadding="2">
              <tbody>
                <tr>
                  <td align="left">Req Forwarded to</td>
                  <td>Forward Comment</td>
                  <td>F/W Request Back Comment</td>
                </tr>
                <?php for($at=0;$at<count($forward_query17);$at++){?>
                <tr>
                  <td><?php echo $forward_query17[$at]["forward_req_user"];?></td>
                  <td><?php echo $forward_query17[$at]["forward_comment"];?></td>
                  <td><?php echo $forward_query17[$at]["forward_back_comment"];?></td>
                </tr>
                <?php } ?>
              </tbody>
            </table></td>
        </tr>
        <?php } ?>
      </tbody>
    </table>
  </div>
</div>
<?
	}
	If($tablename=="device_change")
	{
		$query = "SELECT * FROM ".$tablename." where id=".$RowId;
		$row=select_query($query);
		$forward_query1 = select_query("SELECT * FROM forward_req_history where table_name='$tablename' and table_row_id=".$RowId);
		$total_query1 = count($forward_query1);
	?>
<div id="databox">
  <div class="heading">View Device Change</div>
  <div class="dataleft">
    <table cellspacing="2" cellpadding="2">
      <tbody>
        <tr>
          <td>Date</td>
          <td><?echo date("d-M-Y h:i:s A",strtotime($row[0]["date"]));?></td>
        </tr>
        <tr>
          <td>Request By</td>
          <td><?echo $row[0]["acc_manager"];?></td>
        </tr>
        <tr>
          <td>Account Manager</td>
          <td><?echo $row[0]["sales_manager"];?></td>
        </tr>
        <tr>
          <td>Company</td>
          <td><?echo $row[0]["client"];?></td>
        </tr>
        <? $sql="SELECT Userid AS id,UserName AS sys_username FROM internalsoftware.addclient  WHERE Userid=".$row[0]["user_id"];
		$rowuser=select_query($sql);
		?>
        <tr>
          <td>Client User Name </td>
          <td><?echo $rowuser[0]["sys_username"];?></td>
        </tr>
        <tr>
          <td>Device Model</td>
          <td><?echo $row[0]["device_model"];?></td>
        </tr>
        <tr>
          <td>Device IMEI</td>
          <td><?echo $row[0]["device_imei"];?></td>
        </tr>
        <tr>
          <td>Veh Num</td>
          <td><?echo $row[0]["reg_no"];?></td>
        </tr>
        <tr>
          <td>Mobile Number</td>
          <td><?echo $row[0]["mobile_no"];?></td>
        </tr>
        <tr>
          <td>Date of installation </td>
          <td><?echo $row[0]["date_of_install"];?></td>
        </tr>
        <? $sql="SELECT Userid AS id,UserName AS sys_username FROM internalsoftware.addclient  WHERE Userid=".$row[0]["rdd_username"];
		$rowuser_old=select_query($sql);
		?>
        <tr>
          <td><strong>Replaced Device Details</strong></td>
          <td>---------------------------</td>
        </tr>
        <tr>
          <td>Client User</td>
          <td><?echo $rowuser_old[0]["sys_username"];?></td>
        </tr>
        <tr>
          <td>Client Name</td>
          <td><?echo $row[0]["rdd_companyname"];?></td>
        </tr>
        <tr>
          <td>Device Type</td>
          <td><?echo $row[0]["rdd_device_type"];?></td>
        </tr>
        <tr>
          <td>Device Model</td>
          <td><?echo $row[0]["rdd_device_model"];?></td>
        </tr>
        <tr>
          <td>IMEI</td>
          <td><?echo $row[0]["rdd_device_imei"];?></td>
        </tr>
        <tr>
          <td>Mobile Number</td>
          <td><?echo $row[0]["rdd_device_mobile_num"];?></td>
        </tr>
        <tr>
          <td>Date of installation </td>
          <td><?echo $row[0]["rdd_date_replace"];?></td>
        </tr>
        <tr>
          <td>Billing</td>
          <td><?echo $row[0]["billing"];?></td>
        </tr>
        <tr>
          <td>Service Support Comment</td>
          <td><?echo $row[0]["service_support_com"];?></td>
        </tr>
      </tbody>
    </table>
  </div>
  <div class="dataright">
    <table cellspacing="2" cellpadding="2">
      <tbody>
        <tr>
          <td><strong>Process Pending </strong></td>
          <td><strong>
            <?  if(($row[0]["device_change_status"]==2 && $row[0]["rdd_device_type"]!="New") || (($row[0]["support_comment"]!="" || ($row[0]["admin_comment"]!="" && $row[0]["rdd_device_type"]!="New")) && $row[0]["service_comment"]=="")){echo "Reply Pending at Request Side";}			
	elseif($row[0]["rdd_device_imei"]=="" && $row[0]["rdd_reason"]=="" && $row[0]["approve_status"]==0){echo "Request Not Completely Generate.";}
	elseif($row[0]["account_comment"]=="" && $row[0]["pay_status"]=="" && $row[0]["rdd_reason"]!="" && $row[0]["approve_status"]==0){echo "Pending at Accounts";} 
	elseif($row[0]["rdd_device_type"]=="New" && ($row[0]["service_support_com"]=='' || $row[0]["device_change_status"]==2) && $row[0]["approve_status"]==0){echo "Pending at Delhi Service Support Login";}
	elseif($row[0]["approve_status"]==0 && $row[0]["forward_req_user"]!="" && $row[0]["forward_back_comment"]=="" && $row[0]["device_change_status"]==1)	
	{echo "Pending Admin Approval (Req Forward to ".$row[0]["forward_req_user"].")";}
	elseif($row[0]["approve_status"]==0 && ($row[0]["account_comment"]!="" || $row[0]["pay_status"]!="") && $row[0]["final_status"]==0 && $row[0]["device_change_status"]==1)
	{echo "Pending Admin Approval";}
	elseif($row[0]["approve_status"]==1 && $row[0]["device_change_status"]==1 && $row[0]["final_status"]!=1){echo "Pending at Tech Support Team";}
	elseif($row[0]["final_status"]==1){echo "Process Done";}?>
            </strong></td>
        </tr>
        <tr>
          <td>Reason</td>
          <td><?echo $row[0]["rdd_reason"];?></td>
        </tr>
        <tr>
          <td>Account Comment</td>
          <td><?echo $row[0]["account_comment"];?></td>
        </tr>
        <tr>
          <td>Pallavi Comment</td>
          <td><?echo $row[0]["service_support_com"];?></td>
        </tr>
        <tr>
          <td>Payment Pending </td>
          <td><?echo $row[0]["pay_status"];?></td>
        </tr>
        <tr>
          <td>Service Comment</td>
          <td><?echo $row[0]["service_comment"];?></td>
        </tr>
        <tr>
          <td>Support Comment</td>
          <td><?echo $row[0]["support_comment"];?></td>
        </tr>
        <tr>
          <td>Admin Comment</td>
          <td><?echo $row[0]["admin_comment"];?></td>
        </tr>
        <tr>
          <td>Req Forwarded to</td>
          <td><?echo $row[0]["forward_req_user"];?></td>
        </tr>
        <tr>
          <td>Forward Comment</td>
          <td><?echo $row[0]["forward_comment"];?></td>
        </tr>
        <tr>
          <td>F/W Request Back Comment</td>
          <td><?echo $row[0]["forward_back_comment"];?></td>
        </tr>
        <tr>
          <td>Approval Date</td>
          <td><?
			if($row[0]["approve_status"]==1 && $row[0]["approve_date"]!='')
			{
			echo date("d-M-Y h:i:s A",strtotime($row[0]["approve_date"]));
			}
			else
			{
				echo "";
			}
			
			?></td>
        </tr>
        <tr>
          <td>Closed By</td>
          <td><?echo $row[0]["req_close_by"];?></td>
        </tr>
        <?php if($row[0]["close_comment"]!=""){?>
        <tr>
          <td>Duplicate Close Reason</td>
          <td><?echo $row[0]["close_comment"];?></td>
        </tr>
        <?php } ?>
        <tr>
          <td>Closed Date</td>
          <td><?
			if($row[0]["final_status"]==1 && $row[0]["close_date"]!='')
			{
			echo date("d-M-Y h:i:s A",strtotime($row[0]["close_date"]));
			}
			else
			{
				echo "";
			}
			
			?></td>
        </tr>
        <?php if($total_query1>0){?>
        <tr>
          <td colspan="2">-------------------------------------------</td>
        </tr>
        <tr>
          <td colspan="2"><table cellspacing="2" cellpadding="2">
              <tbody>
                <tr>
                  <td align="left">Req Forwarded to</td>
                  <td>Forward Comment</td>
                  <td>F/W Request Back Comment</td>
                </tr>
                <?php for($at=0;$at<count($forward_query1);$at++){?>
                <tr>
                  <td><?php echo $forward_query1[$at]["forward_req_user"];?></td>
                  <td><?php echo $forward_query1[$at]["forward_comment"];?></td>
                  <td><?php echo $forward_query1[$at]["forward_back_comment"];?></td>
                </tr>
                <?php } ?>
              </tbody>
            </table></td>
        </tr>
        <?php } ?>
      </tbody>
    </table>
  </div>
</div>
<? }


else If($tablename=="deactivate_sim")
	{
	    $query = "SELECT * FROM ".$tablename." where id=".$RowId; 
		$row=select_query($query);
		$forward_query7 = select_query("SELECT * FROM forward_req_history where table_name='$tablename' and table_row_id=".$RowId);
		$total_query7 = count($forward_query7);
			
	?>
<div id="databox">
  <div class="heading">Deactivate SIM</div>
  <div class="dataleft">
    <table cellspacing="2" cellpadding="2">
      <tr>
        <td>Date</td>
        <td><?echo date("d-M-Y h:i:s A",strtotime($row[0]["date"]));?></td>
      </tr>
      <tr>
        <td>Request By</td>
        <td><?echo $row[0]["acc_manager"];?></td>
      </tr>
      <tr>
        <td>Account Manager</td>
        <td><?echo $row[0]["sales_manager"];?></td>
      </tr>
      <? $sql="SELECT Userid AS id,UserName AS sys_username FROM internalsoftware.addclient  WHERE Userid=".$row[0]["user_id"];
		$rowuser=select_query($sql);
		?>
      <tr>
        <td>Client User Name </td>
        <td><?echo $rowuser[0]["sys_username"];?></td>
      </tr>
      <tr>
        <td>Company</td>
        <td><?echo $row[0]["client"];?></td>
      </tr>
      <tr>
        <td>Veh Num</td>
        <td><?echo $row[0]["vehicle"];?></td>
      </tr>
      <tr>
        <td>Device Model</td>
        <td><?echo $row[0]["device_model"];?></td>
      </tr>
      <tr>
        <td>Device IMEI</td>
        <td><?echo $row[0]["device_imei"];?></td>
      </tr>
      <tr>
        <td>Mobile Number</td>
        <td><?echo $row[0]["device_sim"];?></td>
      </tr>
      <tr>
        <td><strong>Present Status of Device</strong></td>
        <td>---------------------------</td>
      </tr>
      <tr>
        <td>Location</td>
        <td><?echo $row[0]["ps_of_location"];?></td>
      </tr>
      <tr>
        <td>Ownership</td>
        <td><?echo $row[0]["ps_of_ownership"];?></td>
      </tr>
      <tr>
        <td>Reason</td>
        <td><?echo $row[0]["replace_date"];?></td>
      </tr>
      <tr>
        <td colspan="2">-------------------------------------------</td>
      </tr>
    </table>
  </div>
  <div class="dataright">
    <table cellspacing="2" cellpadding="2">
      <tbody>
        <!--<tr><td>Admin Approval</td>  <td><?if($row[0]["approve_status"]==1) echo "Approved"; else echo "Pending Approval"?></td></tr>-->
        <tr>
          <td><strong>Process Pending </strong></td>
          <td><strong>
            <?  if($row[0]["account_comment"]=="" && $row[0]["final_status"]==0){echo "Pending at Accounts";} 
				elseif($row[0]["final_status"]==1){echo "Process Done";}?>
            </strong></td>
        </tr>
        <tr>
          <td>Account Comment</td>
          <td><?echo $row[0]["account_comment"];?></td>
        </tr>
        <tr>
          <td>Service Comment</td>
          <td><?echo $row[0]["service_comment"];?></td>
        </tr>
        <tr>
          <td>Support Comment</td>
          <td><?echo $row[0]["support_comment"];?></td>
        </tr>
        <tr>
          <td>Admin Comment</td>
          <td><?echo $row[0]["admin_comment"];?></td>
        </tr>
        <tr>
          <td>Req Forwarded to</td>
          <td><?echo $row[0]["forward_req_user"];?></td>
        </tr>
        <tr>
          <td>Forward Comment</td>
          <td><?echo $row[0]["forward_comment"];?></td>
        </tr>
        <tr>
          <td>F/W Request Back Comment</td>
          <td><?echo $row[0]["forward_back_comment"];?></td>
        </tr>
        <tr>
          <td>Approval Date</td>
          <td><?
			if($row[0]["approve_status"]==1 && $row[0]["approve_date"]!='')
			{
			echo date("d-M-Y h:i:s A",strtotime($row[0]["approve_date"]));
			}
			else
			{
				echo "";
			}
			
			?></td>
        </tr>
        <tr>
          <td>Closed Date</td>
          <td><?
			if($row[0]["final_status"]==1 && $row[0]["close_date"]!='')
			{
			echo date("d-M-Y h:i:s A",strtotime($row[0]["close_date"]));
			}
			else
			{
				echo "";
			}
			
			?></td>
        </tr>
        <?php if($total_query7>0){?>
        <tr>
          <td colspan="2">-------------------------------------------</td>
        </tr>
        <tr>
          <td colspan="2"><table cellspacing="2" cellpadding="2">
              <tbody>
                <tr>
                  <td align="left">Req Forwarded to</td>
                  <td>Forward Comment</td>
                  <td>F/W Request Back Comment</td>
                </tr>
                <?php for($at=0;$at<count($forward_query7);$at++){?>
                <tr>
                  <td><?php echo $forward_query7[$at]["forward_req_user"];?></td>
                  <td><?php echo $forward_query7[$at]["forward_comment"];?></td>
                  <td><?php echo $forward_query7[$at]["forward_back_comment"];?></td>
                </tr>
                <?php } ?>
              </tbody>
            </table></td>
        </tr>
        <?php } ?>
      </tbody>
    </table>
  </div>
</div>
<? }

	else If($tablename=="imei_change")
		{
		    $query = "SELECT * FROM ".$tablename." where id=".$RowId; 
			$row=select_query($query);
			$forward_query18 = select_query("SELECT * FROM forward_req_history where table_name='$tablename' and table_row_id=".$RowId);
			$total_query18 = count($forward_query18);

	?>
<div id="databox">
  <div class="heading">IMEI Change</div>
  <div class="dataleft">
    <table cellspacing="2" cellpadding="2">
      <tbody>
        <tr>
          <td>Date</td>
          <td><?echo date("d-M-Y h:i:s A",strtotime($row[0]["date"]));?></td>
        </tr>
        <tr>
          <td>Request By</td>
          <td><?echo $row[0]["acc_manager"];?></td>
        </tr>
        <tr>
          <td>Account Manager</td>
          <td><?echo $row[0]["sales_manager"];?></td>
        </tr>
        <tr>
          <td>Company</td>
          <td><?echo $row[0]["client"];?></td>
        </tr>
        <? $sql="SELECT Userid AS id,UserName AS sys_username FROM internalsoftware.addclient  WHERE Userid=".$row[0]["user_id"];
		$rowuser=select_query($sql);
		?>
        <tr>
          <td>Client User Name </td>
          <td><?echo $rowuser[0]["sys_username"];?></td>
        </tr>
        <tr>
          <td>Veh Num</td>
          <td><?echo $row[0]["vehicle"];?></td>
        </tr>
        <tr>
          <td>Device Model</td>
          <td><?echo $row[0]["device_model"];?></td>
        </tr>
        <tr>
          <td>Device IMEI</td>
          <td><?echo $row[0]["od_imei"];?></td>
        </tr>
        <tr>
          <td>Mobile Number</td>
          <td><?echo $row[0]["od_sim"];?></td>
        </tr>
        <tr>
          <td>Date of installation</td>
          <td><?echo $row[0]["date_of_installation"];?></td>
        </tr>
        <tr>
          <td><strong>Replaced IMEI Details</strong></td>
          <td>---------------------------</td>
        </tr>
        <tr>
          <td>Device Model</td>
          <td><?echo $row[0]["new_devicetype"];?></td>
        </tr>
        <tr>
          <td>IMEI</td>
          <td><?echo $row[0]["new_device_imei"];?></td>
        </tr>
        <tr>
          <td>Device ID</td>
          <td><?echo $row[0]["new_deviceid"];?></td>
        </tr>
        <tr>
          <td>Mobile Number</td>
          <td><?echo $row[0]["new_sim"];?></td>
        </tr>
        <tr>
          <td>Replace Date</td>
          <td><?echo $row[0]["replace_date"];?></td>
        </tr>
        <tr>
          <td>Reason</td>
          <td><?echo $row[0]["reason"];?></td>
        </tr>
      </tbody>
    </table>
  </div>
  <div class="dataright">
    <table cellspacing="2" cellpadding="2">
      <tbody>
        <tr>
          <td>Account Comment</td>
          <td><?echo $row[0]["account_comment"];?></td>
        </tr>
        <tr>
          <td>Service Comment</td>
          <td><?echo $row[0]["service_comment"];?></td>
        </tr>
        <tr>
          <td>Support Comment</td>
          <td><?echo $row[0]["support_comment"];?></td>
        </tr>
        <tr>
          <td>Admin Comment</td>
          <td><?echo $row[0]["admin_comment"];?></td>
        </tr>
        <tr>
          <td>Req Forwarded to</td>
          <td><?echo $row[0]["forward_req_user"];?></td>
        </tr>
        <tr>
          <td>Forward Comment</td>
          <td><?echo $row[0]["forward_comment"];?></td>
        </tr>
        <tr>
          <td>F/W Request Back Comment</td>
          <td><?echo $row[0]["forward_back_comment"];?></td>
        </tr>
        <tr>
          <td>Approval Date</td>
          <td><?
			if($row[0]["approve_status"]==1)
			{
			echo date("d-M-Y h:i:s A",strtotime($row[0]["approve_date"]));
			}
			else
			{
				echo "";
			}
			
			?></td>
        </tr>
        <tr>
          <td>Closed By</td>
          <td><?echo $row[0]["req_close_by"];?></td>
        </tr>
        <tr>
          <td>Closed Date</td>
          <td><?
			if($row[0]["final_status"]==1)
			{
			echo date("d-M-Y h:i:s A",strtotime($row[0]["close_date"]));
			}
			else
			{
				echo "";
			}
			
			?></td>
        </tr>
        <?php if($total_query18>0){?>
        <tr>
          <td colspan="2">-------------------------------------------</td>
        </tr>
        <tr>
          <td colspan="2"><table cellspacing="2" cellpadding="2">
              <tbody>
                <tr>
                  <td align="left">Req Forwarded to</td>
                  <td>Forward Comment</td>
                  <td>F/W Request Back Comment</td>
                </tr>
                <?php for($at=0;$at<count($forward_query18);$at++){?>
                <tr>
                  <td><?php echo $forward_query18[$at]["forward_req_user"];?></td>
                  <td><?php echo $forward_query18[$at]["forward_comment"];?></td>
                  <td><?php echo $forward_query18[$at]["forward_back_comment"];?></td>
                </tr>
                <?php } ?>
              </tbody>
            </table></td>
        </tr>
        <?php } ?>
      </tbody>
    </table>
  </div>
</div>
<? }

	elseIf($tablename=="new_device_addition")
	{

		  $query = "SELECT * FROM ".$tablename." where id=".$RowId; 
		  $row=select_query($query);
          $forward_query2 = select_query("SELECT * FROM forward_req_history where table_name='$tablename' and table_row_id=".$RowId);  
		  $total_query2 = count($forward_query2);
	?>
<div id="databox">
  <div class="heading">View New device Addition</div>
  <div class="dataleft">
    <table cellspacing="2" cellpadding="2">
      <tbody>
        <tr>
          <td>Date</td>
          <td><?echo date("d-M-Y h:i:s A",strtotime($row[0]["date"]));?></td>
        </tr>
        <tr>
          <td>Request By</td>
          <td><?echo $row[0]["acc_manager"];?></td>
        </tr>
        <tr>
          <td>Account Manager</td>
          <td><?echo $row[0]["sales_manager"];?></td>
        </tr>
        <tr>
          <td>Company</td>
          <td><?echo $row[0]["client"];?></td>
        </tr>
        <? $sql="SELECT Userid AS id,UserName AS sys_username FROM internalsoftware.addclient  WHERE Userid=".$row[0]["user_id"];
		$rowuser=select_query($sql);
		?>
        <tr>
          <td>Client User Name </td>
          <td><?echo $rowuser[0]["sys_username"];?></td>
        </tr>
        <tr>
          <td>Vehicle Name</td>
          <td><?echo $row[0]["vehicle_no"];?></td>
        </tr>
        <tr>
          <td>Device Type </td>
          <td><?echo $row[0]["device_type"];?></td>
        </tr>
        <tr>
          <td>Old Company Name </td>
          <td><?echo $row[0]["old_device_client"];?></td>
        </tr>
        <tr>
          <td>Old Registration No </td>
          <td><?echo $row[0]["old_vehicle_name"];?></td>
        </tr>
        <tr>
          <td>Device Model </td>
          <td><?echo $row[0]["device_model"];?></td>
        </tr>
        <tr>
          <td>Device IMEI </td>
          <td><?echo $row[0]["device_imei"];?></td>
        </tr>
        <? 
		if($row[0]["device_type"]=='Old' || $row[0]["device_type"]=='old') 
		{
			$Deviceid=$row[0]["old_device_id"];
		}
		else {
			$Deviceid=$row[0]["device_id"];
		}
		?>
        <tr>
          <td>Device ID </td>
          <td><? echo $Deviceid;?></td>
        </tr>
        <tr>
          <td>Device Mobile Number </td>
          <td><?echo $row[0]["device_sim_num"];?></td>
        </tr>
        <tr>
          <td>Old Date Of Installation </td>
          <td><?echo $row[0]["olddate_of_installation"];?></td>
        </tr>
        <? /*if($row[0]["device_type"]=='New'){
		$biliing_status=$row[0]["billing"];
		}
		else{
		$biliing_status=$row[0]["billing_if_old_device"];
		}*/
			?>
        <tr>
          <td>Billing</td>
          <td><?echo $row[0]["billing"];?></td>
        </tr>
        <tr>
          <td>Billing Reason</td>
          <td><?echo $row[0]["billing_if_no_reason"];?></td>
        </tr>
      </tbody>
    </table>
  </div>
  <div class="dataright">
    <table cellspacing="2" cellpadding="2">
      <tbody>
        <tr>
          <td>Dimts</td>
          <td><?echo $row[0]["dimts"];?></td>
        </tr>
        <tr>
          <td>Immobilizer </td>
          <td><?echo $row[0]["immobilizer"];?></td>
        </tr>
        <tr>
          <td>AC </td>
          <td><?echo $row[0]["ac"];?></td>
        </tr>
        <tr>
          <td>Date Of Installation </td>
          <td><?echo $row[0]["date_of_installation"];?></td>
        </tr>
        <tr>
          <td>Account Comment</td>
          <td><?echo $row[0]["account_comment"];?></td>
        </tr>
        <tr>
          <td><strong>Process Pending</strong></td>
          <td><strong>
            <?  if($row[0]["new_device_status"]==2 || ($row[0]["support_comment"]!="" && $row[0]["service_comment"]=="")){echo "Reply Pending at Request Side";}
	elseif($row[0]["new_device_status"]==1 && $row[0]["final_status"]!=1){echo "Pending at Tech Support Team";}
	elseif($row[0]["final_status"]==1){echo "Process Done";}?>
            </strong></td>
        </tr>
        <tr>
          <td>Service Comment</td>
          <td><?echo $row[0]["service_comment"];?></td>
        </tr>
        <tr>
          <td>Support Comment</td>
          <td><?echo $row[0]["support_comment"];?></td>
        </tr>
        <tr>
          <td>Admin Comment</td>
          <td><?echo $row[0]["admin_comment"];?></td>
        </tr>
        <tr>
          <td>Req Forwarded to</td>
          <td><?echo $row[0]["forward_req_user"];?></td>
        </tr>
        <tr>
          <td>Forward Comment</td>
          <td><?echo $row[0]["forward_comment"];?></td>
        </tr>
        <tr>
          <td>F/W Request Back Comment</td>
          <td><?echo $row[0]["forward_back_comment"];?></td>
        </tr>
        <tr>
          <td>Approval Date</td>
          <td><?
			if($row[0]["approve_status"]==1 && $row[0]["approve_date"]!='')
			{
			echo date("d-M-Y h:i:s A",strtotime($row[0]["approve_date"]));
			}
			else
			{
				echo "";
			}
			
			?></td>
        </tr>
        <tr>
          <td>Closed By</td>
          <td><?echo $row[0]["req_close_by"];?></td>
        </tr>
        <tr>
          <td>Closed Date</td>
          <td><?
			if($row[0]["final_status"]==1 && $row[0]["close_date"]!='')
			{
			echo date("d-M-Y h:i:s A",strtotime($row[0]["close_date"]));
			}
			else
			{
				echo "";
			}
			
			?></td>
        </tr>
        <?php if($total_query2>0){?>
        <tr>
          <td colspan="2">-------------------------------------------</td>
        </tr>
        <tr>
          <td colspan="2"><table cellspacing="2" cellpadding="2">
              <tbody>
                <tr>
                  <td align="left">Req Forwarded to</td>
                  <td>Forward Comment</td>
                  <td>F/W Request Back Comment</td>
                </tr>
                <?php for($at=0;$at<count($forward_query2);$at++){?>
                <tr>
                  <td><?php echo $forward_query2[$at]["forward_req_user"];?></td>
                  <td><?php echo $forward_query2[$at]["forward_comment"];?></td>
                  <td><?php echo $forward_query2[$at]["forward_back_comment"];?></td>
                </tr>
                <?php } ?>
              </tbody>
            </table></td>
        </tr>
        <?php } ?>
      </tbody>
    </table>
  </div>
</div>
<? }
	else If($tablename=="vehicle_no_change")
	{
		$query = "SELECT * FROM ".$tablename." where id=".$RowId; 
		$row=select_query($query);
		$forward_query3 = select_query("SELECT * FROM forward_req_history where table_name='$tablename' and table_row_id=".$RowId);
		$total_query3 = count($forward_query3);
 
  
	?>
<div id="databox">
  <div class="heading">View Vehicle Change</div>
  <div class="dataleft">
    <table cellspacing="2" cellpadding="2">
      <tbody>
        <tr>
          <td>Date </td>
          <td><?echo date("d-M-Y h:i:s A",strtotime($row[0]["date"]));?></td>
        </tr>
        <tr>
          <td>Request By</td>
          <td><?echo $row[0]["acc_manager"];?></td>
        </tr>
        <tr>
          <td>Account Manager</td>
          <td><?echo $row[0]["sales_manager"];?></td>
        </tr>
        <? $sql="SELECT Userid AS id,UserName AS sys_username FROM internalsoftware.addclient  WHERE Userid=".$row[0]["user_id"];
		$rowuser=select_query($sql);
		?>
        <tr>
          <td>Company Name </td>
          <td><?echo $row[0]["client"];?></td>
        </tr>
        <tr>
          <td>Registration No</td>
          <td><?echo $row[0]["old_reg_no"];?></td>
        </tr>
        <tr>
          <td>New Registration No </td>
          <td><?echo $row[0]["new_reg_no"];?></td>
        </tr>
        <tr>
          <td>Billing</td>
          <td><?echo $row[0]["billing"];?></td>
        </tr>
        <tr>
          <td>Billing Reason</td>
          <td><?echo $row[0]["billing_reason"];?></td>
        </tr>
        <tr>
          <td>Date </td>
          <td><?echo $row[0]["numberchange_date"];?></td>
        </tr>
        <tr>
          <td>Vehicle No Change Reason </td>
          <td><?echo $row[0]["reason"];?></td>
        </tr>
        <tr>
          <td>Client Request Reason </td>
          <td><?echo $row[0]["vehicle_reason"];?></td>
        </tr>
      </tbody>
    </table>
  </div>
  <div class="dataright">
    <table cellspacing="2" cellpadding="2">
      <tbody>
        
        <!--<tr><td>Admin Approval</td>  <td><?if($row[0]["approve_status"]==1) echo "Approved"; else echo "Pending Approval"?></td></tr>-->
        <tr>
          <td><strong>Process Pending </strong></td>
          <td><strong>
            <?  if($row[0]["reason"]=='Temperory no to Permanent no' || $row[0]["reason"]=='Personal no to Commercial no' || $row[0]["reason"]=='Commercial no to Personal no' || $row[0]["reason"]=='For Warranty Renuwal Purpose')
	{
		if($row[0]["vehicle_status"]==2 || ($row[0]["support_comment"]!="" && $row[0]["service_comment"]==""))
		{echo "Reply Pending at Request Side";}
		elseif($row[0]["vehicle_status"]==1 && $row[0]["final_status"]!=1){echo "Pending at Tech Support Team";}
		elseif($row[0]["final_status"]==1){echo "Process Done";} 
	}
	else{
		if($row[0]["vehicle_status"]==2 || (($row[0]["support_comment"]!="" || $row[0]["admin_comment"]!="") && $row[0]["service_comment"]==""))
		{echo "Reply Pending at Request Side";}
		elseif($row[0]["new_reg_no"]=="" && $row[0]["reason"]=="" && $row[0]["approve_status"]==0){echo "Request Not Completely Generate.";}
		elseif($row[0]["account_comment"]=="" && $row[0]["payment_status"]=="" && $row[0]["reason"]!="" && $row[0]["approve_status"]==0){echo "Pending at Accounts";} 
		elseif($row[0]["approve_status"]==0 && $row[0]["forward_req_user"]!="" && $row[0]["forward_back_comment"]=="" && $row[0]["vehicle_status"]==1)	
		{echo "Pending Admin Approval (Req Forward to ".$row[0]["forward_req_user"].")";}
		elseif($row[0]["approve_status"]==0 && ($row[0]["account_comment"]!="" || $row[0]["payment_status"]!="") && $row[0]["final_status"]==0 && $row[0]["vehicle_status"]==1)
		{echo "Pending Admin Approval";}
		elseif($row[0]["approve_status"]==1 && $row[0]["vehicle_status"]==1 && $row[0]["final_status"]!=1){echo "Pending at Tech Support Team";}
		elseif($row[0]["final_status"]==1){echo "Process Done";} 
	} ?>
            </strong></td>
        </tr>
        <tr>
          <td>Account Comment</td>
          <td><?echo $row[0]["account_comment"];?></td>
        </tr>
        <tr>
          <td>Payment Pending </td>
          <td><?echo $row[0]["payment_status"];?></td>
        </tr>
        <tr>
          <td>Service Comment</td>
          <td><?echo $row[0]["service_comment"];?></td>
        </tr>
        <tr>
          <td>Support Comment</td>
          <td><?echo $row[0]["support_comment"];?></td>
        </tr>
        <tr>
          <td>Admin Comment</td>
          <td><?echo $row[0]["admin_comment"];?></td>
        </tr>
        <tr>
          <td>Req Forwarded to</td>
          <td><?echo $row[0]["forward_req_user"];?></td>
        </tr>
        <tr>
          <td>Forward Comment</td>
          <td><?echo $row[0]["forward_comment"];?></td>
        </tr>
        <tr>
          <td>F/W Request Back Comment</td>
          <td><?echo $row[0]["forward_back_comment"];?></td>
        </tr>
        <tr>
          <td>Approval Date</td>
          <td><?
			if($row[0]["approve_status"]==1 && $row[0]["approve_date"]!='')
			{
			echo date("d-M-Y h:i:s A",strtotime($row[0]["approve_date"]));
			}
			else
			{
				echo "";
			}
			
			?></td>
        </tr>
        <tr>
          <td>Closed By</td>
          <td><?echo $row[0]["req_close_by"];?></td>
        </tr>
        <?php if($row[0]["close_comment"]!=""){?>
        <tr>
          <td>Duplicate Close Reason</td>
          <td><?echo $row[0]["close_comment"];?></td>
        </tr>
        <?php } ?>
        <tr>
          <td>Closed Date</td>
          <td><?
			if($row[0]["final_status"]==1 && $row[0]["close_date"]!='')
			{
			echo date("d-M-Y h:i:s A",strtotime($row[0]["close_date"]));
			}
			else
			{
				echo "";
			}
			
			?></td>
        </tr>
        <?php if($total_query3>0){?>
        <tr>
          <td colspan="2">-------------------------------------------</td>
        </tr>
        <tr>
          <td colspan="2"><table cellspacing="2" cellpadding="2">
              <tbody>
                <tr>
                  <td align="left">Req Forwarded to</td>
                  <td>Forward Comment</td>
                  <td>F/W Request Back Comment</td>
                </tr>
                <?php for($at=0;$at<count($forward_query3);$at++){?>
                <tr>
                  <td><?php echo $forward_query3[$at]["forward_req_user"];?></td>
                  <td><?php echo $forward_query3[$at]["forward_comment"];?></td>
                  <td><?php echo $forward_query3[$at]["forward_back_comment"];?></td>
                </tr>
                <?php } ?>
              </tbody>
            </table></td>
        </tr>
        <?php } ?>
      </tbody>
    </table>
  </div>
</div>
<? }
	else If($tablename=="sim_change")
	{
		$query = "SELECT * FROM ".$tablename." where id=".$RowId; 
		$row=select_query($query);
		$forward_query4 = select_query("SELECT * FROM forward_req_history where table_name='$tablename' and table_row_id=".$RowId);
		$total_query4 = count($forward_query4);
		
	?>
<div id="databox">
  <div class="heading">View Mobile Number Change</div>
  <div class="dataleft">
    <table cellspacing="2" cellpadding="2">
      <tbody>
        <tr>
          <td>Date </td>
          <td><?echo date("d-M-Y h:i:s A",strtotime($row[0]["date"]));?></td>
        </tr>
        <tr>
          <td>Request By</td>
          <td><?echo $row[0]["acc_manager"];?></td>
        </tr>
        <tr>
          <td>Account Manager</td>
          <td><?echo $row[0]["sales_manager"];?></td>
        </tr>
        <? $sql="SELECT Userid AS id,UserName AS sys_username FROM internalsoftware.addclient  WHERE Userid=".$row[0]["user_id"];
		$rowuser=select_query($sql);
		?>
        <tr>
          <td>Company Name </td>
          <td><?echo $row[0]["client"];?></td>
        </tr>
        <tr>
          <td>Registration No</td>
          <td><?echo $row[0]["reg_no"];?></td>
        </tr>
        <tr>
          <td>Old Mobile Number </td>
          <td><?echo $row[0]["old_sim"];?></td>
        </tr>
        <tr>
          <td>New Mobile Number </td>
          <td><?echo $row[0]["new_sim"];?></td>
        </tr>
        <tr>
          <td>Reason </td>
          <td><?echo $row[0]["reason"];?></td>
        </tr>
      </tbody>
    </table>
  </div>
  <div class="dataright">
    <table cellspacing="2" cellpadding="2">
      <tbody>
        <!--<tr><td>Support Approval</td>  <td><?if($row[0]["approve_status"]==1) echo "Approved"; else echo "Pending Approval"?></td></tr>-->
        <tr>
          <td><strong>Process Pending </strong></td>
          <td><strong>
            <? 	if($row[0]["sim_change_status"]==2 || ($row[0]["support_comment"]!="" && $row[0]["service_comment"]==""))
		{echo "Reply Pending at Request Side";}
		elseif($row[0]["sim_change_status"]==1 && $row[0]["final_status"]!=1){echo "Pending at Tech Support Team";}
		elseif($row[0]["final_status"]==1){echo "Process Done";} 
	 ?>
            </strong></td>
        </tr>
        <tr>
          <td>Account Comment</td>
          <td><?echo $row[0]["account_comment"];?></td>
        </tr>
        <tr>
          <td>Service Comment</td>
          <td><?echo $row[0]["service_comment"];?></td>
        </tr>
        <tr>
          <td>Support Comment</td>
          <td><?echo $row[0]["support_comment"];?></td>
        </tr>
        <tr>
          <td>Admin Comment</td>
          <td><?echo $row[0]["admin_comment"];?></td>
        </tr>
        <tr>
          <td>Req Forwarded to</td>
          <td><?echo $row[0]["forward_req_user"];?></td>
        </tr>
        <tr>
          <td>Forward Comment</td>
          <td><?echo $row[0]["forward_comment"];?></td>
        </tr>
        <tr>
          <td>F/W Request Back Comment</td>
          <td><?echo $row[0]["forward_back_comment"];?></td>
        </tr>
        <tr>
          <td>Approval Date</td>
          <td><?
			if($row[0]["approve_status"]==1 && $row[0]["approve_date"]!='')
			{
			echo date("d-M-Y h:i:s A",strtotime($row[0]["approve_date"]));
			}
			else
			{
				echo "";
			}
			
			?></td>
        </tr>
        <tr>
          <td>Closed By</td>
          <td><?echo $row[0]["req_close_by"];?></td>
        </tr>
        <?php if($row[0]["close_comment"]!=""){?>
        <tr>
          <td>Duplicate Close Reason</td>
          <td><?echo $row[0]["close_comment"];?></td>
        </tr>
        <?php } ?>
        <tr>
          <td>Closed Date</td>
          <td><?
			if($row[0]["final_status"]==1 && $row[0]["close_date"]!='')
			{
			echo date("d-M-Y h:i:s A",strtotime($row[0]["close_date"]));
			}
			else
			{
				echo "";
			}
			
			?></td>
        </tr>
        <?php if($total_query4>0){?>
        <tr>
          <td colspan="2">-------------------------------------------</td>
        </tr>
        <tr>
          <td colspan="2"><table cellspacing="2" cellpadding="2">
              <tbody>
                <tr>
                  <td align="left">Req Forwarded to</td>
                  <td>Forward Comment</td>
                  <td>F/W Request Back Comment</td>
                </tr>
                <?php for($at=0;$at<count($forward_query4);$at++){?>
                <tr>
                  <td><?php echo $forward_query4[$at]["forward_req_user"];?></td>
                  <td><?php echo $forward_query4[$at]["forward_comment"];?></td>
                  <td><?php echo $forward_query4[$at]["forward_back_comment"];?></td>
                </tr>
                <?php } ?>
              </tbody>
            </table></td>
        </tr>
        <?php } ?>
      </tbody>
    </table>
  </div>
</div>
<? } 
	else If($tablename=="device_lost")
	{
		$query = "SELECT * FROM ".$tablename." where id=".$RowId; 
		$row=select_query($query);
		$forward_query5 = select_query("SELECT * FROM forward_req_history where table_name='$tablename' and table_row_id=".$RowId);
		$total_query5 = count($forward_query5);

	?>
<div id="databox">
  <div class="heading">View Device Lost</div>
  <div class="dataleft">
    <table cellspacing="2" cellpadding="2">
      <tbody>
        <tr>
          <td>Date</td>
          <td><?echo date("d-M-Y h:i:s A",strtotime($row[0]["date"]));?></td>
        </tr>
        <tr>
          <td>Request By</td>
          <td><?echo $row[0]["acc_manager"];?></td>
        </tr>
        <tr>
          <td>Account Manager</td>
          <td><?echo $row[0]["sales_manager"];?></td>
        </tr>
        <? $sql="SELECT Userid AS id,UserName AS sys_username FROM internalsoftware.addclient  WHERE Userid=".$row[0]["user_id"];
		$rowuser=select_query($sql);
		?>
        <tr>
          <td>Client User Name </td>
          <td><?echo $rowuser[0]["sys_username"];?></td>
        </tr>
        <tr>
          <td>Company Name</td>
          <td><?echo $row[0]["client"];?></td>
        </tr>
        <tr>
          <td>Registration No </td>
          <td><?echo $row[0]["odd_reg_no"];?></td>
        </tr>
        <tr>
          <td>Device Model </td>
          <td><?echo $row[0]["odd_device_model"];?></td>
        </tr>
        <tr>
          <td>Device IMEI </td>
          <td><?echo $row[0]["odd_imei"];?></td>
        </tr>
        <tr>
          <td>Device Mobile Number </td>
          <td><?echo $row[0]["odd_sim"];?></td>
        </tr>
        <tr>
          <td>Date Of Installation </td>
          <td><?echo $row[0]["odd_instaltion_date"];?></td>
        </tr>
        <tr>
          <td>New Device Detail:---</td>
          <td></td>
        </tr>
        <tr>
          <td>Device Model </td>
          <td><?echo $row[0]["ndd_device_model"];?></td>
        </tr>
        <tr>
          <td>Device Id </td>
          <td><?echo $row[0]["ndd_device_id"];?></td>
        </tr>
        <tr>
          <td>Device IMEI</td>
          <td><?echo $row[0]["ndd_imei"];?></td>
        </tr>
        <tr>
          <td>Device Mobile Number </td>
          <td><?echo $row[0]["ndd_sim"];?></td>
        </tr>
        <tr>
          <td>Date</td>
          <td><?echo $row[0]["newdevice_addeddate"];?></td>
        </tr>
        <tr>
          <td>Reason </td>
          <td><?echo $row[0]["reason"];?></td>
        </tr>
      </tbody>
    </table>
  </div>
  <div class="dataright">
    <table cellspacing="2" cellpadding="2">
      <tbody>
        <!--<tr><td>Admin Approval</td>  <td><?if($row[0]["approve_status"]==1) echo "Approved"; else echo "Pending Approval"?></td></tr>-->
        <tr>
          <td><strong>Process Pending </strong></td>
          <td><strong>
            <?  if($row[0]["device_lost_status"]==2 || (($row[0]["support_comment"]!="" || $row[0]["admin_comment"]!="") && $row[0]["service_comment"]==""))
	{echo "Reply Pending at Request Side";}
	elseif($row[0]["account_comment"]=="" && $row[0]["odd_paid_unpaid"]=="" && $row[0]["approve_status"]==0 && $row[0]["final_status"]==0){echo "Pending at Accounts";} 
	elseif($row[0]["approve_status"]==0 && $row[0]["forward_req_user"]!="" && $row[0]["forward_back_comment"]=="" && $row[0]["device_lost_status"]==1)	
	{echo "Pending Admin Approval (Req Forward to ".$row[0]["forward_req_user"].")";}
	elseif($row[0]["approve_status"]==0 && ($row[0]["account_comment"]!="" || $row[0]["odd_paid_unpaid"]!="") && $row[0]["final_status"]==0 && $row[0]["device_lost_status"]==1)
	{echo "Pending Admin Approval";}
	elseif($row[0]["approve_status"]==1 && $row[0]["device_lost_status"]==1 && $row[0]["final_status"]!=1){echo "Pending at Tech Support Team";}
	elseif($row[0]["final_status"]==1){echo "Process Done";}?>
            </strong></td>
        </tr>
        <tr>
          <td>Account Comment</td>
          <td><?echo $row[0]["account_comment"];?></td>
        </tr>
        <tr>
          <td>Old Device Paid or Not</td>
          <td><?echo $row[0]["odd_paid_unpaid"];?></td>
        </tr>
        <tr>
          <td>Service Comment</td>
          <td><?echo $row[0]["service_comment"];?></td>
        </tr>
        <tr>
          <td>Support Comment</td>
          <td><?echo $row[0]["support_comment"];?></td>
        </tr>
        <tr>
          <td>Admin Comment</td>
          <td><?echo $row[0]["admin_comment"];?></td>
        </tr>
        <tr>
          <td>Req Forwarded to</td>
          <td><?echo $row[0]["forward_req_user"];?></td>
        </tr>
        <tr>
          <td>Forward Comment</td>
          <td><?echo $row[0]["forward_comment"];?></td>
        </tr>
        <tr>
          <td>F/W Request Back Comment</td>
          <td><?echo $row[0]["forward_back_comment"];?></td>
        </tr>
        <tr>
          <td>Approval Date</td>
          <td><?
			if($row[0]["approve_status"]==1 && $row[0]["approve_date"]!='')
			{
			echo date("d-M-Y h:i:s A",strtotime($row[0]["approve_date"]));
			}
			else
			{
				echo "";
			}
			
			?></td>
        </tr>
        <tr>
          <td>Closed By</td>
          <td><?echo $row[0]["req_close_by"];?></td>
        </tr>
        <tr>
          <td>Closed Date</td>
          <td><?
			if($row[0]["final_status"]==1 && $row[0]["close_date"]!='')
			{
			echo date("d-M-Y h:i:s A",strtotime($row[0]["close_date"]));
			}
			else
			{
				echo "";
			}
			
			?></td>
        </tr>
        <?php if($total_query5>0){?>
        <tr>
          <td colspan="2">-------------------------------------------</td>
        </tr>
        <tr>
          <td colspan="2"><table cellspacing="2" cellpadding="2">
              <tbody>
                <tr>
                  <td align="left">Req Forwarded to</td>
                  <td>Forward Comment</td>
                  <td>F/W Request Back Comment</td>
                </tr>
                <?php for($at=0;$at<count($forward_query5);$at++){?>
                <tr>
                  <td><?php echo $forward_query5[$at]["forward_req_user"];?></td>
                  <td><?php echo $forward_query5[$at]["forward_comment"];?></td>
                  <td><?php echo $forward_query5[$at]["forward_back_comment"];?></td>
                </tr>
                <?php } ?>
              </tbody>
            </table></td>
        </tr>
        <?php } ?>
      </tbody>
    </table>
  </div>
</div>
<?
	}
		else If($tablename=="device_lost")
	{
		$query = "SELECT * FROM ".$tablename." where id=".$RowId; 
		$row=select_query($query);
		$forward_query5 = select_query("SELECT * FROM forward_req_history where table_name='$tablename' and table_row_id=".$RowId);
		$total_query5 = count($forward_query5);

	?>
<div id="databox">
  <div class="heading">View Device Lost</div>
  <div class="dataleft">
    <table cellspacing="2" cellpadding="2">
      <tbody>
        <tr>
          <td>Date</td>
          <td><?echo date("d-M-Y h:i:s A",strtotime($row[0]["date"]));?></td>
        </tr>
        <tr>
          <td>Request By</td>
          <td><?echo $row[0]["acc_manager"];?></td>
        </tr>
        <tr>
          <td>Account Manager</td>
          <td><?echo $row[0]["sales_manager"];?></td>
        </tr>
        <? $sql="SELECT Userid AS id,UserName AS sys_username FROM internalsoftware.addclient  WHERE Userid=".$row[0]["user_id"];
		$rowuser=select_query($sql);
		?>
        <tr>
          <td>Client User Name </td>
          <td><?echo $rowuser[0]["sys_username"];?></td>
        </tr>
        <tr>
          <td>Company Name</td>
          <td><?echo $row[0]["client"];?></td>
        </tr>
        <tr>
          <td>Registration No </td>
          <td><?echo $row[0]["odd_reg_no"];?></td>
        </tr>
        <tr>
          <td>Device Model </td>
          <td><?echo $row[0]["odd_device_model"];?></td>
        </tr>
        <tr>
          <td>Device IMEI </td>
          <td><?echo $row[0]["odd_imei"];?></td>
        </tr>
        <tr>
          <td>Device Mobile Number </td>
          <td><?echo $row[0]["odd_sim"];?></td>
        </tr>
        <tr>
          <td>Date Of Installation </td>
          <td><?echo $row[0]["odd_instaltion_date"];?></td>
        </tr>
        <tr>
          <td>New Device Detail:---</td>
          <td></td>
        </tr>
        <tr>
          <td>Device Model </td>
          <td><?echo $row[0]["ndd_device_model"];?></td>
        </tr>
        <tr>
          <td>Device Id </td>
          <td><?echo $row[0]["ndd_device_id"];?></td>
        </tr>
        <tr>
          <td>Device IMEI</td>
          <td><?echo $row[0]["ndd_imei"];?></td>
        </tr>
        <tr>
          <td>Device Mobile Number </td>
          <td><?echo $row[0]["ndd_sim"];?></td>
        </tr>
        <tr>
          <td>Date</td>
          <td><?echo $row[0]["newdevice_addeddate"];?></td>
        </tr>
        <tr>
          <td>Reason </td>
          <td><?echo $row[0]["reason"];?></td>
        </tr>
      </tbody>
    </table>
  </div>
  <div class="dataright">
    <table cellspacing="2" cellpadding="2">
      <tbody>
        <!--<tr><td>Admin Approval</td>  <td><?if($row[0]["approve_status"]==1) echo "Approved"; else echo "Pending Approval"?></td></tr>-->
        <tr>
          <td><strong>Process Pending </strong></td>
          <td><strong>
            <?  if($row[0]["device_lost_status"]==2 || (($row[0]["support_comment"]!="" || $row[0]["admin_comment"]!="") && $row[0]["service_comment"]==""))
	{echo "Reply Pending at Request Side";}
	elseif($row[0]["account_comment"]=="" && $row[0]["odd_paid_unpaid"]=="" && $row[0]["approve_status"]==0 && $row[0]["final_status"]==0){echo "Pending at Accounts";} 
	elseif($row[0]["approve_status"]==0 && $row[0]["forward_req_user"]!="" && $row[0]["forward_back_comment"]=="" && $row[0]["device_lost_status"]==1)	
	{echo "Pending Admin Approval (Req Forward to ".$row[0]["forward_req_user"].")";}
	elseif($row[0]["approve_status"]==0 && ($row[0]["account_comment"]!="" || $row[0]["odd_paid_unpaid"]!="") && $row[0]["final_status"]==0 && $row[0]["device_lost_status"]==1)
	{echo "Pending Admin Approval";}
	elseif($row[0]["approve_status"]==1 && $row[0]["device_lost_status"]==1 && $row[0]["final_status"]!=1){echo "Pending at Tech Support Team";}
	elseif($row[0]["final_status"]==1){echo "Process Done";}?>
            </strong></td>
        </tr>
        <tr>
          <td>Account Comment</td>
          <td><?echo $row[0]["account_comment"];?></td>
        </tr>
        <tr>
          <td>Old Device Paid or Not</td>
          <td><?echo $row[0]["odd_paid_unpaid"];?></td>
        </tr>
        <tr>
          <td>Service Comment</td>
          <td><?echo $row[0]["service_comment"];?></td>
        </tr>
        <tr>
          <td>Support Comment</td>
          <td><?echo $row[0]["support_comment"];?></td>
        </tr>
        <tr>
          <td>Admin Comment</td>
          <td><?echo $row[0]["admin_comment"];?></td>
        </tr>
        <tr>
          <td>Req Forwarded to</td>
          <td><?echo $row[0]["forward_req_user"];?></td>
        </tr>
        <tr>
          <td>Forward Comment</td>
          <td><?echo $row[0]["forward_comment"];?></td>
        </tr>
        <tr>
          <td>F/W Request Back Comment</td>
          <td><?echo $row[0]["forward_back_comment"];?></td>
        </tr>
        <tr>
          <td>Approval Date</td>
          <td><?
			if($row[0]["approve_status"]==1 && $row[0]["approve_date"]!='')
			{
			echo date("d-M-Y h:i:s A",strtotime($row[0]["approve_date"]));
			}
			else
			{
				echo "";
			}
			
			?></td>
        </tr>
        <tr>
          <td>Closed By</td>
          <td><?echo $row[0]["req_close_by"];?></td>
        </tr>
        <tr>
          <td>Closed Date</td>
          <td><?
			if($row[0]["final_status"]==1 && $row[0]["close_date"]!='')
			{
			echo date("d-M-Y h:i:s A",strtotime($row[0]["close_date"]));
			}
			else
			{
				echo "";
			}
			
			?></td>
        </tr>
        <?php if($total_query5>0){?>
        <tr>
          <td colspan="2">-------------------------------------------</td>
        </tr>
        <tr>
          <td colspan="2"><table cellspacing="2" cellpadding="2">
              <tbody>
                <tr>
                  <td align="left">Req Forwarded to</td>
                  <td>Forward Comment</td>
                  <td>F/W Request Back Comment</td>
                </tr>
                <?php for($at=0;$at<count($forward_query5);$at++){?>
                <tr>
                  <td><?php echo $forward_query5[$at]["forward_req_user"];?></td>
                  <td><?php echo $forward_query5[$at]["forward_comment"];?></td>
                  <td><?php echo $forward_query5[$at]["forward_back_comment"];?></td>
                </tr>
                <?php } ?>
              </tbody>
            </table></td>
        </tr>
        <?php } ?>
      </tbody>
    </table>
  </div>
</div>
<?
}

else If($tablename=="deletion")
	{
		$query = "SELECT * FROM ".$tablename." where id=".$RowId; 
		$row=select_query($query);
		$forward_query6 = select_query("SELECT * FROM forward_req_history where table_name='$tablename' and table_row_id=".$RowId);
		$total_query6 = count($forward_query6);

	?>
<div id="databox">
  <div class="heading">Deletion Vehicle</div>
  <div class="dataleft">
    <table cellspacing="2" cellpadding="2">
      <tbody>
        <tr>
          <td>date</td>
          <td><?echo date("d-M-Y h:i:s A",strtotime($row[0]["date"]));?></td>
        </tr>
        <tr>
          <td>Request By</td>
          <td><?echo $row[0]["acc_manager"];?></td>
        </tr>
        <tr>
          <td>Account Manager</td>
          <td><?echo $row[0]["sales_manager"];?></td>
        </tr>
        <? $sql="SELECT Userid AS id,UserName AS sys_username FROM internalsoftware.addclient  WHERE Userid=".$row[0]["user_id"];
		$rowuser=select_query($sql);
		?>
        <tr>
          <td>Client User Name </td>
          <td><?echo $rowuser[0]["sys_username"];?></td>
        </tr>
        <tr>
          <td>Company Name </td>
          <td><?echo $row[0]["client"];?></td>
        </tr>
        <tr>
          <td>Registration No </td>
          <td><?echo $row[0]["reg_no"];?></td>
        </tr>
        <tr>
          <td>Device Model </td>
          <td><?echo $row[0]["device_model"];?></td>
        </tr>
        <tr>
          <td>Device IMEI </td>
          <td><?echo $row[0]["imei"];?></td>
        </tr>
        <tr>
          <td>Device Mobile Number </td>
          <td><?echo $row[0]["device_sim_no"];?></td>
        </tr>
        <tr>
          <td>Date Of Installation </td>
          <td><?echo $row[0]["date_of_installation"];?></td>
        </tr>
        <tr>
          <td>Present Status of device</td>
          <td>----------------------</td>
        </tr>
        <tr>
          <td>Device Status</td>
          <td><?echo $row[0]["device_status"];?></td>
        </tr>
        <tr>
          <td>Location </td>
          <td><?echo $row[0]["vehicle_location"];?></td>
        </tr>
        <tr>
          <td>Contact person </td>
          <td><?echo $row[0]["Contact_person"];?></td>
        </tr>
        <tr>
          <td>Deactivation of SIM </td>
          <td><?echo $row[0]["deactivation_of_sim"];?></td>
        </tr>
        <tr>
          <td>Reason</td>
          <td><?echo $row[0]["reason"];?></td>
        </tr>
      </tbody>
    </table>
  </div>
  <div class="dataright">
    <table cellspacing="2" cellpadding="2">
      <tbody>
        <!--<tr><td>Admin Approval</td>  <td><?if($row[0]["approve_status"]==1) echo "Approved"; else echo "Pending Approval"?></td></tr>-->
        <tr>
          <td><strong>Process Pending </strong></td>
          <td><strong>
            <?  if($row[0]["delete_veh_status"]==2 || (($row[0]["support_comment"]!="" || $row[0]["admin_comment"]!="") && $row[0]["service_comment"]==""))
	{echo "Reply Pending at Request Side";}
	elseif($row[0]["vehicle_location"]=="gtrack office" && $row[0]["stock_comment"]==""){echo "Pending at Stock";}
	elseif($row[0]["account_comment"]=="" && $row[0]["odd_paid_unpaid"]=="" && $row[0]["approve_status"]==0 && $row[0]["final_status"]==0){echo "Pending at Accounts";} 
	elseif($row[0]["approve_status"]==0 && $row[0]["forward_req_user"]!="" && $row[0]["forward_back_comment"]=="" && $row[0]["delete_veh_status"]==1)	
	{echo "Pending Admin Approval (Req Forward to ".$row[0]["forward_req_user"].")";}
	elseif($row[0]["approve_status"]==0 && ($row[0]["account_comment"]!="" || $row[0]["odd_paid_unpaid"]!="") && $row[0]["final_status"]==0 && $row[0]["delete_veh_status"]==1)
	{echo "Pending Admin Approval";}
	elseif($row[0]["approve_status"]==1 && $row[0]["delete_veh_status"]==1 && $row[0]["final_status"]!=1){echo "Pending at Tech Support Team";}
	elseif($row[0]["final_status"]==1){echo "Process Done";}?>
            </strong></td>
        </tr>
        <tr>
          <td>Account Comment</td>
          <td><?echo $row[0]["account_comment"];?></td>
        </tr>
        <tr>
          <td>Payment Pending</td>
          <td><?echo $row[0]["odd_paid_unpaid"];?></td>
        </tr>
        <tr>
          <td>Service Comment</td>
          <td><?echo $row[0]["service_comment"];?></td>
        </tr>
        <tr>
          <td>Support Comment</td>
          <td><?echo $row[0]["support_comment"];?></td>
        </tr>
        <tr>
          <td>Admin Comment</td>
          <td><?echo $row[0]["admin_comment"];?></td>
        </tr>
        <tr>
          <td>Req Forwarded to</td>
          <td><?echo $row[0]["forward_req_user"];?></td>
        </tr>
        <tr>
          <td>Forward Comment</td>
          <td><?echo $row[0]["forward_comment"];?></td>
        </tr>
        <tr>
          <td>F/W Request Back Comment</td>
          <td><?echo $row[0]["forward_back_comment"];?></td>
        </tr>
        <tr>
          <td>Approval Date</td>
          <td><?
			if($row[0]["approve_status"]==1 && $row[0]["approve_date"]!='')
			{
			echo date("d-M-Y h:i:s A",strtotime($row[0]["approve_date"]));
			}
			else
			{
				echo "";
			}
			
			?></td>
        </tr>
        <tr>
          <td>Closed By</td>
          <td><?echo $row[0]["req_close_by"];?></td>
        </tr>
        <tr>
          <td>Closed Date</td>
          <td><?
			if($row[0]["final_status"]==1 && $row[0]["close_date"]!='')
			{
			echo date("d-M-Y h:i:s A",strtotime($row[0]["close_date"]));
			}
			else
			{
				echo "";
			}
			
			?></td>
        </tr>
        <?php if($total_query6>0){?>
        <tr>
          <td colspan="2">-------------------------------------------</td>
        </tr>
        <tr>
          <td colspan="2"><table cellspacing="2" cellpadding="2">
              <tbody>
                <tr>
                  <td align="left">Req Forwarded to</td>
                  <td>Forward Comment</td>
                  <td>F/W Request Back Comment</td>
                </tr>
                <?php for($at=0;$at<count($forward_query6);$at++){?>
                <tr>
                  <td><?php echo $forward_query6[$at]["forward_req_user"];?></td>
                  <td><?php echo $forward_query6[$at]["forward_comment"];?></td>
                  <td><?php echo $forward_query6[$at]["forward_back_comment"];?></td>
                </tr>
                <?php } ?>
              </tbody>
            </table></td>
        </tr>
        <?php } ?>
      </tbody>
    </table>
  </div>
</div>
<?
}

elseIf($tablename=="debtor_show")
    {
			$sql_query = select_query("select dpb.company_name, sp.name as sales_manager, ca.name as collection_agent 
			 from debtor_pending_billing as dpb left join sales_person as sp on dpb.sales_manager=sp.id left join 
			 collection_agent as ca on dpb.collection_agent=ca.id where dpb.client_id='".$RowId."' limit 1");
			
			$pndg_sub_query = select_query("select dpb.client_id,dpb.company_name, dpb.month,dpb.year, dpb.device_amount_pending, 
											dpb.rent_amount_pending, dpb.accessory_amount_pending, dpb.req_time from 
											debtor_pending_billing as dpb where dpb.client_id='".$RowId."'");
			
			$recd_sub_query = select_query("SELECT client_id,company_name, `month`, `year`, SUM(device_amount_recd) AS device_amount_recd, 
											SUM(rent_amount_recd) AS rent_amount_recd, SUM(accessory_amount_recd) AS accessory_amount_recd,  
											SUM(discounting) AS discounting, SUM(tds_amount) AS tds_amount, received_time
											FROM debtor_received_billing WHERE client_id='".$RowId."' GROUP BY YEAR,MONTH ");


    ?>
<div id="databox">
  <div class="heading">View Debtors Details</div>
  <div class="dataleft">
    <table cellspacing="2" cellpadding="2">
      <tbody>
        <tr>
          <td>Company Name </td>
          <td><?echo $sql_query[0]["company_name"];?></td>
        </tr>
        <tr>
          <td>Account Manager</td>
          <td><?echo $sql_query[0]["sales_manager"];?></td>
        </tr>
        <tr>
          <td>Collection Agent</td>
          <td><?echo $sql_query[0]["collection_agent"];?></td>
        </tr>
      </tbody>
    </table>
    <div class="fix-height">
      <table >
        <tr>
          <th colspan="2" align="right">Pending Debtor</th>
        </tr>
        <tbody>
          <?

for($sq=0;$sq<count($pndg_sub_query);$sq++)
	{
		$monthyear = $pndg_sub_query[$sq]["year"].'-'.$pndg_sub_query[$sq]["month"];
	    $pending_month = date('F Y', strtotime($monthyear));
?>
          <tr>
            <th colspan="2" align="left"><?=$pending_month;?></th>
          </tr>
          <tr>
            <td>Device Pending</td>
            <td><?echo $pndg_sub_query[$sq]["device_amount_pending"];?></td>
          </tr>
          <tr>
            <td>Rent Pending</td>
            <td><?echo $pndg_sub_query[$sq]["rent_amount_pending"];?></td>
          </tr>
          <tr>
            <td>Accessory pending </td>
            <td><?echo $pndg_sub_query[$sq]["accessory_amount_recd"];?></td>
          </tr>
          <? } ?>
        </tbody>
      </table>
    </div>
  </div>
  <div class="dataright fix-height2">
    <table cellspacing="2" cellpadding="2">
      <? 
if(count($recd_sub_query) > 0)
{

?>
      <tr>
        <th colspan="2" align="right">Received Amount</th>
      </tr>
      <tbody>
        <?

for($rs=0;$rs<count($recd_sub_query);$rs++)
	{
		$monthyear = $recd_sub_query[$rs]["year"].'-'.$recd_sub_query[$rs]["month"];
	    $pending_month = date('F Y', strtotime($monthyear));
?>
        <tr>
          <th colspan="2" align="left"><?=$pending_month;?></th>
        </tr>
        <tr>
          <td>Device Amount Recd</td>
          <td><?echo $recd_sub_query[$rs]["device_amount_recd"];?></td>
        </tr>
        <tr>
          <td>Rent Amount Recd</td>
          <td><?echo $recd_sub_query[$rs]["rent_amount_recd"];?></td>
        </tr>
        <tr>
          <td>Accessory Amount Recd </td>
          <td><?echo $recd_sub_query[$rs]["accessory_amount_recd"];?></td>
        </tr>
        <tr>
          <td>Discounting </td>
          <td><?echo $recd_sub_query[$rs]["discounting"];?></td>
        </tr>
        <tr>
          <td>TDS Amount </td>
          <td><?echo $recd_sub_query[$rs]["tds_amount"];?></td>
        </tr>
        <? }  ?>
      </tbody>
      <? } else { ?>
      <tr>
        <td colspan="2">&nbsp;</td>
      </tr>
      <tr>
        <th colspan="2" align="right">No Received Amount</th>
      </tr>
      <? } ?>
    </table>
  </div>
</div>
<? }

}
?>
