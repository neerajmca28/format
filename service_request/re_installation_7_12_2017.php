<?php
include("../connection.php");
include_once(__DOCUMENT_ROOT.'/include/header.inc.php');
include_once(__DOCUMENT_ROOT.'/include/leftmenu_service.php');
?>
<link  href="<?php echo __SITE_URL;?>/css/auto_dropdown.css" rel="stylesheet" type="text/css" />
<!-- <link href="<?php echo __SITE_URL;?>/js/Interbranchjquery.multiselect.css" rel="stylesheet" type="text/css"> -->
<link rel="stylesheet" type="text/css" href="<?php echo __SITE_URL;?>/build/jquery.datetimepicker.css"/>
<script src="<?php echo __SITE_URL;?>/build/jquery.datetimepicker.full.js"></script>

<!-- <script src="<?php echo __SITE_URL;?>/js/jquery.min.js"></script> -->
<!-- <script src="<?php echo __SITE_URL;?>/js/jquery.multiselect.js"></script> -->
<script type="text/javascript">


function selectAllAccessory(source)
{
  //alert(source)
    var checkboxes = document.getElementsByName('accessories[]');
    for(var i in checkboxes)
      checkboxes[i].checked = source.checked;
}

function vehicleType(radioValue)
{
  // alert(radioValue)
   if(radioValue=="Bus")
    {
        document.getElementById('MachineType').style.display = "none";
        document.getElementById('TruckType').style.display = "none";
        document.getElementById('TrailerType').style.display = "none";
        document.getElementById('standard').style.display = "block";
        document.getElementById('lux').style.display = "none";
   
    }
    else if(radioValue=="Car")
    {
        document.getElementById('standard').style.display = "none";
        document.getElementById('TruckType').style.display = "none";
        document.getElementById('MachineType').style.display = "none";
        document.getElementById('TrailerType').style.display = "none";
        document.getElementById('lux').style.display = "block";
        document.getElementById('actype').style.display = "none";
       
    }
    else if(radioValue=="Tempo")
    {
        document.getElementById('standard').style.display = "none";
        document.getElementById('TruckType').style.display = "none";
        document.getElementById('TrailerType').style.display = "none";
        document.getElementById('MachineType').style.display = "none";
        document.getElementById('lux').style.display = "none";
        document.getElementById('actype').style.display = "block";
    }
    else if(radioValue=="Truck")
    {
        document.getElementById('standard').style.display = "none";
        document.getElementById('TrailerType').style.display = "none";
        document.getElementById('MachineType').style.display = "none";
        document.getElementById('actype').style.display = "none";
        document.getElementById('lux').style.display = "none";
        document.getElementById('TruckType').style.display = "block";
    }
    else if(radioValue=="Trailer")
    {
        document.getElementById('standard').style.display = "none";
        document.getElementById('TruckType').style.display = "none";
        document.getElementById('MachineType').style.display = "none";
        document.getElementById('lux').style.display = "none";
        document.getElementById('actype').style.display = "none";
        document.getElementById('TrailerType').style.display = "block";
    }
    else if(radioValue=="Machine")
    {
        document.getElementById('standard').style.display = "none";
        document.getElementById('TruckType').style.display = "none";
        document.getElementById('actype').style.display = "none";
        document.getElementById('actype').style.display = "none";
        document.getElementById('TrailerType').style.display = "none";
        document.getElementById('lux').style.display = "none";
        document.getElementById('MachineType').style.display = "block";
    }
    else if(radioValue=="Bike")
    {
        document.getElementById('standard').style.display = "none";
        document.getElementById('actype').style.display = "none";
        document.getElementById('MachineType').style.display = "none";
        document.getElementById('TruckType').style.display = "none";
        document.getElementById('TrailerType').style.display = "none";
        document.getElementById('lux').style.display = "none";
    }
    else
    {
        document.getElementById('standard').style.display = "none";
        document.getElementById('TruckType').style.display = "none";
        //document.getElementById('deviceMdl').style.display = "none";
    }
   
}
function standardType(radioValue)
{

   document.getElementById('actype').style.display = "block";

}
function aclux(radioValue)
{

  //alert(radioValue)
  
          document.getElementById('actype').style.display = "block";
          //document.getElementById('deviceMdl').style.display = "block";

}

/*Start auto ajax value load code*/

/* End auto ajax value load code*/
</script>
<?php
$Header="Re-Installation";
$date=date("Y-m-d H:i:s");
$account_manager=$_SESSION['username'];
?>

<div class="top-bar">
  <h1><?php echo  $Header;?></h1>
</div>
<div class="table">

<?php


