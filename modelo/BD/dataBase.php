<?php
class DataBase{
    public $host=DB_HOST;
    public $user=DB_USER;
    public $pass=DB_PASS;
    public $dbname=DB_NAME;

    public $link;
    public $error;

    public function __construct(){
        $this->connectDB();
    }
    private function connectDB(){
        $this->link=new mysqli($this->host, $this->user, $this->pass, $this->dbname);
        if(!$this->link){ //Si no existe una conexión, genera un mensaje de error
            $this->error="Conexión fallida".$this->link->connect_error;
            return false;
        }
    }
    // MOSTRAR DATOS DE LA TABLA
    public function select($query){
        $result=$this->link->query($query) or die ($this->link->error.__LINE__);
        if($result->num_rows>0){
            return $result;
        }
        else{
            header("Location:../../index.php?msg=El dato no existe!!!");
            // header("Location:../index.php?msg=Error!!!");
            exit();
        }
    }
    public function verificarUsuario($usuario){
        $query="select usuario from usuario";
        $getData=$this->select($query);
        if($getData->num_rows>0){
            $sw=0;
            while ($row=$getData->fetch_assoc() and $sw==0){
                if($row['usuario']==$usuario){
                    $sw=1;
                }
                else{
                    $sw=0;
                }
            }
        }
        if($sw==1){
            return 1;
        }
        else{
            return 0;
        }
    }
    // EJECUTAR LA CONSULTA
    public function signIn($query, $rol_sesion, $rol_sesion2){
        $sign_row=$this->link->query($query) or die ($this->link->error.__LINE__);
        if($sign_row){
            header("Location:../vista/public/presentacion.php?rol_sesion=".urlencode($rol_sesion)."&rol_sesion2=".urlencode($rol_sesion2));
            exit();
        }else{
            die("Error:(".$this->link->errno.")".$this->link->error);
        }
    }
    // REGISTRAR DATOS A LA TABLA
    public function registerUser($query){
        $sign_row=$this->link->query($query) or die ($this->link->error.__LINE__);
        if($sign_row){
            header("Location:../public/presentacion.php?rol_sesion=".urlencode($rol_sesion));
            exit();
        }else{
            die("Error:(".$this->link->errno.")".$this->link->error);
        }
    }
    // ACTUALIZAR DATOS
    public function updateUsuario($query){
        $update_row=$this->link->query($query) or die($this->link->error.__LINE__);
        if($update_row){
            header("Location:../../vista/public/resultado.php?msg=Los datos han sido actualizados exitosamente!!!");
            exit();
        }else{
            die("Error:(".$this->link->errno.")".$this->link->error);
        }
    }
    // ELIMINAR DATOS
    public function deleteUsuario($query){
        $delete_row=$this->link->query($query) or die($this->link->error.__LINE__);
        if($delete_row){
            header("Location:../../vista/public/resultado.php?msg=Los datos han sido eliminados exitosamente!!!");
            exit();
        }else{
            die("Error:(".$this->link->errno.")".$this->link->error);
        }
    }
}
?>