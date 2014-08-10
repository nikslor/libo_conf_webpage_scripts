<?php

// config
$filename   = 'output_web_bios.html';

include 'functions.php';
date_default_timezone_set('utc');

include 'simplexlsx/simplexlsx.class.php';
$xlsx = new SimpleXLSX('talks_bios.xlsx');

// write header
file_put_contents($filename, '<html><head><meta charset="utf-8"></head><body>'."\n\n");

$bios = array();

foreach( $xlsx->rows() as $line => $row) {
	if ($line === 0 || $line === 1){
		continue;
	}

	$speaker1    = trim($row[0]);
	$speaker2    = trim($row[1]);
	$speaker3    = trim($row[2]);
	$topic       = trim($row[3]);
	$titleTalk   = trim($row[4]);
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

	$templateWJob = '<h2 id="%s">%s</h2>'."\n".
		'<img class="left" src="%s" width="150px" />'."\n".
		'<p><i>%s</i></p>'."\n".
		'<p>%s</p>'."\n".
		'<p style="clear: both;"></p>';

	$templateWOJob = '<h2 id="%s">%s</h2>'."\n".
		'<img class="left" src="%s" width="150px" />'."\n".
		'<!-- <p><i>%s</i></p> -->'."\n".
		'<p>%s</p>'."\n".
		'<p style="clear: both;"></p>';

	$text = sprintf(
		$jobDesc1 === '' ? $templateWOJob : $templateWJob,
		getAnchor($speaker1),
		$speaker1,
		getPictureURL($speaker1),
		$jobDesc1,
		$bio1
	);
	$speakerName = $speaker1;
	$bios[$speakerName] = $text;

	if ( isset($speaker2) && $speaker2 !== '' ) {
		$text = sprintf(
			$jobDesc2 === '' ? $templateWOJob : $templateWJob,
			getAnchor($speaker2),
			$speaker2,
			getPictureURL($speaker2),
			$jobDesc2,
			$bio2
		);
		$speakerName = $speaker2;
		$bios[$speakerName] = $text;
	}

	if ( isset($speaker3) && $speaker3 !== '' ) {
		$text = sprintf(
			$jobDesc3 === '' ? $templateWOJob : $templateWJob,
			getAnchor($speaker3),
			$speaker3,
			getPictureURL($speaker3),
			$jobDesc3,
			$bio3
		);
		$speakerName = $speaker3;
		$bios[$speakerName] = $text;
	}
}

ksort($bios);

foreach($bios as $speakerName => $bio) {
	file_put_contents($filename, sprintf("%s\n\n", $bio),  FILE_APPEND );
	//file_put_contents($filename, "<!-- ********** NEXT BIO ********** -->\n\n",  FILE_APPEND );
}

// write footer
file_put_contents($filename, "\n\n".'</body></html>',  FILE_APPEND);
