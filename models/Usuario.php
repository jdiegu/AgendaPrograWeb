<?php
/*
Archivo:  Usuario.php
Objetivo: clase que encapsula la información de un usuario
Autor:
*/

include_once("AccesoDatos.php");

class Usuario
{
  private $nClave = 0;
  private $sPwd = "";
  private $nTipoUsuario = 0;
  private $sApPaterno = "";
  private $sApMaterno = "";
  private $sNombre = "";

  private $oAD;

  public function getClave()
  {
    return $this->nClave;
  }
  public function setClave($valor)
  {
    $this->nClave = $valor;
  }

  public function getPwd()
  {
    return $this->sPwd;
  }
  public function setPwd($valor)
  {
    $this->sPwd = $valor;
  }

  public function getApPaterno()
  {
    return $this->sApPaterno;
  }

  public function setApPaterno($valor)
  {
    $this->sApPaterno = $valor;
  }

  public function getApMaterno()
  {
    return $this->sApMaterno;
  }

  public function setApMaterno($valor)
  {
    $this->sApMaterno = $valor;
  }

  public function getNombre()
  {
    return $this->sNombre;
  }

  public function setNombre($valor)
  {
    $this->sNombre = $valor;
  }

  public function getNombreCompleto()
  {
    return $this->sApPaterno . " " . $this->sApMaterno . " " . $this->sNombre;
  }

  public function getTipoUsuario()
  {
    if ($this->nTipoUsuario == 1) {
      return "admin";
    } else {
      return "visualizador";
    }
  }

  public function getTipoUsuarioNumero()
  {
    return $this->nTipoUsuario;
  }

  public function setTipoUsuario($valor)
  {
    $this->nTipoUsuario = $valor;
  }

  public function buscarCvePwd()
  {
    $bRet = false;
    $sQuery = "";
    $arrRS = null;
    if (($this->nClave == 0 || $this->sPwd == ""))
      throw new Exception("Usuario->buscar: faltan datos");
    else {
      $sQuery = "SELECT clave_usuario , apPaterno, apMaterno, nombre , contrasena , tipo_usuario
					   FROM usuarios
					   WHERE clave_usuario = " . $this->nClave . "
					   AND contrasena = '" . $this->sPwd . "'";
      //Crear, conectar, ejecutar, desconectar
      $oAD = new AccesoDatos();
      if ($oAD->conectar()) {
        $arrRS = $oAD->ejecutarConsulta($sQuery);
        $oAD->desconectar();
        if ($arrRS != null) {
          $this->setClave($arrRS[0][0]);
          $this->setApPaterno($arrRS[0][1]);
          $this->setApMaterno($arrRS[0][2]);
          $this->setNombre($arrRS[0][3]);
          $this->setPwd($arrRS[0][4]);
          $this->setTipoUsuario($arrRS[0][5]);
          $bRet = true;
        }
      }
    }
    return $bRet;
  }

  function buscar()
  {
    $oAccesoDatos = new AccesoDatos();
    $sQuery = "";
    $arrRS = null;
    $bRet = false;
    if ($this->getClave() == 0)
      throw new Exception("Usuarios->buscar(): faltan datos");
    else {
      if ($oAccesoDatos->conectar()) {
        $sQuery = "SELECT clave_usuario , apPaterno, apMaterno, nombre , contrasena , tipo_usuario
					   FROM usuarios
					   WHERE clave_usuario = " . $this->nClave . "";
        $arrRS = $oAccesoDatos->ejecutarConsulta($sQuery);
        $oAccesoDatos->desconectar();
        if ($arrRS) {
          $this->nClave = $arrRS[0][0];
          $this->sApPaterno = $arrRS[0][1];
          $this->sApMaterno = $arrRS[0][2];
          $this->sNombre = $arrRS[0][3];
          $this->sPwd = $arrRS[0][4];
          $this->nTipoUsuario = $arrRS[0][5];
          $bRet = true;
        }
      }
    }
    return $bRet;
  }


