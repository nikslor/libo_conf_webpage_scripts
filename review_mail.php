<?php

die('Already called!!');

include 'phpmailer/PHPMailerAutoload.php';

date_default_timezone_set('utc');

include 'simplexlsx/simplexlsx.class.php';
$xlsx = new SimpleXLSX('talks_bios.xlsx');

foreach( $xlsx->rows() as $line => $row) {
	if ($line === 0){
		continue;
	}

	$speaker1    = trim($row[0]);
	$speaker2    = trim($row[1]);
	$speaker3    = trim($row[2]);
	$topic       = trim($row[3]);
	$titleSpeech = trim($row[4]);
	$abstract    = trim($row[5]);
	$bio1        = trim($row[6]);
	$bio2        = trim($row[7]);
	$bio3        = trim($row[8]);
	$jobDesc1    = trim($row[9]);
	$jobDesc2    = trim($row[10]);
	$jobDesc3    = trim($row[11]);
	$day         = trim($row[12]);
	$start       = trim($row[13]);
	$end         = trim($row[14]);
	$mail1       = trim($row[15]);
	$mail2       = trim($row[16]);
	$mail3       = trim($row[17]);

	// skip i.e. lightning talks
	if( $mail1 === '' ) {
		continue;
	}

	// fill some fields depending on the number of speakers
	if ( $jobDesc1 === '' ){
		$jobDesc1 = 'Unknown job description, please provide';
	}
	if ( $speaker2 !== '' ){
		if( $jobDesc2 === '' ) {
			$jobDesc2 = 'Unknown job description, please provide';
		}
	}
	if ( $speaker3 !== '' ){
		if( $jobDesc3 === '' ) {
			$jobDesc3 = 'Unknown job description, please provide';
		}
	}

	// Generate speaker list
	$speakerList = sprintf('%s (%s)', $speaker1, $jobDesc1);
	if( $speaker2 !== '') {
		$speakerList = sprintf("%s\n%s (%s)", $speakerList, $speaker2, $jobDesc2);
	}
	if( $speaker3 !== '') {
		$speakerList = sprintf("%s\n%s (%s)", $speakerList, $speaker3, $jobDesc3);
	}

	$bios = sprintf('Bio 1: %s', $bio1);
	if( $bio2 != '') {
		$bios = sprintf("%s\n\nBio 2: %s", $bios, $bio2);
	}
	if( $bio3 != '') {
		$bios = sprintf("%s\n\nBio 3: %s", $bios, $bio3);
	}

	$date = sprintf('%s from: %s ~ to: %s', $day, $start, $end);

	$subject     = 'LibO Conf Bern - please check your speech details';
	$text        = sprintf(
"Hi :)

We're working on the conference booklet for the LibreOffice conference in Bern
and this is the information we will print about your speech.
Please check if everything is okay and send corrections back to me
(nicolas.chistener@ch-open.ch) until 2014-08-12.

IMPORTANT: Please also send me a picture we can print together with your bio.

Thanks for your help and see you in September :)

Speaker list (with job description - please provide if missing)
===============================================================
%s

Topic (FYI)
============
%s

Title of your speech
====================
%s

Abstract
========
%s

Bio of speaker(s)
=================
%s

Date of speech
==============
%s


Please don't forget to send a picture.

Kind regards,
Nicolas

-- 
Nicolas Christener | nicolas.christener@ch-open.ch | +41 76 335 32 57
Verein Swiss Open Systems User Group /ch/open
Belegscanning, 10073 | Postfach | CH-6009 Luzern | http://www.ch-open.ch",

$speakerList,
$topic,
$titleSpeech,
$abstract,
$bios,
$date

);

	// Send mail
	$mail = new PHPMailer();
	$mail->IsSMTP(); // use SMTP

	// SMTP Configuration
	$mail->SMTPAuth   = true;
	$mail->Host       = "mail.syhosting.ch";
	$mail->Username   = "";
	$mail->Password   = "";
	$mail->SMTPSecure = 'tls';
	$mail->Port       = 587; 
	$mail->CharSet    = 'UTF-8';

	$mail->From     = "nicolas.christener@ch-open.ch";
	$mail->FromName = "Nicolas Christener";
	$mail->Subject  = $subject;
	$mail->Body     = $text;
	$mail->IsHTML(false);

	$mail->AddAddress($mail1);
	if( $mail2 !== '' ){
		$mail->AddAddress($mail2);
	}
	if( $mail3 !== '' ){
		$mail->AddAddress($mail3);
	}
	//$mail->AddCC('foo@bar.baz', 'Firstname Lastname');
	//$mail->AddBCC('foo@bar.baz', 'Firstname Lastname');

	$response = NULL;
	if(!$mail->Send()) {
		$response = "Mailer Error: " . $mail->ErrorInfo;
	}
	else {
		$response = "Message sent!";
	}
}