if(isset($_POST['submit']))
{ 
    //echo "<pre>";print_r($_POST);die;

    $date=date("Y-m-d H:i:s");
    $account_manager=$_SESSION['username'];
    $sales_person=trim($_POST['sales_person']);
    $sales_manager = select_query("select id as sales_id from sales_person where name='".$sales_person."' limit 1");
    $sales_person_id=$sales_manager[0]['sales_id'];
    $main_user_id=$_POST['main_user_id'];
    $company=$_POST['company'];
    $imei=$_POST['imei'];
    $allIMEI= array();


    $no_of_vehicals=$_POST['no_of_installation'];


    for ($i=0; $i < $_POST['no_of_installation']; $i++) {       
      array_push($allIMEI, $imei[$i]);
    }

    for($j=0;$j<count($allIMEI);$j++)
    {
      $deviceIMEI.=$allIMEI[$j].",";
    }
     $arrDeviceIMEIStr=substr($deviceIMEI,0,strlen($deviceIMEI)-1);

     //echo $arrDeviceIMEIStr;die;

    
    $deviceCurrentStatus=$_POST['deviecestatus'];
    $deviceStatus=$_POST['txtDeviceStatus'];
    $status=$_POST['status'];
    $location=$_POST['inter_branch'];
    $interbranch = $_POST['inter_branch_loc'];

    if($location == 'Interbranch'){
      $query = select_query("select city from tbl_city_name where branch_id=$interbranch");
      $branchLocation = $query[0]['city'];
    }
    else{
      $branchLocation = "Delhi";
    }

    $accessories=$_POST['accessories'];
    $inter_branch_loc=$_POST['inter_branch_loc'];
    $cnumber=$_POST['cnumber'];
    $designation=$_POST['designation'];
    $designation2=$_POST['designation2'];
    $contact_person=$_POST['contact_person'];
    $contact_person2=$_POST['contact_person2'];
    $contact_number = $_POST['contact_number'];
    $contact_number2 = $_POST['contact_number2'];
    $atime_status=$_POST['atime_status'];
    $back_reason=$_POST['back_reason'];
    $branch_type = $_POST['inter_branch'];
    $instal_reinstall = "re_install";
    $accessories_tollkit = $_POST['accessories'];
    $veh_type = $_POST['veh_type'];

    $accessories_tollkit="";
   
    for($i=0;$i<count($_POST['accessories']);$i++)
    {
      $accessories_tollkit.=$_POST['accessories'][$i]."#";
      $accessories_tollkits=substr($accessories_tollkit,0,strlen($accessories_tollkit)-1);
    }

    $veh_type=$_POST['veh_type'];
    $del_nodelux=$_POST['standard'];
    $actype=$_POST['actype'];
    $TruckType=$_POST['TruckType'];
    $TrailerType=$_POST['TrailerType'];
    $MachineType=$_POST['MachineType'];
    $billing = $_POST['billing'];
    $txtDeviceModel = $_POST['txtDeviceModel'];
    $txtDeviceType = $_POST['txtDeviceType'];
    //$delnoDelux = $_POST['delnoDelux'];
    $luxury = $_POST['lux'];
    $acess_selection = $_POST['access_radio'];
    $landmark=$_POST['landmark'];    
    

    if($instal_reinstall == "re_install")
    {
        $installation_status=1;
    }
    
    $Zone_data = select_query("SELECT id,`name` FROM re_city_spr_1 WHERE `name`='".$_POST['Zone_area']."'");
    
    $zone_count = count($Zone_data);
    
    if($zone_count > 0)
    {
        $Area = $Zone_data[0]["id"];
        $errorMsg = "";
    }
    else
    {
        $errorMsg = "Please Select Type View Listed Area. Not Fill Your Self.";
    }
    
    if($branch_type == "Interbranch"){
        $city=$_POST['inter_branch_loc'];
        $location="";
    }
    else{
        $city=0;
        $location=$_POST['location'];
    }
    
    $required=$_POST['required'];
    
    if($required=="") { $required="normal"; }
       
      $datapullingtime=$_POST['datapullingtime'];


            
        
        if($errorMsg=="")   
        { 
          if($atime_status=="Till")
          {
                  $time=$_POST['time'];  
                  
                  $sql="INSERT INTO installation_request(`req_date`, `request_by`, sales_person, `user_id`, `company_name`, no_of_vehicals, device_status, location,model,time, contact_number, status, contact_person, veh_type,required,branch_id,installation_status, Zone_area,atime_status,`inter_branch`, branch_type, instal_reinstall,designation,device_type,alter_contact_no,accessories_tollkit,billing,TrailerType,TruckType,MachineType,actype,standard,alt_cont_person,alt_designation,acess_selection,luxury,landmark,assign_imei,device_current_location) VALUES('".$date."','".$account_manager."','".$sales_person_id."', '".$main_user_id."', '".$company."','".$no_of_vehicals."','".$status."','".$branchLocation."','".$model."', '".$time."', '".$contact_number."',1,'".$contact_person."','".$veh_type."','".$required."',
                  '".$_SESSION['BranchId']."','".$installation_status."','".$Area."','".$atime_status."','".$city."','".$branch_type."',
                  '".$instal_reinstall."','".$designation."','".$deviceType."','".$contact_number2."','".$accessories_tollkits."','".$billing."','".$TrailerType."','".$TruckType."','".$MachineType."','".$actype."','".$del_nodelux."','".$contact_person2."','".$designation2."','".$acess_selection."','".$luxury."','".$landmark."','".$arrDeviceIMEIStr."','".$deviceCurrentStatus."')";
                  
                  

                  //echo $sql;die; 
          
                   $execute=mysql_query($sql);

                   $insert_id = mysql_insert_id();

                 //  if($installation_status == 1)
                 //  {
                 //    //echo $no_of_vehicals;die;
                 //    for($N=0;$N<$no_of_vehicals;$N++)
                 //    { 
                 //        $installation = "INSERT INTO installation(`inst_req_id`, `req_date`, `request_by`,sales_person,`user_id`, `company_name`, no_of_vehicals, device_imei, device_status, imei_status, location,model,time, contact_number,installed_date, status, contact_person, veh_type, required,branch_id,installation_status, Zone_area,atime_status,`inter_branch`, branch_type, instal_reinstall, designation, device_type, alter_contact_no, accessories_tollkit, billing, TrailerType, TruckType, MachineType, actype, standard, alt_cont_person, alt_designation, acess_selection, imei_device_type, imei_device_model) VALUES('".$insert_id."','".$date."',
                 //        '".$account_manager."','".$sales_person_id."', '".$main_user_id."', '".$company."','".$no_of_vehicals."','".$imei[$N]."','".$status."','".$deviceStatus[$N]."','".$location."','".$model."','".$time."',
                 //        '".$contact_number."',now(),1,'".$contact_person."','".$veh_type."','".$required."','".$_SESSION['BranchId']."','".$installation_status."','".$Area."',
                 //        '".$atime_status."','".$city."','".$branch_type."','".$instal_reinstall."','".$designation2."','".$deviceType."','".$contact_number2."','".$accessories_tollkits."','".$billing."','".$TrailerType."','".$TruckType."','".$MachineType."','".$actype."','".$del_nodelux."','".$contact_person2."','".$designation1."','".$acess_selection."','".$txtDeviceType[$N]."','".$txtDeviceModel[$N]."')";

                 //       $execute_inst=mysql_query($installation);
                 //    }

                 //   // echo $installation; die;
                  
                 // }
               
                 header("location:installation.php");
          }
               
            if($atime_status=="Between")
            {
                $time=$_POST['time1'];
                $totime=$_POST['totime'];
               
                //1-New,2-assigned,3-newbacktoservice,4-backtoservice,5-close,6-callingclose
                 $sql="INSERT INTO installation_request(`req_date`, `request_by`,sales_person,`user_id`, `company_name`, no_of_vehicals, device_status, location,model, 
                 time,totime,contact_number, installed_date, status, contact_person, veh_type, 
                 required,branch_id, installation_status,Zone_area, atime_status,`inter_branch`, branch_type, instal_reinstall,designation,device_type,alter_contact_no,accessories_tollkit,billing,TrailerType,TruckType,MachineType,actype,standard,alt_cont_person,alt_designation,acess_selection,landmark,assign_imei,device_current_location) VALUES('".$date."','".$account_manager."','".$sales_person_id."', '".$main_user_id."', '".$company."',
                 '".$no_of_vehicals."','".$status."','".$branchLocation."','".$model."','".$time."','".$totime."','".$contact_number."',now(),1,'".$contact_person."','".$veh_type."','".$required."',
                 '".$_SESSION['BranchId']."','".$installation_status."','".$Area."','".$atime_status."','".$city."','".$branch_type."',
                 '".$instal_reinstall."','".$designation."','".$deviceType."','".$contact_number2."','".$accessories_tollkits."','".$billing."','".$TrailerType."','".$TruckType."','".$MachineType."','".$actype."','".$del_nodelux."','".$contact_person2."','".$designation2."','".$acess_selection."','".$landmark."','".$arrDeviceIMEIStr."','".$deviceCurrentStatus."')";
                
                 //echo $sql; die;
                 
                     
                       $execute=mysql_query($sql);
                       $insert_id = mysql_insert_id();   

                    //   if($installation_status == 1)
                    //   {

                    //       for($N=0;$N<$no_of_vehicals;$N++)  
                    //       {
                    //           $installation = "INSERT INTO installation(`inst_req_id`, `req_date`, `request_by`,sales_person,`user_id`, `company_name`,no_of_vehicals,location,model,time, totime,contact_number,installed_date, status, contact_person, veh_type,required,branch_id,installation_status, Zone_area,atime_status,`inter_branch`,
                    //            branch_type, instal_reinstall,designation,device_type,alter_contact_no,accessories_tollkit,billing,TrailerType,TruckType,MachineType,actype,standard,alt_cont_person,alt_designation,acess_selection,device_imei,device_status,imei_status, imei_device_type, imei_device_model) VALUES('".$insert_id."','".$date."',
                    //            '".$account_manager."','".$sales_person_id."', '".$main_user_id."', '".$company."','1','".$location."','".$model."','".$time."',
                    //            '".$totime."','".$contact_number."',now(),1,'".$contact_person."','".$veh_type."'  ,
                    //            '".$required."','".$_SESSION['BranchId']."',
                    //            '".$installation_status."','".$Area."','".$atime_status."','".$city."','".$branch_type."','".$instal_reinstall."','".$designation."','".$deviceType."','".$alt_cont_number."','".$accessories_tollkits."','".$billing."','".$TrailerType."','".$TruckType."','".$MachineType."','".$actype."','".$del_nodelux."','".$alt_cont_person."','".$alt_designation."','".$acess_selection."','".$imei[$N]."','".$status."','".$deviceStatus[$N]."','".$txtDeviceType[$N]."','".$txtDeviceModel[$N]."')";
                       
                    //           $execute_inst=mysql_query($installation);
                    //       }  
                    //      // echo $installation; die;   
                    // }
                 header("location:installation.php");
            }
        }   

    
}
?>