  function buscarTodos()
  {
    $oAccesoDatos = new AccesoDatos();
    $sQuery = "";
    $arrRS = null;
    $aLinea = null;
    $oUser = null;
    $j = 0;
    $arrResultado = [];
    if ($oAccesoDatos->conectar()) {
      $sQuery = "SELECT clave_usuario,apPaterno,apMaterno,nombre,contrasena,tipo_usuario
          FROM usuarios WHERE clave_usuario <> " . $this->nClave . "
          ORDER BY clave_usuario";
      $arrRS = $oAccesoDatos->ejecutarConsulta($sQuery);
      $oAccesoDatos->desconectar();
      if ($arrRS) {
        foreach ($arrRS as $aLinea) {
          $oUser = new Usuario();
          $oUser->setClave($aLinea[0]);
          $oUser->setApPaterno($aLinea[1]);
          $oUser->setApMaterno($aLinea[2]);
          $oUser->setNombre($aLinea[3]);
          $oUser->setPwd($aLinea[4]);
          $oUser->setTipoUsuario($aLinea[5]);

          $arrResultado[$j] = $oUser;
          $j = $j + 1;
        }
      } else
        $arrResultado = [];
    }
    return $arrResultado;
  }


  function insertar()
  {
    $oAccesoDatos = new AccesoDatos();
    $sQuery = "";
    $nAfectados = -1;
    if (
      $this->sNombre == "" or $this->sApPaterno == "" or
      $this->sApMaterno == "" or $this->sPwd == "" or $this->nTipoUsuario == 0
    )
      throw new Exception("Usuario->insertar(): faltan datos");
    else {
      if ($oAccesoDatos->conectar()) {
        $sQuery = "INSERT INTO usuarios ( apPaterno, apMaterno, nombre, contrasena, tipo_usuario)
            VALUES ('" . $this->sApPaterno . "', '" . $this->sApMaterno . "',
            '" . $this->sNombre . "','" . $this->sPwd . "',
            " . $this->nTipoUsuario . ");";
        $nAfectados = $oAccesoDatos->ejecutarComando($sQuery);
        $oAccesoDatos->desconectar();
      }
    }
    return $nAfectados;
  }

  function modificar()
  {
    $oAccesoDatos = new AccesoDatos();
    $sQuery = "";
    $nAfectados = -1;
    if (
      $this->sNombre == "" or $this->sApPaterno == "" or
      $this->sApMaterno == "" or $this->sPwd == "" or $this->nTipoUsuario == null or $this->nClave == 0
    )
      throw new Exception("Usuario->modificar(): faltan datos");
    else {
      if ($oAccesoDatos->conectar()) {
        $sQuery = "UPDATE usuarios
        SET apPaterno = '" . $this->sApPaterno . "' ,
        apMaterno = '" . $this->sApMaterno . "' ,
        nombre = '" . $this->sNombre . "',
        contrasena = '" . $this->sPwd . "',
        tipo_usuario = " . $this->nTipoUsuario . "
        WHERE clave_usuario = " . $this->nClave;
        $nAfectados = $oAccesoDatos->ejecutarComando($sQuery);
        $oAccesoDatos->desconectar();
      }
    }
    return $nAfectados;
  }

  function borrar()
  {
    $oAccesoDatos = new AccesoDatos();
    $sQuery = "";
    $nAfectados = -1;
    if ($this->nClave == 0)
      throw new Exception("Usuario->borrar(): faltan datos");
    else {
      if ($oAccesoDatos->conectar()) {
        $sQuery = "DELETE FROM usuarios
                WHERE clave_usuario = " . $this->nClave;
        $nAfectados = $oAccesoDatos->ejecutarComando($sQuery);
        $oAccesoDatos->desconectar();
      }
    }
    return $nAfectados;
  }


}
?>