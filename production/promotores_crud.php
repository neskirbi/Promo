<?php
include("../metodos/metodos1.php");
include("../conexion/conexion.php");
header("Content-Type: text/html;charset=utf-8");
$canales = array();
$sql = "SELECT id, descripcion as [canal] FROM canal
        union (SELECT 0, '')";
$resQuery = odbc_exec($conexion, $sql);
while($row = odbc_fetch_array($resQuery)){
  $canales[] = $row;
}
?>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../bootstrap4/css/bootstrap.min.css">
    <script src="../js/jquery-3.1.1.min.js"></script>
    <script src="../bootstrap4/js/popper.min.js"></script>
    <script src="../bootstrap4/js/bootstrap.min.js"></script>
    <script type="text/javascript">
        function exportar_incentivos() {
            var fecha_ini = document.getElementById("fecha_ini").value;
            var fecha_fin = document.getElementById("fecha_fin").value;
            var link = "../reportesexcel/incentivos.php?fecha_ini=" + fecha_ini + "&fecha_fin=" + fecha_fin;
            //console.log(link);
            document.location.target = "_blank";
            document.location.href = link;
        }
    </script>


    <style>
        .table td.fit,
        .table th.fit {
            white-space: nowrap;
            width: 1%;
        }
        .loader {
            border: 5px solid #f3f3f3; /* Light grey */
            border-top: 5px solid #3498db; /* Blue */
            border-radius: 50%;
            width: 50px;
            height: 50px;
            animation: spin 2s linear infinite;
        }

        .loader-container {
            display: table;
            margin: 0 auto;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }
            100% {
                transform: rotate(360deg);
            }
        }

        /* The snackbar - position it at the bottom and in the middle of the screen */
        #snackbar {
            visibility: hidden; /* Hidden by default. Visible on click */
            min-width: 250px; /* Set a default minimum width */
            margin-left: -125px; /* Divide value of min-width by 2 */
            background-color: #333; /* Black background color */
            color: #fff; /* White text color */
            text-align: center; /* Centered text */
            border-radius: 2px; /* Rounded borders */
            padding: 16px; /* Padding */
            position: fixed; /* Sit on top of the screen */
            z-index: 0; /* Add a z-index if needed */
            left: 50%; /* Center the snackbar */
            top: 30px; /* 30px from the bottom */
        }

        /* Show the snackbar when clicking on a button (class added with JavaScript) */
        #snackbar.show {
            visibility: visible; /* Show the snackbar */
            -webkit-animation: fadein 0.5s;
        }

        #snackbar.hide {
            /*-webkit-animation: fadeout 0.5s;
            visibility: hidden; /* Show the snackbar */
        }

        /* Animations to fade the snackbar in and out */
        @-webkit-keyframes fadein {
            from {
                bottom: 0;
                opacity: 0;
            }
            to {
                top: 30px;
                opacity: 1;
            }
        }

        @keyframes fadein {
            from {
                top: 0;
                opacity: 0;
            }
            to {
                top: 30px;
                opacity: 1;
            }
        }

        @-webkit-keyframes fadeout {
            from {
                top: 30px;
                opacity: 1;
            }
            to {
                bottom: 0;
                opacity: 0;
            }
        }

        @keyframes fadeout {
            from {
                top: 30px;
                opacity: 1;
            }
            to {
                top: 0;
                opacity: 0;
            }
        }
    </style>

    <script type="text/javascript">
        function change(form) {
            var id = form.is_submitted.value;
            var checked = form.cambio.checked;
            var change_form = document.getElementById("change_div_" + id);
            var is_changed = form.is_changed;
            if (checked) {
                change_form.style.visibility = 'visible';
                is_changed.value = "1";
            } else {
                change_form.style.visibility = 'hidden';
                is_changed.value = "0";
            }
        }
    </script>

    <script type="text/javascript">
        const host = 'http://cbd.mine.nu/nodejs';
        var estado;
        var ciudad;
        var select_region;
        var fechaalta;
        var select_canal;
        var select_puesto;
        var input_nombre_completo;
        var snackbar;

        var estadoChanged = function () {
            $.ajax({
                url: host + '/ciudades/ciudades/unicos/' + estado.value,
                type: 'GET',
                data: '',
                dataType: 'json',
                success: function (data) {
                    $("#select-ciudad").empty();
                    for (var i = 0; i < data.length; i++) {
                        var elemento = data[i];
                        var opt = document.createElement('option');
                        opt.text = elemento.d_ciudad;
                        opt.value = elemento.d_ciudad;
                        ciudad.appendChild(opt);
                    }
                }
            });
        };

        var guardarUsuario = function () {
            if (estado.value == '') {
                showSnackbar('Selecciona un estado');
                return;
            }

            if (ciudad.value == '') {
                showSnackbar('Selecciona una ciudad');
                return;
            }

            if (select_region.value == '') {
                showSnackbar('Selecciona una región');
                return;
            }

            if (fechaalta.value == '') {
                showSnackbar('Selecciona la fecha de alta');
                return;
            }

            if (select_canal.value == '') {
                showSnackbar('Selecciona un canal');
                return;
            }

            if (select_puesto.value == '') {
                showSnackbar('Selecciona un puesto');
                return;
            }

            if (input_nombre_completo.value == '') {
                showSnackbar('Ingresa el nombre completo del usuario');
                return;
            }
            showLoadDialog();
            var userData = {
                "us_apellidos": estado.value,
                "us_nombre_real": input_nombre_completo.value,
                "us_region": select_region.value,
                "fechaalta": fechaalta.value,
                "canal": select_canal.value,
                "puesto": select_puesto.value
            };
            $.ajax({
                url: host + '/usuario/',
                type: 'POST',
                data: JSON.stringify(userData),
                contentType: "application/json; charset=utf-8",
                success: function (usuario) {
                    hideLoadDialog();
                    showSnackbar('Guardado! ID: ' + usuario.Id_usuario + ', ' + usuario.us_nombre);
                },
                error: function (XMLHttpRequest, textStatus, errorThrown) {
                    console.log(JSON.stringify(userData));
                    showSnackbar('Error al guardar');
                }
            });
        };

        function showLoadDialog() {
            snackbar.className = "show";
            var loadingContainer = document.createElement('div');
            loadingContainer.className = 'loader-container';
            var loadingBadge = document.createElement('div');
            loadingBadge.className = 'loader';
            loadingContainer.appendChild(loadingBadge);
            snackbar.innerText = '';
            snackbar.appendChild(loadingContainer);
        }

        function hideLoadDialog() {
            snackbar.className = "hide";
        }

        function showSnackbar(text) {
            snackbar.innerText = text;
            snackbar.className = "show";
            setTimeout(function () {
                snackbar.className = "";
            }, 2500);
        }

        $('document').ready(function () {
            estado = document.getElementById('select-estado');
            ciudad = document.getElementById('select-ciudad');
            select_canal = document.getElementById('select-canal');
            select_puesto = document.getElementById('select-puesto');
            select_region = document.getElementById('select-region');
            fechaalta = document.getElementById('date-fechaalta');
            input_nombre_completo = document.getElementById('input-nombre-completo');
            snackbar = document.getElementById('snackbar');

            estado.addEventListener('change', estadoChanged);

            $.ajax({
                url: host + '/ciudades/estados/unicos',
                type: 'GET',
                data: '',
                dataType: 'json',
                success: function (data) {
                    for (var i = 0; i < data.length; i++) {
                        var ciudad = data[i];
                        var opt = document.createElement('option');
                        opt.text = ciudad.d_estado;
                        opt.value = ciudad.d_estado;
                        estado.appendChild(opt);
                    }
                }
            });


            document.getElementById('addUserButton').addEventListener("click", function () {
                    document.getElementById("container-crear-usuario").style.display = 'block';
                }
            );

            document.getElementById('button-cancel-newuser').addEventListener("click", function () {
                    document.getElementById("container-crear-usuario").style.display = 'none';
                }
            );

            document.getElementById('button-guardar-newuser').addEventListener('click', guardarUsuario);


            $.ajax({
                url: host + '/region/',
                type: 'GET',
                data: '',
                dataType: 'json',
                success: function (data) {
                    for (var i = 0; i < data.length; i++) {
                        var region = data[i];
                        var opt = document.createElement('option');
                        opt.text = region.region;
                        opt.value = region.id;
                        select_region.appendChild(opt);
                    }
                }
            });

            $.ajax({
                url: host + '/puesto/',
                type: 'GET',
                data: '',
                dataType: 'json',
                success: function (data) {
                    for (var i = 0; i < data.length; i++) {
                        var puesto = data[i];
                        var opt = document.createElement('option');
                        opt.text = puesto.descripcion;
                        opt.value = puesto.id;
                        select_puesto.appendChild(opt);
                    }
                }
            });

            $.ajax({
                url: host + '/canal/',
                type: 'GET',
                data: '',
                dataType: 'json',
                success: function (data) {
                    for (var i = 0; i < data.length; i++) {
                        var canal = data[i];
                        var opt = document.createElement('option');
                        opt.text = canal.descripcion;
                        opt.value = canal.id;
                        select_canal.appendChild(opt);
                    }
                }
            });
        });

    </script>
