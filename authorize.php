<?php

// FIXME remove this debugging code
// var_dump($_REQUEST);
// die();

ini_set('display_errors','On');
error_reporting(E_STRICT | E_ALL ^ E_DEPRECATED);

function base64DecodeUrlSafe($b64) {
	return base64_decode(str_replace(array('-', '_'), array('+', '/'), $b64));
}

$privateKey = 'hWFZPHCWgZSXCZapw/lv04l+8GIekVbks6WT7EeCmgc=';

// TODO ... is this POST DATA?
// TODO confirm 'wa' and 'wresult' exist
$data['wa'] = 'wsignin1.0';
$data['wresult'] = '2016-03-22T06:07:23.260Z2016-03-22T07:07:23.260Z
http://billing.managedsolution.com/
ZXlKMGVYQWlPaUpLVjFRaUxDSmhiR2NpT2lKSVV6STFOaUo5LmV5SmhkV1FpT2lKb2RIUndPaTh2WW1sc2JHbHVaeTV0WVc1aFoyVmtjMjlzZFhScGIyNHVZMjl0THlJc0ltbHpjeUk2SW1oMGRIQnpPaTh2YldGdVlXZGxaSE52YkhWMGFXOXVZV056TG1GalkyVnpjMk52Ym5SeWIyd3VkMmx1Wkc5M2N5NXVaWFF2SWl3aWJtSm1Jam94TkRVNE5qSTJPRFF6TENKbGVIQWlPakUwTlRnMk16QTBORE1zSW01aGJXVnBaQ0k2SWxsMVRrOTRhVlpDTjI5U01EQjNabGhZYXpkcFRVbDNiMDh3T0VZNVJUWmZTM1V4VG5aNExVaERZbGtpTENKb2RIUndPaTh2YzJOb1pXMWhjeTV0YVdOeWIzTnZablF1WTI5dEwybGtaVzUwYVhSNUwyTnNZV2x0Y3k5MFpXNWhiblJwWkNJNklqSTNNV05tTldVNUxXSTBOemN0TkRjMU9TMWhOV1EyTFRaa05EVTVZbUl6TldZelpTSXNJbWgwZEhBNkx5OXpZMmhsYldGekxtMXBZM0p2YzI5bWRDNWpiMjB2YVdSbGJuUnBkSGt2WTJ4aGFXMXpMMjlpYW1WamRHbGtaVzUwYVdacFpYSWlPaUl6WVdabVl6aG1NaTFqT0dZMkxUUTBaRGN0T0Rrd1lTMDROMk16WVRrNU5tRTBZelFpTENKb2RIUndPaTh2YzJOb1pXMWhjeTU0Yld4emIyRndMbTl5Wnk5M2N5OHlNREExTHpBMUwybGtaVzUwYVhSNUwyTnNZV2x0Y3k5dVlXMWxJam9pWTJKdmVXNTBiMjVBYldGdVlXZGxaSE52YkhWMGFXOXVMbU52YlNJc0ltaDBkSEE2THk5elkyaGxiV0Z6TG5odGJITnZZWEF1YjNKbkwzZHpMekl3TURVdk1EVXZhV1JsYm5ScGRIa3ZZMnhoYVcxekwzTjFjbTVoYldVaU9pSkNiM2x1ZEc5dUlpd2lhSFIwY0RvdkwzTmphR1Z0WVhNdWVHMXNjMjloY0M1dmNtY3ZkM012TWpBd05TOHdOUzlwWkdWdWRHbDBlUzlqYkdGcGJYTXZaMmwyWlc1dVlXMWxJam9pUTJoeWFYTjBhV0Z1SWl3aWFIUjBjRG92TDNOamFHVnRZWE11YldsamNtOXpiMlowTG1OdmJTOXBaR1Z1ZEdsMGVTOWpiR0ZwYlhNdlpHbHpjR3hoZVc1aGJXVWlPaUpEYUhKcGMzUnBZVzRnUW05NWJuUnZiaUlzSW1oMGRIQTZMeTl6WTJobGJXRnpMbTFwWTNKdmMyOW1kQzVqYjIwdmFXUmxiblJwZEhrdlkyeGhhVzF6TDJsa1pXNTBhWFI1Y0hKdmRtbGtaWElpT2lKb2RIUndjem92TDNOMGN5NTNhVzVrYjNkekxtNWxkQzh5TnpGalpqVmxPUzFpTkRjM0xUUTNOVGt0WVRWa05pMDJaRFExT1dKaU16Vm1NMlV2SWl3aWFIUjBjRG92TDNOamFHVnRZWE11YldsamNtOXpiMlowTG1OdmJTOTNjeTh5TURBNEx6QTJMMmxrWlc1MGFYUjVMMk5zWVdsdGN5OWhkWFJvWlc1MGFXTmhkR2x2Ym0xbGRHaHZaQ0k2SW1oMGRIQTZMeTl6WTJobGJXRnpMbTFwWTNKdmMyOW1kQzVqYjIwdmQzTXZNakF3T0M4d05pOXBaR1Z1ZEdsMGVTOWhkWFJvWlc1MGFXTmhkR2x2Ym0xbGRHaHZaQzl3WVhOemQyOXlaQ0lzSW1oMGRIQTZMeTl6WTJobGJXRnpMbTFwWTNKdmMyOW1kQzVqYjIwdmQzTXZNakF3T0M4d05pOXBaR1Z1ZEdsMGVTOWpiR0ZwYlhNdllYVjBhR1Z1ZEdsallYUnBiMjVwYm5OMFlXNTBJam9pTWpBeE5pMHdNeTB5TWxRd05Ub3pPRG93T0M0eU1EbGFJaXdpYVdSbGJuUnBkSGx3Y205MmFXUmxjaUk2SW1oMGRIQnpPaTh2YzNSekxuZHBibVJ2ZDNNdWJtVjBMekkzTVdObU5XVTVMV0kwTnpjdE5EYzFPUzFoTldRMkxUWmtORFU1WW1Jek5XWXpaUzhpZlEuNENwd2g2aUFpWENyM19QTUpLbzQ0b2dqN2tKLVpPMUtLN1VIMnJHOFZrWQ==urn:ietf:params:oauth:token-type:jwthttp://schemas.xmlsoap.org/ws/2005/02/trust/Issuehttp://schemas.xmlsoap.org/ws/2005/05/identity/NoProofKey';

