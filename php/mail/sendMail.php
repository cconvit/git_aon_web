<?php

function sendMailCotizacion($to, $to_name,$body_html,$redirect,$error){
    
    echo "Enviando";
	$mail = new PHPMailer();
	$mail->IsSMTP();
	$mail->SMTPAuth = true;
	$mail->SMTPSecure = "ssl";
	$mail->Host = "smtp.gmail.com";
	$mail->Port = 465;
	$mail->Username = "cotizador.aon@gmail.com";
	$mail->Password = "kvt6Wx7g4aGg";
	$mail->From = "noreply@aon.com.ve";
	$mail->FromName = "AON";
	$mail->SetFrom("noreply@aon.com.ve","AON");
	$mail->AddReplyTo("noreply@aon.com.ve","AON");
	$mail->Subject = "Cotizacion AON";
	$mail->AltBody = "Si no puedes ver este mail visita";
	$mail->MsgHTML($body_html);
        $mail->AddAddress($to, $to_name);
	$mail->IsHTML(true);
	$mail->Send();

        if($mail->Send()) { 
           
           header("Location: ".$redirect); 
        }
        else{
           
           header("Location: ".$error); 
        }
}
?>