<?php

class Subscription {
	private $_id, $_friendlyName, $_quantity, $_unitType, $_parentSubscriptionId, $_creationDate, $_effectiveStartDate,
		$_commitmentEndDate, $_status, $_autoRenewEnabled, $_billingType, $_partnerId, $_contractType, $_links,
		$_offerId, $_offerName, $_orderId, $_attributes, $_suspensionReason, $_customerTenantId;

	function __construct($customerTenantId) {
		$this->_id = '';
		$this->_friendlyName = '';
		$this->_quantity = 0;
		$this->_unitType = 'none';
		$this->_parentSubscriptionId = null;
		$this->_creationDate = '';
		$this->_effectiveStartDate = '';
		$this->_commitmentEndDate = '';
		$this->_status = 'active';
		$this->_autoRenewEnabled = false;
		$this->_billingType = 'none';
		$this->_partnerId = null;
		$this->_contractType = 'subscription';
		$this->_links = array();
		$this->_links['offer'] = array();
		$this->_links['offer']['uri'] = '/v1/offers/';
		$this->_links['offer']['method'] = 'GET';
		$this->_links['offer']['headers'] = array();
		$this->_links['entitlement'] = array();
		$this->_links['entitlement']['uri'] = '/entitlements?key=';
		$this->_links['entitlement']['method'] = 'GET';
		$this->_links['entitlement']['headers'] = array();
		$this->_links['self'] = array();
		$this->_links['self']['uri'] = '/subscriptions?key=';
		$this->_links['self']['method'] = 'GET';
		$this->_links['self']['headers'] = array();
		$this->_offerId = '';
		$this->_offerName = '';
		$this->_orderId = '';
		$this->_attributes = array();
		$this->_attributes['etag'] = '';
		$this->_attributes['objectType'] = 'Subscription';
		$this->_suspensionReason = null;
		$this->_customerTenantId = $customerTenantId;
		return $this;
	}

	public function getSubscriptionList() {
		return $this->requestSubscriptionList();
	}

	private function requestSubscriptionList() {
		$url = Config::instance()->getApiUrl() . '/customers/' . $this->_customerTenantId . '/subscriptions';

		$headerArray[] = 'Authorization: Bearer ' . Config::instance()->getAcToken();
		$headerArray[] = 'Accept: application/json';
		$headerArray[] = 'MS-Contract-Version: v1';
		$headerArray[] = 'MS-RequestId: ' . StringUtil::generateGuid();
		$headerArray[] = 'MS-CorrelationId: ' . StringUtil::generateGuid();
		$headerArray[] = 'Connection: Keep-Alive';
		$httpOptions['headers'] = $headerArray;

		$httpOptions['strip_bom'] = 1;

		$httpClient = new HttpClient();

		$httpResponse = $httpClient->getRequest($url, $httpOptions);
		$jsonResponse = json_decode($httpResponse, true);

		$subscriptionList = array();
		$totalCount = $jsonResponse['totalCount'];

		if (intval($totalCount) > 0) {
			foreach ($jsonResponse['items'] as $item) {
				$subscription = new Subscription($this->_customerTenantId);
				$subscription->fromJson($item);
				$subscriptionList[] = $subscription;
			}
		}

		return $subscriptionList;
	}

	public function getAddOnList() {
		return $this->requestAddOnList();
	}

