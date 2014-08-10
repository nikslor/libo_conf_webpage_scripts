<?php

function getPictureURL($speakerName) {
	$URLPicture = 'assets/Conference/Speaker/150px'; // relative path, w/o trailing '/'

	$speaker = array(); // silverstripes renames files after upload!!
	$speaker['Alexander Werner']    = 'alexanderwerner.png';
	$speaker['Alfredo Parisi']      = 'alfredoparisi.jpg';
	$speaker['Andras Timar']        = 'andrastimar.png';
	$speaker['Charles Schulz']      = 'charleshschulz.jpg';
	$speaker['Eike Rathke']         = 'eikerathke.png';
	$speaker['Florian Effenberger'] = 'florianeffenberg.png';
	$speaker['Fridrich Strba']      = 'fridrichstrba.png';
	$speaker['Italo Vignoli']       = 'italovignoli.jpg';
	$speaker['Lothar K. Becker']    = 'lotharkbecker.jpg';
	$speaker['Michael Meeks']       = 'michaelmeeks.png';
	$speaker['Miklos Vajna']        = 'miklosvajna.png';
	$speaker['Robinson Tryon']      = 'robinsontryon.jpg';
	$speaker['Tobias Mueller']      = 'tobiasmueller.jpg';
	$speaker['Tor Lillqvist']       = 'torlillqvist.png';

	if ( isset($speaker[$speakerName]) ){
		return sprintf('%s/%s', $URLPicture, $speaker[$speakerName]);
	}

	return sprintf('%s/dummy.png', $URLPicture);
}

function getSpeakerURL($speakerName) {
	// config
	$speakerURL = '/2014/speaker'; // relative path

	if($speakerName !== '') {
		return sprintf('%s#%s', $speakerURL, getAnchor($speakerName));
	}

	return $speakerURL;
}

// http://stackoverflow.com/questions/2910976/php-urlize-function
function getAnchor($speakerName) {
	return strtolower(
		preg_replace(
			array( '/[^-a-zA-Z0-9\s]/', '/[\s]/' ), array( '', '-' ),
			$speakerName
		)
	);
}
