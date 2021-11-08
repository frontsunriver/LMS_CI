<?php
namespace App\Models;

use CodeIgniter\Model;

class CalendarioModel extends Model
{
	protected $DBGroup              = '';
	protected $table                = '';
	protected $primaryKey           = '';
	protected $useAutoIncrement     = true;
	protected $insertID             = 0;
	protected $returnType           = 'array';
	protected $useSoftDelete        = false;
	protected $protectFields        = true;
	protected $allowedFields        = [];

	// Dates
	protected $useTimestamps        = false;
	protected $dateFormat           = 'datetime';
	protected $createdField         = '';
	protected $updatedField         = '';
	protected $deletedField         = '';

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

    public function getCursos(){
    	return $this->dao->table('int_asignapr')
					->select('*')
					->join('int_curso','int_curso.cursocod = int_asignapr.cursocod')
					->join('int_salon','int_salon.nemo = int_asignapr.nemo')
					->join('cfg_personal','cfg_personal.p_codigo = int_asignapr.profcod')
					->get()->getResult();
    }

    public function getCursosProf($codigo){
    	return $this->dao->table('int_asignapr')
					->select('*')
					->join('int_curso','int_curso.cursocod = int_asignapr.cursocod')
					->join('cfg_personal','cfg_personal.p_codigo = int_asignapr.profcod')
					->join('int_salon','int_salon.nemo = int_asignapr.nemo')
					->where('int_asignapr.profcod',$codigo)
					->get()->getResult();
    }

	public function getPeriodos(){
    	return $this->dao->table('tb_bimestres')
					->select('*')
					->get()->getResult();
    }

	public function getCombos(){
    	return $this->dao->table('calendario_tbtipo')
					->select('*')
					->get()->getResult();
    }

    public function getNombreCurso($cod){
    	return $this->dao->table('int_curso')
					->select('*')
					->where(['int_curso.cursocod'=>$cod])
					->get()->getFirstRow();
    }

    public function getNombreSalon($nemo){
    	return $this->dao->table('int_salon')
					->select('*')
					->where(['int_salon.nemo'=>$nemo])
					->get()->getFirstRow();
    }

    public function getProfCurso($nemo,$cod){
    	return $this->dao->table('cfg_personal')
					->select('*')
					->join('int_asignapr','int_asignapr.profcod = cfg_personal.p_codigo')
					->where(['int_asignapr.nemo'=>$nemo,'int_asignapr.cursocod'=>$cod])
					->get()->getFirstRow();
    }
    public function getEventos($nemo,$cod,$cod_prof){
    	return $this->dao->table('calendario_seccion')
					->select('*,calendario_eventos.t_descripcion as evento_descripcion')
					->join('calendario_eventos','calendario_eventos.t_id = calendario_seccion.t_idevento')
					->join('calendario_tbtipo','calendario_tbtipo.t_id = calendario_eventos.t_idtipo')
					->where(['calendario_seccion.t_idnemo'=>$nemo,'calendario_seccion.t_codcurso'=>$cod,'calendario_seccion.t_codprofesor'=>$cod_prof])
					->get()->getResult();
    }
    public function getEvento($id){
    	return $this->dao->table('calendario_eventos')
					->select('*')
					->where(['calendario_eventos.t_id'=>$id])
					->get()->getFirstRow();
    }

    public function getEventosFecha($nemo,$cod,$mes,$ano){
    	$mes=($mes<10)?"0".$mes:$mes;
    	return $this->dao->table('calendario_eventos')
					->select('*')
					->join('calendario_seccion','calendario_eventos.t_id = calendario_seccion.t_idevento')
					->join('calendario_tbtipo','calendario_tbtipo.t_id = calendario_eventos.t_idtipo')
					->like('calendario_eventos.t_fecha',$ano."-".$mes)
					->where(['calendario_seccion.t_idnemo'=>$nemo,'calendario_seccion.t_codcurso'=>$cod])
					->get()->getResult();
    }
    public function getNewEventId(){
    	return $this->dao->table('calendario_eventos')
					->select('MAX(t_id)+1 as max_id')
					->get()->getFirstRow();
    }

	public function del_evento($id) {
		return $this->dao->table('calendario_eventos')
						 ->where(['calendario_eventos.t_id'=>$id])
						 ->delete();
	}
	public function del_secciones($id) {
		return $this->dao->table('calendario_seccion')
						 ->where(['calendario_seccion.t_idevento'=>$id])
						 ->delete();
	}
	public function exeQuery($query) {
		return $this->dao->query($query);
	}

	public function getUser($post) {

		return $this->dao->table('cfg_usuario')
					->select('*')
					->join('cfg_tipo_usuario', 'cfg_usuario.u_codtipo = cfg_tipo_usuario.t_id')
					->where('cfg_usuario.u_codigo', $post['name_user'])
					->get()->getRow();
	}

	public function getInfo($post) {
		
	    return $this->dao->query("select p.p_codigo, 
						IFNULL(concat(p.p_nombres,' ',p.p_materno,' ',p.p_paterno), u.u_nombres) as fullname,
						t.t_descripcion as profile
					from cfg_usuario u
						left join cfg_tipo_usuario t on t.t_id=u.u_codtipo
						left join cfg_personal p on p.p_codigo=u.u_profcod
					where u.u_codigo='".$post['scodigo']."'")
	    			->getFirstRow();
	}

}