<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Email extends CI_Controller {
		 private $permisos;
         public function __construct(){
	 	 parent::__construct();
		 $this->permisos = $this->backend_lib->control();
		 $this->load->helper(array('form', 'url'));
	 	 $this->load->library(array('session', 'form_validation', 'email'));
	 	 //$this->load->model("Email/ModeloEmail");
	 }
   function upload_file()
    {

     $config['upload_path'] = 'uploads/';
     $config['allowed_types'] = 'doc|docx|pdf';
     $this->load->library('upload', $config);
     if($this->upload->do_upload('archivo'))
     {
      return $this->upload->data();
     }
     else
     {
      return $this->upload->display_errors();
     }
    }
	public function index(){
		$data  = array(
			'permisos' => $this->permisos,
		);
		$this->load->view('layouts/header');
		$this->load->view('layouts/aside');
		$this->load->view('admin/Email/vistaEmail',$data);
		$this->load->view('layouts/footer');
	}

	public function enviarCorreo(){

    if ($this->input->post()) {

				$ine='';
				$tipoArchivo='';
				if (isset($_FILES["archivo"])) {
				if ($_FILES['archivo']['name'] != '') {
					// code...
          $arc=$_FILES['archivo'];
					$nombreArchivo = $_FILES['archivo']['name'];
					$tipoArchivo = $_FILES['archivo']['type'];
					$tamanoArchivo = $_FILES['archivo']['size'];
					$archivoSubido = fopen($_FILES['archivo']['tmp_name'], 'r+b');
          $ar=$nombreArchivo;
					$ine = fread($archivoSubido, $tamanoArchivo);
					fclose($archivoSubido);
				}
			}
				else {
					$ine='';
					$tipoArchivo='';
				}

        $config = [
          "upload_path" => "./assets/uploads/",
          'allowed_types' => "pdf"
        ];
				// Cargar libreria para poder subir imagen
        $this->load->library("upload",$config);
				$pf='';

        if ($this->upload->do_upload('archivo')) {
          // code...
	        $data = array("upload_data" => $this->upload->data());
					$pf = $data['upload_data']['file_name'];
        }


				//
        $nombre = $this->input->post('nombre');
        $direccion = $this->input->post('direccion');
        $telefono = $this->input->post('telefono');
        $sexo = $this->input->post('sexo');
        $email = $this->input->post('email');

//============================= Parte funcional =======================================
        $this->email->from('prueba686878@gmail.com', 'Ignacio');
        $this->email->to('prueba686878@gmail.com');
        //$this->email->cc('another@another-example.com');
        //$this->email->bcc('them@their-example.com');

        $this->email->subject('La Antigua prueba');

        $this->email->message('
                             <h3 align="center">Correo de prueba Antigua</h3>
                              <table border="1" width="100%" cellpadding="5">
                               <tr>
                                <td width="30%">Nombre</td>
                                <td width="70%">'.$nombre.'</td>
                               </tr>
                               <tr>
                                <td width="30%">Direccion</td>
                                <td width="70%">'.$direccion.'</td>
                               </tr>
                               <tr>
                                <td width="30%">Telefono</td>
                                <td width="70%">'.$telefono.'</td>
                               </tr>
                               <tr>
                                <td width="30%">Sexo</td>
                                <td width="70%">'.$sexo.'</td>
                               </tr>

                              </table>');
        // Aqui va el archivo adjunto
        $file_data = $this->upload_file();
        $this->email->attach('./assets/uploads/'.$pf);


        if ($this->email->send()) {
					$data = array('res' => "success", 'message' => "¡Correo Enviado!");
				} else {
					$data = array('res' => "error", 'message' => "¡Error! :(");
				}

			echo json_encode($data);


		} else {
			echo "No se permite este acceso directo...!!!";
		}
//========================================================
/*
$mail = new PHPMailer();
        //$mail->SMTPDebug = SMTP::DEBUG_SERVER;
        $mail->SMTPDebug = 1;                   //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth = true;                                   //Enable SMTP authentication
    $mail->Username = 'prueba686878@gmail.com';                     //SMTP username
    $mail->Password = 'prueba5656';                               //SMTP password
    $mail->SMTPSecure = 'tsl';         //Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
    $mail->Port = 465;                                    //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

    //Recipients
    $mail->setFrom('prueba686878@gmail.com', 'Nacho');
    $mail->addAddress('prueba686878@gmail.com', 'Joe User');     //Add a recipient


    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    //$mail->Subject = 'Prueba';
    //$mail->Body    = 'This is the HTML message body <b>in bold!</b>';
    //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->Subject = "Contacto";
    $mail->Body = "Nombre: $nombre \n<br />".
    "Email: $email \n<br />".
    "Mensaje: $telefono \n<br />";
    $mail->AddAttachment($ine['tmp_name'], $ine['name']);
    $mail->send();



				if ($mail->Send()) {
					$data = array('res' => "success", 'message' => "¡Correo Enviado!");
				} else {
					$data = array('res' => "error", 'message' => "¡Error! :(");
				}

			echo json_encode($data);


		} else {
			echo "No se permite este acceso directo...!!!";
		}
*/
/*
    $Nombre = $_POST['Nombre'];
    $Email = $_POST['Email'];
    $Mensaje = $_POST['Mensaje'];
    $archivo = $_FILES['adjunto'];

    require '../../assets/phpmailer/class.phpmailer.php';
    require '../../assets/phpmailer/class.smtp.php'; //incluimos la clase para envíos por SMTP
    $mail = new PHPMailer();

    $mail->From     = $Email;
    $mail->FromName = $Nombre;
    $mail->AddAddress("ign.tab13@gmail.com"); // Dirección a la que llegaran los mensajes.

// Aquí van los datos que apareceran en el correo que reciba

    $mail->WordWrap = 50;
    $mail->IsHTML(true);
    $mail->Subject  =  "Contacto";
    $mail->Body     =  "Nombre: $Nombre \n<br />".
    "Email: $Email \n<br />".
    "Mensaje: $Mensaje \n<br />";
    $mail->AddAttachment($archivo['tmp_name'], $archivo['name']);



// Datos del servidor SMTP

    $mail->IsSMTP();
    $mail->CharSet = 'UTF-8';
    $mail->SMTPAuth = true;
    $mail->SMTPSecure = "ssl";
    $mail->Host = "smtp.gmail.com"; //servidor smtp, esto lo puedes dejar igual
    $mail->Port = 465; //puerto smtp de gmail, tambien lo puedes dejar igual
    $mail->Username = 'prueba686878@gmail.com';  // Tu correo gmail
    $mail->Password = 'Prueba5656'; // Tu contrasena gmail
    $mail->FromName = 'Prueba Correo'; //
    $mail->From = 'prueba686878@gmail.com'; //email de remitente desde donde se envía el correo, este caso para evitar spam es el mismo que tu correo gmail

    if ($mail->Send())
    echo "<script>alert('Formulario enviado exitosamente, le responderemos lo más pronto posible.');location.href ='javascript:history.back()';</script>";
    else
    echo "<script>alert('Error al enviar el formulario');location.href ='javascript:history.back()';</script>";

  }

*/
}
}  // Fin del controller
