<?
include("../connection.php");
include_once(__DOCUMENT_ROOT.'/include/header.php');
include_once(__DOCUMENT_ROOT.'/include/leftmenu_service.php');
include_once(__DOCUMENT_ROOT.'/private/master.php');

/*include($_SERVER['DOCUMENT_ROOT']."/format/include/header.php");
include($_SERVER['DOCUMENT_ROOT']."/format/include/leftmenu_service.php");
include($_SERVER['DOCUMENT_ROOT']."/format/private/master.php");*/

$masterObj = new master();

$username="";

if($_POST["submit"])
{

	$selecttype= $_POST["selecttype"];	
	$username= $_POST["userid"];
	
	$userData = $masterObj->getUserDetails($username);
	
	//echo "<pre>";print_r($userData);die;
	
	$userId=$userData[0]['id'];
	$Company=$userData[0]['company'];
	$userPhoneNumber=$userData[0]['phone_number'];

                                                                                   
	$data = $masterObj->getdebug_data($userId,$selecttype);


   //echo "<pre>";print_r($data);die;

}

?>
<script>
function ConfirmDelete(row_id)
{
	
   var retVal = prompt("Write Comment : ", "");
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
		url:"userInfo.php?action=debugComment",
 		 
		 data:"row_id="+row_id+"&comment="+retVal,
		success:function(msg){
			alert(msg);
		 
		location.reload(true);		
		}
	});
}
</script>
<script src="http://trackingexperts.com/thickbox/thickbox.js" type="text/javascript"></script>
<link rel="stylesheet" href="http://trackingexperts.com/thickbox/thickbox.css" type="text/css" media="projection, screen" />

<div class="top-bar">
  <div class="top-bar">
  	<!--<style>
	  @keyframes blink {
		to { color: red; }
		}
		
		.my-element {
		color: #000;
		text-shadow:1px 1px #6F0;
		animation: blink 1s steps(2, start) infinite;
		font-size: 18px; text-align: center;
		}
  </style>
  	<p class="my-element">NOTE: Don't use this page for current location. Data updated till 9:00 am </p>-->
    <div style="float:right";><font style="color:#D462FF;font-weight:bold;">Purple:</font> Device Removed</div>
    <br/>
    <div style="float:right";><font style="color:#01DF01;font-weight:bold;">Green:</font> Problem from clientside</div>
    <br/>
    <div style="float:right";><font style="color:#00FFFF;font-weight:bold;">Blue:</font> Not working vehicle</div>
  </div>
  <h1> Vehicle Detail</h1>
  <div style="float:right;font-weight:bold"><?echo "UserId= ".$userId."<br>";

echo "Phone Number= ".$userPhoneNumber."<br>";

echo "Total Vehicles :". count($data);


?></div>
</div>
<div style="padding-left:5px;padding-top:5px">
  <form method="post" action="" onsubmit="return submitme();" name="form2">
    <input type="text" name="userid" id="userid" value="<?=$username?>">
    &nbsp;&nbsp;
    <select name="selecttype">
      <option id="0" value="0" <?php if($selecttype=="" or $selecttype==0){ ?> selected="selected" <?php } ?> >All Vehicles</option>
      <option id="1" value="1" <?php if($selecttype==1){ ?> selected="selected" <?php } ?> selected >Not Working Vehicles</option>
      <option id="2" value="2" <?php if($selecttype==2){ ?> selected="selected" <?php } ?> >Device removed</option>
    </select>
    &nbsp;&nbsp;
    <input type="submit" name="submit" value="submit">
  </form>
  <br/>
  <table cellpadding="0" cellspacing="0" border="0" class="display" id="example">
    <thead>
      <tr>
        <th>Sl. No</th>
        <th>Id </th>
        <th> Vehicle Reg no</th>
        <th>User Name</th>
        <th> Last ContactTime </th>
        <th> Speed </th>
        <th> Ac Status </th>
        <th>Lat </th>
        <th> Long </th>
        <th>Imei</th>
        <th>Device Status</th>
        <th>SSE </th>
        <th>View Comment</th>
      </tr>
    </thead>
    <tbody>
      <?php 

