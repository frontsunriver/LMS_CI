<?php
namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;
use Config\Services;

class Dashboard extends BaseController
{	
	protected $user_on = [];

	function __construct()
    {
    	$this->user_on = $this->connected();
    }

    private function connected()
    {

    	$user = new UserModel();
        // get data
        $user_info = $user->getInfo([ 'scodigo' => session('scodigo') ]);

        $user_menu = $user->getMenu([
            'scodtipo' => session('scodtipo'),
            'scodigo' => session('scodigo')
        ]);
        

        $user_top_menu = $user->getTopMenu([
            'scodtipo' => session('scodtipo')
        ]);
        
        $general_logo = ($user->getLogo())->logo;

        
        $list_periods = ($user->getPeriods());
        
        return [ 'user_info' => $user_info, 'user_menu' => $user_menu, 'user_top_menu' => $user_top_menu, 'general_logo' => $general_logo, 'list_periods' => $list_periods, 'ruta'=>[1=>'',2=>""] ];
    }

    public function changePeriods()
    {
        // is post
        if ( $this->request->getMethod() == 'post' && 
             $this->request->isAJAX() && 
             $this->request->getPost('token_nonce') == $this->request->getPost('token_site')
        ) {
            $speriodo = $this->request->getPost('year_selected');
            // verification valid period
            $exist = ((new UserModel())->exitsPeriod([
                'cfg_periodo' => $speriodo
            ]))->flag;
            
            if( $exist > 0 ) {
                // get data user
                $user = (new UserModel())->getUser([ 'name_user' => session('scodigo') ]);
                // set period session
                session()->set('speriodo', $speriodo);
                // call session
                helper('user');
                if( setUserSession($user, $speriodo) ) {
                    return $this->response->setJSON(['status'=> true ]);
                }                
            } else {
                // not proccess
                return $this->response->setJSON(['status'=> false ]);
            }
        }
    }

	public function resume()
	{
        return view('resume', $this->user_on);
	}

	public function logout()
	{
		// unsession
		$session = session();
		$session->destroy();
		return redirect()->to(base_url('/'));
	}
}
