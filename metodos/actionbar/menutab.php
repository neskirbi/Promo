<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!--Incluir librerias en donde se use el menu con la ruta
    <link rel="stylesheet" type="text/css" href="../metodos/actionbar/css/bootstrap.css">    
    <script src="../metodos/actionbar/js/bootstrap.js"></script>
-->
    <title>Document</title>
</head>
<body onload="openCity(event, <?php echo "'".$muestra."'"; ?>)">

<?php
  if($muestra == 'a2')
  {
?>
<ul class="tab">

      
      
      <li ><a  href="#" class="tablinks" onclick="openCity(event, 'a2'),oculta(2)"><?php echo $menu2; ?></a></li>
      
      <li style="border-left: 1px #ccc solid;"><a  href="#" class="tablinks" onclick="openCity(event, 'a3'),oculta(3)"><?php echo $menu3; ?></a></li>
</ul>
<?php
  }

  if($muestra == 'a2')
  {
?>
    <div id="a1" class="tabcontent">
      <iframe name="framea" frameborder="0" src="<?php echo $pag1; ?>" style="width: 100%; height: 87%; left: 0px;  margin: 0px 0px 0px 0px; position: absolute; "></iframe>
    </div>

    <div id="a2" class="tabcontent">
      <iframe frameborder="0" src="<?php echo $pag2; ?>" style="width: 100%; height: 87%; left: 0px;  margin: 0px 0px 0px 0px; position: absolute; "></iframe> 
    </div>

    <div id="a3" class="tabcontent">
      <iframe name="frameb" frameborder="0" src="<?php echo $pag3; ?>" style="width: 100%; height: 87%; left: 0px;  margin: 0px 0px 0px 0px; position: absolute; "></iframe>
    </div>
<?php
  }
  else if($muestra == 'a1')
  {
?>
  <ul class="tab" style="width: 100%;">
    <li class='mitad'><a href="#" class="tablinks selecionar" onclick="openCity(event, 'a2'),oculta(1)"><?php echo $menu1; ?></a></li>
    
    <li class='mitad'><a style="border-left: 1px #ccc solid;" href="#" class="tablinks selecionar" onclick="openCity(event, 'a1'),oculta(2)"><?php echo $menu2; ?></a></li>
  </ul>

  <div id="a2" class="tabcontent">
    <iframe onload="oculta(1)" name="framea" frameborder="0" src="<?php echo $pag1; ?>" style="width: 100%; height: 87%; left: 0px;  margin: 0px 0px 0px 0px; position: absolute; "></iframe>
  </div>

  <div id="a1" class="tabcontent">
    <iframe frameborder="0" src="<?php echo $pag2."?usu=Raul Miranda"; ?>" style="width: 100%; height: 87%; left: 0px;  margin: 0px 0px 0px 0px; position: absolute; "></iframe> 
  </div>

<?php
  }
  else if($muestra == 'a3')
  {
?>

  <ul class="tab" style="width: 100%;" > 
    <li class='mitad'><a href="#" class="tablinks selecionar" onclick="openCity(event, 'a2'),oculta(3)"><?php echo $menu3; ?></a></li>
    <li class='mitad'><a style="border-left: 1px #ccc solid;" href="#" class="tablinks selecionar" onclick="openCity(event, 'a3'),oculta(2)"><?php echo $menu2; ?></a></li>
  </ul>

  <div id="a2" class="tabcontent">
    <iframe onload="oculta(3)" name="frameb" frameborder="0" src="<?php echo $pag3; ?>" style="width: 100%; height: 87%; left: 0px;  margin: 0px 0px 0px 0px; position: absolute; "></iframe>
  </div>

  <div id="a3" class="tabcontent">
    <iframe frameborder="0" src="<?php echo $pag2."?usu=Alejandro Jactthar"; ?>" style="width: 100%; height: 87%; left: 0px;  margin: 0px 0px 0px 0px; position: absolute; "></iframe> 
  </div>
<?php
  }
?>
</body>
</html>


