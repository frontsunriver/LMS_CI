<?php
namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;

use CodeIgniter\Cookie\Cookie;
use CodeIgniter\Cookie\CookieStore;
use Config\Services;

class Login extends BaseController
{
	public function index()
	{
        helper('form');
        helper('cookie');
		return view('login');
	}

	public function authenticate() {
        // is post
		if ( $this->request->getMethod() == 'post' && 
             $this->request->isAJAX() && 
             $this->request->getPost('token_nonce') == $this->request->getPost('token_site')
        ) {
			// validator
			$rules = [
                'name_user' => 'required|min_length[2]|max_length[8]',
                'password_user' => 'required|min_length[2]|max_length[12]|validateUser[name_user,password_user]',
            ];

            $errors = [
                'password_user' => [
                    'validateUser' => "Usuario o Contraseña incorrectos",
                ],
            ];

            if (!$this->validate($rules, $errors)) {
            	// error login
                return $this->response->setJSON(['status'=> false, 'errors' => $this->validator->listErrors() ]);

            } else {
            	// success login
                $user = (new UserModel())->getUser([
					'name_user' => $this->request->getPost('name_user')
				]);
                
                if( $this->request->getPost('remember_me') == 'on' ) {
                    // store a cookie value
                    helper('cookie');
                    
                    $login_data = json_encode([
                                    'name_user' => $this->request->getPost('name_user'),
                                    'password_user' => $this->request->getPost('password_user'),
                                   ]);
                    
                    set_cookie([
                        'name' => 'remember_me',
                        'value' => $login_data,
                        'expire' => (time()+60*60*24*365),
                        'httponly' => false
                    ]);

                } else {
                    // remove cookie value
                    helper('cookie');
                    if ( get_cookie('remember_me', true) ) {
                        delete_cookie('remember_me');
                    }
                }
                // period active
                $speriodo = ((new UserModel())->getNowPeriod())->cfg_periodo;
                // string session values
                helper('user');
                setUserSession($user, $speriodo);
                // rsedirecting to dashboard after login
                return $this->response->setJSON(['status'=> true, 'direct' => base_url('/resume'), 'message' => 'Bienvenido al sistema' ]);
            }
		}
	}
}
