<?php
namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;
use App\Models\CalendarioModel;
use Config\Services;

class Calendario extends BaseController
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
        return view('calendario/calendario', $this->user_on);
    }

    public function curso($nemo=0,$cod=0)
    {  
        if($nemo==0 || $cod==0){return redirect()->to(base_url('/calendario'));}
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
        return view('calendario/curso', $this->user_on);
    }
    public function secciones(){
        // is post
        if ( $this->request->getMethod() == 'post' && $this->request->isAJAX() ){

            $calendario=new CalendarioModel();
            $codprof = $this->request->getPost('codprof');
            $nemo = $this->request->getPost('nemo');
            $cod = $this->request->getPost('cod');
            $secc = $this->request->getPost('secc');
            $cursos=$calendario->getCursosProf($codprof);
            $curso=['nemo'=>$nemo,'cod'=>$cod];

            $this->user_on['codprof'] = $codprof;
            $this->user_on['cursos'] = $cursos;
            $this->user_on['curso'] = $curso;
            $this->user_on['secc'] = $secc;
            return view('calendario/secciones', $this->user_on);
        }else{
            return;
        }
    }
    public function detalles(){
        // is post
        if ( $this->request->getMethod() == 'post' && $this->request->isAJAX() ){

            $calendario=new CalendarioModel();
            $id = $this->request->getPost('id');
            $cod = $this->request->getPost('cod');
            $nemo = $this->request->getPost('nemo');
            $evento=$calendario->getEvento($id);
            $nombre_curso=$calendario->getNombreCurso($cod);
            $nombre_salon=$calendario->getNombreSalon($nemo);
            $profesor=$calendario->getProfCurso($nemo,$cod);
            $cod_prof=$profesor->p_codigo;
            $curso=['nemo'=>$nemo,'cod'=>$cod];
            $path=base_url('/assets/files/'.$cod_prof);

            $this->user_on['id'] = $id;
            $this->user_on['mode'] = "readonly";
            $this->user_on['enable'] = "disabled";
            $this->user_on['curso'] = $curso;
            $this->user_on['evento'] = $evento;
            $this->user_on['path'] = $path;
            $this->user_on['nombre_curso'] = $nombre_curso->cursonom;
            $this->user_on['nombre_salon'] = $nombre_salon->nemodes;
            return view('calendario/detalles_evento', $this->user_on);
        }else{
            return;
        }
    }
    public function new_evento(){
        // is post
        if ( $this->request->getMethod() == 'post' && $this->request->isAJAX() ){

            $calendario=new CalendarioModel();
            $id = 0;
            $cod = $this->request->getPost('cod');
            $nemo = $this->request->getPost('nemo');
            $comboId = $this->request->getPost('comboId');
            $fecha_creacion=date("Y-m-d h:i");

            $nombre_curso=$calendario->getNombreCurso($cod);
            $nombre_salon=$calendario->getNombreSalon($nemo);
            $profesor=$calendario->getProfCurso($nemo,$cod);
            $cod_prof=$profesor->p_codigo;
            $curso=['nemo'=>$nemo,'cod'=>$cod];

            $this->user_on['id'] = $id;
            $this->user_on['mode'] = "";
            $this->user_on['evento'] = $evento;
            $this->user_on['comboId'] = $comboId;
            $this->user_on['fecha_creacion'] = $fecha_creacion;
            $this->user_on['nombre_curso'] = $nombre_curso->cursonom;
            $this->user_on['nombre_salon'] = $nombre_salon->nemodes;
            $this->user_on['curso'] = $curso;
            $this->user_on['cod_prof'] = $cod_prof;
            return view('calendario/detalles_evento', $this->user_on);
        }else{
            return;
        }
    }
    public function edt_evento(){
        // is post
        if ( $this->request->getMethod() == 'post' && $this->request->isAJAX() ){

            $calendario=new CalendarioModel();
            $id = $this->request->getPost('id');
            $cod = $this->request->getPost('cod');
            $nemo = $this->request->getPost('nemo');
            $evento=$calendario->getEvento($id);
            $comboId = $evento->t_idtipo;
            $nombre_curso=$calendario->getNombreCurso($cod);
            $nombre_salon=$calendario->getNombreSalon($nemo);
            $profesor=$calendario->getProfCurso($nemo,$cod);
            $cod_prof=$profesor->p_codigo;
            $curso=['nemo'=>$nemo,'cod'=>$cod];
            $path=base_url('/assets/files/'.$cod_prof);

            $this->user_on['id'] = $id;
            $this->user_on['mode'] = "";
            $this->user_on['edit'] = true;
            $this->user_on['evento'] = $evento;
            $this->user_on['comboId'] = $comboId;
            $this->user_on['fecha_creacion'] = $fecha_creacion;
            $this->user_on['nombre_curso'] = $nombre_curso->cursonom;
            $this->user_on['nombre_salon'] = $nombre_salon->nemodes;
            $this->user_on['curso'] = $curso;
            $this->user_on['cod_prof'] = $cod_prof;
            $this->user_on['path'] = $path;
            return view('calendario/detalles_evento', $this->user_on);
        }else{
            return;
        }
    }
    public function save_evento(){
        // is post
        if ( $this->request->getMethod() == 'post' && $this->request->isAJAX() ){

            $calendario=new CalendarioModel();
            $id = $this->request->getPost('id');
            $titulo = $this->request->getPost('titulo');
            $tipoid = $this->request->getPost('tipoid');
            $fecha = $this->request->getPost('txt_fecha');
            $fecha = date("Y-m-d", strtotime($fecha));
            $fecha_crea = $this->request->getPost('fecha_crea');
            $retorno = $this->request->getPost('retorno');
            $fecha_entrega = $this->request->getPost('fecha_entr');
            $fecha_entrega = date("Y-m-d", strtotime($fecha_entrega));
            $retorno=($retorno=="on")?1:0;
            if($retorno==0){$fecha_entrega="";}
            $publicado = $this->request->getPost('publicado');
            $publicado=($publicado=="on")?1:0;
            $desc=$this->request->getPost('desc');
            $desc=trim(htmlentities($desc,ENT_QUOTES));
            $orden=$this->request->getPost('orden');

            $cod = $this->request->getPost('cod');
            $nemo = $this->request->getPost('nemo');
            $profesor=$calendario->getProfCurso($nemo,$cod);
            $profcod=$profesor->p_codigo;
            $nombre_curso=$calendario->getNombreCurso($cod);
            $nombre_salon=$calendario->getNombreSalon($nemo);
            $secc=$this->request->getPost('secc');
            $secciones=explode(";", $secc);
            $loguser=session('scodigo');

            if($id==0){
                $id=$calendario->getNewEventId()->max_id;
                $nuevo=true;
            }else{
                $nuevo=false;
            }
            $path='./assets/files';
            if(!file_exists($path)){mkdir($path);}
            $path.="/".$profcod;
            if(!file_exists($path)){mkdir($path);}

            $files = $this->request->getFileMultiple('file');
            $ruta="";
            $cant_files=0;
            $file_list="";

            for ($i=0; $i < 10; $i++) {
                if($_POST["dfile_".$i]){
                    $file_list.="'".$_POST["dfile_".$i]."',";
                    $cant_files++;
                }
            }

            foreach ($files as $key) {
                if($key->getClientName()){
                    $fix_name="";
                    while (file_exists($path."/".$fix_name.$key->getClientName())) {
                        $fix_name++;
                    }
                    $key->move($path,$fix_name.$key->getClientName());
                    $ruta=$fix_name.$key->getClientName();
                    $cant_files++;
                    $file_list.="'".$ruta."',";
                }
            }
            for ($i=$cant_files; $i <10 ; $i++) { 
                $file_list.="'',";
            }
            $file_list=substr($file_list, 0,-1);

            if($nuevo){
                $sql="INSERT INTO `calendario_eventos` (`t_id`, `t_titulo`, `t_idtipo`, `t_fecha`, `t_fechacreacion`, `t_descripcion`, `t_orden`, `t_chkpublicado`, `t_chkretorno`, `t_fecharetorno`, `t_adjunto01`, `t_adjunto02`, `t_adjunto03`, `t_adjunto04`, `t_adjunto05`, `t_adjunto06`, `t_adjunto07`, `t_adjunto08`, `t_adjunto09`, `t_adjunto10`, `t_logusuario`, `t_logfecha`) VALUES ('$id', '$titulo', '$tipoid', '$fecha', '$fecha_crea', '$desc', '$orden', '$publicado', '$retorno', '$fecha_entrega', $file_list, '$loguser', CURRENT_TIME());";
                $calendario->exeQuery($sql);

                $sql="INSERT INTO `calendario_seccion` (`t_idevento`, `t_idnemo`,`t_codcurso`,`t_codprofesor`) VALUES ('$id', '$nemo','$cod','$profcod');";
                $calendario->exeQuery($sql);

                foreach ($secciones as $seccion){
                    $nemos=explode("|",$seccion)[0];
                    $cods=explode("|",$seccion)[1];
                    $sql="INSERT INTO `calendario_seccion` (`t_idevento`, `t_idnemo`,`t_codcurso`,`t_codprofesor`) VALUES ('$id', '$nemos','$cods','$profesor->p_codigo');";
                    $calendario->exeQuery($sql);
                }
            }else{
                $calendario->del_evento($id);
                $calendario->del_secciones($id);
                $sql="INSERT INTO `calendario_eventos` (`t_id`, `t_titulo`, `t_idtipo`, `t_fecha`, `t_fechacreacion`, `t_descripcion`, `t_orden`, `t_chkpublicado`, `t_chkretorno`, `t_fecharetorno`, `t_adjunto01`, `t_adjunto02`, `t_adjunto03`, `t_adjunto04`, `t_adjunto05`, `t_adjunto06`, `t_adjunto07`, `t_adjunto08`, `t_adjunto09`, `t_adjunto10`, `t_logusuario`, `t_logfecha`) VALUES ('$id', '$titulo', '$tipoid', '$fecha', '$fecha_crea', '$desc', '$orden', '$publicado', '$retorno', '$fecha_entrega', $file_list, '$loguser', CURRENT_TIME());";
                $calendario->exeQuery($sql);

                $sql="INSERT INTO `calendario_seccion` (`t_idevento`, `t_idnemo`,`t_codcurso`,`t_codprofesor`) VALUES ('$id', '$nemo','$cod','$profcod');";
                $calendario->exeQuery($sql);

                foreach ($secciones as $seccion){
                    $nemos=explode("|",$seccion)[0];
                    $cods=explode("|",$seccion)[1];
                    $sql="INSERT INTO `calendario_seccion` (`t_idevento`, `t_idnemo`,`t_codcurso`,`t_codprofesor`) VALUES ('$id', '$nemos','$cods','$profesor->p_codigo');";
                    $calendario->exeQuery($sql);
                }
            }

            return "ok";

        }else{
            return;
        }
    }
    public function del_evento(){
        // is post
        if ( $this->request->getMethod() == 'post' && $this->request->isAJAX() ){

            $calendario=new CalendarioModel();
            $id = $this->request->getPost('id');
            $calendario->del_evento($id);
            $calendario->del_secciones($id);
        }else{
            return;
        }
    }
    public function mes($nemo=0,$cod=0,$mes=0,$ano=0){
        if($nemo==0 || $cod==0){
            return redirect()->to(base_url('/calendario'));
        }
        $curso=['nemo'=>$nemo,'cod'=>$cod];
        if($mes==0 || $ano==0){
            $mes=date("n");
            $ano=date("Y");
        }

        $calendario=new CalendarioModel();

        $eventos=$calendario->getEventosFecha($nemo,$cod,$mes,$ano);
        $nombre_curso=$calendario->getNombreCurso($cod);
        $nombre_salon=$calendario->getNombreSalon($nemo);
        $profesor=$calendario->getProfCurso($nemo,$cod);


        $meses=array(1=>"Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio","Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
        $primer=date("w",mktime(0,0,0,$mes,1,$ano))+1;
        $ultimo=date("d",(mktime(0,0,0,$mes+1,1,$ano)-1));

        $mes_ant=date("n",(mktime(0,0,0,$mes-1,1,$ano)));
        $ano_ant=date("Y",(mktime(0,0,0,$mes-1,1,$ano)));

        $mes_sig=date("n",(mktime(0,0,0,$mes+1,1,$ano)));
        $ano_sig=date("Y",(mktime(0,0,0,$mes+1,1,$ano)));

        $this->user_on['mes'] = $mes;
        $this->user_on['ano'] = $ano;
        $this->user_on['meses'] = $meses;
        $this->user_on['primer'] = $primer;
        $this->user_on['ultimo'] = $ultimo;
        $this->user_on['mes_ant'] = $mes_ant;
        $this->user_on['ano_ant'] = $ano_ant;
        $this->user_on['mes_sig'] = $mes_sig;
        $this->user_on['ano_sig'] = $ano_sig;
        $this->user_on['profesor'] = $profesor;
        $this->user_on['curso'] = $curso;
        $this->user_on['nombre_curso'] = $nombre_curso->cursonom;
        $this->user_on['nombre_salon'] = $nombre_salon->nemodes;
        $this->user_on['eventos'] = $eventos;
        return view('calendario/calendario2', $this->user_on);
    }

}
