<?php 
include("../connection.php");
include_once(__DOCUMENT_ROOT.'/include/header.php');
include_once(__DOCUMENT_ROOT.'/include/leftmenu_admin.php');

if($_GET["rowid"])
{
	echo $_GET["rowid"];
}

?>

 
 <div class="top-bar">
    <div align="center">
        <form name="myformlisting" method="post" action="">
            <select name="Showrequest" id="Showrequest" onchange="form.submit();" >
                <option value="0" <? if($_POST['Showrequest']==0){ echo 'Selected'; }?>>Select</option>
                <option value=3 <?if($_POST['Showrequest']==3){ echo "Selected"; }?>>Approved</option>
                <option value="" <?if($_POST['Showrequest']==''){ echo "Selected"; }?>>Pending</option>
                <option value="1" <?if($_POST['Showrequest']==1){ echo "Selected"; }?>>Closed</option>
                <option value="2" <?if($_POST['Showrequest']==2){ echo "Selected" ;}?>>All</option>
            
            </select>
        </form>
    </div>  
    	 <a href="NewAccountCreation.php" class="button">ADD NEW </a> 
        <h1>New Account Request</h1>
          
    </div>
                   
    <div class="top-bar">
                
    <div style="float:right";><font style="color:#B6B6B4;font-weight:bold;">Grey:</font> Approved</div>
    <br/>
    <div style="float:right";><font style="color:#68C5CA;font-weight:bold;">Blue:</font> Back from support</div>
    <br/>
    <div style="float:right";><font style="color:#99FF66;font-weight:bold;">Green:</font> Completed your requsest.</div>
    <br/>
    <div style="float:right";><font style="color:#F6F;font-weight:bold;">Pink:</font> Add Model requsest.</div>
    <br/>
    </div>
            
    <div class="table">
<?php
 
 if($_POST["Showrequest"]==1)
 {
	  $WhereQuery=" where approve_status=1 and final_status=1 and account_manager='".$_SESSION['user_name']."'";
 }
 else if($_POST["Showrequest"]==2)
 {
	 $WhereQuery=" where account_manager='".$_SESSION['user_name']."' ";
 }
 else if($_POST["Showrequest"]==3)
 {
	 $WhereQuery=" where approve_status=1 and final_status!=1 and account_manager='".$_SESSION['user_name']."'";
 }
 else
 { 
	  
	 $WhereQuery=" where (approve_status=0 or (approve_status=1 and support_comment!='' and final_status!=1)) and (sales_comment is null or acc_creation_status=2) and account_manager='".$_SESSION['user_name']."'";
  
 }
  
$query = select_query("SELECT * FROM new_account_creation ". $WhereQuery."  order by id DESC ");

?>
 <table cellpadding="0" cellspacing="0" border="0" class="display" id="example">
	<thead>
		<tr>
            <!--<th>SL.No</th>-->
            <th>Date</th>
            <th>Account Manager</th>
            <th>Company</th>
            <th>UserName</th>
            <th>Potential</th>
            <th>Account Type</th>
            <th>mode of payment</th>
            <th>Device Price</th>
            <th>Rent</th>
            <th>Device Model</th>
            <th>No of Model</th>
            <th>Branch</th>
            <th>Current Status</th>
            <th>View Detail</th>
            <th>Action</th>
      </tr>
	</thead>
	<tbody>


 
