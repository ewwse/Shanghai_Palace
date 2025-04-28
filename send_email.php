<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Cargar el autoload de Composer
require 'vendor/autoload.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recoger los datos del formulario
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $person = $_POST['person'];

    // Crear una instancia de PHPMailer
    $mail = new PHPMailer(true);
    
    try {
        // Configuración del servidor SMTP
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';  // Servidor SMTP de Gmail
        $mail->SMTPAuth = true;
        $mail->Username = 'tu_correo@gmail.com';  // Tu correo de Gmail
        $mail->Password = 'tu_contraseña';  // Tu contraseña de Gmail (mejor usa contraseñas de aplicaciones)
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Remitente y destinatario
        $mail->setFrom('tu_correo@gmail.com', 'Reserva');
        $mail->addAddress('destinatario@dominio.com');  // Correo al que se enviarán las reservas

        // Asunto y cuerpo del correo
        $mail->isHTML(true);
        $mail->Subject = 'Reserva de mesa';
        $mail->Body    = "Detalles de la reserva:<br><br>
                        Nombre: $name<br>
                        Correo Electrónico: $email<br>
                        Teléfono: $phone<br>
                        Fecha: $date<br>
                        Hora: $time<br>
                        Número de personas: $person<br>";

        // Enviar el correo
        $mail->send();
        echo 'Reserva realizada con éxito!';
    } catch (Exception $e) {
        echo "Hubo un error al enviar el correo. Error: {$mail->ErrorInfo}";
    }
}
?>
