<?php
include("include/header.inc.php");
include ("config.php");


$id=$_GET['id'];

if($_GET['action']=='delete')
{
$sql="DELETE FROM services WHERE id='$id'";
$result=mysql_query($sql);
}

//$rs = mysql_query("SELECT * FROM services order by id desc");


	$rs = mysql_query("SELECT * FROM services and branch_id=".$_SESSION['branch_id']." order by id desc ");
	
	
		

?>
<script type="text/javascript">
		$(document).ready(function(){
			

			$("#myTable").tablesorter().tablesorterPager({container: $("#pagination")});
		});
	</script>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
</head>

<body>
<form name="frmMain" action="" method="post">

<table border="1" cellpadding="0" cellspacing="0" align="center" id="myTable" class="tablesorter">
<thead>

<tr align="Center">
		<th width="84"  align="center"><font color="#0E2C3C"><b>ClientName </b></font></th>
		<th width="54"  align="center"><font color="#0E2C3C"><b>Vehicle No</b></font></th>
		<th width="82"  align="center"><font color="#0E2C3C"><b>Notworking </b></font></th>
		<th width="58"  align="center"><font color="#0E2C3C"><b>Location</b></font></th>
		<th width="67"  align="center"><font color="#0E2C3C"><b>Available Time</b></font></th>
		<th width="53"  align="center"><font color="#0E2C3C"><b>Person Name</b></font></th>
		<th width="64"  align="center"><font color="#0E2C3C"><b>Contact No</b></font></th>
		<th width="79"  align="center"><font color="#0E2C3C"><b>Installation Name</b></font></th>
		<th width="89"  align="center"><font color="#0E2C3C"><b>Installer Current Location</b></font></th>
		<td width="48"  align="center"><font color="#0E2C3C"><b>Edit</b></font></td>
		<!--<td width="63"  align="center"><font color="#0E2C3C"><b>Delete</b></font></td>-->
		
		
	</tr></thead><tbody>
		<?php  
    while ($row = mysql_fetch_array($rs)) {
	
    ?>   
	<tr align="Center">
	
		<td  align="center">&nbsp;<?php echo $row['name'];?></td>
		<td  align="center">&nbsp;<?php echo $row['veh_reg'];?></td>
		
		<td  align="center">&nbsp;<?php echo $row['Notwoking'];?></td>
		<td  align="center">&nbsp;<?php echo $row['location'];?></td>
		<td  align="center">&nbsp;<?php echo $row['atime'];?></td>
		<td  align="center">&nbsp;<?php echo $row['pname'];?></td>
		<td  align="center">&nbsp;<?php echo $row['cnumber'];?></td>
		<td  align="center">&nbsp;<?php echo $row['inst_name'];?></td>
		<td  align="center">&nbsp;<?php echo $row['inst_cur_location'];?></td>
		<td  align="center">&nbsp;<a href="editinstallation.php?id=<?=$row['id'];?>&action=edit&pg=<? echo $pg;?>">Edit</a></td>
		<!--<td  align="center">&nbsp;<a href="services_from_sales.php?id=<?php echo $row['id'];?>&action=delete">Delete</a></td>-->
		
	</tr>
		<?php  
    }
	 
    ?>
	<tr><td colspan="9" align="center">&nbsp;</td></tr>  </tbody>
</table> 
</form>
<div id="pagination" class="pager">
			<form>
				<img src="images/sorting/first.png" class="first"/>
				<img src="images/sorting/prev.png" class="prev"/>
				<input type="text" class="pagedisplay" name="page"/>
				<img src="images/sorting/next.png" class="next"/>
				<img src="images/sorting/last.png" class="last"/>
				<select class="pagesize">
					<option selected="selected"  value="10">10</option>
					<option value="20">20</option>
					<option value="30">30</option>
					<option value="40">40</option>
					<option value="50">50</option>
				</select>
			</form>
		</div>
        <br/><br/>

<?
include("include/footer.inc.php");

?>