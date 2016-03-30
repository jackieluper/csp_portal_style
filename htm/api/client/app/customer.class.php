<?php

class Customer {
	private $_id, $_commerceId, $_companyProfile, $_billingProfile, $_relationshipToPartner, $_allowDelegatedAccess, 
		$_userCredentials, $_attributes, $_companyTenantId, $_companyDomain, $_companyName, $_billingId,
		$_billingFirstName, $_billingLastName, $_billingEmail, $_billingCulture, $_billingLanguage,
		$_billingCompanyName, $_billingAddressCountry, $_billingAddressRegion, $_billingAddressCity,
		$_billingAddressState, $_billingAddressAddressLine1, $_billingAddressAddressLine2, $_billingAddressPostalCode,
		$_billingAddressFirstName, $_billingAddressLastName, $_billingAddressPhoneNumber, $_username, $_password,
		$_responseBillingProfileEtag, $_responsePassword;

	function __construct() {
		$this->_id = null;
		$this->_commerceId = null;
		$this->_companyProfile = array();
		$this->_billingProfile = array();
		$this->_relationshipToPartner = 'none';
		$this->_allowDelegatedAccess = null;
		$this->_userCredentials = array();
		$this->_attributes = array();

		$this->_companyTenantId = null;
		$this->_companyDomain = '';
		$this->_companyName = '';
		$this->_billingId = null;
		$this->_billingFirstName = '';
		$this->_billingLastName = '';
		$this->_billingEmail = '';
		$this->_billingCulture = 'en-US';
		$this->_billingLanguage = 'en';
		$this->_billingCompanyName = '';
		$this->_billingAddressCountry = 'US';
		$this->_billingAddressRegion = '';
		$this->_billingAddressCity = '';
		$this->_billingAddressState = '';
		$this->_billingAddressAddressLine1 = '';
		$this->_billingAddressAddressLine2 = '';
		$this->_billingAddressPostalCode = '';
		$this->_billingAddressFirstName = '';
		$this->_billingAddressLastName = '';
		$this->_billingAddressPhoneNumber = '';
		$this->_username = '';
		$this->_password = '';

		// new variables returned after customer creation
		$_responseBillingProfileEtag = '';
		$_responsePassword = '';
	}

	private function requestDomainAvailableCheck($domainPrefix) {
		// TODO strip out .onmicrosoft.com, only use the prefix?

		$url = Config::instance()->getApiUrl() . '/validations/checkdomainavailability/' . $domainPrefix;

		$headerArray[] = 'Accept: application/json';
		$headerArray[] = 'Authorization: Bearer ' . Config::instance()->getAcToken();
		$headerArray[] = 'MS-Contract-Version: v1';
		$headerArray[] = 'MS-RequestId: ' . StringUtil::generateGuid();
		$headerArray[] = 'MS-CorrelationId: ' . StringUtil::generateGuid();
		$headerArray[] = 'X-Locale: en-US';
		$httpOptions['headers'] = $headerArray;

		$httpClient = new HttpClient();

		$httpResponse = $httpClient->getRequest($url, $httpOptions);

		return StringUtil::stringToBool($httpResponse);
	}

	public function createCustomer() {
		if (!$this->requestDomainAvailableCheck($this->_companyDomain)) {
			return false;
		}

		$this->requestCreateCustomer();

		return true;
	}

	private function requestCreateCustomer() {
		$url = Config::instance()->getApiUrl() . '/customers';

		$headerArray[] = 'Accept: application/json';
		$headerArray[] = 'Authorization: Bearer ' . Config::instance()->getAcToken();
		$headerArray[] = 'MS-Contract-Version: v1';
		$headerArray[] = 'MS-RequestId: ' . StringUtil::generateGuid();
		$headerArray[] = 'MS-CorrelationId: ' . StringUtil::generateGuid();
		$headerArray[] = 'Content-Type: application/json';
		$headerArray[] = 'Expect: 100-continue';
		$headerArray[] = 'Connection: Keep-Alive';
		$httpOptions['headers'] = $headerArray;

		$httpOptions['post_json'] = true;
		$httpOptions['post_data'] = $this->toArray();

		$httpClient = new HttpClient();

		$httpResponse = $httpClient->postRequest($url, $httpOptions);

		$this->updateLocalCustomerDataAfterCreation($httpResponse);

		return $this;
	}

