<?php
include("../connection.php");
include_once(__DOCUMENT_ROOT.'/include/header.php');
include_once(__DOCUMENT_ROOT.'/include/leftmenu_service.php');

/*include($_SERVER['DOCUMENT_ROOT']."/format/include/header.php");
include($_SERVER['DOCUMENT_ROOT']."/format/include/leftmenu_service.php");*/
 
?>
<script>
function forwardbackComment(row_id)
{
   var retVal = prompt("Write Comment : ", "Comment");
  if (retVal)
  {
  addComment(row_id,retVal);
      return ture;
  }
  else
    return false;
}

function addComment(row_id,retVal)
{
	//alert(user_id);
	//return false;
$.ajax({
		type:"GET",
		url:"userInfo.php?action=deletevehiclebackComment",
 		 
		 data:"row_id="+row_id+"&comment="+retVal,
		success:function(msg){
			 alert(msg);
			 
		 
		location.reload(true);		
		}
	});
}
</script>

<div class="top-bar">
  <div align="center">
    <form name="myformlisting" method="post" action="">
      <select name="Showrequest" id="Showrequest" onChange="form.submit();" >
        <option value="0" <? if($_POST['Showrequest']==0){ echo 'Selected'; }?>>Select</option>
        <option value=3 <?if($_POST['Showrequest']==3){ echo "Selected"; }?>>Approved</option>
        <option value="" <?if($_POST['Showrequest']==''){ echo "Selected"; }?>>Pending+Admin Forward</option>
        <option value="1" <?if($_POST['Showrequest']==1){ echo "Selected"; }?>>Closed</option>
        <option value="5" <?if($_POST['Showrequest']==5){ echo "Selected"; }?>>Backed from support</option>
        <option value="4" <?if($_POST['Showrequest']==4){ echo "Selected"; }?>>Action Taken</option>
        <option value="2" <?if($_POST['Showrequest']==2){ echo "Selected" ;}?>>All</option>
      </select>
    </form>
  </div>
  <a href="delete_veh.php" class="button">ADD NEW </a>
  <h1>Deletion List</h1>
</div>
<div class="top-bar">
  <div style="float:right";><font style="color:#B6B6B4;font-weight:bold;">Grey:</font> Approved</div>
  <br/>
  <div style="float:right";><font style="color:#68C5CA;font-weight:bold;">Blue:</font> Back from support</div>
  <br/>
  <div style="float:right";><font style="color:#FF0000;font-weight:bold;">Red:</font> Back from Admin</div>
  <br/>
  <!--<div style="float:right";><font style="color:#F2F5A9;font-weight:bold;">Yellow:</font> Back from Admin</div><br/>-->
  <div style="float:right";><font style="color:#CFBF7E;font-weight:bold;">Brown:</font>Admin forward request</div>
  <br/>
  <div style="float:right";><font style="color:#99FF66;font-weight:bold;">Green:</font> Completed your requsest.</div>
</div>
<div class="table">
  <?php
 
if($_POST["Showrequest"]==1)
 {
	  $WhereQuery=" where approve_status=1 and final_status=1 and (acc_manager='".$_SESSION['user_name']."' or forward_req_user='".$_SESSION["user_name"]."')";
 }
 else if($_POST["Showrequest"]==2)
 {
	 $WhereQuery=" where (acc_manager='".$_SESSION['user_name']."' or forward_req_user='".$_SESSION["user_name"]."') ";
 }
 else if($_POST["Showrequest"]==3)
 {
	 $WhereQuery=" where approve_status=1 and final_status!=1 and support_comment is null and (acc_manager='".$_SESSION['user_name']."' or forward_req_user='".$_SESSION["user_name"]."')";
 }
 else if($_POST["Showrequest"]==4)
 {
	 $WhereQuery=" where (service_comment!='' or forward_back_comment!='') and (acc_manager='".$_SESSION['user_name']."' or forward_req_user='".$_SESSION["user_name"]."')";
 }
 else if($_POST["Showrequest"]==5)
 {
	 $WhereQuery=" where approve_status=1 and final_status!=1 and support_comment!='' and (acc_manager='".$_SESSION['user_name']."' or forward_req_user='".$_SESSION["user_name"]."')";
 }
 else
 { 
	  $WhereQuery=" where ((approve_status=0 or approve_status=1) and final_status!=1) and (service_comment is null or delete_veh_status=2) and (acc_manager='".$_SESSION['user_name']."' or (forward_req_user='".$_SESSION["user_name"]."' and (forward_back_comment is null or forward_back_comment='')))";
  
 } 
 $query = select_query("SELECT * FROM deletion  ". $WhereQuery." order by id DESC ");


?>
  <table cellpadding="0" cellspacing="0" border="0" class="display" id="example">
    <thead>
      <tr>
        <th>SL.No</th>
        <th>Date</th>
        <th>Account Manager</th>
        <th>User Name</th>
        <th>Vehicle Number</th>
        <th>Device IMEI</th>
        <th>Device SIM</th>
        <th>Current Location</th>
        <th>Device Status</th>
        <!--<th>Contact Person</th>
            <th>Payment status</th>-->
        <th>Reason</th>
        <th>Current Status</th>
        <th>View Detail</th>
        <th>Edit</th>
      </tr>
    </thead>
    <tbody>
      <?php 
