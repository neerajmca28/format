<?php
include("../connection.php");
include_once(__DOCUMENT_ROOT.'/include/header.php');
include_once(__DOCUMENT_ROOT.'/include/leftmenu_support.php');

/*include($_SERVER['DOCUMENT_ROOT']."/format/include/header.php");
include($_SERVER['DOCUMENT_ROOT']."/format/include/leftmenu_support.php");*/
 
$group_id = $_SESSION['support_group_id'];

 
 $user_id = "";
 $user_query = select_query("SELECT Userid FROM internalsoftware.addclient WHERE GroupId='".$group_id."'");
 //$user_query = mysql_query("SELECT id FROM matrix.users WHERE $branch AND id NOT IN(1,2143)");
 //while($user_data = mysql_fetch_array($user_query))
 for($u=0;$u<count($user_query);$u++)
 {
	 $user_id.= $user_query[$u]['Userid'].",";
 }
 $user = substr($user_id,0,-1); 

?>
<script>
/*function ConfirmDelete(row_id)
{
  var x = confirm("Are you sure you want to Close this?");
  if (x)
  {
  approve(row_id);
      return ture;
  }
  else
    return false;
}

function approve(row_id)
{
    //alert(user_id);
    //return false;
$.ajax({
        type:"GET",
        url:"userInfo.php?action=no_billsclose",
         data:"row_id="+row_id,
        success:function(msg){
         
        location.reload(true);       
        }
    });
}*/

function softwareComment(row_id)
{
   var retVal = prompt("Write Comment : ", "Comment");
  if (retVal)
  {
  addComment2(row_id,retVal);
      return ture;
  }
  else
    return false;
}

