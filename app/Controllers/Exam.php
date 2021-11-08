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
        // print_r($this->user_on);
        // exit;
        return view('exam/index', $this->user_on);

    }

    // public function detail()
    // {
    //     $id = $this->request->getGet('id');
    //     $exam = new ExamModel();
    //     $data = $exam->getById($id);
    //     $this->user_on['exam'] = $data;
    //     return view('exam/detail', $this->user_on);
    // }

    public function detail_exam($nemo=0,$cod=0)
    {  
        if($nemo==0 || $cod==0){return redirect()->to(base_url('/exam'));}
        if(!session('scodigo')){return redirect()->to(base_url('/'));}
        $calendario=new CalendarioModel();
        $periodos=[];
        $eventos=[];

        $periodos=$calendario->getPeriodos();
        $nombre_curso=$calendario->getNombreCurso($cod);
        $nombre_salon=$calendario->getNombreSalon($nemo);
        $profesor=$calendario->getProfCurso($nemo,$cod);
        $cod_prof=$profesor->p_codigo;
        $eventos=$calendario->getEventos($nemo,$cod,$cod_prof);
        $combos=$calendario->getCombos();
        $curso=['nemo'=>$nemo,'cod'=>$cod];

        $this->user_on['periodos'] = $periodos;
        $this->user_on['nombre_curso'] = $nombre_curso->cursonom;
        $this->user_on['nombre_salon'] = $nombre_salon->nemodes;
        $this->user_on['profesor'] = $profesor;
        $this->user_on['eventos'] = $eventos;
        $this->user_on['curso'] = $curso;
        $this->user_on['combos'] = $combos;
        return view('exam/exam_detail', $this->user_on);
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
