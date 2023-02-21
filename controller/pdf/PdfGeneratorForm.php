<?php
session_start();
require_once '../../models/database/database.php';
require_once '../../main.php';
if(! isset($_SESSION['user_id'])){
    http_response_code(404);
    //header('Location: ../views/');
}else{
    $data=array(
    'Titulo'=>$_POST['TituloForm'],
    'Nombre'=>$_POST['UserName'],
    'Direccion'=>$_POST['UserLocationDir'],
    'FechaNacimiento'=>$_POST['UserDateBorn'],
    'Telefono'=>$_POST['UserPhone'],
    'Correo'=>$_POST['UserEmail'],
    /*
    'Genero'=>$_POST['nameUser'],
    'RH'=>$_POST['nameUser'],
    'TipoAfiliacion'=>$_POST['nameUser'],
    'Subsidio'=>$_POST['nameUser'],
    'Departamento'=>$_POST['nameUser'],
    'Tipo_de_sangre'=>$_POST['nameUser'],
    'Estrato'=>$_POST['nameUser'],
    'EsAlergico'=>$_POST['nameUser'],*/
);}
?><?php
ob_start();
    $imgLogo= "http://".$_SERVER['HTTP_HOST']."/secodeqr/secode/views/assets/img/nosotros.jpg ";
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php //include('../views/templates/header.php')?>
    <title>Formulario</title>
</head>
<body>

<!-- <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Nunito:wght@500&display=swap" rel="stylesheet"> -->

<div style="max-width: 700px; margin:0 auto; ">
    <h2 style="padding: 10px; border-left: 10px solid rgb(255, 95, 95); background:rgb(222, 221, 228); font-family: Verdana, Geneva, Tahoma, sans-serif;

    font-family: 'Nunito', sans-serif;">
        Datos Documento Clinico
        <img src="https://programacion3luis.000webhostapp.com/secode/views/assets/img/logo.png" alt="logo secodeqr" style="
        width: 30px;height: 30px; object-fit: cover;float: right;">
    </h2>

    </div>
    <center>
    <hr width="15%" style="background:rgb(74, 69, 92); height: 5px; border-radius: 5px; ">
    </center>
    <div>
        <h2 style="text-align: center;">Datos:</h2>

<?php foreach($data as $key => $value){  ?>

    <p style="padding:5px;background:#d0d3ec; color:black">
            <spam style="color:#5d2aaf;font-weight: bold;"> <?php echo $key ?> </spam>
            <?php echo $value ?>
        </p>


   <?php  }?>

    </div>


</div>
   

<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Perferendis iste consequuntur at accusantium. Labore dolores omnis architecto totam aliquam aut dignissimos autem. Mollitia iste animi totam perferendis culpa error nihil.</p>

<?php //include('../views/templates/footerWebUser.php') ?>
</body>
</html>
<?php
$html_doc=ob_get_clean();
require_once '../../main.php';
require_once BaseDir.'/vendor/autoload.php';
// reference the Dompdf namespace
use Dompdf\Dompdf;
// instantiate and use the dompdf class

$dompdf = new Dompdf();
$dompdf->loadHtml($html_doc);

$options=$dompdf->getOptions();;
$options->set(array('isRemoteEnabled'=>true));
$dompdf->setOptions($options);

//$dompdf->setPaper('A4', 'landscape');
$dompdf->setPaper('A4');

// Render the HTML as PDF
$doc=$dompdf->render();

$output = $dompdf->output();

//generate random string
$rand_token = openssl_random_pseudo_bytes(16);
//change binary to hexadecimal
$token = bin2hex($rand_token);

//name pdf doc
$name=$token.'.pdf';
$file=file_put_contents($name, $output);

$des='../../views/pdf/'.$name;
//echo $file;
$source = './'.$name;

 if(rename($source,$des) ){
     $Moved = true;
     $urlCodeForm='http://'.$_SERVER['HTTP_HOST'].'/secodeqr/views/pdf/'.$name;
     $atribDefault='&centerImageUrl=https://programacion3luis.000webhostapp.com/secode/views/assets/img/logo.png&size=300&ecLevel=H&centerImageWidth=120&centerImageHeight=120';

     $duration=date("Y-m-d");

     $consult='INSERT INTO codigo_qr 
     (`Id_codigo`,`nombre`, `Duracion`, `Ndocumento`, `Titulo`, `RutaArchivo`, `Atributos`) 
     VALUES (null ,:nombre, :Duracion, :Ndoc, :Titulo, :Ruta, :AtribDefault) ';
    
    $params= $connection->prepare($consult);
    $params->bindParam(':Ndoc',$_SESSION['user_id']);
    $params->bindParam(':Duracion',$duration);
    $params->bindParam(':nombre',$name);
    $params->bindParam(':Titulo', $data['Titulo']);
    $params->bindParam(':Ruta',$urlCodeForm);
    $params->bindParam(':AtribDefault',$atribDefault);
    if ($params->execute()) {
        $p=$connection->prepare('SELECT Id_codigo 
        FROM codigo_qr 
        WHERE Ndocumento = :Ndoc
        ORDER BY Id_codigo DESC LIMIT 1 ');
        $p->bindParam(':Ndoc',$_SESSION['user_id']);
        if ($p->execute()) {
            $idcode=$p->fetch(PDO::FETCH_ASSOC);
            $id=$idcode['Id_codigo'];
            header('Location: ../../views/clinico.php?GenerateError=22&Data='.$id);
        }else{
            echo 'no';
            header('Location: ../../views/clinico.php?GenerateError=1');
        }        
    }else{
        header('Location: ../../views/clinico.php?GenerateError=1');
    }
 }else{
    $Moved=false;
 }

?>
