<?php
include("../connection.php");
include_once(__DOCUMENT_ROOT.'/include/header.php');
include_once(__DOCUMENT_ROOT.'/include/leftmenu_support.php');

/*include($_SERVER['DOCUMENT_ROOT']."/format/include/header.php");
include($_SERVER['DOCUMENT_ROOT']."/format/include/leftmenu_support.php");*/

$user = $_SESSION["user_name"];
 
if(isset($_POST['submit']))
{
	$date_from = $_POST['FromDate']." 00:00";
	$date_to = $_POST['ToDate']." 23:59";
	
	//$date_Start = date('Y-m-d', strtotime($date_from))." 00:00";
	//$date_End = date('Y-m-d', strtotime($date_to))." 23:59";
				
	$query = select_query("SELECT * FROM branch_service_install_report where request_by='".$user."' and request_date>='".$date_from."' and request_date<='".$date_to."' order by id DESC ");
	
	$excel_count = count($query);
}
else
{
 $query = select_query("SELECT * FROM branch_service_install_report where request_by='".$user."' order by id DESC ");
} 
?> 

<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
<script>
var j = jQuery.noConflict();
j(function() 
{
j( "#FromDate" ).datepicker({ dateFormat: "yy-mm-dd" });

j( "#ToDate" ).datepicker({ dateFormat: "yy-mm-dd" });

});

</script>

<div class="top-bar">
	 <a href="branch_service_install_report.php" class="button">ADD NEW </a>
    <h1>Service & Installation Report</h1>
      
</div>

<div class="top-bar">

<form name="myForm" action=""   method="post">

    <table cellspacing="5" cellpadding="5">
        <tr>
            <td >From Date</td>
            <td><input type="text" name="FromDate" id="FromDate" value="<?php echo $_POST["FromDate"];?>"/></td>
            
            <td>To Date</td>
            <td><input type="text" name="ToDate" id="ToDate"  value="<?php echo $_POST["ToDate"];?>" /></td>
            
            <td align="center"> <input type="submit" name="submit" value="submit"  /></td>
        </tr>
     
    </table>
</form>
<?php if($excel_count>0){?>
  <div style="float:right";>
  		
        <?echo '<a href="downloadcsv_service.php?csv=true&name='.$user.'&datefrom='.$date_from.'&dateto='.$date_to.'" >Create Excel</a>';?>
        
   </div><br/><br/>
 <?php } ?>
</div>
                
<div class="top-bar">
            
                            
        <div class="table">



 <table cellpadding="0" cellspacing="0" border="0" class="display" id="example">
    <thead>
        <tr>
            <th>SL No</th>
            <th>Date</th>
            <th>Services Uploaded</th>
            <th>Services Rendered</th>
            <th>Service Cancellation</th>
            <th>Installation Uploaded</th>
            <th>Installation Rendered</th>
            <th>Installation Cancellation</th>
            <th>Installer Present</th>   
            <th>Edit</th> 
        </tr>
    </thead>
    <tbody>
 
 
 
<?php 

//while($row=mysql_fetch_array($query))
for($i=0;$i<count($query);$i++)
{
?>
    <tr align="center">
        <td><?php echo $i+1; ?></td>
        <td><?php echo $query[$i]["request_date"];?></td>
        <td><?php echo $query[$i]["total_services"];?></td>
        <td><?php echo $query[$i]["service_done"];?></td>
        <td><?php echo $query[$i]["service_cancel"];?></td> 
        <td><?php echo $query[$i]["total_installation"];?></td> 
        <td><?php echo $query[$i]["installation_done"];?></td> 
        <td><?php echo $query[$i]["installation_cancel"];?></td>
        <td><?php echo $query[$i]["present_installer"];?></td>
        <td><a href="branch_service_install_report.php?id=<?=$query[$i]['id'];?>&action=edit<? echo $pg;?>">Edit</a></td> 
    </tr> <?php  }?>
</table>
     
   <div id="toPopup"> 
    	
        <div class="close">close</div>
       	<span class="ecs_tooltip">Press Esc to close <span class="arrow"></span></span>
		<div id="popup1"> <!--your content start-->
            

 
        </div> <!--your content end-->
    
    </div> <!--toPopup end-->
    
	<div class="loader"></div>
   	<div id="backgroundPopup"></div>
</div>
 
<?php
include("../include/footer.php"); ?>


