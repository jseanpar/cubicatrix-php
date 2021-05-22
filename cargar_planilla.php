<?php
include('libs.php');
include('cargar_datos/dbconect.php');
require_once('cargar_datos/vendor/php-excel-reader/excel_reader2.php');
require_once('cargar_datos/vendor/SpreadsheetReader.php');

if (isset($_POST["import"]))
{

   echo $_POST["camion"];
    
$allowedFileType = ['application/vnd.ms-excel','text/xls','text/xlsx','application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'];
  
  if(in_array($_FILES["file"]["type"],$allowedFileType)){

        $targetPath = 'cargar_datos/subidas/'.$_FILES['file']['name'];
        move_uploaded_file($_FILES['file']['tmp_name'], $targetPath);
        
        $Reader = new SpreadsheetReader($targetPath);
        
        $sheetCount = count($Reader->sheets());
        for($i=0;$i<$sheetCount;$i++)
        {
            
            $Reader->ChangeSheet($i);
            
            foreach ($Reader as $Row)
            {
          
                $nombres = "";
                if(isset($Row[0])) {
                    $nombres = mysqli_real_escape_string($con,$Row[0]);
                }
                
                $cargo = "";
                if(isset($Row[1])) {
                    $cargo = mysqli_real_escape_string($con,$Row[1]);
                }
				
                $celular = "";
                if(isset($Row[2])) {
                    $celular = mysqli_real_escape_string($con,$Row[2]);
                }
				
                $descripcion = "";
                if(isset($Row[3])) {
                    $descripcion = mysqli_real_escape_string($con,$Row[3]);
                }
                
                if (!empty($nombres) || !empty($cargo) || !empty($celular) || !empty($descripcion)) {
                    $query = "insert into tbl_productos(nombres,cargo, celular, descripcion) values('".$nombres."','".$cargo."','".$celular."','".$descripcion."')";
                    $resultados = mysqli_query($con, $query);
                
                    if (! empty($resultados)) {
                        $type = "success";
                        $message = "Excel importado correctamente";
                    } else {
                        $type = "error";
                        $message = "Hubo un problema al importar registros";
                    }
                }
             }
        
         }
  }
  else
  { 
        $type = "error";
        $message = "El archivo enviado es invalido. Por favor vuelva a intentarlo";
  }
}
?>
<!doctype html>
<html lang="es">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="description" content="">
<meta name="author" content="">
<link rel="icon" href="favicon.ico">
<title>Importar archivo de Excel para cubicar</title>

<!-- Bootstrap core CSS -->
<link href="cargar_datos/dist/css/bootstrap.min.css" rel="stylesheet">
<!-- Custom styles for this template -->
<link href="cargar_datos/assets/sticky-footer-navbar.css" rel="stylesheet">
<link href="cargar_datos/assets/style.css" rel="stylesheet">

</head>

<body>

<!-- Begin page content -->

<div class="container">
  <h3 class="mt-2">Importar archivo de Excel para cubicar</h3>
  <hr>
  <div class="row">
    <div class="col-12 col-md-12"> 
      <!-- Contenido -->
    
    <div class="outer-container">
        <form action="" method="post"
            name="frmExcelImport" id="frmExcelImport" enctype="multipart/form-data">
            <div class="input-group">
                <span class="radio">
                <label>
                    <input type="radio" class="radiobox" name="camion" value="1" checked>
                    <span> Camion de Seco</span> 
                </label>
                <label>
                    <input type="radio" class="radiobox" name="camion" value="2">
                    <span> Camion de Frio</span> 
                </label>
                </span>
            </div>
            <div>
                <label>Elija Archivo Excel</label> <input type="file" name="file"
                    id="file" accept=".xls,.xlsx">
                <button type="submit" id="submit" name="import"
                    class="btn-submit">Importar Registros</button>
        
            </div>
        
        </form>
        
    </div>
    <div id="response" class="<?php if(!empty($type)) { echo $type . " display-block"; } ?>"><?php if(!empty($message)) { echo $message; } ?></div>
    
         
<?php
    $sqlSelect = "SELECT * FROM tbl_productos";
    $result = mysqli_query($con, $sqlSelect);

if (mysqli_num_rows($result) > 0)
{
?>
        
    <table class='tutorial-table'>
        <thead>
            <tr>
                <th>Nombres</th>
                <th>Cargo</th>
                <th>Celular</th>
                <th>Descripcion</th>
                <th>Fecha</th>
            </tr>
        </thead>
<?php
    while ($row = mysqli_fetch_array($result)) {
?>                  
        <tbody>
        <tr>
            <td><?php  echo $row['nombres']; ?></td>
            <td><?php  echo $row['cargo']; ?></td>
            <td><?php  echo $row['celular']; ?></td>
            <td><?php  echo $row['descripcion']; ?></td>
            <td><?php  echo $row['fecha']; ?></td>
        </tr>
<?php
    }
?>
        </tbody>
    </table>
<?php 
} 
?>
      <!-- Fin Contenido --> 
    </div>
  </div>
  <!-- Fin row --> 

  
</div>
<!-- Fin container -->
<footer class="footer">
  <div class="container"> <span class="text-muted">
    <p> Cubicacion de archivos</p>
    </span> </div>
</footer>
<script src="cargar_datos/assets/jquery-1.12.4-jquery.min.js"></script> 

<!-- Bootstrap core JavaScript
    ================================================== --> 
<!-- Placed at the end of the document so the pages load faster --> 

<script src="cargar_datos/dist/js/bootstrap.min.js"></script>
</body>
</html>