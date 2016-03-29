<?php

class PartnerCenterAuth {
	private $_adToken, $_adTokenExpiresOn, $_acToken, $_acTokenExpiresOn;

	public function __construct() {
		$this->_adToken = '';
		$this->_adTokenExpiresOn = 0;
		$this->_acToken = '';
		$this->_acTokenExpiresOn = 0;
		return $this;
	}

	public function getAdToken() {
		if (time() > $this->_adTokenExpiresOn) {
			$this->requestAdToken();
		}

		return $this->_adToken;
	}

	public function getAcToken() {
		if (time() > $this->_acTokenExpiresOn) {
			if (time() > $this->_adTokenExpiresOn) {
				$this->requestAdToken();
			}

			$this->requestAcToken();
		}

		return $this->_acToken;
	}

	private function requestAdToken() {
		$headerArray[] = 'api-version: 2015-03-31';
		$headerArray[] = 'ContentType: application/x-www-form-urlencoded';
		$headerArray[] = 'Accept: application/json';
		$httpOptions['headers'] = $headerArray;

		$postDataArray['resource'] = Config::instance()->getResourceUrl();
		$postDataArray['client_id'] = Config::instance()->getClientId();
		$postDataArray['client_secret'] = Config::instance()->getClientSecret();
		$postDataArray['grant_type'] = 'client_credentials';
		$httpOptions['post_data'] = $postDataArray;

		$httpClient = new HttpClient();

		$httpResponse = $httpClient->postRequest(Config::instance()->getAdTokenUrl(), $httpOptions);

		$jsonResponse = json_decode($httpResponse, true);

		$this->_adToken = $jsonResponse['access_token'];
		$this->_adTokenExpiresOn = intval($jsonResponse['expires_on']);

		return $this;
	}

	private function requestAcToken() {
		$headerArray[] = 'ContentType: application/x-www-form-urlencoded';
		$headerArray[] = 'Authorization: Bearer ' . $this->_adToken;
		$httpOptions['headers'] = $headerArray;

		$postDataArray['grant_type'] = 'jwt_token';
		$httpOptions['post_data'] = $postDataArray;

		$httpClient = new HttpClient();

		$httpResponse = $httpClient->postRequest(Config::instance()->getAcTokenUrl(), $httpOptions);
		$responseTime = time();

		$jsonResponse = json_decode($httpResponse, true);

		$this->_acToken = $jsonResponse['access_token'];
		$this->_acTokenExpiresOn = $responseTime + intval($jsonResponse['expires_in']) - 1;

		return $this;
	}
}
