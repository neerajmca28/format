<?php
include("../connection.php");
include_once(__DOCUMENT_ROOT.'/include/header.inc.php');
include_once(__DOCUMENT_ROOT.'/include/leftmenu_service.php');

/*include($_SERVER['DOCUMENT_ROOT']."/service/include/header.inc.php");
include($_SERVER['DOCUMENT_ROOT']."/format/include/leftmenu_service.php");*/

?>
<link  href="<?php echo __SITE_URL;?>/css/auto_dropdown.css" rel="stylesheet" type="text/css" />
<!-- <link href="<?php echo __SITE_URL;?>/js/jquery.multiselect.css" rel="stylesheet" type="text/css"> -->
<script src="<?php echo __SITE_URL;?>/js/jquery.min.js"></script>
<!-- <script src="<?php echo __SITE_URL;?>/js/jquery.multiselect.js"></script> -->
<link rel="stylesheet" type="text/css" href="<?php echo __SITE_URL;?>/build/jquery.datetimepicker.css"/>
<script src="<?php echo __SITE_URL;?>/build/jquery.datetimepicker.full.js"></script>
<script type="text/javascript">

$(document).ready(function(){
    $("#hide").click(function(){
        $("#acn").hide();
    });
    $("#show").click(function(){
        $("#acn").show();
    });
   $('#main_user_id').attr("disabled", true);
   $('#sales_person').attr("disabled", true); 
 


});

  
function selectAllAccessory(source) {
    var checkboxes = document.getElementsByName('accessories[]');
    for(var i in checkboxes)
      checkboxes[i].checked = source.checked;
  }


  var counter = 1;
  
  function addRow(tableID) 
  {
    var table = document.getElementById(tableID);
    var rowCount = table.rows.length;
            
    if(rowCount>1)
    {
      alert("No more than 2 contact Details fills");
      return false;
    }
    
    var row = table.insertRow(rowCount);
    var colCount = table.rows[0].cells.length;
    //console.log('colCount'+colCount2);
   //alert(colCount);
    
    
    for(var i=0; i<colCount; i++) 
    {

      var newcell = row.insertCell(i);
      
      newcell.innerHTML = table.rows[0].cells[i].innerHTML;
       //alert(newcell.innerHTML);
      //console.log('childnode'+newcell.childNodes[0]);
      //console.log(newcell.childNodes[0].type);
      switch(i) {
        case 0:
          newcell.childNodes[0].selectedIndex = 0;
          newcell.childNodes[0].id = 'designation' + counter ;  
    
          break;
        case 2:
         
          newcell.childNodes[0].id = 'contact_person' + counter ;
          //alert(newcell.childNodes[0].id);
          break;
        case 4:
          
          newcell.childNodes[0].id = 'contact_number' + counter ;
              //alert(newcell.childNodes[0].id);
          break;
      }
      
    }
    
    counter++;
  }
    function deleteRow(tableID)
     {
    try {
      var table = document.getElementById(tableID);
      var rowCount = table.rows.length;
       // alert(rowCount); 
      
      if(rowCount <=1) {
        alert("Cannot delete all the rows.");
        return false;
      }
      if(rowCount > 1) {
        var row = table.rows[rowCount-1];
        //alert(row); 
        table.deleteRow(rowCount-1);
        // table.deleteRow(rowCount-2);
        // table.deleteRow(rowCount-3);
        rowCount = rowCount-3;
        rowCount--;
      }
    }
    catch(e) {
      alert(e);
    }
  }






/*Start auto ajax value load code*/
 var $s = jQuery.noConflict();
