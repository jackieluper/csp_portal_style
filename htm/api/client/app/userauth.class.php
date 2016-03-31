<?php

class UserAuth {
	private $_adToken, $_adTokenExpiresOn, $_idToken;

	public function __construct() {
		$this->_adToken = '';
		$this->_adTokenExpiresOn = 0;
		$this->_idToken = '';
		return $this;
	}

	public function requestAdTokenForAuthCode($authCode) {
		$headerArray[] = 'api-version: 2015-03-31';
		$headerArray[] = 'ContentType: application/x-www-form-urlencoded';
		$headerArray[] = 'Accept: application/json';
		$httpOptions['headers'] = $headerArray;

		$postDataArray['code'] = $authCode;
		$postDataArray['redirect_uri'] = Config::instance()->getRedirectUri();
		$postDataArray['resource'] = Config::instance()->getResourceUrl();
		$postDataArray['client_id'] = Config::instance()->getClientId();
		$postDataArray['client_secret'] = Config::instance()->getClientSecret();
		$postDataArray['grant_type'] = 'authorization_code';
		$httpOptions['post_data'] = $postDataArray;

		$httpClient = new HttpClient();

		$httpResponse = $httpClient->postRequest(Config::instance()->getAdTokenCommonUrl(), $httpOptions);

		$jsonResponse = json_decode($httpResponse, true);

		$this->_adToken = $jsonResponse['access_token'];
		$this->_adTokenExpiresOn = $jsonResponse['expires_on'];
		$this->_idToken = JWT::decode($jsonResponse['id_token'], Config::instance()->getClientSecret(), false);

		return $this;
	}

	public function getAdToken() {
		return $this->_adToken;
	}

	public function setAdToken($adToken) {
		$this->_adToken = $adToken;
		return $this;
	}

	public function getAdTokenExpiresOn() {
		return $this->_adTokenExpiresOn;
	}

	public function setAdTokenExpiresOn($adTokenExpiresOn) {
		$this->_adTokenExpiresOn = $adTokenExpiresOn;
		return $this;
	}

	public function getIdToken() {
		return $this->_idToken;
	}

	public function setIdToken($idToken) {
		$this->_idToken = $idToken;
		return $this;
	}
}