</head>
<?php

function getUsuario($conexion, $where)
{
    $res = odbc_exec($conexion, "SELECT * FROM usuario $where");
    $array = array();
    while ($row = odbc_fetch_array($res)) {
        $array[] = $row;
    }
    return $array;
}

function getSeguimiento($conexion, $where)
{
    $res = odbc_exec($conexion, "SELECT TOP 1 * FROM seguimiento_cambios $where ORDER BY fecha DESC");
    $array = odbc_fetch_array($res);
    return $array;
}

function enviar_cambio($conexion, $usuario, $tipo, $data)
{
    $id_usuario = $usuario['Id_usuario'];
    $nombre = $usuario['us_nombre_real'];
    $nomeclatura = $usuario['us_nombre'];
    $fecha = date('Y-m-d', strtotime(date("Y-m-d")));
    switch ($tipo) {
        case 4: // Laptop
            $sql = "INSERT INTO seguimiento_cambios(Id_usuario,nombre,nomeclatura,tipo,fecha,laptop)
            VALUES('$id_usuario','$nombre','$nomeclatura',4,'$fecha',$data)";
            break;
        case 5: //Equipo
            $sql = "INSERT INTO seguimiento_cambios (Id_usuario,nombre,nomeclatura,tipo,fecha,equipo)
            VALUES('$id_usuario','$nombre','$nomeclatura',5,'$fecha',$data)";
            break;
        case 6: //Canal
            $sql = "INSERT INTO seguimiento_cambios (Id_usuario,nombre,nomeclatura,tipo,fecha,canal)
            VALUES('$id_usuario','$nombre','$nomeclatura',6,'$fecha',$data)";
            break;
        default:
            return;
    }
    odbc_exec($conexion, $sql);
}


