<?php

namespace App\Controllers\api\v1;

use App\Models\Api\V1\UserModel;
use App\Models\Api\V1\AuthModel;
use App\Models\Api\V1\AuthAdminModel;
use App\Models\Api\V1\AdminModel;
use App\Models\Api\V1\UserDetails;
use App\Models\Api\V1\UserServiceModel;

use App\Libraries\Utils;

use CodeIgniter\API\ResponseTrait;
use CodeIgniter\RESTful\ResourceController;
use Exception;

// headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=utf8");
header("Access-Control-Allow-Origin: Content-Type, Access-Control");

class UserController extends ResourceController
{
    use ResponseTrait;
    public function createUser()
    {
        $userModel = new UserModel();
        $utils = new Utils();
        if ($this->request->getMethod() == "post") {

            $rules = [
                'user_name' => 'required',
                'email' => 'required|valid_email',
                'password' => 'required|min_length[5]|max_length[72]',
                'mobile_number' => 'required|exact_length[10]'
            ];

            if ($this->validate($rules)) 
            {
                $data = [
                    "user_name" => $this->request->getVar("user_name"),
                    "email" => $this->request->getVar("email"),
                    "mobile_number" => $this->request->getVar("mobile_number"),
                    "password" => password_hash($this->request->getVar("password"), PASSWORD_DEFAULT),
                    "access_token" => $utils->getToken(),
                    "createdAt" => date('Y-m-d H:i:s'),
                    "updatedAt" => date('Y-m-d H:i:s'),
                ];
                // print_r($data);
                $email_exist = $userModel->where("email", $data["email"])->first();
                if (!$email_exist) 
                {
                    if ($userModel->insert($data)) 
                    {
                             $response = [
                                'status' => 200,
                                "error" => FALSE,
                                "message" => "User registered successfully."
                            ];
                    } else {

                        $response = [
                            'status' => 500,
                            "error" => TRUE,
                            'message' => 'Failed to create registration',
                        ];
                    }
                } else {
                    $response = [
                        "status" => 500,
                        "error" => TRUE,
                        "message" => "The email you specified is already registered. Please try again."
                    ];
                }
            } else {
                $response = [
                    "status" => 500,
                    "error" => TRUE,
                    "message" => $this->validator->getErrors()
                ];
            }
        } else {
            $response = [
                "status" => 503,
                "error" => TRUE,
                "message" => "Access Denied"
            ];
        }
        return $this->respondCreated($response);
    }

    public function loginUser()
    {
        $userModel = new UserModel();
        $authModel = new AuthModel();
        $utils = new Utils();
        if ($this->request->getMethod() == "post") 
        {

            $rules = [
                'email' => 'required|valid_email',
                'password' => 'required|min_length[5]|max_length[72]'
            ];

            $data = [

                "email" => $this->request->getVar("email"),
                "password" => $this->request->getVar("password")
            ];
            if ($this->validate($rules)) 
            {
                $userdata = $userModel->where("email", $data["email"])->first();
                $utils->lastLogin($data["email"], $table = "users_table");

                if (!empty($userdata)) 
                {
                    
                    if (password_verify($data["password"], $userdata['password'])) {
                        $inputData['token_code'] = substr(md5(rand()), 0, 16);
                        $inputData['created_on'] = date("Y-m-d H:i:s");
                        $inputData['expire_on'] = date("Y-m-d H:i:s", strtotime('+6 hours'));
                        $inputData['user_id'] = $userdata['user_id'];
                        $inputData['ip'] = "";

                        if ($authModel->insert($inputData)) 
                        {
                            $authdata = $authModel->where("token_code", $inputData["token_code"])->first();

                            $response = [
                                'status' => 200,
                                'error' => FALSE,
                                'message' => 'User logged In successfully',
                                'data' => [
                                    "token_code" => $authdata['token_code'], "user_id" => $userdata["user_id"], "user_name" => $userdata["user_name"], "email" => $userdata["email"], "last_login" => $userdata["last_login"], "created_on" => $authdata['created_on'], "expire_on" => $authdata['expire_on'], "ip" => $authdata['ip']
                                ]
                            ];

                            return $this->respondCreated($response);
                        }
                    } else {

                        $response = [
                            'status' => 500,
                            'error' => TRUE,
                            'message' => 'Invalid password!'
                        ];
                        return $this->respondCreated($response);
                    }
                } else {
                    $response = [
                        'status' => 500,
                        'error' => TRUE,
                        'message' => 'Invalid email'
                    ];
                    return $this->respondCreated($response);
                }
            } else {
                $response = [
                    "status" => 500,
                    "error" => TRUE,
                    "message" => $this->validator->getErrors()
                ];
                return $this->respondCreated($response);
            }
        } else {
            $response = [
                'status' => 503,
                'error' => TRUE,
                'message' => 'Access Denied'
            ];
            return $this->respondCreated($response);
        }
    }