<script type="text/javascript">
var mode;

function deviceStatus(device){
  if(device > 0){
    document.getElementById("status").style.display="block";
  }
}




function req_info()
{  
  
  if(document.form1.main_user_id.value=="")
  {
  alert("Please Select Client Name") ;
  document.form1.main_user_id.focus();
  return false;
  }

  if(document.form1.TxtSalesPersonName.value=="")
  {
  alert("Please Select Sales Person Name") ;
  document.form1.TxtSalesPersonName.focus();
  return false;
  }
  
  if(document.form1.imeistatus.value=="")
  {
  alert("Please Select Device Type") ;
  document.form1.imeistatus.focus();
  return false;
  } 
  
  if(document.form1.no_of_installation.value=="")
  {
  alert("Please Select No. of Installation") ;
  document.form1.no_of_installation.focus();
  return false;
  }

  var imeiNumber = document.getElementsByName("imei[]");
  var ret = true;
  var ret1 = true;
  for (var x = 0; x < imeiNumber.length; x++) {       
    if(imeiNumber[x].value == '' || imeiNumber[x].value == '0')
    {
      ret = false;
      break;
    } 
    else 
    {
      ret = true;
    }

    for (var y = 0; y < x; y++){
      
      if(imeiNumber[x].value == imeiNumber[y].value)
      {
        
        ret1 = false;
        alert(" Duplicate IMEI: "+ imeiNumber[y].value + " Please Change it!!")
        document.form1.no_of_installation.focus();
        return false;
        break;
      } 
      else 
      {
        ret1 = true;
      } 
    }
  }    
  

  if (ret == false)
  {
    alert('Please Select IMEI Fields'); 
    document.form1.no_of_installation.focus();
    return false;       
  }
  // if(document.form1.access_radio.value=="")
  // {
  //   var accessories = document.getElementsByName("access_radio");
  //   //alert(accessories[1].checked)
  //   if (accessories[0].checked) {
  //       return false;
    
  //   } else if (accessories[1].checked) {
  //       return false;
    
  //   } else {        
    
  //       alert("Please Select Accessories") ;
  //       return false;
  //   }
  // }


  var acc=document.forms["form1"]["acc"].value;
  if (acc==null || acc=="")
  {
      alert("Please Select Accessories Button") ;
      return false;
  }
  if(document.form1.access_radio.value == 'yes'){

  var accessories = document.getElementsByName("accessories[]");
  var acc_len = $('[name="accessories[]"]:checked').length;
    
    if(acc_len == '' || acc_len == '0')
    {
      alert('Please Select Atleast One Accessories'); 
      //document.form1.accessories.focus();
      return false; 
      
    } 

  }

   var inter_branch=document.forms["form1"]["inter_branch"].value;
    if (inter_branch==null || inter_branch=="")
    {
      alert("Please Select Branch Button") ;
      return false;
    }
    if(inter_branch=='Interbranch')
    {
      var interbranch=document.forms["form1"]["inter_branch_loc"].value;
      if(interbranch==null || interbranch=="")
      {
          alert("Please select branch location");
          document.form1.inter_branch_loc.focus();
          return false;
      }
    }

  if(document.form1.Zone_area.value=="")
    {
      alert("Please Select Area") ;
      document.form1.Zone_area.focus();
      return false;
    }

    var location=document.forms["form1"]["location"].value;
    if (location==null || location=="")
    {
        alert("Please Enter Landmark");
        document.form1.location.focus();
        return false;
    }
  
  
    

  var timestatus=document.forms["form1"]["atime_status"].value;
    if (timestatus==null || timestatus=="")
      {
          alert("Please select Availbale Time");
          document.form1.atime_status.focus();
          return false;
      }
 
  var tilltime=document.forms["form1"]["datetimepicker"].value;  
      if(timestatus == "Till" && (tilltime==null || tilltime==""))  
      {     
           alert("Please select Time");    
            document.form1.datetimepicker.focus();  
            return false;   
      } 
      else
      {
        var inputTime = new Date(tilltime).getTime();  
        var time=(inputTime/(3600*1000));    
        var d = new Date(); 
        var n = d.getTime();       
        var currntTime4=(n/(3600*1000));     
        var diff=time-currntTime4;   
        if(timestatus=="Till")
        {       
          if(diff<=3.80)   
          {  
              alert('Please enter 4 hour difference for available time');  
              document.form1.datetimepicker.focus();   
              return false;    
          }
        }

      }  

  
    var betweentime=document.forms["form1"]["datetimepicker1"].value;
    var betweentime2=document.forms["form1"]["datetimepicker2"].value;
    if(timestatus == "Between" && (betweentime==null || betweentime==""))
    {
        alert("Please select From Time");
        document.form1.datetimepicker1.focus();
        return false;
    }
  
    if(timestatus == "Between" && (betweentime2==null || betweentime2==""))
    {
        alert("Please select To Time");
        document.form1.datetimepicker2.focus();
        return false;
    }
    else
    {
        var inputTime = new Date(betweentime).getTime();  
        var time=(inputTime/(3600*1000));    
        var d = new Date(); 
        var n = d.getTime();       
        var currntTime4=(n/(3600*1000));     
        var diff=time-currntTime4;  
        //alert(diff); 
        if(timestatus=="Between")
        {  
          //alert('tt');     
          if(diff<=3.80)   
          {  
              alert('Please enter 4 hour difference for available time');  
              document.form1.datetimepicker1.focus();   
              return false;    
          }
        }
    } 
 

  if(document.form1.designation.value=="")
  {
  alert("Please Select Designation") ;
  document.form1.designation.focus();
  return false;
  }
  
  if(document.form1.contact_person.value=="")
  {
  alert("Please Select Contact Person") ;
  document.form1.Zone_area.focus();
  return false;
  }
  
  if(document.form1.contact_number.value=="")
  {
  alert("Please Select Contact Number") ;
  document.form1.contact_number.focus();
  return false;
  }

  if(document.getElementById("dataDesignation").style.display=='none' ){
      
  }else{
    if(document.form1.designation2.value=="")
    {
    alert("Please Select Alternate Designation") ;
    document.form1.designation2.focus();
    return false;
    }
    
    if(document.form1.contact_person2.value=="")
    {
    alert("Please Input Alternate Contact Person") ;
    document.form1.contact_person2.focus();
    return false;
    }
    
    if(document.form1.contact_number2.value=="")
    {
    alert("Please Input Alternate Contact Number") ;
    document.form1.contact_number2.focus();
    return false;
    }
  }

  
  var phone=document.forms["form1"]["contact_number"].value;
  var phoneNum = phone.replace(/[^\d]/g, '');
  if(phoneNum.length != 10) {  alert("Please Enter Contact Number 10 Digit") ;document.form1.contact_number.focus();
  return false; }

if(document.form1.veh_type.value=="")
  {
  alert("Please Select Vehicle Type") ;
  document.form1.veh_type.focus();
  return false;
  }

  var vehType=document.forms["form1"]["veh_type"].value;
  if(vehType=="Car")
  {

    if(document.form1.lux.value=="")
    {
    alert("Please Select Luxury Type") ;
    document.form1.lux.focus();
    return false;
    }

    var luxaryType=document.forms["form1"]["lux"].value;

    if(luxaryType=="luxury" || luxaryType=="NonLuxury")
    {

      if(document.form1.actype.value=="")
      {
        alert("Please Select AC Type") ;
        document.form1.actype.focus();
        return false;
      }

    }

  }

  if(vehType=="Bus")
  {

    if(document.form1.standard.value=="")
    {
    alert("Please Select Delux Type") ;
    document.form1.standard.focus();
    return false;
    }

    var deluxType=document.forms["form1"]["standard"].value;

    if(deluxType=="Delux" || deluxType=="NonDelux")
    {

      if(document.form1.actype.value=="")
      {
        alert("Please Select AC Type") ;
        document.form1.actype.focus();
        return false;
      }

    }

  }

  if(vehType=="Truck")
  {

    if(document.form1.TruckType.value=="")
    {
    alert("Please Select Truck Category") ;
    document.form1.TruckType.focus();
    return false;
    }

  }
  
  if(vehType=="Trailer")
  {

    if(document.form1.TrailerType.value=="")
    {
    alert("Please Select Trailer Type") ;
    document.form1.TrailerType.focus();
    return false;
    }

  }
  
  if(vehType=="Machine")
  {

    if(document.form1.MachineType.value=="")
    {
    alert("Please Select Machine Type") ;
    document.form1.MachineType.focus();
    return false;
    }

  }
  
}
   
