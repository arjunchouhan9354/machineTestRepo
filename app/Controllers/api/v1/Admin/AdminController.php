<?php

namespace App\Controllers\api\v1\Admin;

use App\Models\Api\V1\UserModel;
use App\Models\Api\V1\UserDetails;
use App\Models\Api\V1\UserServiceModel;
use App\Models\Api\V1\JobListModel;
use App\Models\Api\V1\JobMappingModel;

use App\Libraries\Utils;

use CodeIgniter\API\ResponseTrait;
use CodeIgniter\RESTful\ResourceController;
use Exception;

// headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=utf8");
header("Access-Control-Allow-Origin: Content-Type, Access-Control");

class AdminController extends ResourceController
{
    use ResponseTrait;
    public function getUsersListDetails()
    {
        $userModel = new UserModel();
        $utils = new Utils();
        $authHeader = $this->request->getHeader("Token-Code");
        
        if(!empty($authHeader))
        {
            $authHeader = $authHeader->getValue();
            $responseData = $utils->authCheckAdmin($authHeader);
             if($responseData["error"]==FALSE)
             {
                $usersList = $userModel->getUserListDetails();
                if($usersList)
                {  
                    $response = [
                    "status" => 200,
                    "error" => FALSE,
                    "data" => $usersList
                ];
                }

            else
                {
                    $response = [
                    "status" => 403,
                    "error" => TRUE,
                    "message" => "Data not exist "
                ];
                }               
             }
             else
             {
                return $this->respond($responseData);
             }
            } 
        else
        {
            $data=[
            "status"=>"500",
            "error"=>TRUE,
            "message"=> "Empty API Key"
        ];
            return $this->respond($data);
        }    
      return $this->respond($response);
    }
    public function getAllJobListMapping()
    {
        $jobListModel = new JobListModel();
        $utils = new Utils();
        $authHeader = $this->request->getHeader("Token-Code");
        
        if(!empty($authHeader))
        {
            $authHeader = $authHeader->getValue();
            $responseData = $utils->authCheckAdmin($authHeader);
             if($responseData["error"]==FALSE)
             {
                $jobList = $jobListModel->getAllJobListMapping();
                if($jobList)
                {  
                    $response = [
                    "status" => 200,
                    "error" => FALSE,
                    "data" => $jobList
                ];
                }

            else
                {
                    $response = [
                    "status" => 403,
                    "error" => TRUE,
                    "message" => "Data not exist "
                ];
                }               
             }
             else
             {
                return $this->respond($responseData);
             }
            } 
        else
        {
            $data=[
            "status"=>"500",
            "error"=>TRUE,
            "message"=> "Empty API Key"
        ];
            return $this->respond($data);
        }    
      return $this->respond($response);
    }
}