    public function getUserDetails()
    {
        $utils = new Utils();
        $profileModel = new UserDetails();
        $authHeader = $this->request->getHeader("Token-Code");
        if (!empty($authHeader)) {
            $authHeader = $authHeader->getValue();
            $responseData = $utils->authCheck($authHeader);
            if ($responseData["error"] == FALSE) 
            {
                if ($this->request->getMethod() == "post") {
                    $data = $profileModel->getUsersData($this->request->getVar("user_id"));
                    if ($data) {
                        $response = [
                            "status" => 200,
                            "error" => FALSE,
                            "message" => "Account profile data",
                            "data" => $data
                        ];
                    } else {
                        $response = [
                            "status" => 403,
                            "error" => TRUE,
                            "message" => "Account profile is empty"
                        ];
                    }
                } else {
                    $response = [
                        "status" => 503,
                        "error" => TRUE,
                        "message" => "Access Denied"
                    ];
                }
            } else {
                return $this->respondCreated($responseData);
            }
        } else {
            $data = [
                "status" => 500,
                "error" => TRUE,
                "message" => "Empty API Key"
            ];
            return $this->respondCreated($data);
        }
        return $this->respondCreated($response);
    }

    public function insertUserProfile()
    {
        $utils = new Utils();
        $profileModel = new UserDetails();
        $userServiceModel = new UserServiceModel();
        $authHeader = $this->request->getHeader("Token-Code");

        if (!empty($authHeader)) {
            $authHeader = $authHeader->getValue();
            $responseData = $utils->authCheck($authHeader);
            if ($responseData["error"] == FALSE) {

                if ($this->request->getMethod() == "post") 
                {
                    $profile_exist = $profileModel->where("user_id", $this->request->getVar('user_id'))->first();

                    if (!$profile_exist) {
 
                        $data = [
                            'user_id' => $this->request->getVar('user_id'),
                        ];

                        if ($profileModel->insert($data) && $userServiceModel->insert($data)) 
                        {
                            $data = $profileModel->getUsersData($this->request->getVar("user_id"));

                            $response = [
                                'status' => 200,
                                "error" => FALSE,
                                'message' => 'Profile data inserted successfully',
                                'data' => $data
                            ];
                        } else {

                            $response = [
                                'status' => 500,
                                "error" => TRUE,
                                'message' => 'Failed to insert profile data',
                            ];
                        }
                    } else {
                        $response = [
                            "status" => 500,
                            "error" => TRUE,
                            "message" => "Your profile is already for this account. if need do changes."
                        ];
                    }
                } else {
                    $response = [
                        "status" => 503,
                        "error" => TRUE,
                        "message" => "Access Denied"
                    ];
                }
            } else {
                return $this->respondCreated($responseData);
            }
        } else {
            $data = [
                "status" => "500",
                "error" => TRUE,
                "message" => "Empty API Key"
            ];
            return $this->respondCreated($data);
        }
        return $this->respondCreated($response);
    }