//while($row=mysql_fetch_array($query))
for($i=0;$i<count($query);$i++)
{
?>
      <!--<tr align="center" <?// if( $query[$i]["support_comment"]!="" && $query[$i]["final_status"]!=1 ){ echo 'style="background-color:#68C5CA"';} elseif($query[$i]["final_status"]==1){ echo 'style="background-color:#99FF66"';}elseif( $query[$i]["forward_comment"]!="" && $query[$i]["forward_req_user"]!="" ){ echo 'style="background-color:#CFBF7E"';}elseif($query[$i]["odd_paid_unpaid"]!="" && $query[$i]["odd_paid_unpaid"]!="Payment cleared"){ echo 'style="background-color:#FF0000"';}elseif($query[$i]["approve_status"]==1){ echo 'style="background-color:#B6B6B4"';}elseif( $query[$i]["admin_comment"]!="" && $query[$i]["final_status"]!=1 ){ echo 'style="background-color:#F2F5A9"';}?> >-->
      
      <tr align="center" <? if( $query[$i]["support_comment"]!="" && $query[$i]["final_status"]!=1 ){ echo 'style="background-color:#68C5CA"';} elseif($query[$i]["final_status"]==1){ echo 'style="background-color:#99FF66"';}elseif( $query[$i]["forward_comment"]!="" && $query[$i]["forward_req_user"]!="" ){ echo 'style="background-color:#CFBF7E"';}elseif($query[$i]["admin_comment"]!="" && $query[$i]["approve_status"]==0){ echo 'style="background-color:#FF0000"';}elseif($query[$i]["approve_status"]==1){ echo 'style="background-color:#B6B6B4"';}elseif( $query[$i]["admin_comment"]!="" && $query[$i]["final_status"]!=1 ){ echo 'style="background-color:#F2F5A9"';}?> >
        <td><?php echo $i+1;?></td>
        <td><?php echo $query[$i]["date"];?></td>
        <td><?php echo $query[$i]["sales_manager"];?></td>
        <? $sql="SELECT Userid AS id,UserName AS sys_username FROM addclient  WHERE Userid=".$query[$i]["user_id"];
        $rowuser=select_query($sql);
        ?>
        <td><?php echo $rowuser[0]["sys_username"];?></td>
        <td><?php echo $query[$i]["reg_no"];?></td>
        <td><?php echo $query[$i]["imei"];?></td>
        <td><?php echo $query[$i]["device_sim_no"];?></td>
        <td><?php echo $query[$i]["vehicle_location"];?></td>
        <td><?php echo $query[$i]["device_status"];?></td>
        <!--<td><?php //echo $query[$i]["Contact_person"];?></td> 
        <td><?php //echo $query[$i]["payment_status"];?></td>-->

        <td><?php echo $query[$i]["reason"];?></td>
        <td><strong>
            <?  if($query[0]["delete_veh_status"]==2 || (($query[0]["support_comment"]!="" || $query[0]["admin_comment"]!="") && $query[0]["service_comment"]==""))
    {echo "Reply Pending at Request Side";}
    elseif($query[0]["vehicle_location"]=="gtrack office" && $query[0]["stock_comment"]==""){echo "Pending at Stock";}
    elseif($query[0]["account_comment"]=="" && $query[0]["odd_paid_unpaid"]=="" && $query[0]["approve_status"]==0 && $query[0]["final_status"]==0){echo "Pending at Accounts";}
    elseif($query[0]["approve_status"]==0 && $query[0]["forward_req_user"]!="" && $query[0]["forward_back_comment"]=="" && $query[0]["delete_veh_status"]==1)   
    {echo "Pending Admin Approval (Req Forward to ".$query[0]["forward_req_user"].")";}
    elseif($query[0]["approve_status"]==0 && ($query[0]["account_comment"]!="" || $query[0]["odd_paid_unpaid"]!="") && $query[0]["final_status"]==0 && $query[0]["delete_veh_status"]==1)
    {echo "Pending Admin Approval";}
    elseif($query[0]["approve_status"]==1 && $query[0]["delete_veh_status"]==1 && $query[0]["final_status"]!=1){echo "Pending at Tech Support Team";}
    elseif($query[0]["final_status"]==1){echo "Process Done";}?>
            </strong></td>
        <td><a href="#" onclick="Show_record(<?php echo $query[$i]["id"];?>,'deletion','popup1'); " class="topopup">View Detail</a>
          <? 
        if( $query[$i]["forward_comment"]!="" && $query[$i]["forward_req_user"]==$_SESSION["user_name"]){ ?>
          |<a href="#" onclick="return forwardbackComment(<?php echo $query[$i]["id"];?>);"  >Forward Back Comment</a>
          <? }?></td>
        <td><?php 
        if(( $query[$i]["support_comment"]!="" or $query[$i]["admin_comment"]!="" or $query[$i]["odd_paid_unpaid"]!="") && $query[$i]["final_status"]!=1 ) {?>
          <a href="delete_veh.php?id=<?=$query[$i]['id'];?>&action=edit<? echo $pg;?>">Edit</a> 
          <!--<td width="12%" align="center">&nbsp;<a href="services.php?id=<?php echo $query[$i]['id'];?>&action=delete">Delete</a></td>-->
          
          <?php } ?></td>
      </tr>
      <?php  }?>
  </table>
  <div id="toPopup">
    <div class="close">close</div>
    <span class="ecs_tooltip">Press Esc to close <span class="arrow"></span></span>
    <div id="popup1" style ="height:100%;width:100%"> <!--your content start--> 
      
    </div>
    <!--your content end--> 
    
  </div>
  <!--toPopup end-->
  
  <div class="loader"></div>
  <div id="backgroundPopup"></div>
</div>
<?php
include("../include/footer.php"); ?>
