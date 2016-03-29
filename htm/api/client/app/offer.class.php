<?php

class Offer {
	private $_offerList;

	function __construct() {
		$this->_offerList = null;
	}

	public function getOfferList() {
		if ($this->_offerList === null) {
			$this->requestOfferList();
		}
		return $this->_offerList;
	}

	private function requestOfferList() {
		$url = Config::instance()->getApiUrl() . '/offers?country=US';

		$headerArray[] = 'Accept: application/json';
		$headerArray[] = 'Authorization: Bearer ' . Config::instance()->getAcToken();
		$httpOptions['headers'] = $headerArray;

		$httpClient = new HttpClient();

		$httpResponse = $httpClient->getRequest($url, $httpOptions);
		$httpClean = preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $httpResponse);
		$this->_offerList = json_decode($httpClean, true);

		return $this;
	}
}