$fecha_inicio = '';
$fecha_final = '';
if (isset($_POST["fecha_ini"])) {
    $fecha_inicio = $_POST['fecha_ini'];
} else {
    $fecha_inicio = date('Y-m-01', strtotime(date("Y-m-d")));
}

if (isset($_POST["fecha_fin"])) {
    $fecha_final = $_POST['fecha_fin'];
} else {
    $fecha_final = date('Y-m-t', strtotime(date("Y-m-d")));
}

if (isset($_POST["sc_recuperado"])) {
    $id = $_POST['sc_recuperado'];
    $sql = "DELETE FROM seguimiento_cambios WHERE id = $id";
    odbc_exec($conexion, $sql);
}

/**
 * Actualiza cada campo segun cambie del original (Extraido de la DB).
 */
if (isset($_POST['is_submitted'])) {
    $id_ruta = $_POST['is_submitted'];  //ID de ruta
    $fotoUrl = "http://promdf.mine.nu/jtib/fotopersonal/";
    $oldFileToDelete = basename($_POST['foto']);

    $usuario = getUsuario($conexion, "WHERE Id_ruta = $id_ruta")[0];

    $sql_foto_update = "";
    if ($_FILES['img']['name'] != '') {
        unlink("../fotopersonal/$oldFileToDelete");
        $rand = rand(1, 1000);
        $fileName = $id_ruta . "_" . $rand . ".png";
        move_uploaded_file($_FILES['img']['tmp_name'], "../fotopersonal/$fileName");
        $foto = $fotoUrl . $fileName;
        $sql_foto_update = "foto = '$foto',";
        $sql = "UPDATE usuario SET foto = '$foto' WHERE Id_ruta = '$id_ruta'";
        odbc_exec($conexion, $sql);
    }

    //Nombre
    $nombre_promotor = $_POST['nombre_promotor'];
    if ($nombre_promotor != $usuario["us_nombre_real"]) {
        $sql = "UPDATE usuario SET us_nombre_real = '" . utf8_decode($nombre_promotor) . "' WHERE Id_ruta = '$id_ruta'";
        odbc_exec($conexion, $sql);
    }

    //Ciudad
    $ciudad = $_POST['ciudad'];
    if ($nombre_promotor != $usuario["us_apellidos"]) {
        $sql = "UPDATE usuario SET us_apellidos = '" . utf8_decode($ciudad) . "' WHERE Id_ruta = '$id_ruta'";
        odbc_exec($conexion, $sql);
    }

    //Fecha Alta
    //TODO: Modificar fecha_alta en base a nueva tabla.

    //Smartphone
    $smartphone = $_POST['smartphone'];
    if ($smartphone != $usuario["smartphone"]) {
        $sql = "UPDATE usuario SET smartphone = '$smartphone' WHERE Id_ruta = '$id_ruta'";
        odbc_exec($conexion, $sql);
    }

    //IMEI
    $imei = $_POST['imei'];
    if ($imei != $usuario["ruta"]) {
        $sql = "UPDATE usuario SET ruta = '$imei' WHERE Id_ruta = '$id_ruta'";
        odbc_exec($conexion, $sql);
    }

    //telefono
    $telefono = $_POST['telefono'];
    if ($telefono != $usuario["us_telefono"]) {
        $sql = "UPDATE usuario SET us_telefono = '$telefono' WHERE Id_ruta = '$id_ruta'";
        odbc_exec($conexion, $sql);
    }

    //Canal
    $canal = $_POST['canal'];
    if ($canal != $usuario["canal"]) {
        $sql = "UPDATE usuario SET canal = $canal WHERE Id_ruta = '$id_ruta'";
        odbc_exec($conexion, $sql);
        enviar_cambio($conexion, $usuario, 6, $canal);
    }

    //Puesto
    $puesto = $_POST['puesto'];
    if ($puesto != $usuario["puesto"]) {
        $sql = "UPDATE usuario SET puesto = $puesto WHERE Id_ruta = '$id_ruta'";
        odbc_exec($conexion, $sql);
        //enviar_cambio($conexion, $usuario, 6, $canal);
    }

    //Laptop
    $laptop = $_POST['laptop'];
    if ($laptop != $usuario["Laptop"]) {
        $sql = "UPDATE usuario SET Laptop = '$laptop' WHERE Id_ruta = '$id_ruta'";
        odbc_exec($conexion, $sql);
        if ($laptop == 'Si') {
            $laptop = 1;
        } else {
            $laptop = 0;
        }
        enviar_cambio($conexion, $usuario, 4, $laptop);
    }

    //Modelo Laptop
    $laptop_model = $_POST['laptop_model'];
    if ($laptop_model != $usuario["Modelo"]) {
        $sql = "UPDATE usuario SET Modelo = '$laptop_model' WHERE Id_ruta = '$id_ruta'";
        odbc_exec($conexion, $sql);
    }

    //Comentario
    $comentario = $_POST['comenta'];
    if ($comentario != $usuario["Comenta"]) {
        $sql = "UPDATE usuario SET Comenta = '$comentario' WHERE Id_ruta = '$id_ruta'";
        odbc_exec($conexion, $sql);
    }

    //Cuenta con SmartPhone (Si,no)
    $cuenta_smart = $_POST['cuenta_smart'];
    if ($cuenta_smart != $usuario["cuenta_smart"]) {
        $sql = "UPDATE usuario SET cuenta_smart = '$cuenta_smart' WHERE Id_ruta = '$id_ruta'";
        odbc_exec($conexion, $sql);
        if ($cuenta_smart == 'Si') {
            $cuenta_smart = 1;
        } else {
            $cuenta_smart = 0;
        }
        enviar_cambio($conexion, $usuario, 5, $cuenta_smart);
    }

    $date = $_POST['date'];
    if ($date != $usuario["fechaalta"]) {
        $sql = "UPDATE usuario SET fechaalta = '$date' WHERE Id_ruta = '$id_ruta'";
        odbc_exec($conexion, $sql);
    }

    //Estado del SmartPhone
    $nomeclatura = $usuario['us_nombre'];
    $estado_smart = $_POST['estado_smart'];
    $fecha_estado = date('Y-m-d', strtotime(date("Y-m-d")));
    if ($estado_smart == 3) {
        $sql = "INSERT INTO seguimiento_cambios(Id_usuario,nombre,nomeclatura,tipo,fecha,comentario)
                VALUES('$id_ruta','$nombre_promotor','$nomeclatura','3','$fecha_estado','$comentario')";
        odbc_exec($conexion, $sql);
    }

    //Gafete
    $gafete = $_POST['gafete'];
    if ($gafete != $usuario["gafete"]) {
        $sql = "UPDATE usuario SET gafete = '$gafete' WHERE Id_ruta = '$id_ruta'";
        odbc_exec($conexion, $sql);
    }

    //Fecha_entrega (gafete)
    $gafete_fecha = $_POST['fecha_entrega'];
    if ($gafete_fecha != $usuario["fecha_entrega"]) {
		if ($gafete_fecha = "1969-12-31"){
			
		}else
		{
        $sql = "UPDATE usuario SET fecha_entrega = '$gafete_fecha ' WHERE Id_ruta = '$id_ruta'";
		}
        odbc_exec($conexion, $sql);
    }

    $nomeclatura = $_POST['nomeclatura'];
    //SEGUIMIENTO DE CAMBIOS
    if (isset($_POST['radioBajaAlta']) && $_POST['is_changed'] == 1) {
        $scid = $_POST['id_seguimiento'];
        $state = $_POST['radioBajaAlta'];
        $fecha = $_POST['fecha_altaBaja'];
        $comentario = $_POST['comentario_change'];
        $seguimiento = getSeguimiento($conexion, "WHERE id = $scid");
        if ($scid == "") {//INSERT
            $sql = "
INSERT INTO seguimiento_cambios(Id_usuario,nombre,nomeclatura,tipo,fecha,comentario)
VALUES ('$id_ruta','$nombre_promotor','$nomeclatura','$state','$fecha','$comentario')";
            odbc_exec($conexion, $sql);
        } else {
            if ($seguimiento["tipo"] != $state) {//INSERT
                $sql = "
INSERT INTO seguimiento_cambios(Id_usuario,nombre,nomeclatura,tipo,fecha,comentario)
VALUES ('$id_ruta','$nombre_promotor','$nomeclatura','$state','$fecha','$comentario')";
                odbc_exec($conexion, $sql);
            } else {//UPDATE
                if ($fecha != $seguimiento['fecha']) {
                    $sql = "UPDATE seguimiento_cambios SET fecha = '$fecha' WHERE id = '$scid'";
                    odbc_exec($conexion, $sql);
                }

                if ($comentario != $seguimiento['comentario']) {
                    $sql = "UPDATE seguimiento_cambios SET comentario = '$comentario' WHERE id = '$scid'";
                    odbc_exec($conexion, $sql);
                }
            }
        }
    }
}
?>