// TODO verify the array indexes are accessible
$leftCut = explode('http://billing.managedsolution.com/', $data['wresult']);
$rightCut = explode('urn:ietf:params:oauth:token-type:jwt', $leftCut[1]);
$jwtb64 = trim($rightCut[0]);

if (null === ($jwt = base64DecodeUrlSafe($jwtb64))) {
	throw new UnexpectedValueException('Invalid encoding for JWT token');
}

$jwtSegments = explode('.', $jwt);

if (count($jwtSegments) != 3) {
	throw new \RuntimeException('Invalid number of JWT segments');
}

list($headb64, $payloadb64, $cryptob64) = $jwtSegments;

if (null === ($header = json_decode(base64DecodeUrlSafe($headb64)))) {
	throw new UnexpectedValueException('Invalid encoding for JWT segment');
}

if (null === $payload = json_decode(base64DecodeUrlSafe($payloadb64))) {
	throw new UnexpectedValueException('Invalid encoding for JWT segment');
}

$sig = base64DecodeUrlSafe($cryptob64);

if (isset($key)) {
	if (empty($header->alg)) {
		throw new DomainException('Empty JWT algorithm provided');
	}

	if (!function_exists('openssl_verify')) {
		throw new \RuntimeException('Cannot verify JWT signature, OpenSSL not enabled');
	}

	if (!openssl_verify($sig, "$headb64.$payloadb64", $privateKey, OPENSSL_ALGO_SHA256)) {
		throw new UnexpectedValueException('Signature verification for JWT failed');
	}
}

// TODO header data in $header, data is in $payload