	private function requestAddOnList() {
		$url = Config::instance()->getApiUrl() . '/customers/' . $this->_customerTenantId . '/subscriptions/' . $this->_id . '/addons';

		$headerArray[] = 'Authorization: Bearer ' . Config::instance()->getAcToken();
		$headerArray[] = 'Accept: application/json';
		$headerArray[] = 'MS-Contract-Version: v1';
		$headerArray[] = 'MS-RequestId: ' . StringUtil::generateGuid();
		$headerArray[] = 'MS-CorrelationId: ' . StringUtil::generateGuid();
		$headerArray[] = 'Connection: Keep-Alive';
		$httpOptions['headers'] = $headerArray;

		$httpOptions['strip_bom'] = 1;

		$httpClient = new HttpClient();

		$httpResponse = $httpClient->getRequest($url, $httpOptions);
		$jsonResponse = json_decode($httpResponse, true);

		$addonList = array();
		$totalCount = $jsonResponse['totalCount'];

		if (intval($totalCount) > 0) {
			foreach ($jsonResponse['items'] as $item) {
				$subscription = new Subscription($this->_customerTenantId);
				$subscription->fromJson($item);
				$addonList[] = $subscription;
			}
		}

		return $addonList;
	}

	public function loadSubscription($subscriptionId) {
		$this->_id = $subscriptionId;

		return $this->requestLoadSubscription();
	}

	private function requestLoadSubscription() {
		$url = Config::instance()->getApiUrl() . '/customers/' . $this->_customerTenantId . '/subscriptions/' . $this->_id;

		$headerArray[] = 'Authorization: Bearer ' . Config::instance()->getAcToken();
		$headerArray[] = 'Accept: application/json';
		$headerArray[] = 'MS-Contract-Version: v1';
		$headerArray[] = 'MS-RequestId: ' . StringUtil::generateGuid();
		$headerArray[] = 'MS-CorrelationId: ' . StringUtil::generateGuid();
		$headerArray[] = 'Connection: Keep-Alive';
		$httpOptions['headers'] = $headerArray;

		$httpOptions['strip_bom'] = 1;

		$httpClient = new HttpClient();

		$httpResponse = $httpClient->getRequest($url, $httpOptions);
		$jsonResponse = json_decode($httpResponse, true);

		$this->fromJson($jsonResponse);

		return $this;
	}

	public function updateFriendlyName($friendlyName, $subscriptionId = null) {
		if (isset($subscriptionId)) {
			$this->_id = $subscriptionId;
		}

		$this->requestLoadSubscription();

		$this->_friendlyName = $friendlyName;

		return $this->requestPatch();
	}

	public function updateQuantity($quantity, $subscriptionId = null) {
		if (isset($subscriptionId)) {
			$this->_id = $subscriptionId;
		}

		$this->requestLoadSubscription();

		$this->_quantity = $quantity;

		return $this->requestPatch();
	}

	public function suspendSubscription($subscriptionId = null) {
		if (isset($subscriptionId)) {
			$this->_id = $subscriptionId;
		}

		$this->requestLoadSubscription();

		$this->_status = 'suspended';
		$this->_suspensionReason = 'CustomerCancellation';

		return $this->requestPatch();
	}

	public function resumeSubscription($subscriptionId = null) {
		if (isset($subscriptionId)) {
			$this->_id = $subscriptionId;
		}

		$this->requestLoadSubscription();

		$this->_status = 'active';
		$this->_suspensionReason = null;

		return $this->requestPatch();
	}

	private function requestPatch() {
		$url = Config::instance()->getApiUrl() . '/customers/' . $this->_customerTenantId . '/subscriptions/' . $this->_id;

		$headerArray[] = 'Authorization: Bearer ' . Config::instance()->getAcToken();
		$headerArray[] = 'Accept: application/json';
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

		$httpResponse = $httpClient->patchRequest($url, $httpOptions);

		return $this;
	}

	public function getId() {
		return $this->_id;
	}

	public function setId($id) {
		$this->_id = $id;
		return $this;
	}

	public function getFriendlyName() {
		return $this->_friendlyName;
	}

	public function setFriendlyName($friendlyName) {
		$this->_friendlyName = $friendlyName;
		return $this;
	}

	public function getQuantity() {
		return $this->_quantity;
	}

	public function setQuantity($quantity) {
		$this->_quantity = $quantity;
		return $this;
	}

	public function getUnitType() {
		return $this->_unitType;
	}

