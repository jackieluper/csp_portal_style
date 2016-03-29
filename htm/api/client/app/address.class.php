<?php

class Address {
	private $_addressLine1;
	private $_addressLine2;
	private $_addressLine3;
	private $_city;
	private $_country;
	private $_firstName;
	private $_firstNamePronunciation;
	private $_lastName;
	private $_lastNamePronunciation;
	private $_phoneNumber;
	private $_postalCode;
	private $_region;

	function __construct() {
		$this->_addressLine1 = '';
		$this->_addressLine2 = '';
		$this->_addressLine3 = '';
		$this->_city = '';
		$this->_country = '';
		$this->_firstName = '';
		$this->_firstNamePronunciation = '';
		$this->_lastName = '';
		$this->_lastNamePronunciation = '';
		$this->_phoneNumber = '';
		$this->_postalCode = '';
		$this->_region = '';
	}

	public function getAddressLine1() {
		return $this->_addressLine1;
	}

	public function setAddressLine1($addressLine1) {
		$this->_addressLine1 = $addressLine1;
		return $this;
	}

	public function getAddressLine2() {
		return $this->_addressLine2;
	}

	public function setAddressLine2($addressLine2) {
		$this->_addressLine2 = $addressLine2;
		return $this;
	}

	public function getAddressLine3() {
		return $this->_addressLine3;
	}

	public function setAddressLine3($addressLine3) {
		$this->_addressLine3 = $addressLine3;
		return $this;
	}

	public function getCity() {
		return $this->_city;
	}

	public function setCity($city) {
		$this->_city = $city;
		return $this;
	}

	public function getCountry() {
		return $this->_country;
	}

	public function setCountry($country) {
		$this->_country = $country;
		return $this;
	}

	public function getFirstName() {
		return $this->_firstName;
	}

	public function setFirstName($firstName) {
		$this->_firstName = $firstName;
		return $this;
	}

	public function getFirstNamePronunciation() {
		return $this->_firstNamePronunciation;
	}

	public function setFirstNamePronunciation($firstNamePronunciation) {
		$this->_firstNamePronunciation = $firstNamePronunciation;
		return $this;
	}

	public function getLastName() {
		return $this->_lastName;
	}

	public function setLastName($lastName) {
		$this->_lastName = $lastName;
		return $this;
	}

	public function getLastNamePronunciation() {
		return $this->_lastNamePronunciation;
	}

	public function setLastNamePronunciation($lastNamePronunciation) {
		$this->_lastNamePronunciation = $lastNamePronunciation;
		return $this;
	}

	public function getPhoneNumber() {
		return $this->_phoneNumber;
	}

	public function setPhoneNumber($phoneNumber) {
		$this->_phoneNumber = $phoneNumber;
		return $this;
	}

	public function getPostalCode() {
		return $this->_postalCode;
	}

	public function setPostalCode($postalCode) {
		$this->_postalCode = $postalCode;
		return $this;
	}

	public function getRegion() {
		return $this->_region;
	}

	public function setRegion($region) {
		$this->_region = $region;
		return $this;
	}

	public function toArray() {
		$data['address_line1'] = $this->getAddressLine1();
		$data['address_line2'] = $this->getAddressLine2();
		$data['address_line3'] = $this->getAddressLine3();
		$data['city'] = $this->getCity();
		$data['country'] = $this->getCountry();
		$data['first_name'] = $this->getFirstName();
		$data['first_name_pronunciation'] = $this->getFirstNamePronunciation();
		$data['last_name'] = $this->getLastName();
		$data['last_name_pronunciation'] = $this->getLastNamePronunciation();
		$data['phone_number'] = $this->getPhoneNumber();
		$data['postal_code'] = $this->getPostalCode();
		$data['region'] = $this->getRegion();
		return $data;
	}
}
