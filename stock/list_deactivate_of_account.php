<?php
include("../connection.php");
include_once(__DOCUMENT_ROOT.'/include/header.php');
include_once(__DOCUMENT_ROOT.'/include/leftmenu_stock.php');

/*include($_SERVER['DOCUMENT_ROOT']."/format/include/header.php");
include($_SERVER['DOCUMENT_ROOT']."/format/include/leftmenu_stock.php");*/


?>
<script>
function StockComment(row_id)
{
  var retVal = prompt("Write Comment : ", "Comment");
  if (retVal)
  {
  addStockComment(row_id,retVal);
      return ture;
  }
  else
    return false;
}

function addStockComment(row_id,retVal)
{
	//alert(user_id);
	//return false;
$.ajax({
		type:"GET",
		url:"userInfo.php?action=deact_of_accStockComment",
 		 
		 data:"row_id="+row_id+"&Stockcomment="+retVal,
		success:function(msg){
			 alert(msg);
			 
		 
		location.reload(true);		
		}
	});
}
function DeviceComment(row_id)
{
   var retVal = prompt("No of Devices Removed-: ", "Comment");
  if (retVal)
  {
  addDeviceComment(row_id,retVal);
      return ture;
  }
  else
    return false;
}

function addDeviceComment(row_id,retVal)
{
	//alert(user_id);
	//return false;
$.ajax({
		type:"GET",
		url:"userInfo.php?action=deactivation_of_accountDeviceComment",
 		 
		 data:"row_id="+row_id+"&Devicecomment="+retVal,
		success:function(msg){
			 alert(msg);
			 
		 
		location.reload(true);		
		}
	});
}

function backComment(row_id)
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
		url:"userInfo.php?action=deactivation_of_accountbackComment",
 		 
		 data:"row_id="+row_id+"&backcomment="+retVal,
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
      <select name="Showrequest" id="Showrequest" onchange="form.submit();" >
        <option value="0" <? if($_POST['Showrequest']==0){ echo 'Selected'; }?>>Select</option>
        <option value=3 <?if($_POST['Showrequest']==3){ echo "Selected"; }?>>Admin Approved</option>
        <option value="" <?if($_POST['Showrequest']==''){ echo "Selected"; }?>>Pending+Admin Forward</option>
        <option value="4" <?if($_POST['Showrequest']==4){ echo "Selected"; }?>>Action Taken</option>
        <option value="1" <?if($_POST['Showrequest']==1){ echo "Selected"; }?>>Closed</option>
        <option value="2" <?if($_POST['Showrequest']==2){ echo "Selected" ;}?>>All</option>
      </select>
    </form>
  </div>
  <h1>Deactivation of account</h1>
</div>
<div class="top-bar">
  <div style="float:right";><font style="color:#B6B6B4;font-weight:bold;">Grey:</font>Admin Approved</div>
  <br/>
  <div style="float:right";><font style="color:#83A3D8;font-weight:bold;">Blue:</font> Back from stock</div>
  <br/>
  <div style="float:right";><font style="color:#99FF66;font-weight:bold;">Green:</font> Completed your requsest.</div>
</div>
<div class="table">
  <?php
 
 if($_POST["Showrequest"]==1)
 {
	  $WhereQuery=" where user_id IN($user) and no_device_removed!='' and approve_status=1 and final_status=1";
 }
 else if($_POST["Showrequest"]==2)
 {
	 $WhereQuery="where user_id IN($user)";
 }
  else if($_POST["Showrequest"]==3)
 {
	 $WhereQuery=" where user_id IN($user) and no_device_removed!='' and approve_status=1 and final_status!=1";
 }
 else if($_POST["Showrequest"]==4)
 {
	 $WhereQuery=" where user_id IN($user) and (no_device_removed!='' and approve_status=0) or (forward_back_comment!='' and forward_req_user='".$_SESSION["user_name"]."') ";
 }
  else
 { 
	 $WhereQuery=" where user_id IN($user) and (approve_status=0 or approve_status=2) and ((device_remove_status='Y' and no_device_removed is null ) or (forward_req_user='".$_SESSION["user_name"]."' and (forward_back_comment is null or forward_back_comment='')))";
	   
 }
 