<form action=<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?> method="post">
    <table>
        <tr>
            <td width="10px"></td>
            <td style='width: 40px;'>Inicio:</td>
            <td style='width: 95px;'>
                <input class="form-control" id="fecha_ini" type="date" style="font-size: 13px;" name="fecha_ini"
                       step="1"
                       value="<?php echo $fecha_inicio; ?>">
            </td>
            <td style='width: 40px;'>&nbsp;&nbsp;Fin:</td>
            <td style='width: 95px;'>
                <input class="form-control" id="fecha_fin" type="date" style="font-size: 13px;" name="fecha_fin"
                       step="1"
                       value="<?php echo $fecha_final; ?>">
            </td>
            <td style='width: 85px;'>
                &nbsp;&nbsp;<input type="submit" class="btn btn-warning bt-sm" value="Buscar">
            </td>
            <td><input type="button" class="btn btn-warning bt-sm" value="Exportar incentivos"
                       onclick="exportar_incentivos()"></td>
            <td>
                <!--input type="button" class="btn btn-outline-success center" id="addUserButton" value="Añadir usuario"/-->
            </td>
        </tr>
    </table>
</form>

<div class="container center w-25" id="container-crear-usuario" style="display: none">
    <div class="row">
        <div class="col-md-12">
            <form>
                <input id="input-nombre-completo" type="text" placeholder="Nombre completo" class="form-control">
            </form>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <label for="select-estado" class="col-form-label">Estado </label>
            <select class="custom-select" id="select-estado">

            </select>
        </div>
        <div class="col-md-6">
            <label for="select-ciudad" class="col-form-label">Ciudad </label>
            <select class="custom-select" id="select-ciudad">
            </select>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <label for="select-region" class="col-form-label">Region</label>
            <select class="custom-select" id="select-region">

            </select>
        </div>
        <div class="col-md-6">
            <label for="date-fechaalta" class="col-form-label">Fecha alta</label>
            <input class="form-control" type="date" id="date-fechaalta">
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <label for="select-canal" class="col-form-label">Canal</label>
            <select class="custom-select" id="select-canal">
            </select>
        </div>
        <div class="col-md-6">
            <label for="select-puesto" class="col-form-label">Puesto</label>
            <select class="custom-select" id="select-puesto">

            </select>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-md-6">
            <input type="button" id="button-cancel-newuser" class="btn btn-outline-danger" value="Descartar"/>
        </div>
        <div class="col-md-6">
            <input type="button" id="button-guardar-newuser" class="btn btn-outline-success" value="Guardar"/>
        </div>
    </div>
