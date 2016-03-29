<?php

class Profile {
	private $_companyName;
	private $_culture;
	private $_defaultAddress;
	private $_email;
	private $_firstName;
	private $_lastName;
	private $_language;
	private $_type;

	function __construct() {
		$this->_companyName = '';
		$this->_culture = '';
		$this->_defaultAddress = new Address();
		$this->_email = '';
		$this->_firstName = '';
		$this->_lastName = '';
		$this->_language = '';
		$this->_type = '';
	}

	public function getCompanyName() {
		return $this->_companyName;
	}

	public function setCompanyName($companyName) {
		$this->_companyName = $companyName;
		return $this;
	}

	public function getCulture() {
		return $this->_culture;
	}

	public function setCulture($culture) {
		$this->_culture = $culture;
		return $this;
	}

	public function getDefaultAddress() {
		return $this->_defaultAddress;
	}

	public function setDefaultAddress(Address $defaultAddress) {
		$this->_defaultAddress = $defaultAddress;
		return $this;
	}

	public function getEmail() {
		return $this->_email;
	}

	public function setEmail($email) {
		$this->_email = $email;
		return $this;
	}

	public function getFirstName() {
		return $this->_firstName;
	}

	public function setFirstName($firstName) {
		$this->_firstName = $firstName;
		return $this;
	}

	public function getLastName() {
		return $this->_lastName;
	}

	public function setLastName($lastName) {
		$this->_lastName = $lastName;
		return $this;
	}

	public function getLanguage() {
		return $this->_language;
	}

	public function setLanguage($language) {
		$this->_language = $language;
		return $this;
	}

	public function getType() {
		return $this->_type;
	}

	public function setType($type) {
		$this->_type = $type;
		return $this;
	}

	public function toArray() {
		$data['company_name'] = $this->getCompanyName();
		$data['culture'] = $this->getCulture();
		$data['default_address'] = $this->getDefaultAddress()->toArray();
		$data['email'] = $this->getEmail();
		$data['first_name'] = $this->getFirstName();
		$data['last_name'] = $this->getLastName();
		$data['language'] = $this->getLanguage();
		$data['type'] = $this->getType();
		return $data;
	}
}