function setVisibility(id, visibility)
{
    document.getElementById(id).style.display = visibility;
}

function TillBetweenTime(radioValue)
{
//alert(radioValue)
 if(radioValue=="Till")
    {

      document.getElementById('TillTime').style.display = "block";
      document.getElementById('BetweenTime').style.display = "none";
      if(document.getElementById('TillTime').value=="")
      {
      alert("Please Select Time") ;
      return false; 
      }

    
    }
    else if(radioValue=="Between")
    {
    document.getElementById('TillTime').style.display = "none";
    document.getElementById('BetweenTime').style.display = "block";
    }
    else
    {
    document.getElementById('TillTime').style.display = "none";
    document.getElementById('BetweenTime').style.display = "none";
    }
}

function TillBetweenTime12(radioValue)
{
 if(radioValue=="Till")
    {
    document.getElementById('TillTime').style.display = "block";
    document.getElementById('BetweenTime').style.display = "none";
    }
    else if(radioValue=="Between")
    {
    document.getElementById('TillTime').style.display = "none";
    document.getElementById('BetweenTime').style.display = "block";
    }
    else
    {
    document.getElementById('TillTime').style.display = "none";
    document.getElementById('BetweenTime').style.display = "none";
    }
   
}

function StatusBranch(radioValue)
{
  //alert(radioValue)
   if(radioValue=="Interbranch")
    {
        document.getElementById('branchlocation').style.display = "block";
    }
    else if(radioValue=="Samebranch")
    {
        document.getElementById('branchlocation').style.display = "none";
    }
    else
    {
        document.getElementById('branchlocation').style.display = "none";
    }
   
} 

function showAccess(radioValue)
{
  //alert(radioValue)
   if(radioValue=="yes")
    {
        document.getElementById('accessTable').style.display = "block";
    }
    else if(radioValue=="no")
    {
        document.getElementById('accessTable').style.display = "none";
    }
    else
    {
        document.getElementById('accessTable').style.display = "none";
    }
   
}
          

function StatusBranch12(radioValue)
{
  //alert(radioValue)
   if(radioValue=="Interbranch")
    {
        document.getElementById('branchlocation1').style.display = "block";
    }
    else if(radioValue=="Samebranch")
    {
        document.getElementById('branchlocation').style.display = "none";
    }
    else
    {
        document.getElementById('branchlocation').style.display = "none";
        //document.getElementById('samebranchid').style.display = "none";
    }
   
} 
</script> 
  

<?php echo "<p align='left' style='padding-left: 250px;width: 500px;' class='message'>" .$errorMsg. "</p>" ; ?>
  
<style type="text/css" >

.custom-date-style {
  background-color: red !important;
}

.input{ 
}
.input-wide{
  width: 500px;
}