</div>

<div id="snackbar">
</div>

<br>
<br>
<table class="table table-responsive table-striped">
    <tr class="fit">
        <th class="fit col-md-3">Canal</th>
        <th class="fit col-md-4">Puesto</th>
        <th class="fit col-md-1">Activos</th>
        <th class="fit col-md-1">Vacantes</th>
        <th class="fit col-md-1">Autorizados</th>
        <th class="fit col-md-1">Equipos</th>
        <th class="fit col-md-1">Laptops</th>
    </tr>
    <?php
    $sql = "
    with total as(
    	select us.canal, us.puesto, count(*) as [Rutas]
    	from usuario us
    	where us.us_nombre_real NOT LIKE '%VACANTE%' and us.dni != 'P0'
    	group by us.canal, us.puesto),
    smartphone as (
    	select us.canal, us.puesto, count(*) as [Smartphone]
    	from usuario us
    	where us.cuenta_smart LIKE '%Si%' and us.dni != 'P0'
    	group by us.canal, us.puesto),
    laptop as (
    	select us.canal, us.puesto, count(*) as [Laptops]
    	from usuario us
    	where us.Laptop LIKE '%Si%' and us.us_nombre_real NOT LIKE '%VACANTE%' and us.dni != 'P0'
    	group by us.canal, us.puesto),
    pruebaRutas as (SELECT count(*) as [Rutas] FROM usuario us WHERE us.dni = 'P0'),
    pruebaEquipos as (SELECT count(*) as [Equipos] FROM usuario us WHERE us.dni = 'P0' and us.cuenta_smart LIKE '%Si%'),
    pruebaLaptops as (SELECT count(*) as [Laptops] FROM usuario us WHERE us.dni = 'P0' and us.Laptop LIKE '%Si%'),
    vacantes as (
        select us.canal, us.puesto, count(*) as [Vacantes]
    	from usuario us
    	where us.us_nombre_real LIKE '%VACANTE%' and us.dni != 'P0'
    	group by us.canal, us.puesto),
    autorizados as (
        select us.canal, us.puesto, count(*) as [Autorizados]
    	from usuario us
    	WHERE us.dni != 'P0'
    	group by us.canal, us.puesto)

        select cn.[descripcion] as [Canal], pt.[descripcion] as [Puesto],
        tt.[Rutas] as [Activos], --tt.[Rutas]
    CASE WHEN vc.[Vacantes] IS NULL THEN 0 ELSE vc.[Vacantes] END as [Vacantes],
    CASE WHEN au.[Autorizados] IS NULL THEN 0 ELSE au.[Autorizados] END as [Autorizados],
     --tt.[Rutas]
    CASE WHEN sm.smartphone IS NULL THEN 0 ELSE
    sm.smartphone
    END as [Smartphone],
    CASE WHEN lp.Laptops IS NULL THEN 0 ELSE
    lp.Laptops
    END as [Laptops]
    from total tt
    left join canal cn on cn.id = tt.canal
    left join puesto pt on pt.id = tt.puesto
    left join smartphone sm on sm.canal = tt.canal and sm.puesto = tt.puesto
    left join vacantes vc on vc.canal = tt.canal and vc.puesto = tt.puesto
    left join laptop lp on lp.canal = tt.canal and lp.puesto = tt.puesto
    left join autorizados au on au.canal = tt.canal and au.puesto = tt.puesto
    UNION SELECT 'Prueba' as [canal], 'Prueba' as [Puesto], 0 as [Activos], 0 as [Vacantes], 0 as [Autorizados], (SELECT * FROM pruebaEquipos) as [Equipos], (SELECT * FROM pruebaLaptops) as [Laptops]
    order by cn.descripcion asc, pt.descripcion asc