$query = select_query("SELECT * FROM deactivation_of_account ". $WhereQuery."   order by id desc ");   

?>
  <table cellpadding="0" cellspacing="0" border="0" class="display" id="example">
    <thead>
      <tr>
        <th>SL No</th>
        <th>Date</th>
        <th>Account Manager</th>
        <th>Client</th>
        <th>Total No Of Vehicles</th>
        <th>Deactivate Temporary</th>
        <th>Payment status</th>
        <th>Reason</th>
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
      <tr align="center" <? if($query[$i]["no_device_removed"]!="" && $query[$i]["final_status"]==1){ echo 'style="background-color:#99FF66"';}elseif($query[$i]["no_device_removed"]!="" && $query[$i]["approve_status"]==1){ echo 'style="background-color:#B6B6B4"';}elseif($query[$i]["stock_comment"]!=""){ echo 'style="background-color:#83A3D8"';}?> >
        <td><?php echo $i+1; ?></td>
        <td><?php echo $query[$i]["date"];?></td>
        <td><?php echo $query[$i]["acc_manager"];?></td>
        <? $sql="SELECT Userid AS id,UserName AS sys_username FROM addclient  WHERE Userid=".$query[$i]["user_id"];
	$rowuser=select_query($sql);

			?>
        <td><?php echo $rowuser[0]["sys_username"];?></td>
        <td><?php echo $query[$i]["total_no_of_vehicles"];?></td>
        <td><?php echo $query[$i]["deactivate_temp"];?></td>
        <!-- <td><?php echo $query[$i]["reg_no"];?></td>
  <td><?php echo $query[$i]["ps_of_location"];?></td>
  <td><?php echo $query[$i]["ps_of_ownership"];?></td>
  <td><?php echo $query[$i]["reason"];?></td>
  <td><?php echo $query[$i]["psd_paid"];?></td>
  <td><?php echo $query[$i]["psd_unpaid"];?></td>
  <td><?php echo $query[$i]["ps_rent"];?></td>
  <td><?php echo $query[$i]["service_action"];?></td> -->
        <td><?php echo $query[$i]["payment_status"];?></td>
        <td><?php echo $query[$i]["reason"];?></td>
        <td   ><a href="#" onclick="Show_record(<?php echo $query[$i]["id"];?>,'deactivation_of_account','popup1'); " class="topopup">View Detail</a>
          <?php if( $_POST["Showrequest"]!=1 && $_POST["Showrequest"]!=2 ){?>
          | <a href="#" onclick="return StockComment(<?php echo $query[$i]["id"];?>);"  >Back Comment</a>
          <?php if( $query[$i]["forward_back_comment"]=="" && $query[$i]["forward_req_user"]=="stock" ){?>
          | <a href="#" onclick="return backComment(<?php echo $query[$i]["id"];?>);"  >Forward Back Comment</a>
          <?php }}?>
          
          <!--<a href="#" onclick="return DeviceComment(<?php echo $query[$i]["id"];?>);"  >No of Device Received</a> --></td>
        <td><?php if( $query[$i]["device_remove_status"]=="Y" && $query[$i]["final_status"]!=1 && $query[$i]["no_device_removed"]=="" && $_POST["Showrequest"]==""){?>
          <a href="deactivationofaccount.php?id=<?=$query[$i]['id'];?>&action=edit<? echo $pg;?>">Edit</a>
          <?php } ?></td>
      </tr>
      <?php }?>
  </table>
  <div id="toPopup">
    <div class="close">close</div>
    <span class="ecs_tooltip">Press Esc to close <span class="arrow"></span></span>
    <div id="popup1"> <!--your content start--> 
      
    </div>
    <!--your content end--> 
    
  </div>
  <!--toPopup end-->
  
  <div class="loader"></div>
  <div id="backgroundPopup"></div>
</div>
<?php
include("../include/footer.php"); ?>
