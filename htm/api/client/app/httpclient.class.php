<?php

class HttpClient {
	function __construct() {}

	public function getRequest($url, $options = null) {
		return $this->httpRequest('GET', $url, $options);
	}

	public function postRequest($url, $options = null) {
		return $this->httpRequest('POST', $url, $options);
	}

	public function httpRequest($requestType, $url, $options) {
		$curl = curl_init();

		$curlOptions[CURLOPT_URL] = $url;
		$curlOptions[CURLOPT_HEADER] = 0;
		$curlOptions[CURLOPT_RETURNTRANSFER] = 1;
		$curlOptions[CURLOPT_FAILONERROR] = 0;
		$curlOptions[CURLOPT_TIMEOUT] = 30;
		$curlOptions[CURLOPT_SSL_VERIFYPEER] = 0;

		if (isset($options['ssl_verify'])) {
			$curlOptions[CURLOPT_SSL_VERIFYPEER] = 1;
		}

		if (isset($options['debug'])) {
			$curlOptions[CURLOPT_STDERR] = fopen('php://stderr', 'w+');
			$curlOptions[CURLOPT_FRESH_CONNECT] = 1;
			$curlOptions[CURLOPT_FORBID_REUSE] = 1;
			$curlOptions[CURLOPT_VERBOSE] = 1;
			$curlOptions[CURLOPT_HEADER] = 1;
			$curlOptions[CURLOPT_FAILONERROR] = 1;
		}

		switch($requestType) {
			case 'POST': {
				$curlOptions[CURLOPT_POST] = 1;

				if (!empty($options['post_data'])) {
					if (isset($options['post_json'])) {
						$curlOptions[CURLOPT_POSTFIELDS] = json_encode($options['post_data']);
					} else {
						$curlOptions[CURLOPT_POSTFIELDS] = http_build_query($options['post_data']);
					}
				}
			}
				break;
			case 'GET':
				break;
			default:
				break;
		}

		if (isset($options['headers'])) {
			$curlOptions[CURLOPT_HTTPHEADER] = $options['headers'];
		}

		curl_setopt_array($curl, $curlOptions);
		$result = curl_exec($curl);

		if (isset($options['debug'])) {
			$error = curl_error($curl);
			$errno = curl_errno($curl);

			if (!$result) {
				trigger_error($error);
			}
		}

		curl_close($curl);
		return $result;
	}
}
