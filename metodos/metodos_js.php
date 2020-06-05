<script src="../jquery-3.3.1.min.js" type="text/javascript"></script>
<script src="../metodos/json2csv.js" type="text/javascript"></script>
<script src="moment-with-locales.js"></script>
<script type="text/javascript">
    function actualiza(id, idobjeto) {

        entrada = document.getElementById("entrada" + idobjeto).value;
        salida = document.getElementById("salida" + idobjeto).value;
        idcli = document.getElementById("idcli" + idobjeto).value;


        window.open("../actual/actualizaact.php?entrada=" + entrada + "&salida=" + salida + "&idcli=" + idcli + "&ref=" + id, "nuevo", "directories=no, location=no, menubar=no, scrollbars=yes, statusbar=no, tittlebar=no, width=400, height=200");


    }

    var expanded = false;

    function showCheckboxes() {

        var checkboxes = document.getElementById("checkboxes");
        if (!expanded) {
            checkboxes.style.display = "block";
            expanded = true;
        } else {
            checkboxes.style.display = "none";
            expanded = false;
        }
    }

    function muestra(numero) {
        var todo = "";
        for (var i = 1; i <= numero; i++) {
            var check = document.getElementById(i).checked;
            console.log(check);
            if (check) {
                console.log(document.getElementById(i).value);
                todo = todo + document.getElementById(i).value;
            }

        }


    }


    function Nuevos(numero) {
        console.log(numero);

        var ciudad = "";

        for (var i = 1; i <= numero; i++) {
            var check = document.getElementById(i).checked;
            //console.log(check);
            if (check) {
                //todo[i]=document.getElementById(i).value;
                //console.log(document.getElementById(i).value);
                ciudad = document.getElementById(i).value + "," + ciudad;

                //todo=todo+document.getElementById(i).value;
            }

        }
        console.log(ciudad);
        var ruta = document.getElementById("ruta").value;
        var fecha = document.getElementById("fecha").value;
        //var ciudad =document.getElementById("ciudad").value;
        var fecha2 = document.getElementById("fecha2").value;
        var link = "validacion.php?ruta=" + ruta + "&letra=Nuevos&fecha=" + fecha + "&ciudad=" + ciudad + "&fecha2=" + fecha2;
        console.log(link);
        document.getElementById("frame_val").src = link;
    }

    function Modificados(numero) {
        console.log(numero);

        var ciudad = "";
        for (var i = 1; i <= numero; i++) {
            var check = document.getElementById(i).checked;
            //console.log(check);
            if (check) {
                //todo[i-1]=document.getElementById(i).value;
                ciudad = document.getElementById(i).value + "," + ciudad;
                //console.log(document.getElementById(i).value);
                //todo=todo+document.getElementById(i).value;
            }

        }
        //var ruta = todo.join(",");
        var ruta = document.getElementById("ruta").value;
        var fecha = document.getElementById("fecha").value;
        //var ciudad =document.getElementById("ciudad").value;
        var fecha2 = document.getElementById("fecha2").value;
        var link = "validacion.php?ruta=" + ruta + "&letra=Modificados&fecha=" + fecha + "&ciudad=" + ciudad + "&fecha2=" + fecha2;
        console.log(link);
        document.getElementById("frame_val").src = link;
    }

    function Todos(numero) {
        console.log(numero);

        var ciudad = "";
        for (var i = 1; i <= numero; i++) {
            var check = document.getElementById(i).checked;
            console.log(check);
            if (check) {
                //todo[i-1]=document.getElementById(i).value;
                ciudad = document.getElementById(i).value + "," + ciudad;
                //console.log(document.getElementById(i).value);
                //todo=todo+document.getElementById(i).value;
            }

        }
        //var ruta = todo.join(",");
        var ruta = document.getElementById("ruta").value;
        var fecha = document.getElementById("fecha").value;
        //var ciudad =document.getElementById("ciudad").value;
        var fecha2 = document.getElementById("fecha2").value;
        var link = "validacion.php?ruta=" + ruta + "&letra=Todo&fecha=" + fecha + "&ciudad=" + ciudad + "&fecha2=" + fecha2;
        console.log(link);
        document.getElementById("frame_val").src = link;
    }

    function exportexceldeta2() {
        //supervisor
        var superv = document.getElementById("a111").value;
        //fecha
        var fecha = document.getElementById("b222").value;
        //periodo
        var peri = document.getElementById("c333").value;
        //foto
        var foto = document.getElementById('fotosn').checked;
        var seleccionado = "";

        if (foto) {
            seleccionado = "con";

        } else {
            seleccionado = "sin";
        }

        var link = "../reportesexcel/ejecucion_autom.php?fecha=" + fecha + "&perio=" + peri
            + "&super=" + superv + "&foto=" + seleccionado;
        console.log(link);

        document.location.target = "_blank";
        document.location.href = link;
    }

    function exportexceldeta3() {
        //supervisor
        var superv = document.getElementById("a111").value;
        //fecha
        var fecha = document.getElementById("b222").value;
        //periodo
        var peri = document.getElementById("c333").value;
        //foto
        var foto = document.getElementById('fotosn').checked;
        var seleccionado = "";

        if (foto) {
            seleccionado = "con";

        } else {
            seleccionado = "sin";
        }

        var link = "../reportesexcel/reporteexceldetallepen3.php?fecha=" + fecha + "&perio=" + peri
            + "&super=" + superv + "&foto=" + seleccionado;
        console.log(link);

        document.location.target = "_blank";
        document.location.href = link;
    }

    function exportexceldeta4() {
        //supervisor
        var superv = document.getElementById("a111").value;
        //fecha
        var fecha = document.getElementById("b222").value;
        //periodo
        var peri = document.getElementById("c333").value;
        //foto
        var foto = document.getElementById('fotosn').checked;
        var seleccionado = "";

        if (foto) {
            seleccionado = "con";

        } else {
            seleccionado = "sin";
        }
        var link = "../reportesexcel/reportedinamica.php?fecha=" + fecha + "&perio=" + peri
            + "&super=" + superv + "&foto=" + seleccionado;
        console.log(link);

        document.location.target = "_blank";
        document.location.href = link;
    }

    function exportexceldeta() {
        //supervisor
        var superv = document.getElementById("a111").value;
        //fecha
        var fecha = document.getElementById("b222").value;
        //periodo
        var peri = document.getElementById("c333").value;


        document.location.target = "_blank";
        document.location.href = "../reportesexcel/reporteexceldetallepen.php?fecha=" + fecha + "&perio=" + peri + "&super=" + superv;
    }

    function exportexeceldeta_layout() {
        //supervisor
        var superv = document.getElementById("a111").value;
        //fecha
        var fecha = document.getElementById("b222").value;
        //periodo
        var peri = document.getElementById("c333").value;


        document.location.target = "_blank";
        document.location.href = "../reportesexcel/php72/ejecucion_autom_layout_fast.php?fecha=" + fecha + "&perio=" + peri + "&super=" + superv;
    }

    function addDays(date, days) {
        var result = new Date(date);
        result.setDate(result.getDate() + days);
        return result;
    }

    function ejecucion_por_dni(dni) {
        //fecha
        var fecha_inicio = document.getElementById("b222").value;
        var fecha_final = fecha_inicio;

        //periodo
        var periodo = document.getElementById("c333").value;

        if (periodo == 'Semanal') {
            fecha_final = addDays(fecha_inicio, 8);
            fecha_final = moment(fecha_final).format('YYYY-MM-DD');
        }

        var data = {
            "fecha_inicio": fecha_inicio,
            "fecha_final": fecha_final
        };

        console.log(data);

        $.ajax({
            url: 'http://localhost:3000/nodejs/ejecucion/dni/' + dni.trim(),
            type: 'POST',
            data: JSON.stringify(data),
            contentType: "application/json; charset=utf-8",
            headers: {
                Accept: "text/csv; charset=utf-8"
            },
            success: function (data) {
                data = 'data:text/csv; charset=utf-8,' + data;
                var encodedUri = encodeURI(data);
                var link = document.createElement("a");
                link.setAttribute("href", encodedUri);
                link.setAttribute("download", "Reporte ejecucion.csv");
                document.body.appendChild(link); // Required for FF
                link.click(); // This will download the data file named "my_data.csv".
            },
            error: function (request, status, error) {
                console.log(error);
            }
        });
    }


    function exportexceldetacomp() {
        //supervisor
        var superv = document.getElementById("a111").value;
        //fecha
        var fecha = document.getElementById("b222").value;
        //periodo
        //var peri=document.getElementById("c333").value;
        document.location.target = "_blank";
        document.location.href = "../reportesexcel/reporteexceldetallepencomp.php?fecha=" + fecha + "&super=" + superv;
    }

    function popup(ruta) {


        window.open("popup.php?ruta=" + ruta, "nuevo", "directories=no, location=no, menubar=no, scrollbars=yes, statusbar=no, tittlebar=no, width=460, height=580");
    }

    function exportexcelbitacora() {
        //fecha inicio
        var fecha1 = document.getElementById("b2221").value;
        //fecha fin
        var fecha2 = document.getElementById("b2222").value;
        //supervisor
        //var superv = document.getElementById("a111").value;
        var superv = "";
        //checkbox
        var ruta = document.getElementsByName('check');
        var txt = "";
        console.log(ruta);
        for (var i = 0; i < ruta.length; i++) {
            if (ruta[i].checked) {
                txt = txt + ruta[i].value + "";
                console.log(txt);
            }
        }

        if (txt != "") {
            if (txt == "rutas2") {
                var rutas = document.getElementsByName("varias_rutas");
                for (var j = 0; j < rutas.length; j++) {
                    if (rutas[j].checked) {
                        superv = superv + rutas[j].value + ":";
                        //console.log(superv);
                    }
                }
            }
            else {
                superv = document.getElementById("a111").value;
            }

            document.location.target = "_blank";
            document.location.href = "../reportesexcel/reporteexcelbitacora.php?fecha1=" + fecha1 + "&fecha2=" + fecha2 + "&super=" + superv;

        }
        else {
            alert("Selecciona una opcion");
            //console.log("Esta vacio");
        }
    }

    function exportexcelkpis() {
        //fecha inicio
        var fecha1 = document.getElementById("b2221kpis").value;
        //fecha fin
        var fecha2 = document.getElementById("b2222kpis").value;
        //supervisor
        //var superv = document.getElementById("a111").value;
        var superv = "";
        //checkbox
        var ruta = document.getElementsByName('checkkpis');
        var txt = "";
        console.log(ruta);
        for (var i = 0; i < ruta.length; i++) {
            if (ruta[i].checked) {
                txt = txt + ruta[i].value + "";
                console.log(txt);
            }
        }

        if (txt != "") {
            if (txt == "rutas2") {
                var rutas = document.getElementsByName("varias_rutaskpis");
                for (var j = 0; j < rutas.length; j++) {
                    if (rutas[j].checked) {
                        superv = superv + rutas[j].value + ":";
                        //console.log(superv);
                    }
                }
            }
            else {
                superv = document.getElementById("a111kpis").value;
            }

            document.location.target = "_blank";
            document.location.href = "../reportesexcel/reporteexcelkpis.php?fecha1=" + fecha1 + "&fecha2=" + fecha2 + "&super=" + superv;

        }
        else {
            alert("Selecciona una opcion");
            //console.log("Esta vacio");
        }
    }

    function exportexcelcorb() {
        //fecha inicio
        var fecha1 = document.getElementById("b2221corb").value;
        //fecha fin
        var fecha2 = document.getElementById("b2222corb").value;
        //supervisor
        //var superv = document.getElementById("a111").value;
        var superv = "";
        //checkbox
        var ruta = document.getElementsByName('checkcorb');
        var txt = "";
        console.log(ruta);
        for (var i = 0; i < ruta.length; i++) {
            if (ruta[i].checked) {
                txt = txt + ruta[i].value + "";
                console.log(txt);
            }
        }

        if (txt != "") {
            if (txt == "rutas2") {
                var rutas = document.getElementsByName("varias_rutascorb");
                for (var j = 0; j < rutas.length; j++) {
                    if (rutas[j].checked) {
                        superv = superv + rutas[j].value + ":";
                        //console.log(superv);
                    }
                }
            }
            else {
                superv = document.getElementById("a111corb").value;
            }

            document.location.target = "_blank";
            document.location.href = "../reportesexcel/reporteexcelcorb.php?fecha1=" + fecha1 + "&fecha2=" + fecha2 + "&super=" + superv;

        }
        else {
            alert("Selecciona una opcion");
            //console.log("Esta vacio");
        }
    }

    function exportejecucion_x_ka() {
        //fecha inicio
        var fecha1 = document.getElementById("b2221xka").value;
        //fecha fin
        var fecha2 = document.getElementById("b2222xka").value;
        //supervisor
        //var superv = document.getElementById("a111").value;
        var superv = "";

        document.location.target = "_blank";
        document.location.href = "../reportesexcel/Ejecucion_x_KA.php?fecha1=" + fecha1 + "&fecha2=" + fecha2;
    }

    function exportejecucion_x_ciudad() {
        //fecha inicio
        var fecha1 = document.getElementById("b2221xciu").value;
        //fecha fin
        var fecha2 = document.getElementById("b2222xciu").value;
        //supervisor
        //var superv = document.getElementById("a111").value;
        var superv = "";

        document.location.target = "_blank";
        document.location.href = "../reportesexcel/Ejecucion_x_ciudad.php?fecha1=" + fecha1 + "&fecha2=" + fecha2;
    }

    function exportresultadossup() {
        //fecha inicio
        var fecha1 = document.getElementById("b222i").value;
        //fecha fin
        var fecha2 = document.getElementById("b222f").value;
        //supervisor
        //var superv = document.getElementById("a111").value;
        var superv = "";

        console.log(fecha1);

        document.location.target = "_blank";
        document.location.href = "../reportesexcel/resultadossup.php?fecha1=" + fecha1 + "&fecha2=" + fecha2;
    }

    function exportresultadossupv2() {
        //fecha inicio
        var fecha1 = document.getElementById("b222i").value;
        //fecha fin
        var fecha2 = document.getElementById("b222f").value;
        //supervisor
        //var superv = document.getElementById("a111").value;
        var sd = document.getElementById("sd").value;

        console.log(fecha1);

        document.location.target = "_blank";
        document.location.href = "../reportesexcel/resultadossupv2.php?fecha1=" + fecha1 + "&fecha2=" + fecha2 + "&sd=" + sd;
    }

    function exportarnumerodeencuestas() {
        //fecha inicio
        var fecha1 = document.getElementById("b222i").value;
        //fecha fin
        var fecha2 = document.getElementById("b222f").value;
        //supervisor
        //var superv = document.getElementById("a111").value;
        var sd = document.getElementById("sd").value;

        console.log(fecha1);
        document.location.target = "_blank";
        document.location.href = "../reportesexcel/numero_encuestas.php?fecha1=" + fecha1 + "&fecha2=" + fecha2 + "&sd=" + sd;
    }

    function exportarnumerodeencuestasauditoria() {
        //fecha inicio
        var fecha1 = document.getElementById("b222i").value;
        //fecha fin
        var fecha2 = document.getElementById("b222f").value;
        //supervisor
        //var superv = document.getElementById("a111").value;
        //var sd = document.getElementById("sd").value;

        console.log(fecha1);
        document.location.target = "_blank";
        document.location.href = "../reportesexcel/reporte_numeroencuestas_supervisor.php?fecha1=" + fecha1 + "&fecha2=" + fecha2; //+ "&sd=" + sd;
    }

    function exportarauditoria() {
        //fecha inicio
        var fecha1 = document.getElementById("b222i").value;
        //fecha fin
        var fecha2 = document.getElementById("b222f").value;
        //supervisor
        //var superv = document.getElementById("a111").value;
        var sd = document.getElementById("sd").value;

        console.log(fecha1);
        document.location.target = "_blank";
        document.location.href = "../reportesexcel/reporte_auditoria.php?fecha1=" + fecha1 + "&fecha2=" + fecha2 + "&sd=" + sd;
    }

    function exportarseguimiento_ruta() {
        var fecha_inicio = document.getElementById("fecha_inicio").value;
        var fecha_final = document.getElementById("fecha_final").value;
        document.location.target = "_blank";
        document.location.href = "/jtib/reportesexcel/reporte_seguimientoruta.php?fecha_inicio=" + fecha_inicio + '&fecha_final = ' + fecha_final;
    }

    function exportarasistencia() {
        //fecha inicio
        var fecha1 = document.getElementById("b222i").value;
        //fecha fin
        var fecha2 = document.getElementById("b222f").value;
        //supervisor
        //var superv = document.getElementById("a111").value;
        var sd = document.getElementById("sd").value;

        console.log(fecha1);
        document.location.target = "_blank";
        document.location.href = "../reportesexcel/reporte_asistencia.php?fecha1=" + fecha1 + "&fecha2=" + fecha2 + "&sd=" + sd;
    }
</script>