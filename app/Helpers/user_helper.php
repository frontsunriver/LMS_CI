<?php

function setUserSession($user, $speriodo)
{
	// save fields important
    $data = [
        'scodigo' => $user->u_codigo,
        'snombres' => $user->u_nombres,
        'scodtipo' => $user->u_codtipo,
        'snomtipo' => $user->t_descripcion,
        'scodprof' => $user->u_profcod,
        'schki' => $user->u_chki,
        'schkipermiso' => $user->u_chki_permiso,
        'schkp' => $user->u_chkp,
        'schkppermiso' => $user->u_chkp_permiso,
        'schks' => $user->u_chks,
        'schkspermiso' => $user->u_chks_permiso,
        'sfiltrosalon' => $user->t_mns_filtro_salon,
        'speriodo' => $speriodo,
        'isLoggedIn' => true
    ];
    
    session()->set($data);
    return true;
}