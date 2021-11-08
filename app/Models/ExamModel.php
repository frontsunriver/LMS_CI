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

    function getExamList($id) {
        return $this->dao->query("SELECT count(*) as count, exam_list.title, exam_list.id FROM ".
                "exam_quiz LEFT JOIN exam_list ON exam_list.id = exam_quiz.list_id ".
                "LEFT JOIN exam_main ON exam_list.main_id = exam_main.id ".
                "WHERE exam_main.id = ".$id)->getResult();
    }
}
