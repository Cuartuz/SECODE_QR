<?php

require_once("../assets/php/database.php");

class persona {
    $Ndocumento;
    $Direccion;
    $Genero;
    $FechaNacimiento;
    $Id_Eps;
    $Img_perfil;
    $TipoImg;

    public function obtenerPersona($Ndocumento){
        $db = Db::conectar();
        $select = $db ->prepare("SELECT * FROM usuario WHERE Ndocumento = :id");
        $select -> bindValue("id",$Ndocumento);
        $select -> execute();
        $persona = $select -> fetch();
        $myPersona = new Persona();
        $myPersona -> setId($persona["Ndocumento"]);
        $myPersona -> setNombre($persona["Nombre"]);
        $myPersona -> setCorreo($persona["Correo"]);
        $myPersona -> setGenero($persona["Genero"]);
        $myPersona -> setFechaNacimiento($persona["FechaNacimineto"]);
        $myPersona -> setTipoImg($persona["TipoImg"]);
        $myPersona -> setImgperfil($persona["Img_perfil"]);
        $myPersona -> setId_eps($persona["id"]);
        return $myPersona;
    }


    public function mostrar(){
        $db=Db::conectar();
        $listaPersona = [];
        $select = $db->query("SELECT * FROM usuario");

        foreach($select -> fetchAll() as $persona){
            $myPersona = new Persona();
            $myPersona -> setNdocumento($persona["Ndocumento"]);
            $myPersona -> setNombre($persona["Nombre"]);
            $myPersona -> setCorreo($persona["Correo"]);
            $myPersona -> setDireccion($persona["Direccion"]);
            $myPersona -> setGenero($persona["Genero"]);
            $myPersona -> setFechaNacimineto($persona["FechaNacimineto"]);
            $myPersona -> setid($persona["id"]);
            $myPersona -> setImg_perfil($persona["Img_perfil");
            $listaPersona[] = $myPersona;
        }
        return $listaPersona;
    }

    public function actualizar($persona){
        $db = Db::conectar();
        $actualizar = $db ->prepare("UPDATE usuario SET  Genero=:Genero, Correo=:Correo, Id_Eps=:Id_Eps,FechaNacimiento=:FechaNacimiento, Img_perfil=:Img_perfil, TipoImg=:TipoImg, Direccion=:Direccion  WHERE Ndocumento = :Ndocumento");
        $actualizar -> bindValue("Ndocumento",$persona -> getNdocumento());
        $actualizar -> bindValue("Genero",$persona -> getGenero());
        $actualizar -> bindValue("Correo",$persona -> getCorreo());
        $actualizar -> bindValue("Id_Eps",$persona -> getId_Eps());
        $actualizar -> bindValue("FechaNacimiento",$persona -> getFechaNacimiento());
        $actualizar -> bindValue("Img_perfil",$persona -> getImg_perfil());
        $actualizar -> bindValue("TipoImg",$persona -> getTipoImg());
        $actualizar -> bindValue("Direccion",$persona -> getDireccion());
        $actualizar -> execute();
    }


    /*
    public function insertar($persona){
        $db =Db::conectar();
        $insert= $db->prepare("INSERT INTO usuario (Nombre,Correo,Contrasena,Ndocumento,img_perfil,tipo,info) VALUES ( :nombre, :email,'',:telefono,'',:tipo, :informacion)");
        $insert -> bindValue("Nombre",$persona->getNombre());
        $insert -> bindValue("Correo",$persona->getCorreo());
        $insert -> bindValue("telefono",$persona->getTelefon());
        $insert -> bindValue("informacion",$persona->getInformacion());
        $insert -> bindValue("tipo",$persona->getTipo());
        $insert -> execute();
    }
*/

/*
    public function eliminar($id){
        $db = Db::conectar();
        $eliminar = $db ->prepare(" DELETE FROM suscripcion WHERE id = :id");
        $eliminar -> bindValue("id",$id);
        $eliminar -> execute();
        $eliminar1 = $db ->prepare(" DELETE FROM users WHERE id = :id");
        $eliminar1 -> bindValue("id",$id);
        $eliminar1 -> execute();
    }
*/

}

?>