$s(document).ready(function(){
    $s(document).click(function(){
        $s("#ajax_response").fadeOut('slow');
    });
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
$s('#datetimepicker').datetimepicker({
  onChangeDateTime:logic,
  onShow:logic
});
$s('#datetimepicker1').datetimepicker({
  onChangeDateTime:logic,
  onShow:logic
});

$s('#datetimepicker2').datetimepicker({
  onChangeDateTime:logic,
  onShow:logic
});






    $s("#required").focus();

    var offset = $s("#Zone_area").offset();
    var width = $s("#Zone_area").width()-2;
    $s("#ajax_response").css("left",offset);
    $s("#ajax_response").css("width","15%");
    $s("#ajax_response").css("z-index","1");
    $s("#Zone_area").keyup(function(event){
         //alert(event.keyCode);
        var keyword = $s("#Zone_area").val();
         var city_id= $s("#inter_branch_loc").val();
          var inter_branch= $s("#inter_branch").val();
         if(keyword.length)
         {
             if(event.keyCode != 40 && event.keyCode != 38 && event.keyCode != 13)
             {
                 $s("#loading").css("visibility","visible");
                 $s.ajax({
                   type: "POST",
                   url: "load_zone_area.php",
                   data: "data="+keyword+"&city_id="+city_id,
                   success: function(msg){   
                    if(msg != 0)
                      $s("#ajax_response").fadeIn("slow").html(msg);
                    else
                    {
                      $s("#ajax_response").fadeIn("slow");   
                      $s("#ajax_response").html('<div style="text-align:left;">No Matches Found</div>');
                    }
                    $s("#loading").css("visibility","hidden");
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
                      $s("li").each(function(){
                         if($s(this).attr("class") == "selected")
                            found = 1;
                      });
                      if(found == 1)
                      {
                        var sel = $s("li[class='selected']");
                        sel.next().addClass("selected");
                        sel.removeClass("selected");
                      }
                      else
                        $s("li:first").addClass("selected");
                     }
                 break;
                 case 38:
                 {
                      found = 0;
                      $s("li").each(function(){
                         if($s(this).attr("class") == "selected")
                            found = 1;
                      });
                      if(found == 1)
                      {
                        var sel = $s("li[class='selected']");
                        sel.prev().addClass("selected");
                        sel.removeClass("selected");
                      }
                      else
                        $s("li:last").addClass("selected");
                 }
                 break;
                 case 13:
                    $s("#ajax_response").fadeOut("slow");
                    $s("#Zone_area").val($s("li[class='selected'] a").text());
                 break;
                }
             }
         }
         else
            $s("#ajax_response").fadeOut("slow");
    });
    $s("#ajax_response").mouseover(function(){
        $s(this).find("li a:first-child").mouseover(function () {
              $s(this).addClass("selected");
        });
        $s(this).find("li a:first-child").mouseout(function () {
              $s(this).removeClass("selected");
        });
        $s(this).find("li a:first-child").click(function () {
              $s("#Zone_area").val($s(this).text());
              $s("#ajax_response").fadeOut("slow");
        });
    });

     $s('.checkbox1').on('change', function() {
     var bool = $s('.checkbox1:checked').length === $s('.checkbox1').length;  
      $s('#acess_all').prop('checked', bool);       
       }); 
       $s('#acess_all').on('change', function() {    
       $s('.checkbox1').prop('checked', this.checked);      
      });
    

});
/* End auto ajax value load code*/
</script>
<?php
//$Header="New Installation";

$date=date("Y-m-d H:i:s");
$account_manager=$_SESSION['username'];

?>

<div class="top-bar">
  <h1><? echo $Header;?></h1>
</div>
<div class="table">


<?
$Header="Edit Online Crack";
$account_manager=$_SESSION['username'];
$action=$_GET['action'];
$id=$_GET['id'];
$page=$_POST['page'];
if($action=='edit' or $action=='editp')
    {
        $Header="Edit Online Crack";
        $result = select_query("select * from installation_request where id=$id and branch_id=".$_SESSION['BranchId']);   
        //echo '<pre>'; print_r($result); die;
       
        $Zone_area = $result[0]["Zone_area"];
        $area = select_query("SELECT id,`name` FROM re_city_spr_1 WHERE id='".$Zone_area."'");
    

        $devicelList = select_query("SELECT dp.id as device_id,dp.name as deviceType from new_account_model_master as newmodel inner join device_types as dp ON newmodel.device_type=dp.id WHERE newmodel.new_account_reqid='".$result[0]['user_id']."'");

         //echo '<pre>'; print_r($devicelList); die;
       $devModelList = select_query("SELECT dm.id as model_id,dm.device_model as model_name from new_account_model_master as newmodel inner join device_model as dm  ON newmodel.device_model=dm.id WHERE newmodel.new_account_reqid='".$result[0]['user_id']."' and dm.parent_id='".$result[0]['device_type']."'");
        //echo '<pre>'; print_r($devModelList); die;
       $toolk=explode('#',$result[0]['accessories_tollkit']);
      // echo $toolk[1];die;




    }?>

<div class="top-bar">
  <h1><? echo $Header;?></h1>
</div>
<div class="table">
<?
if(isset($_POST['submit']))
{
    //echo '<pre>'; print_r($_POST);die;
    //echo '<pre>'; print_r($_POST);die;
    //echo "<pre>";print_r($_POST);die;
    $date=date("Y-m-d H:i:s");
    $account_manager=$_SESSION['username'];
    $sales_person=trim($_POST['sales_person']);
    $sales_manager = select_query("select id as sales_id from sales_person where name='".$sales_person."' limit 1");
    $sales_person_id=$sales_manager[0]['sales_id'];
     //$main_user_id=$_POST['main_user_id'];
     $main_user_id=$_POST['user_id_hidden'];
    
    $company=$_POST['company'];
    $no_of_vehicals=$_POST['no_of_vehicals'];
    //$location=$_POST['location'];
    $model=$_POST['model'];
    //$cnumber=$_POST['cnumber'];
    $designation=$_POST['designation'][0];
    $alt_designation=$_POST['designation'][1];
    $contact_person=$_POST['contact_person'][0];
    $alt_cont_person=$_POST['contact_person'][1];
    $contact_number=$_POST['contact_number'][0];
    $alt_cont_number=$_POST['contact_number'][1];
    $atime_status=$_POST['atime_status'];
    $back_reason=$_POST['back_reason'];
   
    //$instal_reinstall = $_POST['instal_reinstall'];
    $instal_reinstall = 'online_crack';
    //$accessories_tollkit = $_POST['accessories'];
    //echo count($_POST['accessories']); die;
    $accessories_tollkit="";
     $acess_selection = $_POST['access_radio'];
    // echo $acess_selection;die; 
    if($acess_selection=='yes')
    {
      //echo 'tt'; die;
       for($i=0;$i<count($_POST['accessories']);$i++)
      {
        $accessories_tollkit.=$_POST['accessories'][$i]."#";
        $accessories_tollkits=substr($accessories_tollkit,0,strlen($accessories_tollkit)-1);
      }

   }
   else
   {
      $accessories_tollkits="";
   }

    // echo $accessories_tollkits; die;
    $veh_type=$_POST['veh_type'];
    $del_nodelux=$_POST['standard'];
    $actype=$_POST['actype'];
    $TruckType=$_POST['TruckType'];
    $TrailerType=$_POST['TrailerType'];
    $MachineType=$_POST['MachineType'];
    $billing = $_POST['billing'];
    $delnoDelux = $_POST['delnoDelux'];
    $luxury = $_POST['lux'];
    
    $deviceType=$_POST['deviceType'];


  
    $required=$_POST['required'];
    if($required=="") { $required="normal"; }

    $installation_status = $_POST['installation_status'];
   
    
  
    $Zone_data = select_query("SELECT id,`name` FROM re_city_spr_1 WHERE `name`='".$_POST['Zone_area']."'");
    $zone_count = count($Zone_data);
  $rent_payment = $_POST["rent_plan"];
  $rent_status = $_POST["rent_status"];
   
    if($zone_count > 0)
    {
        $Area = $Zone_data[0]["id"];
    //$Area_name = $Zone_data[0]["name"];
        $errorMsg = "";
    }
    else
    {
        $errorMsg = "Please Select Type View Listed Area. Not Fill Your Self.";
    }
   
   
    // if($_POST['location'] == "")
    // {
    //     $location="";
    // }
    // else
    // {
    //     $location=$_POST['location'];
    // }
     $branch_type = $_POST['inter_branch'];
    if($branch_type == "Interbranch"){
        $city=$_POST['inter_branch_loc'];
       // $location="";
    }else{
        $city=0;
        //$location=$_POST['location'];
    }
    $location=$_POST['location'];
    $location1=$_POST['inter_branch'];
    $interbranch = $_POST['inter_branch_loc'];

    if($location1 == 'Interbranch'){
      $query = select_query("select city from tbl_city_name where branch_id='".$interbranch."'");
      $branchLocation = $query[0]['city'];
    }
    else
    {
      $branchLocation = "Delhi";
    }

    if($errorMsg=="")   
    {           
        if($atime_status=="Till")
        {
            //$time=$_POST['time'];
              $time=date('Y-m-d H:i:s',strtotime($_POST['time']));  
            
           
              $sql="update installation_request set sales_person='".$sales_person."', `user_id`= '".$main_user_id."', `company_name`='".$company."', time='".$time."', atime_status='".$atime_status."', model='".$model."', contact_number='".$contact_number."' , contact_person='".$contact_person."',Zone_area='".$Area."',inter_branch='".$city."', location='".$branchLocation."',branch_type='".$branch_type."',veh_type='".$veh_type."',required='".$required."',designation='".$designation."',alt_designation='".$alt_designation."',alt_cont_person='".$alt_cont_person."',standard='".$del_nodelux."',actype='".$actype."',MachineType='".$MachineType."',TruckType='".$TruckType."',TrailerType='".$TrailerType."',billing='".$billing."',accessories_tollkit='".$accessories_tollkits."',alter_contact_no='".$alt_cont_number."',device_type='".$deviceType."',landmark='".$location."',instal_reinstall='".$instal_reinstall."',acess_selection='".$acess_selection."' where id='".$id."'"; 
              // echo $sql; die;
            
             $execute=mysql_query($sql);
           

            $installation="update installation set sales_person='".$sales_person."', `user_id`= '".$main_user_id."', `company_name`='".$company."', time='".$time."',atime_status='".$atime_status."', model='".$model."', contact_number='".$contact_number."' ,contact_person='".$contact_person."',Zone_area='".$Area."',inter_branch='".$city."', location='".$branchLocation."',branch_type='".$branch_type."',veh_type='".$veh_type."',required='".$required."',designation='".$designation."',alt_designation='".$alt_designation."',alt_cont_person='".$alt_cont_person."',standard='".$del_nodelux."',actype='".$actype."',MachineType='".$MachineType."',TruckType='".$TruckType."',TrailerType='".$TrailerType."',billing='".$billing."',accessories_tollkit='".$accessories_tollkits."',alter_contact_no='".$alt_cont_number."',device_type='".$deviceType."', landmark='".$location."',instal_reinstall='".$instal_reinstall."',acess_selection='".$acess_selection."' where inst_req_id='".$id."'";
             $execute=mysql_query($sql);
             //echo $sql;die;
                       
            /*echo "<script>document.location.href ='installation.php'</script>";*/
        }
        if($atime_status=="Between")
        { //echo $atime_status;
             // $time=$_POST['time1'];
             // $totime=$_POST['totime'];  
            $time=date('Y-m-d H:i:s',strtotime($_POST['time']));  
            $totime=date('Y-m-d H:i:s',strtotime($_POST['totime']));           
            $sql="update installation_request set sales_person='".$sales_person."', `user_id`= '".$main_user_id."', `company_name`='".$company."', time='".$time."',totime='".$totime."',atime_status='".$atime_status."', model='".$model."', contact_number='".$contact_number."' ,contact_person='".$contact_person."',Zone_area='".$Area."',inter_branch='".$city."', location='".$branchLocation."',branch_type='".$branch_type."',  veh_type='".$veh_type."',designation='".$designation."',alt_designation='".$alt_designation."',alt_cont_person='".$alt_cont_person."',standard='".$del_nodelux."',actype='".$actype."',MachineType='".$MachineType."',TruckType='".$TruckType."',TrailerType='".$TrailerType."',billing='".$billing."',accessories_tollkit='".$accessories_tollkits."',alter_contact_no='".$alt_cont_number."',device_type='".$deviceType."', landmark='".$location."',instal_reinstall='".$instal_reinstall."',acess_selection='".$acess_selection."' where id='".$id."'"; 
              //echo $sql; die;      
              $execute=mysql_query($sql);

           
            $installation="update installation set sales_person='".$sales_person."', `user_id`= '".$main_user_id."', `company_name`='".$company."', time='".$time."',totime='".$totime."',atime_status='".$atime_status."', model='".$model."', contact_number='".$contact_number."' ,contact_person='".$contact_person."',Zone_area='".$Area."',inter_branch='".$city."', location='".$branchLocation."',branch_type='".$branch_type."',veh_type='".$veh_type."',designation='".$designation."',alt_designation='".$alt_designation."',alt_cont_person='".$alt_cont_person."',standard='".$del_nodelux."',actype='".$actype."',MachineType='".$MachineType."',TruckType='".$TruckType."',TrailerType='".$TrailerType."',billing='".$billing."',accessories_tollkit='".$accessories_tollkits."',alter_contact_no='".$alt_cont_number."',device_type='".$deviceType."', landmark='".$location."',instal_reinstall='".$instal_reinstall."',acess_selection='".$acess_selection."' where inst_req_id='".$id."'";
                $execute=mysql_query($installation);
           
            /*echo "<script>document.location.href ='installation.php'</script>";*/
          }
         
        if($installation_status == '7')
        {
            $update_query = mysql_query("update installation_request set installation_status=8 where id=$id");
            //$update_query = mysql_query("update installation set installation_status=1 where inst_req_id=$id");
        }
       
        echo "<script>document.location.href ='installation.php'</script>";
    }
   
}

?>

<script type="text/javascript">
var mode;
function req_info()
{
  //alert(document.form1.sales_person.value);
  if(document.form1.sales_person.value=="")
  {
    alert("Please Select Sales Person Name") ;
    document.form1.sales_person.focus();
    return false;
  }
 
  // if(document.form1.main_user_id.value=="")
  // {
  // alert("Please Select Client Name") ;
  // document.form1.main_user_id.focus();
  // return false;
  // }
  
  // if(document.form1.no_of_vehicals.value=="")
  // {
  // alert("Please Select No Of Installation") ;
  // document.form1.no_of_vehicals.focus();
  // return false;
  // }
 
  if(document.form1.deviceType.value=="")
  {
        alert("Please Enter Model") ;
        document.form1.deviceType.focus();
        return false;
  }
  if(document.form1.model.value=="")
  {
        alert("Please Enter Model") ;
        document.form1.model.focus();
        return false;
  }
    //  alert(document.form1.acc.value) ; 
    // return false;
  var acc=document.form1.acc.value
  if (acc==null || acc=="")
  {
      alert("Please Select Accessories Button") ;
      return false;
  }
  if(document.form1.access_radio.value == 'yes')
  {
    
    var accessories = document.getElementsByName("accessories[]");
    var acc_len = $('[name="accessories[]"]:checked').length;
   
    
    if(acc_len == '' || acc_len == '0')
    {
      alert('Please Select Atleast One Accessories'); 
      return false; 
      
    } 

  }

  // alert(document.forms["form1"]["inter_branch"].value);
  //  return false;
    var inter_branch=document.forms["form1"]["inter_branch"].value;
    if (inter_branch==null || inter_branch=="")
    {
      alert("Please Select Branch Button") ;
      return false;
    }

   if(document.form1.Zone_area.value=="")
    {
    alert("Please Select Area") ;
    document.form1.Zone_area.focus();
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

  
    var location=document.forms["form1"]["location"].value;
    if (location==null || location=="")
    {
        alert("Please Enter LandMark");
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
 
  var Dtable = document.getElementById('dataTable');
  var DrowCount = Dtable.rows.length;
    //alert(DrowCount);
  for(var m=0; m<DrowCount; m++)
  {
    if(m == 0)
    {
      var fcounter = 0;
      var contact_person = 'contact_person';
      var contact_number = 'contact_number';
      var designation = 'designation';
    }
    else
    {
      var fTxtDeviceType = 'contact_person'+fcounter;
      var contact_number = 'contact_number'+fcounter;
      var designation = 'designation'+fcounter;
    }
    if(document.getElementById(designation).value=="")
    {
      alert("Please Select Designation.") ;
      document.getElementById(designation).focus();
      return false;
    }
    if(document.getElementById(contact_person).value=="")
    {
      alert("Please Write Contact Person Name.") ;
      document.getElementById(contact_person).focus();
      return false;
    }
    if(document.getElementById(contact_number).value=="")
    {
      alert("Please Write Contact Number") ;
      document.getElementById(contact_number).focus();
      return false;
    }
  }
    
    if(document.form1.veh_type.value=="")
    {
        alert("Please Select Vehicle Type") ;
        document.form1.veh_type.focus();
        return false;
    }
    if(d.getHours() >= 18)
    {  
      if(d.getMinutes() > 00)      
      alert("Request raise only before 6 PM")   
      return false;  
    }
  
  
  
}
   
function setVisibility(id, visibility)
{
    document.getElementById(id).style.display = visibility;
}

function TillBetweenTime(radioValue)
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

function TillBetweenTime12(radioValue)
{
  //alert('tt');
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
        document.getElementById('inter_branch1').checked = true;
        document.getElementById('branchlocation').style.display = "block";
    }
    else if(radioValue=="Samebranch")
    {
      document.getElementById('inter_branch').checked = true;
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
        document.getElementById('inter_branch_loc').style.display = "block";
    }
    else if(radioValue=="Samebranch")
    {
        document.getElementById('branchlocation').style.display = "none";
    }
    else
    {
        document.getElementById('branchlocation').style.display = "none";
        document.getElementById('samebranchid').style.display = "none";
    }
   
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

function standardType(radioValue){

  //alert(radioValue)
  // if(radioValue=="Delux")
  //     {
          document.getElementById('actype').style.display = "block";
         // document.getElementById('deviceMdl').style.display = "block";
      //}
      // else if(radioValue=="NonDelux")
      // {
      //     document.getElementById('actype').style.display = "none";
      //     document.getElementById('deviceMdl').style.display = "block";
      //     document.getElementById('actype').style.display = "block";
      // }
      // else
      // {
      //     document.getElementById('actype').style.display = "none";
      //     document.getElementById('deviceMdl').style.display = "none";
      // }


}
function aclux(radioValue)
{
    //alert('tt');
     if(radioValue!="")
     {
  
          document.getElementById('actype').style.display = "block";
          //document.getElementById('deviceMdl').style.display = "block";
     }
     else
     {
          document.getElementById('actype').style.display = "none";
     }

}  

function accesShow(radioValue)
{
    if(radioValue=="yes")
     {
          document.getElementById('acc').checked = true;
          document.getElementById('accessTable').style.display = "block";
          
     }
     else
     {
           document.getElementById('acc').checked = true;
           document.getElementById('accessTable').style.display = "none";
     }

}




</script> 

<?php echo "<p align='left' style='padding-left: 250px;width: 500px;' class='message'>" .$errorMsg. "</p>" ; ?>
  
<style type="text/css" >
.errorMsg{border:1px solid red; }
.message{color: red; font-weight:bold; }
</style>
<style>
body { font-family:'Open Sans' Arial, Helvetica, sans-serif}
ul,li { margin:0; padding:0; list-style:none;}
.label { color:#000; font-size:16px;}
</style>

 <form method="post" action="" name="form1" autocomplete="off" onSubmit="return req_info();">
    <table style="padding-left: 100px;width: 500px;" cellspacing="5" cellpadding="5">
      <tr>
        <td colspan="2"><input type="hidden" name="back_reason" id="back_reason" value="<?php echo $result['back_reason']?>"/></td>
      </tr>
     <!--   <tr>
        <td  align="right">Job:</td>

        <td><input type="radio" name="instal_reinstall"  value="installation" id="instal_reinstall" <?php if($result[0]['instal_reinstall']=='installation') {echo "checked=\"checked\""; }?> />
          New
          <input type="radio" name="instal_reinstall" value="crack" id="instal_reinstall" <?php if($result[0]['instal_reinstall']=='crack') {echo "checked=\"checked\""; }?>" />
          Crack </td>
    </tr> -->
      <input type="hidden" name="user_id_hidden" id="user_id_hidden" value="<?php echo $result[0]['user_id'];?>">
    <tr>
        <td  align="right"> Client User Name:<font color="red">* </font></td>
        <td><select name="main_user_id" id="main_user_id"  onchange="showUser(this.value,'ajaxdata'); getCompanyName(this.value,'TxtCompany');"  >
            <option value="" >-- Select One --</option>
            <?php
            $main_user_iddata = select_query("SELECT Userid AS user_id,UserName AS `name` FROM addclient WHERE sys_active=1 ORDER BY `name` asc");
            //while ($data=mysql_fetch_assoc($main_user_iddata))
      for($u=0;$u<count($main_user_iddata);$u++)
            {
                if($main_user_iddata[$u]['user_id']==$result[0]['user_id'])
                {
                    $selected="selected";
                }
                else
                {
                    $selected="";
                }
            ?>
            <option   value ="<?php echo $main_user_iddata[$u]['user_id'] ?>"  <?echo $selected;?>> <?php echo $main_user_iddata[$u]['name']; ?> </option>
            <?php
            }
           
            ?>
          </select></td>
      </tr>
      <tr>
        <td  align="right">Billing: </td>
        <td><?php $branch_data = select_query("select * from tbl_city_name where branch_id='".$_SESSION['BranchId']."'"); ?>
          <input type='radio' Name ='billing' id='bill_yes' value= 'yes' <?php if($result['branch_type']=='Samebranch'){echo "checked=\"checked\""; }?> checked="checked">
          Yes
         <!--  <Input type='radio' Name ='billing' id='bill_no' value= 'no' <?php// if($result['branch_type']=='Interbranch'){echo "checked=\"checked\""; }?>>
          No  -->
       
    
        &#160;&#160;&#160;&#160;&#160;&#160;Urgent:
        <input type="checkbox" name="required" id="required" value="urgent" <?php if($result[0]['required']=='urgent') {?> checked="checked" <? }?> />
        </td>
      </tr>
      

        <tr>
        <td align="right">Sales Person:<font color="red">* </font></td>
        <td><select name="sales_person" id="sales_person" style="width:150px">
            <option value="">Select Name</option>
            <?
            $sales_manager = select_query("select * from sales_person where branch_id='".$_SESSION['BranchId']."' and active=1 order by name asc");
            //while($data=mysql_fetch_array($query)) 
      for($s=0;$s<count($sales_manager);$s++)
      {
             ?>
            <option value="<?=$sales_manager[$s]['id']?>" <? if($result[0]['sales_person']==$sales_manager[$s]['id']) {?> selected="selected" <? } ?> >
            <?=$sales_manager[$s]['name']?>
            </option>
            <? } ?>
          </select></td>
      </tr>
     
     
      
     <tr>
        <td  align="right"> Company Name:<font color="red">* </font></td>
        <td><input type="text" name="company" id="TxtCompany" readonly value="<?=$result[0]['company_name']?>"/></td>
      </tr>
      <tr>
        <td height="32" align="right">No. Of Vehicles:<font color="red">* </font></td>
        <td><?=$result[0]['no_of_vehicals']?></td>
      </tr>
      
      
      <tr id="deviceTyp">
        <td height="32" align="right">Device Type:<font color="red">* </font></td>
        <td>
          <select name="deviceType" id="deviceType" style="width:150px" onchange="getModelName(this.value,'modelName');">
          <option value="">Select Device:*</option>
            <?
            //$query = select_query("select * from device_model");
            //while($data=mysql_fetch_array($query)) 
      for($m=0;$m<count($devicelList);$m++)
      {
             ?>
            <option value="<?=$devicelList[$m]['device_id']?>" <? if($result[0]['device_type']==$devicelList[$m]['device_id']) {?> selected="selected" <? } ?> >
            <?=$devicelList[$m]['deviceType']?>
            </option>
            <? } ?>
          
          </select>
        </td>
      </tr>



     <tr>
        <td height="32" align="right">Model:<font color="red">* </font></td>
        <td><select name="model" id="modelName" style="width:150px">
            <option value="">Select Device:*</option>
            <?
            //$query = select_query("select * from device_model");
            //while($data=mysql_fetch_array($query)) 
      for($m=0;$m<count($devModelList);$m++)
      {
             ?>
            <option value="<?=$devModelList[$m]['model_id']?>" <? if($result[0]['model']==$devModelList[$m]['model_id']) {?> selected="selected" <? } ?> >
            <?=$devModelList[$m]['model_name']?>
            </option>
            <? } ?>
          </select></td>
      </tr>



    <tr>
        <td  align="right">Accessories:<font color="red">* </font> </td>
        <td><?php $branch_data = select_query("select * from tbl_city_name where branch_id='".$_SESSION['BranchId']."'"); ?>
          <input type='radio' Name ='access_radio' id='acc' value= 'yes' <?php //if($result['branch_type']=='Samebranch'){echo "checked=\"checked\""; }?> onchange="showAccess(this.value);">
          Yes
          <Input type='radio' Name ='access_radio' id='acc' value= 'no' <?php// if($result['branch_type']=='Interbranch'){echo "checked=\"checked\""; }?>
          onchange="showAccess(this.value);">
          No 
        </td>
    </tr>


      <!-- <tr>
        <td colspan="2">
          <table  id="accessTable"  align="right"  style="width: 100%;display:none;margin-left:-6px;" cellspacing="5" cellpadding="5">

  <tr>
        <td height="32" align="right"></td>
        <td><select name="accessories[]" multiple id="accessories" style="width:200px" onchange="();" >
            <option value="">Select Accessories</option>
            <?
            $accessory_data=select_query("SELECT id,items AS `access_name` FROM toolkit_access   ORDER BY `access_name` asc");
            //while($data=mysql_fetch_array($query)) 
      for($v=0;$v<count($accessory_data);$v++)
      {
             ?>
            <option value="<?=$toolk[$v]?>"<? if($toolk[$v]==$accessory_data[$v]['id']) {?> selected="selected" <? } ?>  ><?=$accessory_data[$v]['access_name']?>
            </option>
      <? } ?>
          </select></td>
      </tr>

      </table>
        </td>
  </tr>
 -->

      <tr>
        <td colspan="2">
          <table  id="accessTable"  align="right" style="height: 20em; width: 30em; overflow: auto;display:none;border:1px solid #000;" cellspacing="2" cellpadding="2">
          <td> <input type="checkbox" name="acess_all" id="acess_all" onclick="selectAllAccessory(this)"  style="width:150px;" /> Select All</td>
          <?
            $accessory_data=select_query("SELECT id,items AS `access_name` FROM toolkit_access   ORDER BY `access_name` asc");
           // echo '<pre>';print_r($accessory_data[0]['id']); die;
            //while($data=mysql_fetch_array($query)) 
            $acc_veh=array();
            $tools=array();
            //echo $toolk[0]; die;
      for($v=0;$v<count($accessory_data);$v++)
      {
        $acc_id[]=$accessory_data[$v]['id'];
        $acc_name[]=$accessory_data[$v]['access_name']; 
        $tools[]=$toolk[$v];
      }

      for($u=0;$u<count($acc_id);$u++)
      {
    
          if(in_array($acc_id[$u],$tools))
            {
              
          ?>
              <tr>
                <td><input type="checkbox" name="accessories[]" id="accessories" class="checkbox1" value="<?php echo $acc_id[$u];?>" checked style="width:150px;">
                <?=$acc_name[$u]?>
                </td>    
              </tr>
            <?php
             }
             else
             {
            ?>  <tr>
              
                <td><input type="checkbox" name="accessories[]" id="accessories" class="checkbox1" value="<?php echo $acc_id[$u];   ?>" style="width:150px;">
                <?=$acc_name[$u]?></td>    
              </tr>
              <?php 
            } 
      }?>
          
          </table>
        </td>
      </tr>



      <tr>
        <td  align="right">Branch:<font color="red">* </font> </td>
        <td><?php $branch_data = select_query("select * from tbl_city_name where branch_id='".$_SESSION['BranchId']."'"); ?>
          <input type='radio' Name ='inter_branch' id='inter_branch' value= 'Samebranch' <?php if($result[0]['branch_type']=='Samebranch'){echo "checked=\"checked\""; }?> onchange="StatusBranch(this.value);">
          <?php echo $branch_data[0]["city"];?>
          <Input type='radio' Name ='inter_branch' id='inter_branch1' value= 'Interbranch' <?php if($result[0]['branch_type']=='Interbranch'){echo "checked=\"checked\""; }?>
        onchange="StatusBranch(this.value);">
          Inter Branch 
        </td>
      </tr>

      <tr>
        <td colspan="2">
          <table  id="branchlocation"  align="right"  style="width: 100%;display:none;margin-left:-6px;" cellspacing="5" cellpadding="5">
            <tr>
              <td align="right" style="width: 18%;margin-right:-1px;">Branch Location:*</td>
              <td><select name="inter_branch_loc" id="inter_branch_loc" style="width:150px;">
                  <option value="" >-- Select One --</option>
                  <?php
                      $city1=select_query("select * from tbl_city_name where branch_id!='".$_SESSION['BranchId']."'");
                      //while($data=mysql_fetch_assoc($city1))
                      for($i=0;$i<count($city1);$i++)
                      {
                          if($city1[$i]['branch_id']==$result[0]['inter_branch'])
                          {
                              $selected="selected";
                          }
                          else
                          {
                              $selected="";
                          }
                      ?>
                      <option value ="<?php echo $city1[$i]['branch_id'] ?>"  <?echo $selected;?>> <?php echo $city1[$i]['city']; ?> </option>
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
        <td  align="right"> Area:<font color="red">* </font></td>
        <td><input type="text" name="Zone_area" id="Zone_area" value="<?php echo $area[0]["name"];?>"  />
          <div id="ajax_response"></div></td>
      </tr>
      
     <tr>
        <td align="right"> LandMark:<font color="red">* </font></td>
        <td><input type="text" name="location"  id="location" value="<?=$result[0]['landmark']?>" minlength="15"/></td>
    </tr> 
      
    <tr>
        <td align="right">Availbale Time status:<font color="red">* </font></td>
        <td><select name="atime_status" id="atime_status" style="width:150px" onchange="TillBetweenTime(this.value)">
            <option value="">Select Status</option>
            <option value="Till" <? if($result[0]['atime_status']=='Till') {?> selected="selected" <? } ?> >Till</option>
            <option value="Between" <? if($result[0]['atime_status']=='Between') {?> selected="selected" <? } ?> >Between</option>
          </select></td>
        <td colspan="2"><table  id="TillTime" align="left" style="width: 300px;display:none;border:1"  cellspacing="5" cellpadding="5">
            <tr>
              <td height="32" align="right">Time:<font color="red">* </font></td>
              <td><input type="text" name="time" id="datetimepicker" value="<?=$result[0]['time']?>" style="width:147px"/></td>
            </tr>
          </table>
          <table  id="BetweenTime" align="left" style="width: 300px;display:none;border:1"  cellspacing="5" cellpadding="5">
            <tr>
              <td height="32" align="right">From Time:<font color="red">* </font></td>
              <td><input type="text" name="time1" id="datetimepicker1" value="<?=$result[0]['time']?>" style="width:147px"/></td>
            </tr>
            <tr>
              <td height="32" align="right">To Time:<font color="red">* </font></td>
              <td><input type="text" name="totime" id="datetimepicker2" value="<?=$result[0]['totime']?>" style="width:147px"/></td>
            </tr>
          </table></td>
      </tr>


     <table style="padding-left: 700px;width: 800px;" cellspacing="5" cellpadding="5">
        <tr>
          <td colspan="2">
              <INPUT type="button" value="+" id='addRowss' onClick="addRow('dataTable')" />
        
              <INPUT type="button" value="-" id='delRowss' onClick="deleteRow('dataTable')" />
          </td>
        </tr>
      </table>

      <table id="dataTable" style="padding-left: 100px;width:800px;" cellspacing="5" cellpadding="5">
      <tr>
            <td  height="32" align="right"><select name="designation[]" id="designation" style="width:150px"
            onchange="designationChange(this.value)">
                <option value="">-- Select Designation --</option>
                <option value="driver" <? if($result[0]['designation']=='driver') {?> selected="selected" <? } ?> >Driver</option>
                <option value="supervisor"  <? if($result[0]['designation']=='supervisor') {?> selected="selected" <? } ?> >supervisor</option>
                <option value="manager"  <? if($result[0]['designation']=='manager') {?> selected="selected" <? } ?> >Manager</option>
                <option value="senior manager"  <? if($result[0]['designation']=='senior manager') {?> selected="selected" <? } ?>  >Senior Manager</option>
                 <option value="owner"  <? if($result[0]['designation']=='owner') {?> selected="selected" <? } ?> >Owner</option>
                 <option value="sale person"  <? if($result[0]['designation']=='sale person') {?> selected="selected" <? } ?> >Sale Person</option>
                 <option value="others"  <? if($result[0]['designation']=='others') {?> selected="selected" <? } ?>>Others</option>
              
              </select>
            </td>
            <td height="32" align="right">Contact Person:<font color="red">* </font></td>
            <td><input type="text" name="contact_person[]" id="contact_person"  value="<?=$result[0]['contact_person']?>" style="width:147px"/>
            </td>

           <td height="32" align="right">Contact Number:<font color="red">* </font></td>
            <td><input type="text" name="contact_number[]" id="contact_number"  minlength="10" maxlength="10"  value="<?=$result[0]['contact_number']?>"  onkeypress='return event.charCode >= 48 && event.charCode <= 57'  style="width:147px"/>
           </td>       
      </tr>
      <?php if($result[0]['alt_designation']!="")
      {?>
    <tr>
            <td  height="32" align="right"><select name="designation[]" id="designation" style="width:150px"
            onchange="designationChange(this.value)">
                <option value="">-- Select Designation --</option>
                <option value="driver" <? if($result[0]['alt_designation']=='driver') {?> selected="selected" <? } ?> >Driver</option>
                <option value="supervisor"  <? if($result[0]['alt_designation']=='supervisor') {?> selected="selected" <? } ?> >Supervisoer</option>
                <option value="manager"  <? if($result[0]['alt_designation']=='manager') {?> selected="selected" <? } ?> >Manager</option>
                <option value="senior manager"  <? if($result[0]['alt_designation']=='senior manager') {?> selected="selected" <? } ?>  >Senior Manager</option>
                 <option value="owner"  <? if($result[0]['alt_designation']=='owner') {?> selected="selected" <? } ?> >Owner</option>
                 <option value="sale person"  <? if($result[0]['alt_designation']=='sale person') {?> selected="selected" <? } ?> >Sale Person</option>
                 <option value="others"  <? if($result[0]['alt_designation']=='others') {?> selected="selected" <? } ?>>Others</option>
              
              </select>
            </td>
            <td height="32" align="right">Contact Person:</td>
            <td><input type="text" name="contact_person[]" id="contact_person"  value="<?=$result[0]['alt_cont_person']?>" style="width:147px"/>
            </td>

           <td height="32" align="right">Contact Number:</td>
            <td><input type="text" name="contact_number[]" id="contact_number" maxlength="10" value="<?=$result[0]['alter_contact_no']?>" style="width:147px"/>
           </td>       
      </tr>
      <?php }?>
  </table>

      

    <table style=" padding-left: 100px;width: 500px;" cellspacing="5" cellpadding="5">
      <tr>
        <td height="32" align="right">Vehicle Type:<font color="red">* </font></td>
        <td>
          <select name="veh_type" id="veh_type" style="width:150px" onchange="vehicleType(this.value,'standard');" >
            <option value=""  selected>Select your option</option>
            <option value="Car" <? if($result[0]['veh_type']=='Car') {?> selected="selected" <? } ?>>Car</option>
            <option value="Bus" <? if($result[0]['veh_type']=='Bus') {?> selected="selected" <? } ?>>Bus</option>
            <option value="Truck" <? if($result[0]['veh_type']=='Truck') {?> selected="selected" <? } ?>>Truck</option>
            <option value="Bike" <? if($result[0]['veh_type']=='Bike') {?> selected="selected" <? } ?>>Bike</option>
            <option value="Trailer" <? if($result[0]['veh_type']=='Trailer') {?> selected="selected" <? } ?>>Trailer</option>
            <option value="Tempo" <? if($result[0]['veh_type']=='Tempo') {?> selected="selected" <? } ?>>Tempo</option>
            <option value="Machine" <? if($result[0]['veh_type']=='Machine') {?> selected="selected" <? } ?>>Machine</option>
          </select>
        </td>
      <td>
          <select name="TrailerType" id="TrailerType" palceholder="Vehicle Type" style="width:150px;display:none" >
            <option value="" selected>Select your category</option>
            <option value="Genset  AC Trailer" <? if($result[0]['veh_type']=='Machine') {?> selected="selected" <? } ?>>Genset  AC Trailer</option>
            <option value="Refrigerated Trailer" <? if($result[0]['veh_type']=='Machine') {?> selected="selected" <? } ?>>Refrigerated Trailer</option>
          </select>
        </td>
        <td>
          <select name="MachineType" id="MachineType" palceholder="Vehicle Type" style="width:150px;display:none" >
            <option value="" selected>Select Machine category</option>
            <option value="Vermeer Series-2" <? if($result[0]['MachineType']=='Vermeer Series-2') {?> selected="selected" <? } ?>>Vermeer Series-2</option>
            <option value="Ditch Witch" <? if($result[0]['MachineType']=='Ditch Witch') {?> selected="selected" <? } ?>>Ditch Witch</option>
            <option value="Halyma" <? if($result[0]['MachineType']=='Halyma') {?> selected="selected" <? } ?>>Halyma</option>
            <option value="Drillto" <? if($result[0]['MachineType']=='Drillto') {?> selected="selected" <? } ?>>Drillto</option>
            <option value="LCV" <? if($result[0]['MachineType']=='LCV') {?> selected="selected" <? } ?>>LCV</option>
            <option value="Oil Filtering Machine" <? if($result[0]['MachineType']=='Oil Filtering Machine') {?> selected="selected" <? } ?>>Oil Filtering Machine</option>
            <option value="JCB" <? if($result[0]['veh_type']=='JCB') {?> selected="selected" <? } ?>>JCB</option>
            <option value="Sudhir Generator" <? if($result[0]['MachineType']=='Sudhir Generator') {?> selected="selected" <? } ?>>Sudhir Generator</option>
            <option value="Container Loading Machine (Kony)" <? if($result[0]['MachineType']=='Container Loading Machine (Kony)') {?> selected="selected" <? } ?>>Container Loading Machine (Kony)</option>
          </select>
        </td>
        <td>
          <select name="standard" id="standard" palceholder="Vehicle Type" style="width:150px;display:none" onchange="standardType(this.value,'actype');" >
            <option value="" selected>Select Delux category</option>
            <option value="Delux" <? if($result[0]['standard']=='Delux') {?> selected="selected" <? } ?> >Delux</option>
            <option value="NonDelux" <? if($result[0]['standard']=='NonDelux') {?> selected="selected" <? } ?>>NonDelux</option>
          </select>
        </td>
          <td>
          <select name="lux" id="lux" style="width:150px;display:none" onchange="aclux();" >
            <option value="" selected>Select Luxury Category</option>
            <option value="luxury" <? if($result[0]['luxury']=='luxury') {?> selected="selected" <? } ?> >Lurxury</option>
            <option value="NonLuxury" <? if($result[0]['luxury']=='NonLuxury') {?> selected="selected" <? } ?>>Non-Luxury</option>
          </select>
        </td>
         <!-- <td>
          <select name="delnoDelux" id="delnoDelux" palceholder="Vehicle Type" style="width:150px;display:none" onchange="LuxType(this.value,'actype');" >
            <option value="" selected>Select Luxury category</option>
            <option value="Luxury" <? if($result[0]['delnoDelux']=='Luxury') {?> selected="selected" <? } ?>>Luxury</option>
            <option value="NonLuxury" <? if($result[0]['delnoDelux']=='delnoDelux') {?> selected="selected" <? } ?>>Non Luxury</option>
          </select>
        </td> -->
        <td>
          <select name="TruckType" id="TruckType" palceholder="Vehicle Type" style="width:150px;display:none" >
            <option value="" selected>Select Truck Category</option>
            <option value="Refrigerated Truck" <? if($result[0]['TruckType']=='Refrigerated Truck') {?> selected="selected" <? } ?>>Refrigerated Truck</option>
            <option value="Pickup Van" <? if($result[0]['TruckType']=='Pickup Van') {?> selected="selected" <? } ?>>Pickup Van</option>
          </select>
        </td>
        <td>
          <select name="actype" id="actype" style="width:150px;display:none" onchange="checkbox_lease();" >
            <option value="" selected>Select AC Category</option>
            <option value="AC" <? if($result[0]['actype']=='AC') {?> selected="selected" <? } ?>>AC</option>
            <option value="NonAC" <? if($result[0]['actype']=='NonAC') {?> selected="selected" <? } ?>>Non-AC</option>
          </select>
        </td>
      

      </tr>
      <tr>
        <td height="32" align="right"><input type="submit" name="submit" id="button1" value="submit" align="right" /></td>
        <td><input type="button" name="Cancel" value="Cancel" onClick="window.location = 'installation.php' " /></td>
      </tr>
      
    </table>
 </form>
</div>
<?
include("../include/footer.php");

?>
<script type="text/javascript">
  




</script>
<script>StatusBranch12("<?=$result[0]['branch_type'];?>");StatusBranch("<?=$result[0]['branch_type'];?>");TillBetweenTime12("<?=$result[0]['atime_status'];?>");
vehicleType("<?=$result[0]['veh_type'];?>");standardType("<?=$result[0]['standard'];?>");aclux("<?=$result[0]['actype'];?>");accesShow("<?=$result[0]['acess_selection'];?>")</script>
