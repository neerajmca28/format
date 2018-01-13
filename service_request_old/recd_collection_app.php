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
    if(empty($_POST['user_name']) || empty($_POST['password']) || empty($_POST['req_id']) || empty($_POST['to_pay']) || empty($_POST['paying']) 
    || empty($_POST['month']) || empty($_POST['year']) || empty($_POST['client_id']) || empty($_POST['type']))
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
        $password  = addslashes($_POST['password']);
        $req_id    = $_POST['req_id'];
        
        $to_pay    = $_POST['to_pay'];
        $paying    = $_POST['paying'];
        $monthValue= $_POST['month'];
        $monthyear = $_POST['year'];
        $client_id = $_POST['client_id'];
        $type      = $_POST['type'];
        
        
        $login_query = select_query("SELECT * FROM internalsoftware.login_user WHERE user_name='".$user_name."' and  
                                    password='".$password."' and req_person_id='".$req_id."' ");
        
        //echo "<pre>";print_r($login_query);die;
        if(count($login_query)>0)
        {
              $data=array();
                            
              $clientData = select_query("select dpb.* from internalsoftware.debtor_pending_billing as dpb where 
                              dpb.collection_agent='".$login_query[0]['req_person_id']."' AND dpb.client_id='".$client_id."' 
                            AND dpb.month='".$monthValue."' AND dpb.year='".$monthyear."' AND  is_status='1' AND  is_active='1'");
                            
              //echo "<pre>";print_r($debtorData);die;
              if(count($clientData)>0)
              {
                
                $recd_query = select_query("SELECT * FROM internalsoftware.collection_received_billing WHERE client_id='".$client_id."' AND 
                                            `month`='".$monthValue."'  AND `year`='".$monthyear."' AND  is_status='1' AND  is_active='1'");
                
                if(count($recd_query)>0)
                {                                   
                    if($_POST['type'] == "device_money")
                    {
                        
                        $final_device_amount_recd = $recd_query[0]['device_amount_recd'] + $_POST['paying'];
                        
                        $update_recd = array('device_amount_recd' => $final_device_amount_recd, 'received_time' => date("Y-m-d H:i:s"));
                    }
                    
                    if($_POST['type'] == "rent_money")
                    {
                        
                        $final_rent_amount_recd = $recd_query[0]['rent_amount_recd'] + $_POST['paying'];
                        
                        $update_recd = array('rent_amount_recd' => $final_rent_amount_recd, 'received_time' => date("Y-m-d H:i:s"));
                    }
                    
                    if($_POST['type'] == "advance_money")
                    {
                        
                        $advance_amount_recd = $recd_query[0]['advance_amount_recd'] + $_POST['paying'];
                        
                        $update_recd = array('advance_amount_recd' => $advance_amount_recd, 'received_time' => date("Y-m-d H:i:s"));
                    }
                        
                    $condition3 = array('id' => $recd_query[0]['id']);
                    update_query('internalsoftware.collection_received_billing', $update_recd, $condition3);
                    
                }
                else
                {                
                    if($_POST['type'] == "device_money")
                    {
                        $debtor_history = array('client_id' => $clientData[0]['client_id'], 'company_name' => $clientData[0]['company_name'], 
                            'sales_manager' => $clientData[0]['sales_manager'], 'collection_agent' => $clientData[0]['collection_agent'], 
                            'month' => $_POST['month'], 'year' => $_POST['year'], 'device_amount_recd' =>  $_POST['paying'], 
                            'rent_amount_recd' =>  '0', 'accessory_amount_recd' =>  '0', 'advance_amount_recd' => '0', 'discounting' =>  '0', 
                            'tds_amount' =>  '0', 'received_time' => date("Y-m-d H:i:s"));
                    }
                    
                    if($_POST['type'] == "rent_money")
                    {
                        $debtor_history = array('client_id' => $clientData[0]['client_id'], 'company_name' => $clientData[0]['company_name'], 
                            'sales_manager' => $clientData[0]['sales_manager'], 'collection_agent' => $clientData[0]['collection_agent'], 
                            'month' => $_POST['month'], 'year' => $_POST['year'], 'device_amount_recd' =>  '0', 'advance_amount_recd' => '0', 
                            'rent_amount_recd' =>  $_POST['paying'], 'accessory_amount_recd' =>  '0', 'discounting' =>  '0', 
                            'tds_amount' =>  '0', 'received_time' => date("Y-m-d H:i:s"));
                    }  
                    
                    if($_POST['type'] == "advance_money")
                    {
                        $debtor_history = array('client_id' => $clientData[0]['client_id'], 'company_name' => $clientData[0]['company_name'], 
                            'sales_manager' => $clientData[0]['sales_manager'], 'collection_agent' => $clientData[0]['collection_agent'], 
                            'month' => $_POST['month'], 'year' => $_POST['year'], 'device_amount_recd' =>  '0', 'rent_amount_recd' => '0', 
                            'advance_amount_recd' =>  $_POST['paying'], 'accessory_amount_recd' =>  '0', 'discounting' =>  '0', 
                            'tds_amount' =>  '0', 'received_time' => date("Y-m-d H:i:s"));
                    }   
                                
                    $insert_query = insert_query('internalsoftware.collection_received_billing', $debtor_history);
                    
                }                                  
                          
                $arr=array('status'      => true,
                           'username'    => $user_name,
                           'BranchId'    => $login_query[0]['branch_id'],
                           'req_id'      => $req_id,
                           'message'     => "ok",) ;
                array_push($data,$arr);                           
                          
        
              }
              else
                {
                    $arr=array('status'      => false,
                               'username'    => "0",
                               'BranchId'    => "0",
                               'req_id'      => "0",
                               'message'     => "Not ok",);
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