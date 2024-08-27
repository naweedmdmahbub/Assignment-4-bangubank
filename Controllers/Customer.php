<?php
// require 'helpers.php';
class Customer {
    public function login()
    {

    }

    public function authenticate($user)
    {
        $emai = $password = '';
        if(empty($user['email'])){
            $errors['email'] = 'Email is required';
        } elseif(!filter_var($user['email'], FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = 'Please provide a valid email';
        } else {        
            $email = sanitize($user['email']);
        }
        if(empty($user['password'])){
            $errors['password'] = 'Please provide a password';
        } elseif(strlen($user['password']) <6) {
            $errors['password'] = 'Password must contain be at least 6 characters';
        } else {        
            $password = sanitize($user['password']);
        }
        
        if(empty($errors)){
            $file = "./json/users.json";
            $data_array = [];
            if (file_exists($file) && filesize($file) > 0) {
                $json_data = file_get_contents($file);
                $data_array = json_decode($json_data, true);
            }
            $data = [
              'email' => $_POST['email'],
              'password' => $_POST['password'],
              'role' => 'customer',
            ];
            $authenticated_user = null;
            foreach ($data_array as $data) {
                if ($email === $data['email'] && $password === $data['password']) {
                    $authenticated_user = $user;
                    $authenticated_user['role'] = 'customer';
                    break;
                }
            }
            // dd($authenticated_user);
            if($authenticated_user === null) {
                $errors['auth'] = 'Email & Password doesn`t match';
                return ['errors'=> $errors];
            } else return ['authenticated_user'=> $authenticated_user];
        } else {
            return ['errors'=> $errors];
        }

    }
}


?>