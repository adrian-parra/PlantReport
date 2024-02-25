<?php
class RespuestasAPI {
    public static function exitosa($datos = null ,$title='') {
        return json_encode(array('icon' => 'success', 'body' => $datos,'title'=>$title));
    }

    public static function error($mensaje,$estatus = 422) {
        return json_encode(array('icon' => 'error', 'title' => $mensaje ,'estatus'=>$estatus));
    }

}