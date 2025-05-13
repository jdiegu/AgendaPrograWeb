function evalua(oNombre, oApePat, oApeMat, psw, tipo, oEmail) {
  var sErr = "";
  var bRet = false;

  if (oNombre.disabled == false && oNombre.value == "")
    sErr = sErr + "\n Falta nombre";

  if (oApePat.disabled == false && oApePat.value == "")
    sErr = sErr + "\n Falta apellido paterno";

  if (oApeMat.disabled == false && oApeMat.value == "")
    sErr = sErr + "\n Falta apellido Materno";

  if (psw.disabled == false && psw.value == "")
    sErr = sErr + "\n Falta numero";

  if (tipo.disabled == false && tipo.value == "")
    sErr = sErr + "\n Falta direccion";

  if (oEmail.disabled == false && oEmail.value == "")
    sErr = sErr + "\n Falta email";

  if (sErr == "") bRet = true;
  else alert(sErr);

  return bRet;
}


function evalua2(oNombre, oApePat, oApeMat, psw, tipo) {
  var sErr = "";
  var bRet = false;

  if (oNombre.disabled == false && oNombre.value == "")
    sErr = sErr + "\n Falta nombre";

  if (oApePat.disabled == false && oApePat.value == "")
    sErr = sErr + "\n Falta apellido paterno";

  if (oApeMat.disabled == false && oApeMat.value == "")
    sErr = sErr + "\n Falta apellido Materno";

  if (psw.disabled == false && psw.value == "")
    sErr = sErr + "\n Falta contraseña";

  if (tipo.disabled == false && tipo.value == 0)
    sErr = sErr + "\n Falta Tipo de Usuario";


  if (sErr == "") bRet = true;
  else alert(sErr);

  return bRet;
}