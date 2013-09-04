<?php
       /*
	include("class.phpmailer.php");
	include("class.smtp.php");
        $to="carlos.convit@gmail.com";
        $to_name="";
        $body_html="";
        $redirect="";
        * 
        */
function sendMail($to, $to_name,$body_html,$redirect,$error){
	$mail = new PHPMailer();
	$mail->IsSMTP();
	$mail->SMTPAuth = true;
	$mail->SMTPSecure = "ssl";
	$mail->Host = "smtp.gmail.com";
	$mail->Port = 465;
	$mail->Username = "cconvit1@gmail.com";
	$mail->Password = "371d19cb";
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