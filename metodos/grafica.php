<?php
function grafgere($arre)
{
//   

$a=$arre[0];
$b=$arre[1];
$c=$arre[2];
$id=$arre[3];
?>
	

    
    

		
		<style type="text/css">
    ${demo.css}
		</style>
		<script type="text/javascript">

        
    $(function () {
        var a=parseInt("<?php echo $a?>");
        var b=parseInt("<?php echo $b?>");
        var c=parseInt("<?php echo $c?>");
        var id=parseInt("<?php echo $id?>");
        console.log(a);
        console.log(b);
        console.log(c);
        console.log(id);
    $('#container'+id).highcharts({

        chart: {
            type: 'column'
        },
        title: {
            text: ''
        },
        xAxis: {
            categories: ['']
        },
        yAxis: {
            min: 0,
            title: {
                text: ''
            }
        },
        tooltip: {
            pointFormat: '<span style="color:{series.color}">{series.name}</span>: <b>{point.y}</b> ({point.percentage:.0f}%)<br/>',
            shared: true
        },
        plotOptions: {
            column: {
                stacking: 'percent'
            }
        },
        series: [{
            name: 'V.F.ruta',
            data: [b]
        }, {
            name: 'Visitas',
            data: [a]
        }, {
            name: 'Faltantes',
            data: [c]
        }]
    });
});
		</script>
	<body>
<!--<script src="../graficas/js/highcharts.js"></script>-->



<?php
}
 
?>