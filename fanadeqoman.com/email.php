<?php
		$toemail='brahmaji.provab@gmail.com';
	    $fromemail='fanadeqoman.support@provabextranet.com';
		$subject = 'Cancelltion Voucher from fanadeqoman';
		$message = 'Testing';
		// To send HTML mail, the Content-type header must be set
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

		// Additional headers
		$headers .= 'To:'.  $toemail ."\r\n";
		$headers .= 'From:'.$fromemail. "\r\n";
		// Mail it
		$sendmail=mail($toemail, $subject, $message, $headers);
?>