	public function setUnitType($unitType) {
		$this->_unitType = $unitType;
		return $this;
	}

	public function getParentSubscriptionId() {
		return $this->_parentSubscriptionId;
	}

	public function setParentSubscriptionId($parentSubscriptionId) {
		$this->_parentSubscriptionId = $parentSubscriptionId;
		return $this;
	}

	public function 
                CreationDate() {
		return $this->_creationDate;
	}

	public function setCreationDate($creationDate) {
		$this->_creationDate = $creationDate;
		return $this;
	}

	public function getEffectiveStartDate() {
		return $this->_effectiveStartDate;
	}

	public function setEffectiveStartDate($effectiveStartDate) {
		$this->_effectiveStartDate = $effectiveStartDate;
		return $this;
	}

	public function getCommitmentEndDate() {
		return $this->_commitmentEndDate;
	}

	public function setCommitmentEndDate($commitmentEndDate) {
		$this->_commitmentEndDate = $commitmentEndDate;
		return $this;
	}

	public function getStatus() {
		return $this->_status;
	}

	public function setStatus($status) {
		$this->_status = $status;
		return $this;
	}

	public function isAutoRenewEnabled() {
		return $this->_autoRenewEnabled;
	}

	public function setAutoRenewEnabled($autoRenewEnabled) {
		$this->_autoRenewEnabled = $autoRenewEnabled;
		return $this;
	}

	public function getBillingType() {
		return $this->_billingType;
	}

	public function setBillingType($billingType) {
		$this->_billingType = $billingType;
		return $this;
	}

	public function getPartnerId() {
		return $this->_partnerId;
	}

	public function setPartnerId($partnerId) {
		$this->_partnerId = $partnerId;
		return $this;
	}

	public function getContractType() {
		return $this->_contractType;
	}

	public function setContractType($contractType) {
		$this->_contractType = $contractType;
		return $this;
	}

	public function getLinks() {
		return $this->_links;
	}

	public function setLinks($links) {
		$this->_links = $links;
		return $this;
	}

	public function getOrderId() {
		return $this->_orderId;
	}

	public function setOrderId($orderId) {
		$this->_orderId = $orderId;
		return $this;
	}

	public function getAttributes() {
		return $this->_attributes;
	}

	public function setAttributes($attributes) {
		$this->_attributes = $attributes;
		return $this;
	}

	public function getCustomerTenantId() {
		return $this->_customerTenantId;
	}

	public function setCustomerTenantId($customerTenantId) {
		$this->_customerTenantId = $customerTenantId;
		return $this;
	}

	public function getOfferId() {
		return $this->_offerId;
	}

	public function setOfferId($offerId) {
		$this->_offerId = $offerId;
		return $this;
	}

	public function getOfferName() {
		return $this->_offerName;
	}

	public function setOfferName($offerName) {
		$this->_offerName = $offerName;
		return $this;
	}

	public function getSuspensionReason() {
		return $this->_suspensionReason;
	}

	public function setSuspensionReason($suspensionReason) {
		$this->_suspensionReason = $suspensionReason;
		return $this;
	}

	public function getSuspensionReasonComment() {
		return $this->_suspensionReasonComment;
	}

	public function setSuspensionReasonComment($suspensionReasonComment) {
		$this->_suspensionReasonComment = $suspensionReasonComment;
		return $this;
	}