function addComment2(row_id,retVal)
{
    //alert(user_id);
    //return false;
$.ajax({
        type:"GET",
        url:"userInfo.php?action=Add_no_bill_supportComment",
          
         data:"row_id="+row_id+"&comment="+retVal,
        success:function(msg){
             
         
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
        url:"userInfo.php?action=no_billssupportComment",
          
         data:"row_id="+row_id+"&comment="+retVal,
        success:function(msg){
             
         
        location.reload(true);       
        }
    });
}

function forwardbackComment(row_id)
{
   var retVal = prompt("Write Comment : ", "Comment");
  if (retVal)
  {
  addComment1(row_id,retVal);
      return ture;
  }
  else
    return false;
}

function addComment1(row_id,retVal)
{
    //alert(user_id);
    //return false;
$.ajax({
        type:"GET",
        url:"userInfo.php?action=nobillbackComment",
          
         data:"row_id="+row_id+"&comment="+retVal,
        success:function(msg){
            // alert(msg);
             
         
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
        <option value="" <?if($_POST['Showrequest']==''){ echo "Selected"; }?>>Pending+Admin Forward</option>
        <option value="4" <?if($_POST['Showrequest']==4){ echo "Selected"; }?>>Action Taken</option>
        <option value="1" <?if($_POST['Showrequest']==1){ echo "Selected"; }?>>Closed</option>
        <option value="2" <?if($_POST['Showrequest']==2){ echo "Selected" ;}?>>All</option>
      </select>
    </form>
  </div>
  <h1>No Bill</h1>
</div>
<div class="top-bar">
  <div style="float:right";><font style="color:#B6B6B4;font-weight:bold;">Grey:</font> Approved</div>
  <br/>
  <div style="float:right";><font style="color:#D462FF;font-weight:bold;">Purple:</font> Back from support</div>
  <br/>
  <div style="float:right";><font style="color:#F2F5A9;font-weight:bold;">Yellow:</font> Back from Admin</div>
  <br/>
  <div style="float:right";><font style="color:#8BFF61;font-weight:bold;">Green:</font> Completed your requsest.</div>
</div>
<div class="table">
  <?php
               
  if($_POST["Showrequest"]==1)
 {
      $WhereQuery=" where client IN($user) and final_status=1";
 }
 else if($_POST["Showrequest"]==2)
 {
     /*$WhereQuery=" where client IN($user) and (approve_status=1 or approve_status=0) and discount_issue='Software Issue' ";*/
     $WhereQuery=" where client IN($user) and no_bill_issue='Software Issue'";
 }
 else if($_POST["Showrequest"]==4)
 {
     $WhereQuery=" where (client IN($user) and (support_comment!='' || software_comment!='') and final_status=0 and (sales_comment is null or no_bill_status=2)) or (forward_req_user='".$_SESSION["user_name"]."' and forward_back_comment!='')";
 }
 else
 {
     
     $WhereQuery=" where (client IN($user) and (approve_status=0 and no_bill_issue='Software Issue' and no_bill_status=1 and ((support_comment is null and software_comment is null) or sales_comment!=''))) or (forward_req_user='".$_SESSION["user_name"]."' and (forward_back_comment is null or forward_back_comment=''))";
      
 }
 
$query = select_query("SELECT * FROM no_bills  ". $WhereQuery."   order by id desc ");  

?>
  <table cellpadding="0" cellspacing="0" border="0" class="display" id="example">
    <thead>
      <tr>
        <th>SL No</th>
        <th>Date</th>
        <th>Account Manager</th>
        <th>User Name</th>
        <th>Company Name</th>
        <th>Vehicle for No Bill</th>
        <th>Reason</th>
        <!--  <th>Registration No</th>
            <th>Present Status Of Location</th>
            <th>Present Status Of Ownership</th>
            <th>Reason</th>
            <th>Payment Status Device Paid</th>
            <th>Payment Status Device Unpaid</th>
            <th>Payment Status Rent</th>
            <th>Service Action</th>
            <th>Sales Action</th> -->
        <th>View Detail</th>
        <th>Add Comments</th>
      </tr>
    </thead>
    <tbody>
      <?php

//while($row=mysql_fetch_array($query))
for($i=0;$i<count($query);$i++)
{
?>
      <tr align="center" <? if( $query[$i]["support_comment"]!="" && $query[$i]["final_status"]!=1 && $query[$i]["sales_comment"]==""){ echo 'style="background-color:#D462FF"';} elseif($query[$i]["final_status"]==1){ echo 'style="background-color:#8BFF61"';}elseif($query[$i]["approve_status"]==1){ echo 'style="background-color:#B6B6B4"';}elseif( $query[$i]["admin_comment"]!="" && $query[$i]["final_status"]!=1 ){ echo 'style="background-color:#F2F5A9"';}?> >
        <td><?php echo $i+1; ?></td>
        <td><?php echo $query[$i]["date"];?></td>
        <td><?php echo $query[$i]["acc_manager"];?></td>
        <? $sql="SELECT Userid AS id,UserName AS sys_username FROM addclient  WHERE Userid=".$query[$i]["client"];
    $rowuser=select_query($sql);

            ?>
        <td><?php echo $rowuser[0]["sys_username"];?></td>
        <td><?php echo $query[$i]["company_name"];?></td>
        <td><?php echo $query[$i]["total_no_of_veh"];?></td>
        <td><?php echo $query[$i]["reason"];?></td>
        <td  style="width:200px"><a href="#" onclick="Show_record(<?php echo $query[$i]["id"];?>,'no_bills','popup1'); " class="topopup">View Detail</a>
          <?php if($_POST["Showrequest"]!=1 && $_POST["Showrequest"]!=2){?>
          
          <!--| <a href="#" onclick="return ConfirmDelete(<?php echo $query[$i]["id"];?>);"  >Done</a>--> 
          | <a href="#" onclick="return backComment(<?php echo $query[$i]["id"];?>);"  >Back Comment</a>
          <?php } ?></td>
        <td><?php if($_POST["Showrequest"]!=1 && $_POST["Showrequest"]!=2){?>
          <?php if($query[$i]["no_bill_issue"]=="Software Issue") {?>
          <a href="#" onclick="return softwareComment(<?php echo $query[$i]["id"];?>);"  >Add Comment</a> 
          <!--<a href="no_bill.php?id=<?=$query[$i]['id'];?>&action=edit<? echo $pg;?>">Add Comments</a>--> 
          <!--<td width="12%" align="center">&nbsp;<a href="services.php?id=<?php echo $query[$i]['id'];?>&action=delete">Delete</a></td>-->
          
          <?php }
    if( $query[$i]["forward_comment"]!="" && $query[$i]["forward_req_user"]!="" ){ ?>
          |<a href="#" onclick="return forwardbackComment(<?php echo $query[$i]["id"];?>);"  >Forward Back Comment</a>
          <? }}?></td>
      </tr>
      <?php  }?>
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