	private function updateLocalCustomerDataAfterCreation($httpResponse) {
		$jsonResponse = json_decode($httpResponse, true);

		$this->_id = $jsonResponse['id'];
		$this->_commerceId = $jsonResponse['commerceId'];
		$this->_companyTenantId = $jsonResponse['companyProfile']['tenantId'];
		$this->_companyDomain = $jsonResponse['companyProfile']['domain'];
		$this->_billingId = $jsonResponse['billingProfile']['id'];

		// new variables returned after customer creation
		$this->_responseBillingProfileEtag = $jsonResponse['billingProfile']['attributes']['etag'];
		$this->_responsePassword = $jsonResponse['userCredentials']['password'];
	}

	private function loadFromDatabase($customerId) {
		// TODO fields to load
		// TODO search for matching record of $customerId
//		$this->_id
//		$this->_commerceId
//		$this->_relationshipToPartner
//		$this->_allowDelegatedAccess
//		$this->_companyTenantId
//		$this->_companyDomain
//		$this->_companyName
//		$this->_billingId
//		$this->_billingFirstName
//		$this->_billingLastName
//		$this->_billingEmail
//		$this->_billingCulture
//		$this->_billingLanguage
//		$this->_billingCompanyName
//		$this->_billingAddressCountry
//		$this->_billingAddressRegion
//		$this->_billingAddressCity
//		$this->_billingAddressState
//		$this->_billingAddressAddressLine1
//		$this->_billingAddressAddressLine2
//		$this->_billingAddressPostalCode
//		$this->_billingAddressFirstName
//		$this->_billingAddressLastName
//		$this->_billingAddressPhoneNumber
//		$this->_username
//		$this->_password
	}

	private function storeToDatabase() {
		// TODO search for existing customer in database
		// TODO if customer exists, update, otherwise create
		// TODO List of fields to store:
//		$this->_id
//		$this->_commerceId
//		$this->_relationshipToPartner
//		$this->_allowDelegatedAccess
//		$this->_companyTenantId
//		$this->_companyDomain
//		$this->_companyName
//		$this->_billingId
//		$this->_billingFirstName
//		$this->_billingLastName
//		$this->_billingEmail
//		$this->_billingCulture
//		$this->_billingLanguage
//		$this->_billingCompanyName
//		$this->_billingAddressCountry
//		$this->_billingAddressRegion
//		$this->_billingAddressCity
//		$this->_billingAddressState
//		$this->_billingAddressAddressLine1
//		$this->_billingAddressAddressLine2
//		$this->_billingAddressPostalCode
//		$this->_billingAddressFirstName
//		$this->_billingAddressLastName
//		$this->_billingAddressPhoneNumber
//		$this->_username
//		$this->_password
	}