";
    $result = odbc_exec($conexion, $sql);
    $total = array('Activos' => 0,'Vacantes' => 0, 'Autorizados' => 0, 'Smartphone' => 0, 'Laptops' => 0);
    while ($row = odbc_fetch_array($result)) {
        ?>
        <tr>
            <td><?php echo $row['Canal']?></td>
            <td><?php echo $row['Puesto']; ?></td>
            <td><?php echo $row['Activos']; $total['Activos'] += $row['Activos']?></td>
            <td><?php echo $row['Vacantes']; $total['Vacantes'] += $row['Vacantes']?></td>
            <td><?php echo $row['Autorizados']; $total['Autorizados'] += $row['Autorizados']?></td>
            <td><?php echo $row['Smartphone']; $total['Smartphone'] += $row['Smartphone']?></td>
            <td><?php echo $row['Laptops']; $total['Laptops'] += $row['Laptops']?></td>
        </tr>
        <?php
    }
    ?>
    <tr>
        <td></td>
        <td><b>Total</b></td>
        <td><b><?php echo $total['Activos'] ?></b></td>
        <td><b><?php echo $total['Vacantes'] ?></b></td>
        <td><b><?php echo $total['Autorizados'] ?></b></td>
        <td><b><?php echo $total['Smartphone'] ?></b></td>
        <td><b><?php echo $total['Laptops'] ?></b></td>
    </tr>
</table>
<br>
<br>
<?php
/**
 * Created by PhpStorm.
 * User: nztr
 * Date: 05/12/2017
 * Time: 17:16
 */
$result = dnis($_COOKIE['login'], $conexion);
$request = "";
while (odbc_fetch_row($result)) {
    $request = $request . "'" . odbc_result($result, "Ruta") . "'" . ",";
}
$request = substr($request, 0, -1);
$sql = "SELECT Id_usuario FROM usuario WHERE dni in ($request)";
$res2 = odbc_exec($conexion, $sql);

$usuarios = "";
while (odbc_fetch_row($res2)) {
    $usuarios = $usuarios . odbc_result($res2, "Id_usuario") . ",";
}

$usuarios = substr($usuarios, 0, -1);
//include "../../helpdesk/app/index.php?usuarios=$usuarios";
//<li><a href="../../helpdesk/app/kpi.php?id=' . $id_usuario . '&programa=jti" target="frame_a">Seguimiento incidencias</a></li>
//echo '<iframe src="../../helpdesk/promotores.php?usuarios=' . $usuarios . '&programa=jti" height="100%" width="100%" frameborder="0px"></iframe>'
$filterOpt = "";
if (isset($_POST['filter'])) {
    if ($_POST['id_us'] != "") {
        $id = $_POST['id_us'];
        $filterOpt = " and us.Id_usuario = $id";
    }

    if ($_POST['us_name'] != "") {
        $name = $_POST['us_name'];
        $filterOpt = " and us.us_nombre_real LIKE '%$name%'";
    }
}
$sql_nuevo = "
SELECT ROW_NUMBER() OVER (ORDER BY cast(us.Id_usuario as int) ASC) as RowNumber,
us.Id_usuario as 'Id-ruta',
us.us_nombre as 'Ruta',
us.us_apellidos as 'Ciudad',
us.us_nombre_real as 'Nombre Promotor',
canal.descripcion as 'Canal',
puesto.descripcion as 'Puesto',
us.foto as 'Foto',
sp.Nombre 'ID-Supervisor',
us2.us_nombre_real as 'Nombre Supervisor',
us.fechaalta as 'Fecha de Alta',
(SELECT COUNT(*) FROM incidencia inc WHERE inc.ruta = us.Id_usuario and inc.codigoinci = 5) as 'Faltas acumuladas',
(SELECT COUNT(*)
  FROM incidencia inc
  WHERE inc.codigoinci = 4
  and inc.fecha BETWEEN '$fecha_inicio' and '$fecha_final' and ruta = us.Id_usuario) as 'Permisos',
(SELECT COUNT(*) FROM incidencia inc WHERE inc.ruta = us.Id_usuario and inc.codigoinci = 5 and inc.fecha BETWEEN '$fecha_inicio' and '$fecha_final') as 'Faltas',
us.us_telefono,
us.ruta as 'imei',
us.Laptop as 'laptop',
us.Modelo as 'modelo',
us.Comenta as 'comenta',
us.smartphone as 'smartphone',
sc.id as 'sc.id',
--sc.Id_usuario as 'sc.id'
sc.tipo as 'sc.tipo',
sc.fecha as 'sc.fecha',
sc.comentario as 'sc.comentario',
us.cuenta_smart as 'cuenta_smart',
us.estado_smart as 'estado_smart',
us.gafete as gafete,
us.fecha_entrega as fecha_entrega,
rg.region as [region]
FROM usuario us
LEFT JOIN supervisor sp on sp.Ruta = us.dni					-- Obtiene el supervisor de cada DNI
LEFT JOIN usuario us2 on sp.Nombre = us2.us_nombre and us2.dni != 'T3'-- Obtiene el
LEFT JOIN canal canal on canal.id = us.canal
LEFT JOIN puesto puesto on puesto.id = us.puesto
LEFT JOIN regiones rg on rg.id = us.us_region
OUTER APPLY (SELECT TOP 1 * FROM seguimiento_cambios sc WHERE sc.Id_usuario = us.Id_usuario and (sc.tipo = 1 or sc.tipo = 2) ORDER BY sc.id DESC) sc
WHERE us.Id_usuario != '-1' $filterOpt
--and us.dni != 'T3'--oculta usuario de prueba.
ORDER BY us.dni ASC, us.Id_tipouser ASC,cast(us.Id_usuario as int) ASC
";
$resultado = odbc_exec($conexion, $sql_nuevo);
echo '<table class="table">
    <form action="promotores_crud.php" method="post">
    <input type="hidden" name="filter">
    <tr>
        <td><input type="submit" value="Aplicar">Filtro</td>
        <td><input type="number" name="id_us" placeholder="ID-Usuario" style="width: 120px"></td>
        <td></td>
        <td></td>
        <td><input type="text" name="us_name" placeholder="Nombre" ></td>
    </tr>
    </form>
    <tr>
        <th>Id-ruta</th>
        <th>Ruta</th>
        <th>Ciudad</th>
        <th>Nombre promotor</th>
        <th>Canal</th>
        <th>Puesto</th>
        <th>Foto</th>
        <th>ID-Supervisor</th>
        <th>Nombre Jefe Directo</th>
        <th>Fecha alta</th>
        <th>Region</th>
        <th>Cuenta con SmartPhone</th>
        <th>SmartPhone</th>
        <th>Estado del SmartPhone</th>
        <th>IMEI</th>
        <th>Numero telefono</th>
        <th>Laptop</th>
        <th>Modelo</th>
        <th>Comentarios</th>
        <th>Gafete</th>
        <th>Fecha de entrega</th>
        <th>Cambio</th>
    </tr>';