.errorMsg{border:1px solid red; }
.message{color: red; font-weight:bold; }
body { font-family:'Open Sans' Arial, Helvetica, sans-serif}
ul,li { margin:0; padding:0; list-style:none;}
.label { color:#000; font-size:16px;}
/*td{ border :1px solid#000; }*/
</style>

 <form method="post" action="" name="form1" onSubmit="return req_info();" autocomplete="off">
    <table style="padding-left: 100px;width: 600px;" cellspacing="5" cellpadding="5">
      <tr>
        <td align="right" nowrap width="100px"> Client User Name:<font color="red">*</font></td>
        <td width="400px">
          <select style="width:150px;" name="main_user_id" id="main_user_id"  onchange="getCompanyName(this.value,'TxtCompany');getSalesPersonName(this.value,'TxtSalesPersonName');getdeletedImei(this.value,'deletedImei');" >
            <option value="" >-- Select One --</option>
            <?php

              $main_user_iddata=select_query("SELECT Userid AS user_id,UserName AS `name` FROM addclient WHERE sys_active=1 ORDER BY `name` asc");
              
              for($u=0;$u<count($main_user_iddata);$u++)
              {
                if($main_user_iddata[$u]['user_id']==$result['user_id'])
                {
                  $selected="selected";
                }
                else
                {
                  $selected="";
                }
            ?>
            <option value ="<?php echo $main_user_iddata[$u]['user_id'] ?>"  <?php echo $selected;?>> <?php echo $main_user_iddata[$u]['name']; ?> </option>
            <?php
              }
            ?>
          </select>
        </td>
      </tr>
      <tr>
        <td align="right" nowrap>Billing:</td>
        <td>
          <input type='radio' name ='billing' id='bill_no' value='No' checked="checked" />No 

          &#160;&#160;&#160;&#160;&#160;&#160; Urgent:<input type="checkbox" name="required" id="required" value="urgent" <?php if($result['required']=='urgent') {?> checked="checked" <? }?> />
        </td>
  
      </tr>
      <tr>
        <td  align="right" nowrap>Sales Person:<font color="red">*</font></td>
        <td colspan="2"><input style="width:146px" type="text" name="sales_person" id="TxtSalesPersonName" readonly /></td>
      </tr>
      <tr>
        <td  align="right" nowrap>Company Name:<font color="red">*</font></td>
        <td colspan="2"><input style="width:146px" type="text" name="company" id="TxtCompany" readonly /></td>
      </tr>
      <tr>        
        <td align="right" nowrap >Select Device Type<font color="red">*</font></td>
        <td>
           <select name="status" id="imeistatus" style="width:150px" onchange="deviceImeiStatus(this.value)">
            <option value="" selected disabled>Select Device Type</option>
            <option value="Deleted">Deleted</option>
            <option value="Spare">Spare</option>
           </select>
        </td>
      </tr>
      <tr>        
        <td align="right" nowrap >Select Device Status<font color="red">*</font></td>
        <td>
           <select name="deviecestatus" id="deviecestatus" style="width:150px" onchange="deviceStatus2(this.value)">
            <option value="" selected disabled>Select Device Status</option>
            <option value="1">G-Trac</option>
            <option value="2">Client</option>
           </select>
        </td>
      </tr>
      
      <tr>
        <td align="right" nowrap>No. Of Installation:<font color="red">*</font></td>
        <td>
          <select name="no_of_installation" id="no_of_installation" style="width:150px" onchange="deviceRecords(this.value)">
                <option value="">Select Installation</option>
                <?php for($i=1;$i<=20;$i++) { ?>  
                  <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                <?php } ?>  
                </select>
        </td>
      </tr>
      <tr>
        <td></td>
        <td>
          <table>
            <tr>
              <td>
                 <tbody id="textA"></tbody>
              </td>
            </tr>
          </table>
        </td>
      </tr>
    <tr>
        <td  align="right">Accessories:<font color="red">*</font></td>
        <td nowrap><?php $branch_data = select_query("select * from tbl_city_name where branch_id='".$_SESSION['BranchId']."'"); ?>
          <input type='radio' Name ='access_radio' id='acc' value= 'yes' <?php //if($result['branch_type']=='Samebranch'){echo "checked=\"checked\""; }?> onchange="showAccess(this.value);">
          Yes
          <input type='radio' Name ='access_radio' id='acc' value= 'no' <?php// if($result['branch_type']=='Interbranch'){echo "checked=\"checked\""; }?>
          onchange="showAccess(this.value);">
          No &#160;&#160;&#160;&#160;&#160;<span id="msg1"></span>
        </td>

    </tr>

    <tr>
      <td></td>
        <td align="left">
          <table  id="accessTable"  align="left" style="height: 15em;  overflow: auto;display:none;" cellspacing="2" cellpadding="2">
          <td> <input type="checkbox" name="acess_all[]" id="acess_all" onClick="selectAllAccessory(this)"  style="width:150px;" /> Select All</td>
          <?
            $accessory_data=select_query("SELECT id,items AS `access_name` FROM toolkit_access   ORDER BY `access_name` asc");
            //while($data=mysql_fetch_array($query)) 

          for($v=0;$v<count($accessory_data);$v++)
          {
            ?>
                <tr>

                
                  <td><input type="checkbox" name="accessories[]" id="accessories<?php echo $v; ?>" value="<?php echo $accessory_data[$v]['id']; ?>" style="width:150px;" onClick="setRow('<?php echo $v; ?>');" class="checkbox1">
                  <?=$accessory_data[$v]['access_name']?></td>    
                </tr>
              <?php
               }
          ?>  
          
          </table>
        </td>
      </tr>

      <tr>
        <td  align="right">Branch:<font color="red">*</font></td>
        <td><?php $branch_data = select_query("select * from tbl_city_name where branch_id='".$_SESSION['BranchId']."'"); ?>
          <input type='radio' Name ='inter_branch' id='inter_branch' value='Samebranch' onchange="StatusBranch(this.value);">
          <?php echo $branch_data[0]["city"];?>
          <Input type='radio' Name ='inter_branch' id='inter_branch' value='Interbranch'
        onchange="StatusBranch(this.value);">
          Inter Branch &#160;&#160;&#160;&#160;&#160;<span id="msg2"></span>
        </td>
      </tr>

      <tr>
        <td colspan="2">
          <table  id="branchlocation"  align="right"  style="width: 100%;display:none;margin-left:-6px;" cellspacing="5" cellpadding="5">
            <tr>
              <td align="right" style="width: 41%;margin-right:-1px;">Branch Location:<font color="red">*</font></td>
              <td><select name="inter_branch_loc" id="inter_branch_loc" style="width:150px;">
                  <option value="" >-- Select One --</option>
                  <?php
                      $city1=select_query("select * from tbl_city_name where branch_id!='".$_SESSION['BranchId']."'");
                      
                      for($i=0;$i<count($city1);$i++)
                      {
                          if($city1[$i]['branch_id']==$result['inter_branch'])
                          {
                              $selected="selected";
                          }
                          else
                          {
                              $selected="";
                          }
                      ?>
                      <option value ="<?php echo $city1[$i]['branch_id'] ?>"  <?php echo $selected;?>> <?php echo $city1[$i]['city']; ?> </option>
                      <?php
                      }
                      ?>
                </select>
              </td>
            </tr>
          </table>
        </td>
      </tr>
      <tr>
        <td align="right" nowrap> Area:<font color="red">*</font></td>
        <td><input style="width:146px" type="text" name="Zone_area" id="Zone_area" value="<?php echo $area["name"];?>" />
          <div id="ajax_response"></div>
        </td>
      </tr>
      
     <tr>
        <td align="right" nowrap> LandMark:<font color="red">*</font></td>
        <td><input style="width:146px" type="text" name="landmark"  id="location" value="<?=$result['location']?>" minlength="15"/></td>
    </tr> 
      
      <tr>
        <td align="right" nowrap>Availbale Time status:<font color="red">*</font></td>
        <td><select name="atime_status" id="atime_status" style="width:150px" onchange="TillBetweenTime(this.value)">
            <option value="">Select Status</option>
            <option value="Till" <?php if($result['atime_status']=='Till') {?> selected="selected" <?php } ?> >Till</option>
            <option value="Between" <?php if($result['atime_status']=='Between') {?> selected="selected" <?php } ?> >Between</option>
          </select>
        </td>
      </tr>
      
      <tr>
        <td colspan="2">
          <table  id="TillTime" align="left" style="width:100%;display:none;margin-left:60px;"  cellspacing="5" cellpadding="5">
            <tr>
              <td height="32" align="right">Time:<font color="red">*</font></td>
              <td><input type="text" name="time" id="datetimepicker" value="<?=$result['time']?>" style="width:147px"/></td>
            </tr>
          </table>
          <table  id="BetweenTime" align="left" style="width:100%;display:none;margin-left:38px;"  cellspacing="5" cellpadding="5">
            <tr>
              <td height="32" align="right">From Time:<font color="red">*</font></td>
              <td><input type="text" name="time1" id="datetimepicker1" value="<?=$result['time']?>" style="width:147px"/></td>
            </tr>
            <tr>
              <td height="32" align="right">To Time:<font color="red">*</font></td>
              <td><input type="text" name="totime" id="datetimepicker2" value="<?=$result['totime']?>" style="width:147px"/></td>
            </tr>
          </table></td>
      </tr>
      <tr>
        <td align="right" valign="top">Contact Details<font color="red">*</font></td>
        <td style="margin-left:20px;">
          <table cellspacing="0" cellpadding="0">
            <tr>
              <td>
                  <INPUT type="button" value="+" id='addRowss' onClick="addRow('dataTable')" />
              </td>
              <td>
                  <INPUT type="button" value="-" id='delRowss' onClick="deleteRow('dataTable')" />
              </td>
            </tr>
          </table>
          <table id="dataTable"  cellspacing="" cellpadding="">
           <tr>
                <td  height="32" align="right">
                  <select name="designation" id="designation" style="margin-left:-4px"
                onchange="designationChange(this.value)">
                    <option value="" disabled selected>-- Select Designation --</option>
                    <option value="driver" >Driver</option>
                    <option value="supervisor" >Supervisoer</option>
                    <option value="manager" >Manager</option>
                    <option value="senior manager" >Senior Manager</option>
                     <option value="owner">Owner</option>
                     <option value="sale person">Sale Person</option>
                     <option value="others">Others</option>
                  
                  </select>
                </td>
                <td>
                  <input type="text" name="contact_person" placeholder="Contact Person" pattern="[a-zA-Z]{3,}" id="contact_person" value="<?=$result['contact_person']?>" style="width:147px"/>
                </td>
                <td>
                  <input type="text" name="contact_number" placeholder="Contact Number" id="contact_number"  minlength="10" maxlength="10" value="<?=$result['contact_number']?>"  onkeypress='return event.charCode >= 48 && event.charCode <= 57'  style="width:147px"/>
                </td>       
           </tr>
           <tr id="dataDesignation" style="display:none">
                <td  height="32" align="right">
                  <select name="designation2" id="designation2" style="margin-left:-4px"
                onchange="designationChange(this.value)">
                    <option value="" disabled selected>-- Select Designation --</option>
                    <option value="driver" >Driver</option>
                    <option value="supervisor" >Supervisoer</option>
                    <option value="manager" >Manager</option>
                    <option value="senior manager" >Senior Manager</option>
                     <option value="owner">Owner</option>
                     <option value="sale person">Sale Person</option>
                     <option value="others">Others</option>
                  
                  </select>
                </td>
                <td>
                  <input type="text" name="contact_person2" placeholder="Contact Person" pattern="[a-zA-Z]{3,}" id="contact_person2" value="<?=$result['contact_person']?>" style="width:147px"/>
                </td>
                <td>
                  <input type="text" name="contact_number2" placeholder="Contact Number" id="contact_number2"  minlength="10" maxlength="10" value="<?=$result['contact_number']?>"  onkeypress='return event.charCode >= 48 && event.charCode <= 57'  style="width:147px"/>
                </td>       
           </tr>
          </table>
          
        </td>
      </tr>
      
      <tr>
        <td height="32" align="right">Vehicle Type:<font color="red">*</font></td>
        <td>
          <table align="left" cellspacing="5" cellpadding="5">
            <tr>
              <td>
                <select name="veh_type" id="veh_type" style="width:150px;margin-left:-12px" onchange="vehicleType(this.value,'standard');" >
                  <option value=""  disabled selected>-- Select Vehicle Type --</option>
                  <option value="Car" <?php if($result[0]['veh_type']=='Car') {?> selected="selected" <?php } ?>>Car</option>
                  <option value="Bus" <?php if($result[0]['veh_type']=='Bus') {?> selected="selected" <?php } ?>>Bus</option>
                  <option value="Truck" <?php if($result[0]['veh_type']=='Truck') {?> selected="selected" <?php } ?>>Truck</option>
                  <option value="Bike" <?php if($result[0]['veh_type']=='Bike') {?> selected="selected" <?php } ?>>Bike</option>
                  <option value="Trailer" <?php if($result[0]['veh_type']=='Trailer') {?> selected="selected" <?php } ?>>Trailer</option>
                  <option value="Tempo" <?php if($result[0]['veh_type']=='Tempo') {?> selected="selected" <?php } ?>>Tempo</option>
                  <option value="Machine" <?php if($result[0]['veh_type']=='Machine') {?> selected="selected" <?php } ?>>Machine</option>
                </select>
              </td>
              <td>
                <select name="lux" id="lux" style="width:150px;display:none" onchange="aclux(this.value);" >
                  <option value="" disabled selected>Select Luxury Category</option>
                  <option value="luxury" <?php if($result[0]['luxury']=='luxury') {?> selected="selected" <?php } ?> >Lurxury</option>
                  <option value="NonLuxury" <?php if($result[0]['luxury']=='NonLuxury') {?> selected="selected" <?php } ?>>Non-Luxury</option>
                </select>
              </td>
              <td>
                <select name="standard" id="standard" palceholder="Vehicle Type" style="width:150px;display:none" onchange="standardType(this.value,'actype');" >
                  <option value="" disabled selected>Select Delux category</option>
                  <option value="Delux" <?php if($result[0]['standard']=='Delux') {?> selected="selected" <?php } ?> >Delux</option>
                  <option value="NonDelux" <?php if($result[0]['standard']=='NonDelux') {?> selected="selected" <?php } ?>>NonDelux</option>
                </select>
              </td>
              <td>
                <select name="actype" id="actype" style="width:150px;display:none" onchange="checkbox_lease();" >
                  <option value="" disabled  selected>Select AC Category</option>
                  <option value="AC" <?php if($result[0]['actype']=='AC') {?> selected="selected" <?php } ?>>AC</option>
                  <option value="NonAC" <?php if($result[0]['actype']=='NonAC') {?> selected="selected" <?php } ?>>Non-AC</option>
                </select>
              </td>
            <td>
                <select name="TrailerType" id="TrailerType" palceholder="Vehicle Type" style="width:150px;display:none" >
                  <option value="" disabled selected>Select your category</option>
                  <option value="Genset  AC Trailer" <?php if($result[0]['veh_type']=='Machine') {?> selected="selected" <?php } ?>>Genset  AC Trailer</option>
                  <option value="Refrigerated Trailer" <?php if($result[0]['veh_type']=='Machine') {?> selected="selected" <?php } ?>>Refrigerated Trailer</option>
                </select>
              </td>
              <td>
                <select name="MachineType" id="MachineType" palceholder="Vehicle Type" style="width:150px;display:none" >
                  <option value="" disabled selected>Select Machine category</option>
                  <option value="Vermeer Series-2" <?php if($result[0]['MachineType']=='Vermeer Series-2') {?> selected="selected" <?php } ?>>Vermeer Series-2</option>
                  <option value="Ditch Witch" <?php if($result[0]['MachineType']=='Ditch Witch') {?> selected="selected" <?php } ?>>Ditch Witch</option>
                  <option value="Halyma" <?php if($result[0]['MachineType']=='Halyma') {?> selected="selected" <?php } ?>>Halyma</option>
                  <option value="Drillto" <?php if($result[0]['MachineType']=='Drillto') {?> selected="selected" <?php } ?>>Drillto</option>
                  <option value="LCV" <?php if($result[0]['MachineType']=='LCV') {?> selected="selected" <?php } ?>>LCV</option>
                  <option value="Oil Filtering Machine" <?php if($result[0]['MachineType']=='Oil Filtering Machine') {?> selected="selected" <?php } ?>>Oil Filtering Machine</option>
                  <option value="JCB" <?php if($result[0]['veh_type']=='JCB') {?> selected="selected" <?php } ?>>JCB</option>
                  <option value="Sudhir Generator" <?php if($result[0]['MachineType']=='Sudhir Generator') {?> selected="selected" <?php } ?>>Sudhir Generator</option>
                  <option value="Container Loading Machine (Kony)" <?php if($result[0]['MachineType']=='Container Loading Machine (Kony)') {?> selected="selected" <?php } ?>>Container Loading Machine (Kony)</option>
                </select>
              </td>
              <td>
                <select name="TruckType" id="TruckType" palceholder="Vehicle Type" style="width:150px;display:none" >
                  <option value="" disabled selected>Select Truck Category</option>
                  <option value="Refrigerated Truck" <?php if($result[0]['TruckType']=='Refrigerated Truck') {?> selected="selected" <?php } ?>>Refrigerated Truck</option>
                  <option value="Pickup Van" <?php if($result[0]['TruckType']=='Pickup Van') {?> selected="selected" <?php } ?>>Pickup Van</option>
                </select>
              </td>
            </tr>
          </table>  

        </td>
      </tr>
      <tr>
        <td height="32" align="right"><input type="submit" name="submit" id="button1" value="submit" align="right" /></td>
        <td><input type="button" name="Cancel" value="Cancel" onClick="window.location = 'installation.php' " /></td>
      </tr>
      
    </table>

  </form>
</div>
<!-- <script>

jq.datetimepicker.setLocale('en');

jq('#datetimepicker_format').datetimepicker({value:'2015/04/15 05:03', format: jq("#datetimepicker_format_value").val()});
console.log(jq('#datetimepicker_format').datetimepicker('getValue'));

jq("#datetimepicker_format_change").on("click", function(e){
  jq("#datetimepicker_format").data('xdsoft_datetimepicker').setOptions({format: jq("#datetimepicker_format_value").val()});
});
jq("#datetimepicker_format_locale").on("change", function(e){
  jq.datetimepicker.setLocale(jq('e.currentTarget').val('#datetimepicker.setLocale.getHours()' + "04:00:00"));
});

jq('#datetimepicker').datetimepicker({
dayOfWeekStart : 1,
lang:'en',
disabledDates:['1986/01/08','1986/01/09','1986/01/10'],
startDate:  'newdate',step:10
});


jq('.some_class').datetimepicker();


jq('#datetimepicker1').datetimepicker({
dayOfWeekStart : 2,
lang:'en',
disabledDates:['1986/01/08','1986/01/09','1986/01/10'],
startDate:  '#datetimepicker_format_locale',step:10
});

jq('.some_class').datetimepicker();

jq('#datetimepicker2').datetimepicker({
dayOfWeekStart : 1,
lang:'en',
disabledDates:['1986/01/08','1986/01/09','1986/01/10'],
startDate:  '#datetimepicker_format_locale',step:10
});


jq('.some_class').datetimepicker();
</script> -->

<script type="text/javascript">
  

//var $jq = jquery.noConflict();

$(document).ready(function(){

  $('#no_of_installation').change(function(){
   // alert("1")
      $("#textA").html("");
      var number = $("#no_of_installation").val();
      //alert(number)

         
    });




  $("#hide").click(function(){
      $("#acn").hide();
  });
  $("#show").click(function(){
      $("#acn").show();
  });

  // Designation Hide Show

  var counter=0;

  $("#delRowss").click(function(){
      $("#dataDesignation").hide();
      $("#designation2").val('');
      $("#contact_person2").val('');
      $("#contact_number2").val('');
      if($("#dataDesignation").hide()){ --counter; }
      //alert(counter)
      if(counter < 0){alert("Atleast One Contact Must")}

  });
  $("#addRowss").click(function(){
      $("#dataDesignation").show();
      if($("#dataDesignation").show()){ ++counter; }
      if(counter > 1){alert("No More Add Contacts")}
  });

  // End Designation Hide Show

  // $('#deviecestatus').change(function() {
  //   location.reload();
  // });

  // Accessories Checked Unchecked

  $('.checkbox1').on('change', function() {
  var bool = $('.checkbox1:checked').length === $('.checkbox1').length;
    $('#acess_all').prop('checked', bool);
    });

    $('#acess_all').on('change', function() {
    $('.checkbox1').prop('checked', this.checked);
  });

  // End Accessories Checked Unchecked  


  
  var offset = $("#Zone_area").offset();
    var width = $("#Zone_area").width()-2;
    $("#ajax_response").css("left",offset);
    $("#ajax_response").css("width","15%");
    $("#ajax_response").css("z-index","1");
    $("#Zone_area").keyup(function(event){
         //alert(event.keyCode);
         var keyword = $("#Zone_area").val();
         var city_id= $("#inter_branch_loc").val();
         var inter_branch= $("#inter_branch").val();
          //alert(inter_branch);
         if(city_id=='')
         {
            city_id=1;
         }
         //alert(city_id);
         if(keyword.length)
         {
             if(event.keyCode != 40 && event.keyCode != 38 && event.keyCode != 13)
             {
                 $("#loading").css("visibility","visible");
                 $.ajax({
                   type: "POST",
                   url: "load_zone_area.php",
                   data: "data="+keyword+"&city_id="+city_id,
                   success: function(msg){  
                  // alert(msg); 
                    if(msg != 0)
                      $("#ajax_response").fadeIn("slow").html(msg);
                    else
                    {
                      $("#ajax_response").fadeIn("slow");   
                      $("#ajax_response").html('<div style="text-align:left;">No Matches Found</div>');
                    }
                    $("#loading").css("visibility","hidden");
                   }
                 });
             }
             else
             {
                switch (event.keyCode)
                {
                 case 40:
                 {
                      found = 0;
                      $("li").each(function(){
                         if($(this).attr("class") == "selected")
                            found = 1;
                      });
                      if(found == 1)
                      {
                        var sel = $("li[class='selected']");
                        sel.next().addClass("selected");
                        sel.removeClass("selected");
                      }
                      else
                        $("li:first").addClass("selected");
                     }
                 break;
                 case 38:
                 {
                      found = 0;
                      $("li").each(function(){
                         if($(this).attr("class") == "selected")
                            found = 1;
                      });
                      if(found == 1)
                      {
                        var sel = $("li[class='selected']");
                        sel.prev().addClass("selected");
                        sel.removeClass("selected");
                      }
                      else
                        $("li:last").addClass("selected");
                 }
                 break;
                 case 13:
                    $("#ajax_response").fadeOut("slow");
                    $("#Zone_area").val($("li[class='selected'] a").text());
                 break;
                }
             }
         }
         else
            $("#ajax_response").fadeOut("slow");
    });
   
    $("#ajax_response").mouseover(function(){
        $(this).find("li a:first-child").mouseover(function () {
              $(this).addClass("selected");
        });
        $(this).find("li a:first-child").mouseout(function () {
              $(this).removeClass("selected");
        });
        $(this).find("li a:first-child").click(function () {
              $("#Zone_area").val($(this).text());
              $("#ajax_response").fadeOut("slow");
        });
    });

 });

  function deviceStatus2(devicestatus){
    
    if(devicestatus > 0)
      {
          $("#status").show();
          var d_status = $("#deviecestatus").val();
          var user_id = $("#main_user_id").val();
           //alert(d_status)
          $.ajax({
            type:"GET",
            url:"userInfo.php?action=getAllImei",
            data:"userId="+user_id+"&dStatus="+d_status,
            success:function(msg){
             //alert(msg);
             var deviceImei = JSON.parse(msg)
             var imeiNumber = [];
             //alert(""+deviceImei.length)
             for(var i=0;i<deviceImei.length;i++){
              //alert(deviceImei.length)
              //alert(deviceImei[i].imei)

              imeiNumber.push(deviceImei[i].device_imei)
                    
             }
             if(d_status == 1){
                alert("Deleted GTRAC IMEI("+deviceImei.length+"): "+imeiNumber) 
             }
             else if(d_status == 2){
               alert("Deleted CLEINT IMEI("+deviceImei.length+"): "+imeiNumber)
             }
             else{
                alert("Record not found")
             }
            }    
         });
      }
  }

  function deviceRecords(total)
  {
    //alert(total);
    if(total > 0)
      {
          $("#status").show();
          var d_status = $("#deviecestatus").val();
          var user_id = $("#main_user_id").val();
           //alert(d_status)
          $.ajax({
            type:"GET",
            url:"userInfo.php?action=getAllImei",
            data:"userId="+user_id+"&dStatus="+d_status,
            success:function(msg){
             //alert(msg);
             var deviceImei = JSON.parse(msg)
             var imeiNumber = [];
             //alert(""+deviceImei.length)
             for(var i=0;i<deviceImei.length;i++){
              //alert(deviceImei.length)
              //alert(deviceImei[i].imei)

              imeiNumber.push(deviceImei[i].device_imei)
                    
             }
             
             var num = String(imeiNumber).split(',')
             var option = "<option value=''>Select Imei No</option>"
             for(var a = 0; a < num.length; a++) {
              
              option += "<option value='"+num[a]+"'>"+num[a]+"</option>"
              
             }
              for(var i =1; i <= total; i++){

                var age1 = `<tr><td><select name='imei[]' id="device_imei${i}" style="width:150px" onchange="devicestatus(this.value,'txtDeviceStatus${i}'),devicetype(this.value,'txtDeviceType${i}'),devicemodel(this.value,'txtDeviceModel${i}')">${option}</select></td><td><input type='text' style="width:145px" placeholder="Device Status" name='txtDeviceStatus[]' id='txtDeviceStatus${i}' readonly></td><td><input type='text' style="width:145px" name='txtDeviceType[]' placeholder="Device Type" id='txtDeviceType${i}' readonly></td><td><input type='text' style="width:145px" name='txtDeviceModel[]' placeholder="Device Model" id='txtDeviceModel${i}' readonly></td></tr>`;
                $("#textA").append(age1);

              }
            }    
          });
        } 
}

function devicestatus(imei,setDivId){
  //alert(imei)
  $.ajax({
      type:"GET",
      url:"userInfo.php?action=imeistatus",
      data:"imeiNo="+imei,
      success:function(msg){
        //alert(msg);
        document.getElementById(setDivId).value = msg;
      }
  });
}

function devicetype(imei,setDivId)
{
  //alert(imei);
  $.ajax({
      type:"GET",
      url:"userInfo.php?action=imeiDeviceType",
      data:"imeiNo="+imei,
      success:function(msg){
        //alert(msg);
        document.getElementById(setDivId).value = msg;
      }
  });
}

function devicemodel(imei,setDivId)
{
  //alert(imei)
  $.ajax({
      type:"GET",
      url:"userInfo.php?action=imeiModelName",
      data:"imeiNo="+imei,
      success:function(msg){
        //alert(msg)
        document.getElementById(setDivId).value = msg;
      }
  });
}


function deviceImeiStatus(imeistatus)
{
  
  if(imeistatus == "Deleted"){
    document.getElementById('no_of_installation').style.display = "block";
  }
  else{
    document.getElementById('no_of_installation').style.display = "block";
  }
}

function getdeletedImei(RowId,DivId)
{
  //var user_id = document.getElementById("main_user_id");
  //alert(RowId)
  $.ajax({
    type:"GET",
    url:"userInfo.php?action=countDeletedImei",
    //data:"category="+category+"&expairy="+expairy1+"&duration="+durationlist+"&sortby="+sortby+"&price="+price+"&search="+search1,
    data:"row_id="+RowId,
    success:function(msg){
      $("#textB").html("");
      if(msg.length > 0){
        //alert(msg)

        var objImei = JSON.parse(msg);
        //alert(objImei[0].imei)
        for(var i =1; i <= objImei.length; i++){

              $('#textB').append($('<option>',
            {
                value: i,
                text : i 

            }));

          }
      }       
    }
  });
}
  


</script>


<?
include("../include/footer.php");

?>
<script type="text/javascript">
  
var logic = function( currentDateTime ){
  if (currentDateTime && currentDateTime.getDay() == 6){
    this.setOptions({
      minTime:'11:00'
    });
  }else
    this.setOptions({
      minTime:'8:00'
    });
};
$('#datetimepicker').datetimepicker({
  onChangeDateTime:logic,
  onShow:logic
});
$('#datetimepicker1').datetimepicker({
  onChangeDateTime:logic,
  onShow:logic
});

$('#datetimepicker2').datetimepicker({
  onChangeDateTime:logic,
  onShow:logic
});


</script>
<script>StatusBranch12("<?=$result['branch_type'];?>");TillBetweenTime12("<?=$result['atime_status'];?>");</script>
