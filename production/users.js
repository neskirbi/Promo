function setBorrarNominaAction() {
	if(confirm("Se guardaran todos los campos referentes a Incentivos con el valor 0")) {
document.frmUser.action = "update_incentivos.php";
document.frmUser.submit();
    }
}
function setCleanIncentAction() {
	if(confirm("Se guardaran todos los campos referentes a Incentivos con el valor 0")) {
document.frmUser.action = "update_incentivos.php";
document.frmUser.submit();
    }
}
function setInsertarAction() {
if(confirm("Cualquier cambio realizado en la nomina será guardado ok?")) {
document.frmUser.action = "update_generar.php";
document.frmUser.submit();
}
}
function setModificarAction() {
if(confirm("Esta seguro que quieres modificar estos campos?")) {
document.frmUser.action = "update.php";
document.frmUser.submit();
}
}
function setCrearUsuarioAction() {

document.frmUser.action = "edit_crear_usuario.php";
document.frmUser.submit();

}
function setEditUserBidAction(){
document.frmUser.action = "edit_edit_us.php";
document.frmUser.submit();
}
function setBajaUsuarioBidAction(){
if(confirm("Esta a punto de dar de baja a este usuario, estas seguro de esto?")) {
document.frmUser.action = "edit_baja_us.php";
document.frmUser.submit();
}
}
function setActivaUsuarioBidAction(){
if(confirm("Esta a punto de dar de Alta a este usuario, estas seguro de esto?")) {
document.frmUser.action = "edit_alta_us.php";
document.frmUser.submit();
}
}
function setExcelAction(){
if(confirm("Esta a punto de, estas seguro de esto?")) {
document.frmUser.action = "excel.php";
document.frmUser.submit();
}
}
function setNewUserBAction(){
document.frmUser.action = "edit_crear_usuario_new.php";
document.frmUser.submit();	
}
function setFotoAction(){
document.frmUser.action = "foto.php";
document.frmUser.submit();	
}