    public function updateUserDetails()
    {
        $utils = new Utils();
        $profileModel = new UserDetails();
        $userModel = new UserModel();
        $authHeader = $this->request->getHeader("Token-Code");

        if (!empty($authHeader)) {
            $authHeader = $authHeader->getValue();
            $responseData = $utils->authCheck($authHeader);
            if ($responseData["error"] == FALSE) {


                if ($this->request->getMethod() == "post") {

                    $row = $profileModel->getUsersData($this->request->getVar("user_id"));
                        // echo $row[0]->user_name;
                        // print_r($row[0]);die();
                    if ($row) {
                        $file = $this->request->getFile("profile_pic");

                        if (isset($_FILES['profile_pic']) && is_uploaded_file($_FILES['profile_pic']['tmp_name'])) {

                            $profile_response = $utils->upload_profile($file);

                            if ($profile_response['error'] === TRUE) {
                                return $this->respondCreated($profile_response);
                            } else {
                                $profile = $profile_response['new_name'];
                                if (!empty($row[0]->profile_pic)) {
                                    unlink("public/assets/upload/" . $row[0]->profile_pic);
                                }
                            }
                        } else {
                            $profile = $row[0]->profile_pic;
                        }
                        $user_data = [
                            'user_name' => $this->request->getVar('user_name'),
                            'mobile_number' => $this->request->getVar('mobile_number'),
                        ];

                        $user_details = [
                            'address' => $this->request->getVar('address'),
                            'profile_pic' => $profile,
                            'pic_code' => $this->request->getVar('pic_code'),
                            'city' => $this->request->getVar('city'),
                        ];

                        if ($profileModel->where('user_id', $this->request->getVar('user_id'))->set($user_details)->update() && $userModel->where('user_id', $this->request->getVar('user_id'))->set($user_data)->update()) {

                            $response = [
                                'status' => 200,
                                "error" => FALSE,
                                'message' => 'Profile data updated successfully',
                            ];
                        } else {

                            $response = [
                                'status' => 500,
                                "error" => TRUE,
                                'message' => 'Failed to update profile data',
                            ];
                        }
                    } else {
                        $response = [
                            "status" => 503,
                            "error" => TRUE,
                            "message" => "Profile data not found!"
                        ];
                    }
                } else {
                    $response = [
                        "status" => 503,
                        "error" => TRUE,
                        "message" => "Access Denied"
                    ];
                }
            } else {
                return $this->respondCreated($responseData);
            }
        } else {
            $data = [
                "status" => "500",
                "error" => TRUE,
                "message" => "Empty API Key"
            ];
            return $this->respondCreated($data);
        }


        return $this->respondCreated($response);
    }
    /*==================================================================================**/
    /*===========================|ADMIN AND TRAINER LOGIN|==============================**/
    /*==================================================================================**/
    public function authLoginUser()
    {
        helper(["app"]);
        $adminModel = new AdminModel();
        $authModel = new AuthAdminModel();
        $utils = new Utils();

        if ($this->request->getMethod() == "post") {

            $rules = [
                'email' => 'required|valid_email',
                'password' => 'required|min_length[5]|max_length[72]'
            ];
            $data = [

                "email" => $this->request->getVar("email"),
                "password" => $this->request->getVAr("password")
            ];
            if ($this->validate($rules)) {
                $utils->lastLogin($data["email"], $table = "admin_tbl");
                $userdata = $adminModel->where("email", $data["email"])->first();

                if (!empty($userdata)) {
                    if ($userdata["status"] == '1') {
                        if (password_verify($data["password"], $userdata['password'])) {
                            $inputData['token_code'] = substr(md5(rand()), 0, 16);
                            $inputData['created_on'] = date("Y-m-d H:i:s");
                            $inputData['expire_on'] = date("Y-m-d H:i:s", strtotime('+6 hours'));
                            $inputData['admin_id'] = $userdata['admin_id'];
                            $inputData['ip'] = getClientIpAddress();
                            if ($authModel->insert($inputData)) {
                                $authdata = $authModel->where("token_code", $inputData["token_code"])->first();

                                $response = [
                                    'status' => 200,
                                    'error' => FALSE,
                                    'message' => 'User logged In successfully',
                                    'data' => [
                                        "token_code" => $authdata['token_code'], "admin_id" => $userdata["admin_id"], "first_name" => $userdata["first_name"], "last_name" => $userdata["last_name"], "email" => $userdata["email"], "role" => $userdata["role"], "status" => $userdata["status"], "notify" => $userdata["notify"], "last_login" => $userdata["last_login"], "created_on" => $userdata['created'], "expire_on" => $authdata['expire_on'], "ip" => $authdata['ip']
                                    ]
                                ];
                                return $this->respondCreated($response);
                            }
                        } else {

                            $response = [
                                'status' => 500,
                                'error' => TRUE,
                                'message' => 'Invalid password!'
                            ];
                            return $this->respondCreated($response);
                        }
                    } else {
                        $response = [
                            'status' => 500,
                            'error' => TRUE,
                            'message' => 'Your account is not verified by learnotronix team. Please wait while we verify your account'
                        ];
                        return $this->respondCreated($response);
                    }
                } else {
                    $response = [
                        'status' => 500,
                        'error' => TRUE,
                        'message' => 'Invalid email'
                    ];
                    return $this->respondCreated($response);
                }
            } else {
                $response = [
                    "status" => 500,
                    "error" => TRUE,
                    "message" => $this->validator->getErrors()
                ];
                return $this->respondCreated($response);
            }
        } else {
            $response = [
                'status' => 503,
                'error' => TRUE,
                'message' => 'Access Denied'
            ];
            return $this->respondCreated($response);
        }
    }
}
