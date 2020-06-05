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
        document.location.href = "../reportesexcel/ejecucion_autom_layout.php?fecha=" + fecha + "&perio=" + peri + "&super=" + superv;
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