<?php
namespace App\Libraries;

class Utils{

    public function __construct()
    {
        $this->db = \Config\Database::connect();
    }    
 function getToken($length=32){
    $token = "";
    $codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
    $codeAlphabet.= "abcdefghijklmnopqrstuvwxyz";
    $codeAlphabet.= "0123456789";
    for($i=0;$i<$length;$i++){
        $token .= $codeAlphabet[$this->crypto_rand_secure(0,strlen($codeAlphabet))];
    }
    return $token;
}
 

function crypto_rand_secure($min, $max) {
    $range = $max - $min;
    if ($range < 0) return $min; // not so random...
    $log = log($range, 2);
    $bytes = (int) ($log / 8) + 1; // length in bytes
    $bits = (int) $log + 1; // length in bits
    $filter = (int) (1 << $bits) - 1; // set all lower bits to 1
    do {
        $rnd = hexdec(bin2hex(openssl_random_pseudo_bytes($bytes)));
        $rnd = $rnd & $filter; // discard irrelevant bits
    } while ($rnd >= $range);
    return $min + $rnd;
}
  public function lastLogin($email, $table){

    $builder = $this->db->table($table);
    // to get datetime for 'last login' field
    $last_login=date('Y-m-d H:i:s');
     // update method
    $builder->set('last_login', $last_login);
    $builder->where('email', $email);
    $builder->update();
     return true;

}
function authCheck($inputData)
    {
       
        if (!empty($inputData)) {
            $where_array = array(
                'token_code' => $inputData,
                'expire_on >=' => date("Y-m-d H:i:s")
            );
             $builder = $this->db->table("auth_token");
            $builder->where($where_array);
            $data = $builder->get()->getRow();
           
            if (empty($data->user_id)) {
                $response = [
                'status' => 500,
                'error' => TRUE,
                'messages' => 'Invalid API Authentication'
            ];
            } else {
               
              
                    $authIncress['expire_on'] = date("Y-m-d H:i:s", strtotime('+6 hours'));
                    $builder->update(['expire_on'=> $authIncress], ['token_code' => $inputData]);
                   $response = [
                    'status' => 200,
                    'error' => FALSE,
                    
            ];
           } 
        } else {
             $response = [
                'status' => 500,
                'error' => TRUE,
                'messages' => 'Please enter proper Auth detail'
            ];
        }
        return $response;
    }

 function authCheckAdmin($inputData)
    {
       
        if (!empty($inputData)) {
            $where_array = array(
                'token_code' => $inputData,
                'expire_on >=' => date("Y-m-d H:i:s")
            );
             $builder = $this->db->table("auth_token_admin");
            $builder->where($where_array);
            $data = $builder->get()->getRow();
           
            if (empty($data->admin_id)) {
                $response = [
                'status' => 500,
                'error' => TRUE,
                'messages' => 'Invalid API Authentication'
            ];
            } else {
               
              
                    $authIncress['expire_on'] = date("Y-m-d H:i:s", strtotime('+6 hours'));
                    $builder->update(['expire_on'=> $authIncress], ['token_code' => $inputData]);
                   $response = [
                    'status' => 200,
                    'error' => FALSE,
                    
            ];
           } 
        } else {
             $response = [
                'status' => 500,
                'error' => TRUE,
                'messages' => 'Please enter proper Auth detail'
            ];
        }
        return $response;
    }


    function upload_profile($logo)
    {

        $target_dir = 'public/assets/upload/';  
        $basename = uniqid()."_".time();
        $file = $logo;
       
        $file_name = $file->getName();

        $target_file = $target_dir.$file_name;
    
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        $new_name = $basename.".".$imageFileType;
            
                 
                        if ($file->getSize() <= 5000000) 
                        {
                            if($file->getMIMEType() == "image/jpg" || $file->getMIMEType() == "image/png" || $file->getMIMEType() == "image/jpeg")
                             {
                                
                                $file->move($target_dir,$new_name);
                                // $response = $new_name;
                                $response = [
                                                "status" => 200,
                                                "error" => FALSE,
                                                "new_name" => $new_name
                                              
                                            ];
                        }
                        else{
                                $response = [
                                                "status" => 503,
                                                "error" => TRUE,
                                                "message" => "Sorry, only JPG, JPEG and PNG files are allowed."
                                            ];
                                
                             }
                        }
                        else
                        {
                            $response = [
                                            "status" => 503,
                                            "error" => TRUE,
                                            "message" => "Sorry, image is not should be greater then 5 Mb."
                                        ];
                            
                        }
        return $response;               
}

}

?>
