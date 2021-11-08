<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ExamModel;
use App\Models\UserModel;
use App\Models\CalendarioModel;
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

        $calendario=new CalendarioModel();
        $cursos=[];
        if($this->user_on['user_info']->profile=="Administrador del Sistema"){$cursos=$calendario->getCursos();}
        if($this->user_on['user_info']->profile=="Profesor"){$cursos=$calendario->getCursosProf($this->user_on['user_info']->p_codigo);}
        $this->user_on['cursos'] = $cursos;
        return view('exam/index', $this->user_on);

    }



    public function getExamList()
    {  
        $nemo = $this->request->getPost('nemo');
        $cod = $this->request->getPost('cod');
        if($nemo==0 || $cod==0){return redirect()->to(base_url('/exam'));}
        if(!session('scodigo')){return redirect()->to(base_url('/'));}
        $exam = new ExamModel();
        $data = $exam->getExamList($nemo, $cod);
        $this->user_on['data'] = $data;
        return view('exam/exam_detail', $this->user_on);
    }

    public function examDetail($nemo=0,$cod=0){

        $calendario=new CalendarioModel();
        if($this->user_on['user_info']->profile=="Administrador del Sistema"){$cursos=$calendario->getCursos();}
        if($this->user_on['user_info']->profile=="Profesor"){$cursos=$calendario->getCursosProf($this->user_on['user_info']->p_codigo);}
        $this->user_on['cursos'] = $cursos;

        if($nemo==0 || $cod==0){return redirect()->to(base_url('/exam'));}
        if(!session('scodigo')){return redirect()->to(base_url('/'));}
        $exam = new ExamModel();
        $nemodes = $exam->getnemodes($nemo);
        $cursonom = $exam->getcursonom($cod);

        $this->user_on['nemodes'] = $nemodes;
        $this->user_on['cursonom'] = $cursonom;
        return view('exam/exam_detail', $this->user_on);
    }
    

    public function getExamQusList()
    {
        $id = $this->request->getPost('exam_id');
        $exam = new ExamModel();
        $data = $exam->getExamQusList($id);
        $result['data'] = $data;
        echo json_encode($result);
    }
}