	private function fromJson($rawJson) {
		if (!isset($rawJson['id'])) {
			return false;
		}

		$this->_id = $rawJson['id'];
		$this->_attributes['etag'] = $rawJson['attributes']['etag'];
		$this->_attributes['objectType'] = $rawJson['attributes']['objectType'];
		$this->_autoRenewEnabled = $rawJson['autoRenewEnabled'];
		$this->_billingType = $rawJson['billingType'];
		$this->_commitmentEndDate = $rawJson['commitmentEndDate'];
		$this->_contractType = $rawJson['contractType'];
		$this->_creationDate = $rawJson['creationDate'];
		$this->_effectiveStartDate = $rawJson['effectiveStartDate'];
		$this->_friendlyName = $rawJson['friendlyName'];
		$this->_links['offer']['method'] = $rawJson['links']['offer']['method'];
		$this->_links['offer']['uri'] = $rawJson['links']['offer']['uri'];
		$this->_links['self']['method'] = $rawJson['links']['self']['method'];
		$this->_links['self']['uri'] = $rawJson['links']['self']['uri'];
		$this->_offerId = $rawJson['offerId'];
		$this->_offerName = $rawJson['offerName'];
		$this->_orderId = $rawJson['orderId'];
		$this->_quantity = $rawJson['quantity'];
		$this->_status = $rawJson['status'];
		$this->_unitType = $rawJson['unitType'];

		if (isset($rawJson['links']['entitlement']['method']) && isset($rawJson['links']['entitlement']['uri'])) {
			$this->_links['entitlement']['method'] = $rawJson['links']['entitlement']['method'];
			$this->_links['entitlement']['uri'] = $rawJson['links']['entitlement']['uri'];
		} else {
			$this->_links['entitlement'] = null;
		}

		if (isset($rawJson['parentSubscriptionId'])) {
			$this->_parentSubscriptionId = $rawJson['parentSubscriptionId'];
		} else {
			$this->_parentSubscriptionId = null;
		}

		if (isset($rawJson['partnerId'])) {
			$this->_partnerId = $rawJson['partnerId'];
		} else {
			$this->_partnerId = null;
		}

		return true;
	}

	public function toArray() {
		$data = array();
		$data['id'] = $this->_id;
		$data['attributes'] = array();
		$data['attributes']['etag'] = $this->_attributes['etag'];
		$data['attributes']['objectType'] = $this->_attributes['objectType'];
		$data['autoRenewEnabled'] = $this->_autoRenewEnabled;
		$data['billingType'] = $this->_billingType;
		$data['commitmentEndDate'] = $this->_commitmentEndDate;
		$data['contractType'] = $this->_contractType;
		$data['creationDate'] = $this->_creationDate;
		$data['effectiveStartDate'] = $this->_effectiveStartDate;
		$data['friendlyName'] = $this->_friendlyName;
		$data['links'] = array();
		$data['links']['offer'] = array();
		$data['links']['offer']['method'] = $this->_links['offer']['method'];
		$data['links']['offer']['uri'] = $this->_links['offer']['uri'];
		$data['links']['self'] = array();
		$data['links']['self']['method'] = $this->_links['self']['method'];
		$data['links']['self']['uri'] = $this->_links['self']['uri'];
		$data['offerId'] = $this->_offerId;
		$data['offerName'] = $this->_offerName;
		$data['orderId'] = $this->_orderId;
		$data['quantity'] = $this->_quantity;
		$data['status'] = $this->_status;
		$data['unitType'] = $this->_unitType;

		if (isset($rawJson['links']['entitlement']['method']) && isset($rawJson['links']['entitlement']['uri'])) {
			$data['links']['entitlement'] = array();
			$data['links']['entitlement']['method'] = $this->_links['entitlement']['method'];
			$data['links']['entitlement']['uri'] = $this->_links['entitlement']['uri'];
		} else {
			$data['links']['entitlement'] = null;
		}

		if (isset($this->_parentSubscriptionId)) {
			$data['parentSubscriptionId'] = $this->_parentSubscriptionId;
		} else {
			$data['parentSubscriptionId'] = null;
		}

		if (isset($this->_partnerId)) {
			$data['partnerId'] = $this->_partnerId;
		} else {
			$data['partnerId'] = null;
		}

		if (isset($this->_suspensionReason)) {
			$data['suspensionReasons'] = array();
			$data['suspensionReasons'][] = $this->_suspensionReason;
		}

		return $data;
	}
}
