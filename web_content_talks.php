<?php

// config
$filename   = 'output_web_talks.html';

include 'functions.php';
date_default_timezone_set('utc');

include 'simplexlsx/simplexlsx.class.php';
$xlsx = new SimpleXLSX('talks_bios.xlsx');

// write header
file_put_contents($filename, '<html><head><meta charset="utf-8"></head><body>'."\n\n");

$topics = array();

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

	// Generate speaker list
	if($jobDesc1 !== '') {
		$speakerList = sprintf(
			'<a href="%s">%s</a> (%s)',
			getSpeakerURL($speaker1),
			$speaker1,
			$jobDesc1
		);
	}
	else {
		$speakerList = sprintf(
			'<a href="%s">%s</a>',
			getSpeakerURL($speaker1),
			$speaker1
		);
	}
	if( $speaker2 !== '') {
		if($jobDesc2 !== '') {
			$speakerList = sprintf(
				'%s, <a href="%s">%s</a> (%s)',
				$speakerList,
				getSpeakerURL($speaker2),
				$speaker2,
				$jobDesc2
			);
		}
		else {
			$speakerList = sprintf(
				'%s, <a href="%s">%s</a>',
				$speakerList,
				getSpeakerURL($speaker2),
				$speaker2
			);
		}
	}
	if( $speaker3 !== '') {
		if($jobDesc3 !== '') {
			$speakerList = sprintf(
				'%s, <a href="%s">%s</a> (%s)',
				$speakerList,
				getSpeakerURL($speaker3),
				$speaker3,
				$jobDesc3
			);
		}
		else {
			$speakerList = sprintf(
				'<a href="%s">%s</a>, %s',
				$speakerList,
				getSpeakerURL($speaker3),
				$speaker3
			);
		}
	}

	$date = sprintf('%s from: %s ~ to: %s', $day, $start, $end);

	$text = sprintf(
		'<h2 id="%s">%s [%s]</h2>'."\n".
		'<p><i>%s</i></p>'."\n".
		'<p>%s</p>'."\n".
		'<p><small>%s</small></p>'."\n\n",
	getAnchor($titleTalk),
	$titleTalk,
	$topic,
	$speakerList,
	$abstract,
	$date

	);

	$topics[$topic][] = $text;
}

foreach($topics as $topic => $talks) {
	foreach($talks as $talk) {
		file_put_contents($filename, sprintf("%s\n", $talk),  FILE_APPEND );
	}
	
	file_put_contents($filename, "<!-- ********** NEXT TOPIC ********** -->\n\n",  FILE_APPEND );
}

// write footer
file_put_contents($filename, "\n\n".'</body></html>',  FILE_APPEND);