	private function buildCustomerDataArrays() {
		// update the object array data
		$this->_companyProfile['TenantId'] = $this->_companyTenantId;
		$this->_companyProfile['Domain'] = $this->_companyDomain . '.onmicrosoft.com';
		$this->_companyProfile['CompanyName'] = $this->_companyName;
		$this->_companyProfile['Attributes'] = array();
		$this->_companyProfile['Attributes']['ObjectType'] = 'CustomerCompanyProfile';
		$this->_billingProfile['Id'] = $this->_billingId;
		$this->_billingProfile['FirstName'] = $this->_billingFirstName;
		$this->_billingProfile['LastName'] = $this->_billingLastName;
		$this->_billingProfile['Email'] = $this->_billingEmail;
		$this->_billingProfile['Culture'] = $this->_billingCulture;
		$this->_billingProfile['Language'] = $this->_billingLanguage;
		$this->_billingProfile['CompanyName'] = $this->_billingCompanyName;
		$this->_billingProfile['DefaultAddress'] = array();
		$this->_billingProfile['DefaultAddress']['Country'] = $this->_billingAddressCountry;
		$this->_billingProfile['DefaultAddress']['Region'] = $this->_billingAddressRegion;
		$this->_billingProfile['DefaultAddress']['City'] = $this->_billingAddressCity;
		$this->_billingProfile['DefaultAddress']['State'] = $this->_billingAddressState;
		$this->_billingProfile['DefaultAddress']['AddressLine1'] = $this->_billingAddressAddressLine1;
		$this->_billingProfile['DefaultAddress']['AddressLine2'] = $this->_billingAddressAddressLine2;
		$this->_billingProfile['DefaultAddress']['PostalCode'] = $this->_billingAddressPostalCode;
		$this->_billingProfile['DefaultAddress']['FirstName'] = $this->_billingAddressFirstName;
		$this->_billingProfile['DefaultAddress']['LastName'] = $this->_billingAddressLastName;
		$this->_billingProfile['DefaultAddress']['PhoneNumber'] = $this->_billingAddressPhoneNumber;
		$this->_billingProfile['Attributes'] = array();
		$this->_billingProfile['Attributes']['ObjectType'] = 'CustomerBillingProfile';
		$this->_userCredentials['userName'] = $this->_username;
		$this->_userCredentials['password'] = $this->_password;
		$this->_attributes['ObjectType'] = 'Customer';
	}

	public function toArray() {
		$this->buildCustomerDataArrays();

		// prepare the data array for transmission
		$data['Id'] = $this->_id;
		$data['CommerceId'] = $this->_commerceId;
		$data['CompanyProfile'] = $this->_companyProfile;
		$data['BillingProfile'] = $this->_billingProfile;
		$data['RelationshipToPartner'] = $this->_relationshipToPartner;
		$data['AllowDelegatedAccess'] = $this->_allowDelegatedAccess;
		$data['UserCredentials'] = $this->_userCredentials;
		$data['Attributes'] = $this->_attributes;
		return $data;
	}

	public function getId() {
		return $this->_id;
	}

	public function setId($id) {
		$this->_id = $id;
		return $this;
	}

	public function getCommerceId() {
		return $this->_commerceId;
	}

	public function setCommerceId($commerceId) {
		$this->_commerceId = $commerceId;
		return $this;
	}

	public function getCompanyProfile() {
		return $this->_companyProfile;
	}

	public function setCompanyProfile($companyProfile) {
		$this->_companyProfile = $companyProfile;
		return $this;
	}

	public function getBillingProfile() {
		return $this->_billingProfile;
	}

	public function setBillingProfile($billingProfile) {
		$this->_billingProfile = $billingProfile;
		return $this;
	}

	public function getRelationshipToPartner() {
		return $this->_relationshipToPartner;
	}

	public function setRelationshipToPartner($relationshipToPartner) {
		$this->_relationshipToPartner = $relationshipToPartner;
		return $this;
	}

	public function getAllowDelegatedAccess() {
		return $this->_allowDelegatedAccess;
	}

	public function setAllowDelegatedAccess($allowDelegatedAccess) {
		$this->_allowDelegatedAccess = $allowDelegatedAccess;
		return $this;
	}

	public function getUserCredentials() {
		return $this->_userCredentials;
	}

	public function setUserCredentials($userCredentials) {
		$this->_userCredentials = $userCredentials;
		return $this;
	}

	public function getAttributes() {
		return $this->_attributes;
	}

	public function setAttributes($attributes) {
		$this->_attributes = $attributes;
		return $this;
	}

	public function getCompanyTenantId() {
		return $this->_companyTenantId;
	}

	public function setCompanyTenantId($companyTenantId) {
		$this->_companyTenantId = $companyTenantId;
		return $this;
	}

	public function getCompanyDomain() {
		return $this->_companyDomain;
	}

	public function setCompanyDomain($companyDomain) {
		$this->_companyDomain = $companyDomain;
		return $this;
	}

	public function getCompanyName() {
		return $this->_companyName;
	}

	public function setCompanyName($companyName) {
		$this->_companyName = $companyName;
		return $this;
	}

	public function getBillingId() {
		return $this->_billingId;
	}

