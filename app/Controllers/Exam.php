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
        $result['data'] = $data;
        echo json_encode($result);
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
    
    public function createExam($nemo=0,$cod=0){
        if($nemo==0 || $cod==0){return redirect()->to(base_url('/exam'));}
        if(!session('scodigo')){return redirect()->to(base_url('/'));}
        $exam = new ExamModel();
        $nemodes = $exam->getnemodes($nemo);
        $cursonom = $exam->getcursonom($cod);

        $this->user_on['nemodes'] = $nemodes;
        $this->user_on['cursonom'] = $cursonom;
        $this->user_on['exam_id'] = 0;
        return view('exam/exam_create', $this->user_on);
    }

    public function saveExam(){
        $exam = new ExamModel();
        $param = $_POST;
        $returndata = $exam->saveExame($param);
        return json_encode($returndata);
    }

    public function saveExamQuestion(){
        $exam = new ExamModel();
        $param = $_POST;
        $returndata;
        switch ($param['type']) {
            case 0:
                $returndata = $exam->saveUniqQuestion($param);
                break;
            case 1:
                break;
            case 2:
                break;
            case 3:
                break;
            case 4: 
                break;
        }
        return json_encode($returndata);
    }

    public function getQuesList(){
        $param = $_POST;
        $exam = new ExamModel();
        $result['data'] = $exam->getQuesList($param);
        echo json_encode($result);
    }
    public function deleteQuize(){
        $param = $_POST;
        $exam = new ExamModel();
        $result['data'] = $exam->deleteQuiz($param);
        echo json_encode($result);
    }
 
    public function getQuizById() {
        $param = $_POST;
        $exam = new ExamModel();
        $result['data'] = $exam->getQuizById($param);
        echo json_encode($result);
    }
}
