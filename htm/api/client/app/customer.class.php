<?php

class Customer {
	private $_domainPrefix;
	private $_username;
	private $_password;
	private $_profile;
	private $_newCustomerUrl;
	private $_customerId;
	private $_customerTid;
	private $_customerEtid;
	private $_customerEoid;

	function __construct() {
		$this->_newCustomerUrl = 'https://api.cp.microsoft.com/' . Config::instance()->getSaId() . '/customers/create-reseller-customer';
		$this->_domainPrefix = '';
		$this->_username = '';
		$this->_password = '';
		$this->_profile = new Profile();
	}

	public function getCustomerId() {
		return $this->_customerId;
	}

	public function setCustomerId($customerId) {
		$this->_customerId = $customerId;
		return $this;
	}

	public function getCustomerTid() {
		return $this->_customerTid;
	}

	public function setCustomerTid($customerTid) {
		$this->_customerTid = $customerTid;
		return $this;
	}

	public function getCustomerEtid() {
		return $this->_customerEtid;
	}

	public function setCustomerEtid($customerEtid) {
		$this->_customerEtid = $customerEtid;
		return $this;
	}

	public function getCustomerEoid() {
		return $this->_customerEoid;
	}

	public function setCustomerEoid($customerEoid) {
		$this->_customerEoid = $customerEoid;
		return $this;
	}

	public function loadCustomerFromIdToken($idToken) {
		var_dump($idToken);
		die();
	}

	public function requestNew() {
		$headerArray[] = 'api-version: 2015-03-31';
		$headerArray[] = 'Content-Type: application/json';
		$headerArray[] = 'Accept: application/json';
		$headerArray[] = 'Authorization: Bearer ' . Config::instance()->getSaToken();
		$headerArray[] = 'x-ms-tracking-id: ' . StringUtil::generateGuid();
		$headerArray[] = 'x-ms-correlation-id: ' . StringUtil::generateGuid();
		$httpOptions['headers'] = $headerArray;

		$httpOptions['post_json'] = true;
		$httpOptions['post_data'] = $this->toArray();

		$httpClient = new HttpClient();

		$httpResponse = $httpClient->postRequest($this->_newCustomerUrl, $httpOptions);

		$jsonResponse = json_decode($httpResponse, true);

		$customer = $jsonResponse['customer'];
		$this->_customerId = $customer['id'];
		$customerIdentity = $customer['identity'];
		$customerIdentityData = $customerIdentity['data'];
		$this->_customerTid = $customerIdentityData['tid'];
		$this->_customerEtid = $customerIdentityData['etid'];
		$this->_customerEoid = $customerIdentityData['eoid'];

		return $this;
	}

	public function toArray() {
		$data['domain_prefix'] = $this->getDomainPrefix();
		$data['password'] = $this->getPassword();
		$data['profile'] = $this->getProfile()->toArray();
		$data['user_name'] = $this->getUsername();
		return $data;
	}

	public function getDomainPrefix() {
		return $this->_domainPrefix;
	}

	public function setDomainPrefix($domainPrefix) {
		$this->_domainPrefix = $domainPrefix;
		return $this;
	}

	public function getPassword() {
		return $this->_password;
	}

	public function setPassword($password) {
		$this->_password = $password;
		return $this;
	}

	public function getProfile() {
		return $this->_profile;
	}

	public function setProfile(Profile $profile) {
		$this->_profile = $profile;
		return $this;
	}

	public function getUsername() {
		return $this->_username;
	}

	public function setUsername($username) {
		$this->_username = $username;
		return $this;
	}
}
