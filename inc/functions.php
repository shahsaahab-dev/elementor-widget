<?php

class Form_Function{
    
    public function register_user($username,$name,$email,$phone,$password){
        $build_string = $username . $name . $email . $phone . $password;
        wp_send_json($build_string);
        // All Working
        
    }
}