<?php 
//while($row=mysql_fetch_array($query))
for($i=0;$i<count($query);$i++)
{
	if($_POST["Showrequest"]==1  || $_POST["Showrequest"]==3)
	{
		$ModelData = select_query("select * from new_account_model_master where is_active='1' and new_account_reqid='".$query[$i]['id']."' ");
	} else {
		$ModelData = select_query("select * from new_account_model_master where is_active='0' and new_account_reqid='".$query[$i]['id']."' ");
	}
	
	$getmodel = select_query("SELECT * FROM internalsoftware.item_master  WHERE item_id=".$ModelData[0]["device_model"]);
	$modelcount = count($ModelData);
	
	if($query[$i]["branch_id"]==1){ $branch = "Delhi";}
	elseif($query[$i]["branch_id"]==2){ $branch = "Mumbai";}
	elseif($query[$i]["branch_id"]==3){ $branch = "Jaipur";}
	elseif($query[$i]["branch_id"]==4){ $branch = "Sonipath";}
	elseif($query[$i]["branch_id"]==6){ $branch = "Ahmedabad";}
	elseif($query[$i]["branch_id"]==7){ $branch = "Kolkata";}
	
?>
 
 <tr align="center" <? if( $query[$i]["support_comment"]!="" && $query[$i]["final_status"]!=1 ){ echo 'style="background-color:#68C5CA"';} elseif($query[$i]["approve_status"]==1 && $query[$i]["final_status"]==1){ echo 'style="background-color:#99FF66"';}elseif( $query[$i]["forward_comment"]!="" && $query[$i]["forward_req_user"]!="" ){ echo 'style="background-color:#CFBF7E"';}elseif($query[$i]["approve_status"]==1 && $query[$i]["final_status"]!=1){ echo 'style="background-color:#B6B6B4"';}elseif( $query[$i]["admin_comment"]!="" && $query[$i]["final_status"]!=1 ){ echo 'style="background-color:#F2F5A9"';}elseif($query[$i]["approve_status"]==0 && $query[$i]["final_status"]==1 && $query[$i]["model_status"]==1 && $query[$i]["admin_comment"]==""){ echo 'style="background-color:#F6F"';}elseif($query[$i]["admin_comment"]!="" && $query[$i]["final_status"]==1 && $query[$i]["model_status"]==1){ echo 'style="background-color:#FC6"';}?> >
 
  <!--<td><?php echo $i+1;?></td>-->
  <td><?php echo $query[$i]["date"];?></td> 
  <td><?php echo $query[$i]["sales_manager"];?></td>
  <td><?php echo $query[$i]["company"];?></td>
  <td><?php echo $query[$i]["user_name"];?></td>
  <td><?php echo $query[$i]["potential"];?></td>
  <?php
	 if($modelcount>0){
	  if($ModelData[0]["mode_of_payment"]=="CashClient") {
		  $device_price=$ModelData[0]["device_price"];
		  $device_rent=$ModelData[0]["device_rent_Price"];
	  }
	  else if($ModelData[0]["mode_of_payment"]=="Billed") {
		  $device_price=$ModelData[0]["device_price"];
		  $device_rent=$ModelData[0]["device_rent_Price"];
	  }
	  else
	  {
		   $device_price=$ModelData[0]["device_price_total"];
		   $device_rent=$ModelData[0]["DTotalREnt"];
	  }
	  ?>
	<td><?php echo $ModelData[0]["account_type"];?></td>
	<td><?php echo $ModelData[0]["mode_of_payment"];?></td>
	<td><?php echo $device_price;?></td>
	<td><?php echo $device_rent;?></td>
	<td><?php echo $getmodel[0]["item_name"];?></td>
	
	<?php } else {
	  if($query[$i]["mode_of_payment"]=="Cash") {
		  $device_price=$query[$i]["device_price_total"];
		  $device_rent=$query[$i]["DTotalREnt"];
	  }
	  else if($query[$i]["mode_of_payment"]=="Cheque") {
		  $device_price=$query[$i]["device_price"];
		  $device_rent=$query[$i]["device_rent_Price"];
	  }
	  else
	  {
		   $device_price=$query[$i]["device_price_total"];
		   $device_rent=$query[$i]["DTotalREnt"];
	  }
	  ?>
	<td><?php echo $query[$i]["account_type"];?></td>
	<td><?php echo $query[$i]["mode_of_payment"];?></td>
	<td><?php echo $device_price;?></td>
	<td><?php echo $device_rent;?></td>
	<td><?php echo $query[$i]["device_model"];?></td>
	<?php } ?>
	<td><?=$modelcount;?></td>
	<td><?php echo $branch;?> </td>
 	<td><?  if($query[$i]["acc_creation_status"]==2 || (($query[$i]["support_comment"]!="" || $query[$i]["admin_comment"]!="") && $query[$i]["sales_comment"]==""))
    {echo "Reply Pending at Request Side";}
    elseif($query[$i]["approve_status"]==0 && $query[$i]["forward_req_user"]!="" && $query[$i]["forward_back_comment"]=="" && $query[$i]["acc_creation_status"]==1)   
    {echo "Pending Admin Approval (Req Forward to ".$query[$i]["forward_req_user"].")";}
    elseif($query[$i]["approve_status"]==0 && $query[$i]["acc_creation_status"]==1)
    {echo "Pending Admin Approval";}
    elseif($query[$i]["approve_status"]==1 && $query[$i]["acc_creation_status"]==1 && $query[$i]["final_status"]!=1){echo "Pending at Tech Support Team";}
    elseif($query[$i]["approve_status"]==1 && $query[$i]["final_status"]==1){echo "Process Done";}?></td>
    
    <td><a href="#" onclick="Show_record(<?php echo $query[$i]["id"];?>,'new_account_creation','popup1'); " class="topopup">View Detail</a></td>
  
  
  <td><?php if($_POST["Showrequest"]!=1 && $_POST["Showrequest"]!=2){		 
	  if(($query[$i]["admin_comment"]!="" && $query[$i]["approve_status"]!=1 && $query[$i]["model_status"]==0) or ($query[$i]["approve_status"]!=1 && $query[$i]["model_status"]==0)) {?>
		<a href="NewAccountCreation.php?id=<?=$query[$i]['id'];?>&action=edit<? echo $pg;?>">Edit</a> 
	  <?php } else if($query[$i]["support_comment"]!="" && $query[$i]["final_status"]!=1 && $query[$i]["model_status"]==0) { ?>
		<a href="NewAccountCreation.php?id=<?=$query[$i]['id'];?>&action=editp<? echo $pg;?>">Edit</a> 
	  <?php } else if(($query[$i]["admin_comment"]!="" && $query[$i]["approve_status"]!=1 && $query[$i]["model_status"]==1) or ($query[$i]["approve_status"]!=1 && $query[$i]["model_status"]==1)) { ?>
		<a href="client_model_add.php?id=<?=$query[$i]['id'];?>&action=edit<? echo $pg;?>">Edit</a>
	  <?php } 
	  }
	  if($_POST["Showrequest"]==1){	?>
	  <?php if($query[$i]["final_status"]==1 && $query[$i]["close_date"]!='') { ?>
	  <a href="client_model_add.php?id=<?=$query[$i]['id'];?>">Add Model</a>
	  <?php } }?>
	  
	  </td>

	</tr> 
  <?php  }?>
</table>
     
<div id="toPopup" > 
    	
        <div class="close">close</div>
       	<span class="ecs_tooltip">Press Esc to close <span class="arrow"></span></span>
		<div id="popup1" > <!--your content start-->
            

 
        </div> <!--your content end-->
    
    </div> <!--toPopup end-->
    
	<div class="loader"></div>
   	<div id="backgroundPopup"></div>
</div>
 

 
<?php
include("../include/footer.php"); ?>
 