<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ExamModel;
use App\Models\UserModel;
use Config\Services;

class Exam extends BaseController
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
        
        return [ 'user_info' => $user_info, 'user_menu' => $user_menu, 'user_top_menu' => $user_top_menu, 'general_logo' => $general_logo, 'list_periods' => $list_periods,'ruta'=>[1=>'lms',2=>""]];
    }

    public function index()
    {
        $exam = new ExamModel();
        $data = $exam->getExamMainList();
        $this->user_on['exam_list'] = $data; 
        
        return view('exam/index', $this->user_on);
    }

    public function detail()
    {
        $id = $this->request->getGet('id');
        $exam = new ExamModel();
        $data = $exam->getById($id);
        $this->user_on['exam'] = $data;
        return view('exam/detail', $this->user_on);
    }

    public function getExamList()
    {
        $id = $this->request->getPost('exam_id');
        $exam = new ExamModel();
        $data = $exam->getExamList($id);
        $result['data'] = $data;
        echo json_encode($result);
    }
}