for($i=0;$i<count($data);$i++)
{
	//device_removed_service 
	$rowStyle="";
	$time1=date('Y-m-d H:i:s');
	$time2=$data[$i]['lastcontact'];
	$hourdiff = round((strtotime($time1) - strtotime($time2))/3600, 0);
    $device_removed=$data[$i]['device_removed_service'];
	
	if($device_removed==1 )
		{$rowStyle='style="background-color:#D462FF"';}
	else if($data[$i]['tel_voltage']<'3.5' && $data[$i]['tel_voltage']>'0.0')
		{$rowStyle='style="background-color:#01DF01"';}
	else if($data[$i]['tel_poweralert']=0)
		{$rowStyle='style="background-color:#01DF01"';}
	elseif($hourdiff>=2)
		{$rowStyle='style="background-color:#00FFFF"';}

  $Imag=''; 
  $toolTip=''
?>
      <tr align="center" <? echo $rowStyle;?> >
        <? 
 if($username=="vimal")
{

	$vimal_data = $masterObj->getVimalDetails($data[$i]['id']); 

 	$userName=$vimal_data[0]['sys_username'];

}
else
{

	$userName=$username;

}

$telecallerData = $masterObj->getSseName($userName);

?>
        <td><?php echo $i+1; ?></td>
        <td>&nbsp;<?php echo $data[$i]['id'];?></td>
        <td>&nbsp;<?php echo $data[$i]['veh_reg'];?></td>
        <td>&nbsp;<?php echo $userName;?></td>
        <td>&nbsp;<?php echo $data[$i]['lastcontact'];?></td>
        <td>&nbsp;<?php echo $data[$i]['speed'];?></td>
        <td>&nbsp;
          <?php if($data[$i]['aconoff']==1){echo "AC ON"; }else{ echo "AC OFF";}?></td>
        <td>&nbsp;<?php echo $data[$i]['lat'];?></td>
        <td>&nbsp;<?php echo $data[$i]['lng'];?></td>
        <td>&nbsp;<?php echo $data[$i]['imei'];?></td>
        <td>&nbsp;
          <?php if($data[$i]['tel_voltage']<'3.5' && $data[$i]['tel_voltage']>'0.0')
	{

		$Imag="nobattery.PNG";
		$toolTip= " No Battery";
		?>
          <img width="20px" height="20px" border="0" src="<?echo $Imag;?>" title="<?echo $toolTip?>"><br/>
          <?
		}
	  if($data[$i]['poweronoff']==false && $data[$i]['tel_voltage']!=null && $data[$i]['tel_voltage']>0)
		{
	  $Imag="nopower.PNG";
	  $toolTip= " No power running with bettery power";
	  
		?>
          <img width="20px" height="20px" border="0" src="<?echo $Imag;?>" title="<?echo $toolTip?>"><br/>
          <?
	  }
	  if($data[$i]['gps_fix']<1)
		{$toolTip= " No GPS";
	  $Imag="nogps.PNG";
	?>
          <img width="20px" height="20px" border="0" src="<?echo $Imag;?>" title="<?echo $toolTip?>"><br/>
          <?
	  }?>
          
          <!--<img width="20px" height="20px" border="0" src="<?echo $Imag;?>" title="<?echo $toolTip?>"><br/>-->
          <? //echo $data[$i]['poweronoff'];?></td>
        <td>&nbsp;<?php echo $telecallerData[0]['telecaller'];?></td>
        <td><a href="#" onclick="Show_record(<?php echo $data[$i]["id"];?>,'comment','popup1'); " class="topopup">View Comment</a></td>
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
<?
include("../include/footer.php");

?>