	public function setBillingId($billingId) {
		$this->_billingId = $billingId;
		return $this;
	}

	public function getBillingFirstName() {
		return $this->_billingFirstName;
	}

	public function setBillingFirstName($billingFirstName) {
		$this->_billingFirstName = $billingFirstName;
		return $this;
	}

	public function getBillingLastName() {
		return $this->_billingLastName;
	}

	public function setBillingLastName($billingLastName) {
		$this->_billingLastName = $billingLastName;
		return $this;
	}

	public function getBillingEmail() {
		return $this->_billingEmail;
	}

	public function setBillingEmail($billingEmail) {
		$this->_billingEmail = $billingEmail;
		return $this;
	}

	public function getBillingCulture() {
		return $this->_billingCulture;
	}

	public function setBillingCulture($billingCulture) {
		$this->_billingCulture = $billingCulture;
		return $this;
	}

	public function getBillingLanguage() {
		return $this->_billingLanguage;
	}

	public function setBillingLanguage($billingLanguage) {
		$this->_billingLanguage = $billingLanguage;
		return $this;
	}

	public function getBillingCompanyName() {
		return $this->_billingCompanyName;
	}

	public function setBillingCompanyName($billingCompanyName) {
		$this->_billingCompanyName = $billingCompanyName;
		return $this;
	}

	public function getBillingAddressCountry() {
		return $this->_billingAddressCountry;
	}

	public function setBillingAddressCountry($billingAddressCountry) {
		$this->_billingAddressCountry = $billingAddressCountry;
		return $this;
	}

	public function getBillingAddressRegion() {
		return $this->_billingAddressRegion;
	}

	public function setBillingAddressRegion($billingAddressRegion) {
		$this->_billingAddressRegion = $billingAddressRegion;
		return $this;
	}

	public function getBillingAddressCity() {
		return $this->_billingAddressCity;
	}

	public function setBillingAddressCity($billingAddressCity) {
		$this->_billingAddressCity = $billingAddressCity;
		return $this;
	}

	public function getBillingAddressState() {
		return $this->_billingAddressState;
	}

	public function setBillingAddressState($billingAddressState) {
		$this->_billingAddressState = $billingAddressState;
		return $this;
	}

	public function getBillingAddressAddressLine1() {
		return $this->_billingAddressAddressLine1;
	}

	public function setBillingAddressAddressLine1($billingAddressAddressLine1) {
		$this->_billingAddressAddressLine1 = $billingAddressAddressLine1;
		return $this;
	}

	public function getBillingAddressAddressLine2() {
		return $this->_billingAddressAddressLine2;
	}

	public function setBillingAddressAddressLine2($billingAddressAddressLine2) {
		$this->_billingAddressAddressLine2 = $billingAddressAddressLine2;
		return $this;
	}

	public function getBillingAddressPostalCode() {
		return $this->_billingAddressPostalCode;
	}

	public function setBillingAddressPostalCode($billingAddressPostalCode) {
		$this->_billingAddressPostalCode = $billingAddressPostalCode;
		return $this;
	}

	public function getBillingAddressFirstName() {
		return $this->_billingAddressFirstName;
	}

	public function setBillingAddressFirstName($billingAddressFirstName) {
		$this->_billingAddressFirstName = $billingAddressFirstName;
		return $this;
	}

	public function getBillingAddressLastName() {
		return $this->_billingAddressLastName;
	}

	public function setBillingAddressLastName($billingAddressLastName) {
		$this->_billingAddressLastName = $billingAddressLastName;
		return $this;
	}

	public function getBillingAddressPhoneNumber() {
		return $this->_billingAddressPhoneNumber;
	}

	public function setBillingAddressPhoneNumber($billingAddressPhoneNumber) {
		$this->_billingAddressPhoneNumber = $billingAddressPhoneNumber;
		return $this;
	}

	public function getUsername() {
		return $this->_username;
	}

	public function setUsername($username) {
		$this->_username = $username;
		return $this;
	}

	public function getPassword() {
		return $this->_password;
	}

	public function setPassword($password) {
		$this->_password = $password;
		return $this;
	}
}
