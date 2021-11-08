<?php
namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
	protected $DBGroup              = 'default';
	protected $table                = 'cfg_usuario';
	protected $primaryKey           = 'u_codigo';
	protected $useAutoIncrement     = true;
	protected $insertID             = 0;
	protected $returnType           = 'array';
	protected $useSoftDelete        = false;
	protected $protectFields        = true;
	protected $allowedFields        = [
		"u_codigo",
		"u_nombres",
		"u_password",
		"u_codtipo",
	];

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

	public function getMenu($post) {

	    return $this->dao->query("select
						m.m_orden, m.m_modulo, u.m_enlace as enlace, m.m_codigo, u.m_icono, u.m_nombre, u.m_tipo, u.m_menupad 
					from cfg_menu u 
						left join cfg_menu_usuario m on u.m_orden=m.m_orden and u.m_modulo=m.m_modulo 
					where m.m_tipo='".$post['scodtipo']."' and m.m_coduser='".$post['scodigo']."' and u.m_activo=1
					order by 1")
			    	->getResult();
	}

	public function getRol($tipo) {

		return $this->dao->table("cfg_tipo_usuario")
						 ->select("cfg_tipo_usuario.t_descripcion")
						 ->where("cfg_tipo_usuario.t_id",$tipo)
						 ->get()->getFirstRow();
	}

	public function getLogo() {

	    return $this->dao->query("select i_logo as logo from `institucion` where i_id='I0001'")
			    	->getFirstRow();
	}

	public function getTopMenu($post) {

	    return $this->dao->query("select 
					t.t_id, t.btn_inicio_icon, t.btn_inicio_link, t.btn_calendario_icon, t.btn_calendario_link, t.btn_cursos_icon, t.btn_cursos_link, t.btn_mensajeria_icon, t.btn_mensajeria_link, t.btn_comunicados_icon, t.btn_comunicados_link, t.btn_asistencia_icon, t.btn_asistencia_link, t.btn_notificacion_link, t.btn_notificacion_icon 
					from cfg_tipo_usuario t where t.t_flgactivo=1 and t.t_id='".$post['scodtipo']."'")
			    	->getFirstRow();
	}

	public function getPeriods() {

		return $this->dao->table('cfg_periodo')
					->select('*')
					->get()->getResult();
	}

	public function exitsPeriod($post) {
		
		return $this->dao->query("select count(SCHEMA_NAME) as flag from INFORMATION_SCHEMA.SCHEMATA where SCHEMA_NAME='".getenv('database.default.sufixdb') . $post['cfg_periodo']."'")->getFirstRow();
	}

	public function getNowPeriod() {

		return $this->dao->query("select `cfg_periodo` from `cfg_periodo` where cfg_vicente='S' and cfg_estado='I'")
					->getFirstRow();
	}

}