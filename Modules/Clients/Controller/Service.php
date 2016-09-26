<?php

class Clients_Controller_Service extends Com_Module_Controller_Json
{

    public function Save()
    {
        if ($this->isPost()) {
            $obj = $this->getPostObject();
            $cli = Clients_Model_Client::getInstance()->getByEmail($obj->Email);
//            print_r(empty($cli->CliId));
            if (empty($cli->CliId)) {
                Clients_Model_Client::getInstance()->doInsert($obj, null);

                $this->sendEmail($obj);
//                echo $this->drawImage($obj->Cupon);
                echo json_encode($this->drawImage($obj->Cupon));
//                echo 'http://localhost/amelie/cupones/cupon-zWxo1Ph8RM.jpg';
            } else
                echo json_encode(0);

        }
    }

    function drawImage($codigo)
    {
        // Create Image From Existing File
        $jpg_image = imagecreatefromjpeg(DIR_PATH . '/cupones/cupon.jpg');
        // Allocate A Color For The Text
        $white = imagecolorallocate($jpg_image, 255, 255, 255);

        $font = DIR_PATH . '/cupones/HelveticaLTStd-Bold.ttf';

        // Add some shadow to the text
        imagettftext($jpg_image, 20, 0, 370, 68, $white, $font, $codigo);
        $url = DIR_PATH . '/cupones/cupon-' .$codigo.'.jpg';
        // Send Image to Browser
        imagejpeg($jpg_image,$url ,90);

        // Clear Memory
        imagedestroy($jpg_image);
        return 'http://'.$_SERVER['HTTP_HOST'].'/amelie/cupones/cupon-'. $codigo .'.jpg';
    }

    public function sendEmail()
    {
        // Varios destinatarios
        $para = 'daniel.monroy.b@gmail.com'; // atención a la coma


// título
        $titulo = 'Recordatorio de cumpleaños para Agosto';

// mensaje
        $mensaje = '
<html>
<head>
  <title>Recordatorio de cumpleaños para Agosto</title>
</head>
<body>
  <p>¡Estos son los cumpleaños para Agosto!</p>
  <table>
    <tr>
      <th>Quien</th><th>Día</th><th>Mes</th><th>Año</th>
    </tr>
    <tr>
      <td>Joe</td><td>3</td><td>Agosto</td><td>1970</td>
    </tr>
    <tr>
      <td>Sally</td><td>17</td><td>Agosto</td><td>1973</td>
    </tr>
  </table>
</body>
</html>
';

// Para enviar un correo HTML, debe establecerse la cabecera Content-type
        $cabeceras = 'MIME-Version: 1.0' . "\r\n";
        $cabeceras .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

// Cabeceras adicionales
        $cabeceras .= 'To: Mary <mary@example.com>, Kelly <kelly@example.com>' . "\r\n";
        $cabeceras .= 'From: Recordatorio <cumples@example.com>' . "\r\n";
        $cabeceras .= 'Cc: birthdayarchive@example.com' . "\r\n";
        $cabeceras .= 'Bcc: birthdaycheck@example.com' . "\r\n";

// Enviarlo
        mail($para, $titulo, $mensaje, $cabeceras);

    }
}
