<?php

namespace App\Models;

use CodeIgniter\Model;

class ExamModel extends Model
{
    protected $DBGroup              = 'default';
    protected $table                = 'exams_main';
    protected $primaryKey           = 'id';
    protected $useAutoIncrement     = true;
    protected $insertID             = 0;
    protected $returnType           = 'array';
    protected $useSoftDeletes       = false;
    protected $protectFields        = true;
    protected $allowedFields        = [];

    // Dates
    protected $useTimestamps        = false;
    protected $dateFormat           = 'datetime';
    protected $createdField         = 'created_at';
    protected $updatedField         = 'updated_at';
    protected $deletedField         = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks       = true;
    protected $beforeInsert         = [];
    protected $afterInsert          = [];
    protected $beforeUpdate         = [];
    protected $afterUpdate          = [];
    protected $beforeFind           = [];
    protected $afterFind            = [];
    protected $beforeDelete         = [];
    protected $afterDelete          = [];

    protected $dao 					= '';

    function __construct()
    {
        parent::__construct();
        helper('connect');
        $this->dao = db( $this->db );
    }

    function getExamMainList() {
        return $this->dao->table('exam_main')
            ->select('*')
            ->get()->getResult();
    }
    
    function getById($id) {
        return $this->dao->table('exam_main')
            ->select('*')
            ->where('id', $id)
            ->get()->getFirstRow();
    }

    function getExamList($nemo, $cod) {
        $returnvValue = [];
        $result =  $this->dao->query("SELECT exam_list.id, exam_list.title, int_curso.cursocod, int_curso.cursonom,  int_salon.nemodes FROM ".
                "exam_list LEFT JOIN int_curso ON exam_list.idcurso = int_curso.cursocod ".
                "LEFT JOIN int_salon ON exam_list.idsalon = int_salon.nemo ".
                "WHERE exam_list.idcurso = ".$cod." and exam_list.idsalon = ".$nemo)->getResult();
        foreach ($result as $key) {
            $count = $this->dao->query("select * from exam_quiz where exam_id = ".$key->id)->getResult();
            $temp = [];
            $temp['id'] = $key->id;
            $temp['title'] = $key->title;
            $temp['cursocod'] = $key->cursocod;
            $temp['cursonom'] = $key->cursonom;
            $temp['nemodes'] = $key->nemodes;
            $temp['quizeCount'] = count($count);
            array_push($returnvValue, $temp);
        }
        return $returnvValue;
    }


    function getnemodes($nemo){
        $result = $this->dao->query("select nemodes from int_salon where nemo = ".$nemo)->getResult();
        $temp = [];
        $temp['nemodes'] = $result[0]->nemodes;
        $temp['nemo'] = $nemo;
        return $temp;
    }

    function getcursonom($cod){
        $result = $this->dao->query("select cursonom from int_curso where cursocod = ".$cod)->getResult();
        $temp = [];
        $temp['cursonom'] = $result[0]->cursonom;
        $temp['cod'] = $cod;
        return $temp;
    }

    function getExamQusList($id) {
        return $this->dao->query("SELECT count(*) as count, exam_list.title, exam_list.id FROM ".
                "exam_quiz LEFT JOIN exam_list ON exam_list.id = exam_quiz.list_id ".
                "LEFT JOIN exam_main ON exam_list.main_id = exam_main.id ".
                "WHERE exam_main.id = ".$id)->getResult();
    }

    function saveExame($param){
        $data = [
            'title' => $param['title'],
            'content'  => $param['content'],
            'idsalon'  => $param['idsalon'],
            'idcurso'  => $param['iscurso']
        ];
        $result = $this->dao->table('exam_list')->insert($data);
        $id = $this->dao->insertID();
        return $id;
    }

    function saveUniqQuestion($param){
        $examid = $param['examid'];
        $problems = $param['questions'];
        $content = $param['content'];
        $quizeid = $param['quizeid'];
        $answer = 0;
        $question = "";
        for($i = 0; $i < count($problems); $i++){
            if($problems[$i]['answer'] != "false"){
                $answer = $i;
            }
            $question .= $problems[$i]['question']."&";            
        }

        $data = [
            'exam_id' => $examid,
            'type' => 0,
            'ques_content' => $content,
            'answer' => $answer,
            'question' => $question

        ];
        if($quizeid != ""){
            $this->dao->table('exam_quiz')->where('id', $quizeid)->update($data);

        }else{
            $this->dao->table('exam_quiz')->insert($data);
        }
        return $examid;
    }
    function getQuesList($param){
        $id = $param['exam_id'];
        $result = $this->dao->query("select * from exam_quiz where exam_id = ".$id)->getResult();
        return $result;
    }

    function deleteQuiz($param){
        $id = $param['id'];
        $this->dao->table('exam_quiz')->delete(['id'=>$id]);
        return true;
    }

    function getQuizById($param){
        $id = $param['id'];
        $result = $this->dao->query("select * from exam_quiz where id = ".$id)->getFirstRow();
        return $result;
    }
}