while (odbc_fetch_row($resultado)) {
    $Id_ruta = odbc_result($resultado, "Id-ruta");
    $usuario = odbc_result($resultado, "Id-ruta");
    $nomeclatura = odbc_result($resultado, "Ruta");
    $ciudad = utf8_encode(odbc_result($resultado, "Ciudad"));
    $canal = odbc_result($resultado, "Canal");

    $canal_select_control = "";
    //$canales = array("", "Tradicional", "Moderno", "Mixto", "Mayoreo");
    //$values_canal = array(0, 1, 2, 3, 4);
    foreach ($canales as $key => $value) {
        if ($value['canal'] == $canal) {
            $canal_select_control = $canal_select_control . "<option selected value=".$value['id'].">".$value['canal']."</option>\n";
        } else {
            $canal_select_control = $canal_select_control . "<option value=".$value['id'].">".$value['canal']."</option>\n";
        }
    }

    $puesto = odbc_result($resultado, "Puesto");
    $puesto_select_control = "";
    $puestos = array("", "Supervisor", "Merchandieser", "Asesor de Ventas", "Representante de Ventas", "Demostradora", "Vendedor Sombra");
    $values_puesto = array(0, 1, 2, 3, 4, 5, 6);
    foreach ($puestos as $key => $value) {
        if ($value == $puesto) {
            $puesto_select_control = $puesto_select_control . "<option selected value='$values_puesto[$key]'>$value</option>\n";
        } else {
            $puesto_select_control = $puesto_select_control . "<option value='$values_puesto[$key]'>$value</option>\n";
        }
    }


    $nombre = utf8_encode(odbc_result($resultado, "Nombre Promotor"));
    $nombre_sup = utf8_encode(odbc_result($resultado, "Nombre Supervisor"));
    $fecha_alta = odbc_result($resultado, "Fecha de alta");
    $fecha_alta = date('Y-m-d', strtotime($fecha_alta));
    $telefono = odbc_result($resultado, "us_telefono");
    $imei = odbc_result($resultado, "imei");
    $selected_laptop = odbc_result($resultado, "laptop");
    $options_laptop = "";
    $attay_options = array("", "Si", "No");
    foreach ($attay_options as $key => $value) {
        if ($value == $selected_laptop) {
            $options_laptop = $options_laptop . "<option selected>$value</option>\n";
        } else {
            $options_laptop = $options_laptop . "<option>$value</option>\n";
        }
    }
    $laptop_model = odbc_result($resultado, "modelo");
    $avail_models = array("", "HP", "Dell", "Lenovo");
    $select_models = "";
    foreach ($avail_models as $key => $value) {
        if ($value == $laptop_model) {
            $select_models = $select_models . "<option selected>$value</option>\n";
        } else {
            $select_models = $select_models . "<option>$value</option>\n";
        }
    }
    $comentario_usu = odbc_result($resultado, "comenta");
    $smartphone = odbc_result($resultado, "smartphone");

    $scid = odbc_result($resultado, "sc.id");
    $checked_alta = "";
    $checked_baja = "";
    //1 = ALTA, 2 = BAJA
    if (odbc_result($resultado, "sc.tipo") == 1) {
        $checked_alta = "checked";
    } else if (odbc_result($resultado, "sc.tipo") == 2) {
        $checked_baja = "checked";
    }
    $date = date("Y-m-d", time());
    if (odbc_result($resultado, "sc.fecha") != "") {
        $date = odbc_result($resultado, "sc.fecha");
    }
    $comentario = odbc_result($resultado, "sc.comentario");

    $change_div = '
<div id="change_div_' . $Id_ruta . '" style="visibility: hidden">
    <input type="hidden" name="is_changed" value="0">
    <input type="hidden" name="id_seguimiento" value="' . $scid . '">
    <input type="radio" name="radioBajaAlta" value="1" ' . $checked_alta . '>Alta
    <br>
    <input type="radio" name="radioBajaAlta" value="2" ' . $checked_baja . '>Baja
    <br>
    <input type="date" name="fecha_altaBaja" value="' . $date . '">
    <br>
    <input type="text" name="comentario_change" placeholder="Comentario" value="' . $comentario . '">
</div>';

    $cuenta_smart = odbc_result($resultado, "cuenta_smart");
    $cuenta_smart_options = "";
    foreach ($attay_options as $key => $value) {
        if ($value == $cuenta_smart) {
            $cuenta_smart_options = $cuenta_smart_options . "<option selected>$value</option>\n";
        } else {
            $cuenta_smart_options = $cuenta_smart_options . "<option>$value</option>\n";
        }
    }

    $estado_smart = odbc_result($resultado, "estado_smart");
    $estado_smart_options = "";
    $estado_smart_selections = array("", "Recuperado", "Pendiente de Recuperacion");
    foreach ($estado_smart_selections as $key => $value) {
        if ($value == $estado_smart) {
            $estado_smart_options = $estado_smart_options . "<option selected>$value</option>\n";
        } else {
            $estado_smart_options = $estado_smart_options . "<option>$value</option>\n";
        }
    }

    $selected_gafete = odbc_result($resultado, "gafete");
    $options_gafete = "";
    $posible_gafete_values = array("", "Si", "No");
    foreach ($posible_gafete_values as $key => $value) {
        if ($value == $selected_gafete) {
            $options_gafete = $options_gafete . "<option selected>$value</option>\n";
        } else {
            $options_gafete = $options_gafete . "<option>$value</option>\n";
        }
    }

    $fecha_entrega = odbc_result($resultado, "fecha_entrega");
   // $fecha_entrega = date('Y-m-d', strtotime($fecha_entrega));

    echo '<form action="promotores_crud.php" method="post" enctype="multipart/form-data">';
    echo '<input type="hidden" value="' . $Id_ruta . '" name="is_submitted">';
    echo '<input type="hidden" value="' . $nomeclatura . '" name="nomeclatura">';
    echo '<input type="hidden" value="' . odbc_result($resultado, "foto") . '" name="foto">';
    echo '<tr>';
    echo "<td>$usuario</td>";
    echo "<td>$nomeclatura</td>";
    echo "<td><input type='text' value='$ciudad' name='ciudad'></td>";
    echo "<td> <input type='text' name='nombre_promotor' value='$nombre'></td>";
    echo "<td><select name='canal'>$canal_select_control</select></td>";    //Canal
    echo "<td><select name='puesto'>$puesto_select_control</select></td>";    //Puesto
    echo '<td> <img src="' . odbc_result($resultado, "foto") . '" alt="" height=100 width=100/><br> <input type="file" name="img"></td>';
    echo '<td>' . odbc_result($resultado, "ID-Supervisor") . '</td>';
    echo "<td>$nombre_sup</td>";

    //echo '<td>' . odbc_result($resultado, "Fecha de alta") . '</td>';
    echo "<td><input type='date' name='date' value=$fecha_alta></td>";
    echo "<td>".odbc_result($resultado, "region")."</td>";
    echo "<td><select name='cuenta_smart'>$cuenta_smart_options</select></td>";        //Cuenta con smartphone?
    echo "<td><input type='text' name='smartphone' value='$smartphone' placeholder='Modelo'></td>"; //Smartphone (Modelo)
    echo "<td><select name='estado_smart'><option></option><option value='3'>Pendiente de recuperación</option></select></td>";   //Estado del smartphone.
    echo "<td><input type='text' name='imei' value='$imei' placeholder='IMEI'></td>";
    echo "<td><input type='text' name='telefono' value='$telefono' placeholder='Telefono'></td>";
    echo "<td><select name='laptop'>$options_laptop</select>";
    echo "<td><select name='laptop_model'>$select_models</select>";
    echo "<td><input name='comenta' value='$comentario_usu' placeholder='Comentario'></td>";   //comentarios
    echo "<td><select name='gafete'>$options_gafete</select>";//Gafete
    echo "<td><input type='date' name='fecha_entrega' value=$fecha_entrega></td>";//Fecha de entrega.
    //echo '<td>' . odbc_result($resultado, "Faltas acumuladas") . '</td>';
    //echo '<td>' . odbc_result($resultado, "Permisos") . '</td>';
    //echo '<td>' . odbc_result($resultado, "Faltas") . '</td>';
    echo "<td><input type='checkbox' name='cambio' onchange='change(this.form)'/><br>$change_div</td>";
    echo '<td> <input type="submit" value="Actualizar"> </td>';
    echo '</tr>';
    echo '</form>';
}
echo '</table>';

$sql2 = "SELECT * FROM seguimiento_cambios WHERE tipo= 3";
$res2 = odbc_exec($conexion, $sql2);

echo "<table class='table'>
        <tr>
        <th>Usuario</th>
        <th>Nombre</th>
        <th>Nomeclatura</th>
        <th>Fecha</th>
        <th>Comentario</th>
        <th>Recuperado</th>
        </tr>
";
while ($row = odbc_fetch_array($res2)) {
    $id = $row["id"];
    $usuario = $row["Id_usuario"];
    $nombre = $row["nombre"];
    $nomeclatura = $row["nomeclatura"];
    $fecha = $row["fecha"];
    $comentario = $row["comentario"];
    echo "<form action='promotores_crud.php' method='post'>
            <input type='hidden' name='sc_recuperado' value=$id>
            <tr>
                <td>$usuario</td>
                <td>$nombre</td>
                <td>$nomeclatura</td>
                <td>$fecha</td>
                <td>$comentario</td>
                <td><input type='submit' value='Recuperado'></td>
            </tr>
          </form>
            ";
}
echo "</table>";
?>

<br>
<br>
