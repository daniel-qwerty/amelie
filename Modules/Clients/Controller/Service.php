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
                echo json_encode($obj->Cupon);
            } else
                echo json_encode(0);

        }
    }

    public function sendEmail()
    {
        // Varios destinatarios
        $para = 'daniel.monroy.b@gmail.com'; // atención a la coma


// título
        $título = 'Recordatorio de cumpleaños para Agosto';

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
        mail($para, $título, $mensaje, $cabeceras);

    }
}
