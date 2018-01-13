<?php
include("../connection.php"); 
 
$headers = apache_request_headers();

foreach ($headers as $header => $value) {
        if($header=="INTERNALGTRAC")
        {
                $httpHeader=$value;
        }
 }
if($httpHeader!="APIapiGTRACgtrac")
{
        die();
}



if($_POST)
{
    if(empty($_POST['user_name']) || empty($_POST['password']) || empty($_POST['req_id']))
    {
        //echo "You did not fill out the Username and Password.";
        $data["status"]   = false;
        $data["username"] = "0";
        $data["BranchId"] = "0";
        $data["req_id"]   = "0";
        $data["message"]  = "Username and Password should be filled";
    }
    else
    {
        $user_name = addslashes($_POST['user_name']);
        $password = addslashes($_POST['password']);
        $req_id = $_POST['req_id'];
        
        $login_query = select_query("SELECT * FROM login_user WHERE user_name='".$user_name."' and password='".$password."' and 
                                    req_person_id='".$req_id."' ");
        
        $CurrentYear = date("Y");
        $CurrentMonth = date('m');
        
        $OldYear = date("Y", strtotime("-1 years"));        
        $oldMonth = date('m', strtotime("-11 months".date('Y-m-d')));
        
        //echo $OldYear."-".$oldMonth;die;
        //echo "<pre>";print_r($login_query);die;
        if(count($login_query)>0)
        {
              $data=array();
             
                 $clientData = select_query("select dpb.* from debtor_pending_billing as dpb where 
                              dpb.collection_agent='".$login_query[0]['req_person_id']."' and dpb.client_id!=0 group by dpb.client_id ");
              //echo "<pre>";print_r($debtorData);die;
              if(count($clientData)>0)
              {
                  for($i=0;$i<count($clientData);$i++)
                  {            
                                                 
                     $debtorData = select_query("select ad.UserName, dpb.client_id, dpb.company_name, cla.name as collection_person, 
                                 sp.name as sales_persone, dpb.month,dpb.year,dpb.device_amount_pending, dpb.rent_amount_pending, 
                                dpb.accessory_amount_pending, dpb.yearly_rent
                                from debtor_pending_billing as dpb left join collection_agent as cla on dpb.collection_agent=cla.id 
                                left join sales_person as sp on dpb.sales_manager=sp.id left join addclient as ad on dpb.client_id=ad.Userid 
                                where dpb.collection_agent='".$login_query[0]['req_person_id']."' and 
                                dpb.client_id='".$clientData[$i]['client_id']."' and ((dpb.month>='".$oldMonth."' and dpb.year='".$OldYear."') 
                                or (dpb.month<='".$CurrentMonth."' and dpb.year='".$CurrentYear."')) order by dpb.year,dpb.month");
                      
                      $client_name='';$company_name='';$sales_persone='';$collection_person='';
                      
                      if(count($debtorData)>0)
                      {
                          $total_device_collection=0;$total_rent_collection=0;$yearly_rent=0;
                          
                          $deviceJan=0;$deviceFeb=0;$deviceMar=0;$deviceApr=0;$deviceMay=0;$deviceJun=0;$deviceJuly=0;$deviceAug=0;
                          $deviceSept=0;$deviceOct=0;$deviceNov=0;$deviceDec=0;
                          
                          $rentJan=0;$rentFeb=0;$rentMar=0;$rentApr=0;$rentMay=0;$rentJun=0;$rentJuly=0;$rentAug=0;$rentSept=0;
                          $rentOct=0;$rentNov=0;$rentDec=0;
                          
                          for($dt=0;$dt<count($debtorData);$dt++)
                          {            
                             
                             $client_name = $debtorData[$dt]['UserName'];
                             $client_id   = $debtorData[$dt]['client_id'];
                             $company_name = $debtorData[$dt]['company_name'];
                             $sales_persone = $debtorData[$dt]['sales_persone'];
                             $collection_person = $debtorData[$dt]['collection_person'];
                             
                             $yearly_rent = $yearly_rent + $debtorData[$dt]['yearly_rent'];
                             
                             $total_device_collection = $total_device_collection + $debtorData[$dt]['device_amount_pending'];
                             $total_rent_collection = $total_rent_collection + $debtorData[$dt]['rent_amount_pending'];
                             
                             if($debtorData[$dt]['month'] == '1' && $debtorData[$dt]['year']==$OldYear)
                             {
                                 $deviceJan = $debtorData[$dt]['device_amount_pending'];
                                 
                                 if(!empty($debtorData[$dt]['yearly_rent']) && trim($debtorData[$dt]['yearly_rent'])!='')
                                 {
                                     $rentJan = $debtorData[$dt]['rent_amount_pending'] + $debtorData[$dt]['yearly_rent'];
                                  } else {
                                    $rentJan = $debtorData[$dt]['rent_amount_pending'];
                                 }
                                 
                             }
                             if($debtorData[$dt]['month'] == '2' && $debtorData[$dt]['year']==$OldYear)
                             {
                                 $deviceFeb = $debtorData[$dt]['device_amount_pending'];
                                 
                                 if(!empty($debtorData[$dt]['yearly_rent']) && trim($debtorData[$dt]['yearly_rent'])!='')
                                 {
                                     $rentFeb = $debtorData[$dt]['rent_amount_pending'] + $debtorData[$dt]['yearly_rent'];
                                  } else {
                                    $rentFeb = $debtorData[$dt]['rent_amount_pending'];
                                 }
                                 
                             }
                             if($debtorData[$dt]['month'] == '3' && $debtorData[$dt]['year']==$OldYear)
                             {
                                 $deviceMar = $debtorData[$dt]['device_amount_pending'];
                                 
                                 if(!empty($debtorData[$dt]['yearly_rent']) && trim($debtorData[$dt]['yearly_rent'])!='')
                                 {
                                     $rentMar = $debtorData[$dt]['rent_amount_pending'] + $debtorData[$dt]['yearly_rent'];
                                  } else {
                                    $rentMar = $debtorData[$dt]['rent_amount_pending'];
                                 }
                                 
                             }
                             if($debtorData[$dt]['month'] == '4' && $debtorData[$dt]['year']==$OldYear)
                             {
                                 $deviceApr = $debtorData[$dt]['device_amount_pending'];
                                 
                                 if(!empty($debtorData[$dt]['yearly_rent']) && trim($debtorData[$dt]['yearly_rent'])!='')
                                 {
                                     $rentApr = $debtorData[$dt]['rent_amount_pending'] + $debtorData[$dt]['yearly_rent'];
                                  } else {
                                    $rentApr = $debtorData[$dt]['rent_amount_pending'];
                                 }
                                 
                             }
                             if($debtorData[$dt]['month'] == '5' && $debtorData[$dt]['year']==$OldYear)
                             {
                                 $deviceMay = $debtorData[$dt]['device_amount_pending'];
                                 
                                 if(!empty($debtorData[$dt]['yearly_rent']) && trim($debtorData[$dt]['yearly_rent'])!='')
                                 {
                                     $rentMay = $debtorData[$dt]['rent_amount_pending'] + $debtorData[$dt]['yearly_rent'];
                                  } else {
                                    $rentMay = $debtorData[$dt]['rent_amount_pending'];
                                 }
                                 
                             }
                             if($debtorData[$dt]['month'] == '6' && $debtorData[$dt]['year']==$OldYear)
                             {
                                 $deviceJun = $debtorData[$dt]['device_amount_pending'];
                                 
                                 if(!empty($debtorData[$dt]['yearly_rent']) && trim($debtorData[$dt]['yearly_rent'])!='')
                                 {
                                     $rentJun = $debtorData[$dt]['rent_amount_pending'] + $debtorData[$dt]['yearly_rent'];
                                  } else {
                                    $rentJun = $debtorData[$dt]['rent_amount_pending'];
                                 }
                                 
                             }
                             if($debtorData[$dt]['month'] == '7' && $debtorData[$dt]['year']==$OldYear)
                             {
                                 $deviceJuly = $debtorData[$dt]['device_amount_pending'];
                                 
                                 if(!empty($debtorData[$dt]['yearly_rent']) && trim($debtorData[$dt]['yearly_rent'])!='')
                                 {
                                     $rentJuly = $debtorData[$dt]['rent_amount_pending'] + $debtorData[$dt]['yearly_rent'];
                                  } else {
                                    $rentJuly = $debtorData[$dt]['rent_amount_pending'];
                                 }
                                 
                             }
                             if($debtorData[$dt]['month'] == '8' && $debtorData[$dt]['year']==$OldYear)
                             {
                                 $deviceAug = $debtorData[$dt]['device_amount_pending'];
                                 
                                 if(!empty($debtorData[$dt]['yearly_rent']) && trim($debtorData[$dt]['yearly_rent'])!='')
                                 {
                                     $rentAug = $debtorData[$dt]['rent_amount_pending'] + $debtorData[$dt]['yearly_rent'];
                                  } else {
                                    $rentAug = $debtorData[$dt]['rent_amount_pending'];
                                 }
                                 
                             }
                             if($debtorData[$dt]['month'] == '9' && $debtorData[$dt]['year']==$OldYear)
                             {
                                 $deviceSept = $debtorData[$dt]['device_amount_pending'];
                                 
                                 if(!empty($debtorData[$dt]['yearly_rent']) && trim($debtorData[$dt]['yearly_rent'])!='')
                                 {
                                     $rentSept = $debtorData[$dt]['rent_amount_pending'] + $debtorData[$dt]['yearly_rent'];
                                  } else {
                                    $rentSept = $debtorData[$dt]['rent_amount_pending'];
                                 }
                                 
                             }
                             if($debtorData[$dt]['month'] == '10' && $debtorData[$dt]['year']==$OldYear)
                             {
                                 $deviceOct = $debtorData[$dt]['device_amount_pending'];
                                 
                                 if(!empty($debtorData[$dt]['yearly_rent']) && trim($debtorData[$dt]['yearly_rent'])!='')
                                 {
                                     $rentOct = $debtorData[$dt]['rent_amount_pending'] + $debtorData[$dt]['yearly_rent'];
                                  } else {
                                    $rentOct = $debtorData[$dt]['rent_amount_pending'];
                                 }
                                 
                             }
                             if($debtorData[$dt]['month'] == '11' && $debtorData[$dt]['year']==$OldYear)
                             {
                                 $deviceNov = $debtorData[$dt]['device_amount_pending'];
                                 
                                 if(!empty($debtorData[$dt]['yearly_rent']) && trim($debtorData[$dt]['yearly_rent'])!='')
                                 {
                                     $rentNov = $debtorData[$dt]['rent_amount_pending'] + $debtorData[$dt]['yearly_rent'];
                                  } else {
                                    $rentNov = $debtorData[$dt]['rent_amount_pending'];
                                 }
                                 
                             }
                             if($debtorData[$dt]['month'] == '12' && $debtorData[$dt]['year']==$OldYear)
                             {
                                 $deviceDec = $debtorData[$dt]['device_amount_pending'];
                                 
                                 if(!empty($debtorData[$dt]['yearly_rent']) && trim($debtorData[$dt]['yearly_rent'])!='')
                                 {
                                     $rentDec = $debtorData[$dt]['rent_amount_pending'] + $debtorData[$dt]['yearly_rent'];
                                  } else {
                                    $rentDec = $debtorData[$dt]['rent_amount_pending'];
                                 }
                                 
                             }
                             
                             if($debtorData[$dt]['month'] == '1' && $debtorData[$dt]['year']==$CurrentYear)
                             {
                                 $deviceJan = $debtorData[$dt]['device_amount_pending'];
                                 
                                 if(!empty($debtorData[$dt]['yearly_rent']) && trim($debtorData[$dt]['yearly_rent'])!='')
                                 {
                                     $rentJan = $debtorData[$dt]['rent_amount_pending'] + $debtorData[$dt]['yearly_rent'];
                                  } else {
                                    $rentJan = $debtorData[$dt]['rent_amount_pending'];
                                 }
                                 
                             }
                             if($debtorData[$dt]['month'] == '2' && $debtorData[$dt]['year']==$CurrentYear)
                             {
                                 $deviceFeb = $debtorData[$dt]['device_amount_pending'];
                                 
                                 if(!empty($debtorData[$dt]['yearly_rent']) && trim($debtorData[$dt]['yearly_rent'])!='')
                                 {
                                     $rentFeb = $debtorData[$dt]['rent_amount_pending'] + $debtorData[$dt]['yearly_rent'];
                                  } else {
                                    $rentFeb = $debtorData[$dt]['rent_amount_pending'];
                                 }
                                 
                             }
                             if($debtorData[$dt]['month'] == '3' && $debtorData[$dt]['year']==$CurrentYear)
                             {
                                 $deviceMar = $debtorData[$dt]['device_amount_pending'];
                                 
                                 if(!empty($debtorData[$dt]['yearly_rent']) && trim($debtorData[$dt]['yearly_rent'])!='')
                                 {
                                     $rentMar = $debtorData[$dt]['rent_amount_pending'] + $debtorData[$dt]['yearly_rent'];
                                  } else {
                                    $rentMar = $debtorData[$dt]['rent_amount_pending'];
                                 }
                                 
                             }
                             if($debtorData[$dt]['month'] == '4' && $debtorData[$dt]['year']==$CurrentYear)
                             {
                                 $deviceApr = $debtorData[$dt]['device_amount_pending'];
                                 
                                 if(!empty($debtorData[$dt]['yearly_rent']) && trim($debtorData[$dt]['yearly_rent'])!='')
                                 {
                                     $rentApr = $debtorData[$dt]['rent_amount_pending'] + $debtorData[$dt]['yearly_rent'];
                                  } else {
                                    $rentApr = $debtorData[$dt]['rent_amount_pending'];
                                 }
                                 
                             }
                             if($debtorData[$dt]['month'] == '5' && $debtorData[$dt]['year']==$CurrentYear)
                             {
                                 $deviceMay = $debtorData[$dt]['device_amount_pending'];
                                 
                                 if(!empty($debtorData[$dt]['yearly_rent']) && trim($debtorData[$dt]['yearly_rent'])!='')
                                 {
                                     $rentMay = $debtorData[$dt]['rent_amount_pending'] + $debtorData[$dt]['yearly_rent'];
                                  } else {
                                    $rentMay = $debtorData[$dt]['rent_amount_pending'];
                                 }
                                 
                             }
                             if($debtorData[$dt]['month'] == '6' && $debtorData[$dt]['year']==$CurrentYear)
                             {
                                 $deviceJun = $debtorData[$dt]['device_amount_pending'];
                                 
                                 if(!empty($debtorData[$dt]['yearly_rent']) && trim($debtorData[$dt]['yearly_rent'])!='')
                                 {
                                     $rentJun = $debtorData[$dt]['rent_amount_pending'] + $debtorData[$dt]['yearly_rent'];
                                  } else {
                                    $rentJun = $debtorData[$dt]['rent_amount_pending'];
                                 }
                                 
                             }
                             if($debtorData[$dt]['month'] == '7' && $debtorData[$dt]['year']==$CurrentYear)
                             {
                                 $deviceJuly = $debtorData[$dt]['device_amount_pending'];
                                 
                                 if(!empty($debtorData[$dt]['yearly_rent']) && trim($debtorData[$dt]['yearly_rent'])!='')
                                 {
                                     $rentJuly = $debtorData[$dt]['rent_amount_pending'] + $debtorData[$dt]['yearly_rent'];
                                  } else {
                                    $rentJuly = $debtorData[$dt]['rent_amount_pending'];
                                 }
                                 
                             }
                             if($debtorData[$dt]['month'] == '8' && $debtorData[$dt]['year']==$CurrentYear)
                             {
                                 $deviceAug = $debtorData[$dt]['device_amount_pending'];
                                 
                                 if(!empty($debtorData[$dt]['yearly_rent']) && trim($debtorData[$dt]['yearly_rent'])!='')
                                 {
                                     $rentAug = $debtorData[$dt]['rent_amount_pending'] + $debtorData[$dt]['yearly_rent'];
                                  } else {
                                    $rentAug = $debtorData[$dt]['rent_amount_pending'];
                                 }
                                 
                             }
                             if($debtorData[$dt]['month'] == '9' && $debtorData[$dt]['year']==$CurrentYear)
                             {
                                 $deviceSept = $debtorData[$dt]['device_amount_pending'];
                                 
                                 if(!empty($debtorData[$dt]['yearly_rent']) && trim($debtorData[$dt]['yearly_rent'])!='')
                                 {
                                     $rentSept = $debtorData[$dt]['rent_amount_pending'] + $debtorData[$dt]['yearly_rent'];
                                  } else {
                                    $rentSept = $debtorData[$dt]['rent_amount_pending'];
                                 }
                                 
                             }
                             if($debtorData[$dt]['month'] == '10' && $debtorData[$dt]['year']==$CurrentYear)
                             {
                                 $deviceOct = $debtorData[$dt]['device_amount_pending'];
                                 
                                 if(!empty($debtorData[$dt]['yearly_rent']) && trim($debtorData[$dt]['yearly_rent'])!='')
                                 {
                                     $rentOct = $debtorData[$dt]['rent_amount_pending'] + $debtorData[$dt]['yearly_rent'];
                                  } else {
                                    $rentOct = $debtorData[$dt]['rent_amount_pending'];
                                 }
                                 
                             }
                             if($debtorData[$dt]['month'] == '11' && $debtorData[$dt]['year']==$CurrentYear)
                             {
                                 $deviceNov = $debtorData[$dt]['device_amount_pending'];
                                 
                                 if(!empty($debtorData[$dt]['yearly_rent']) && trim($debtorData[$dt]['yearly_rent'])!='')
                                 {
                                     $rentNov = $debtorData[$dt]['rent_amount_pending'] + $debtorData[$dt]['yearly_rent'];
                                  } else {
                                    $rentNov = $debtorData[$dt]['rent_amount_pending'];
                                 }
                                 
                             }
                             if($debtorData[$dt]['month'] == '12' && $debtorData[$dt]['year']==$CurrentYear)
                             {
                                 $deviceDec = $debtorData[$dt]['device_amount_pending'];
                                 
                                 if(!empty($debtorData[$dt]['yearly_rent']) && trim($debtorData[$dt]['yearly_rent'])!='')
                                 {
                                     $rentDec = $debtorData[$dt]['rent_amount_pending'] + $debtorData[$dt]['yearly_rent'];
                                  } else {
                                    $rentDec = $debtorData[$dt]['rent_amount_pending'];
                                 }
                                 
                             }
                             
                             
                          }
                          
                          $final_rent = $total_rent_collection + $yearly_rent;
                          
                          $arr=array(
                                        'client_name'           => $client_name,
                                        'client_id'             => $client_id,
                                        'company_name'          => $company_name,
                                        'sales_manager'         => $sales_persone,
                                        'collection_agent'      => $collection_person,
                                        'device_collection'        => (string)$total_device_collection,
                                        'rent_collection'        => (string)$final_rent,                                        
                                        'D_jan'                 => (string)round($deviceJan),
                                        'D_feb'                 => (string)round($deviceFeb),
                                        'D_march'               => (string)round($deviceMar),
                                        'D_april'               => (string)round($deviceApr),
                                        'D_may'                 => (string)round($deviceMay),
                                        'D_june'                => (string)round($deviceJun),
                                        'D_july'                => (string)round($deviceJuly),
                                        'D_aug'                 => (string)round($deviceAug),
                                        'D_sep'                 => (string)round($deviceSept),
                                        'D_oct'                 => (string)round($deviceOct),
                                        'D_nov'                 => (string)round($deviceNov),
                                        'D_dec'                 => (string)round($deviceDec),    
                                        'R_jan'                 => (string)round($rentJan),
                                        'R_feb'                 => (string)round($rentFeb),
                                        'R_march'               => (string)round($rentMar),
                                        'R_april'               => (string)round($rentApr),
                                        'R_may'                 => (string)round($rentMay),
                                        'R_june'                => (string)round($rentJun),
                                        'R_july'                => (string)round($rentJuly),
                                        'R_aug'                 => (string)round($rentAug),
                                        'R_sep'                 => (string)round($rentSept),
                                        'R_oct'                 => (string)round($rentOct),
                                        'R_nov'                 => (string)round($rentNov),
                                        'R_dec'                 => (string)round($rentDec),                                    
                                        'status'                => true,
                                        'message'               => "Data Found",                                                    
                                        ) ;
                                array_push($data,$arr);                           
                          
                          
                      }
                      else
                        {
                            $arr=array(
                                        'client_name'           => "0",
                                        'client_id'             => "0",
                                        'company_name'          => "0",
                                        'sales_manager'         => "0",
                                        'collection_agent'      => "0",
                                        'device_collection'        => "0",
                                        'rent_collection'        => "0",                                        
                                        'D_jan'                 => "0",
                                        'D_feb'                 => "0",
                                        'D_march'               => "0",
                                        'D_april'               => "0",
                                        'D_may'                 => "0",
                                        'D_june'                => "0",
                                        'D_july'                => "0",
                                        'D_aug'                 => "0",
                                        'D_sep'                 => "0",
                                        'D_oct'                 => "0",
                                        'D_nov'                 => "0",
                                        'D_dec'                 => "0",    
                                        'R_jan'                 => "0",
                                        'R_feb'                 => "0",
                                        'R_march'               => "0",
                                        'R_april'               => "0",
                                        'R_may'                 => "0",
                                        'R_june'                => "0",
                                        'R_july'                => "0",
                                        'R_aug'                 => "0",
                                        'R_sep'                 => "0",
                                        'R_oct'                 => "0",
                                        'R_nov'                 => "0",
                                        'R_dec'                 => "0",                                
                                        'status'                => false,
                                        'message'               => "Not Applicable",
                                        );
                            array_push($data,$arr); 
                        }
                      
                  }
        
              }
              else
                {
                    $arr=array(
                                'client_name'           => "0",
                                'client_id'             => "0",
                                'company_name'          => "0",
                                'sales_manager'         => "0",
                                'collection_agent'      => "0",
                                'device_collection'        => "0",
                                'rent_collection'        => "0",                                        
                                'D_jan'                 => "0",
                                'D_feb'                 => "0",
                                'D_march'               => "0",
                                'D_april'               => "0",
                                'D_may'                 => "0",
                                'D_june'                => "0",
                                'D_july'                => "0",
                                'D_aug'                 => "0",
                                'D_sep'                 => "0",
                                'D_oct'                 => "0",
                                'D_nov'                 => "0",
                                'D_dec'                 => "0",    
                                'R_jan'                 => "0",
                                'R_feb'                 => "0",
                                'R_march'               => "0",
                                'R_april'               => "0",
                                'R_may'                 => "0",
                                'R_june'                => "0",
                                'R_july'                => "0",
                                'R_aug'                 => "0",
                                'R_sep'                 => "0",
                                'R_oct'                 => "0",
                                'R_nov'                 => "0",
                                'R_dec'                 => "0",                                
                                'status'                => false,
                                'message'               => "Not Applicable",
                                );
                    array_push($data,$arr); 
                }
        }
        else
        {
            $data["status"]   = false;
            $data["username"] = "0";
            $data["BranchId"] = "0";
            $data["req_id"]   = "0";
            $data["message"]  = "Username and Password Not Valid";
        }
    }
    
    echo json_encode($data);
    
}




?>