<?php
namespace App\Validation;
use App\Models\UserModel;

class Userrules{

  public function validateUser(string $str, string $fields, array $data){
    
    $user = (new UserModel())->where('u_codigo', $data['name_user'])->first();

    if(!$user) return false;

	return ( md5($data['password_user']) == $user['u_password'] ? true : false);
  }
}