<?php

	function sendMailCotizacion($to, $to_name,$body_html,$redirect,$error){
		$mail = new PHPMailer();
                $mail->mailer = "sendmail";
                $mail->SingleTo = true; 
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
		$mail->Subject='=?UTF-8?B?'.base64_encode("Cotización de automóvil Aon Risk Services Venezuela").'?=';
		$mail->AltBody = "";
		$mail->MsgHTML($body_html);
		$mail->AddAddress($to, $to_name);
		$mail->IsHTML(true);
                $mail->CharSet = 'UTF-8';
		
                if($mail->Send()) {  

                    header("Location: ".$redirect); 
                    }
                else{
                    header("Location: ".$error); 
                }
	}
        
        function sendMailCotizacion_mail($to, $to_name,$body_html,$redirect,$error){
		   

        // subject
        $subject = '=?UTF-8?B?'.base64_encode("Cotización de automóvil Aon Risk Services Venezuela").'?=';

                    // To send HTML mail, the Content-type header must be set
        $headers  = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

        // Additional headers
        $headers .= 'To: '.$to_name.' <'.$to.'>'. "\r\n";
        $headers .= 'From: AON <noreply@aon.com.ve>' . "\r\n";

        // Mail it

            if(mail($to, $subject, $body_html, $headers)) {  
                header("Location: ".$redirect); 
                }
            else{
                header("Location: ".$error); 
            }
	}
?>
