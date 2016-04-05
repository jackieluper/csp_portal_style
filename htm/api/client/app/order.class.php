<?php

/*
{
	"line_items": [
		{
			"line_item_number": 0,
			"offer_uri": "/3c95518e-8c37-41e3-9627-0ca339200f53/offers/84A03D81-6B37-4D66-8D4A-FAEA24541538",
			"quantity": 1,
			"friendly_name": "Basic AD for Office"
		},
		{
			"line_item_number": 1,
			"offer_uri": "/3c95518e-8c37-41e3-9627-0ca339200f53/offers/84A03D81-6B37-4D66-8D4A-FAEA24541538",
			"quantity": 1,
			"friendly_name": "Basic AD for Tech"
		}
	],
	"recipient_customer_id": "5f536fc8-5be0-4fbd-b05c-e1d4c7a868b8"
}
*/

class Order {
	private $_id, $_referenceCustomerId, $_lineItems, $_status, $_creationDate, $_attributes;

	function __construct($customerTid) {
		$this->_id = null;
		$this->_referenceCustomerId = $customerTid;
		$this->_lineItems = array();
		$this->_status = 'none';
		$this->_creationDate = null;
		$this->_attributes = array();
		$this->_attributes['ObjectType'] = 'Order';
		return $this;
	}

	public function addOrderItem($offerId, $friendlyName, $quantity, $partnerIdOnRecord) {
		$orderItem = new OrderItem;
                echo $orderItem;
		$orderItem->
			setLineItemNumber(count($this->_lineItems))->
			setOfferId($offerId)->
			setFriendlyName($friendlyName)->
			setQuantity($quantity)->
			setPartnerIdOnRecord($partnerIdOnRecord);
		$this->_lineItems[] = $orderItem;
	}

	public function submitOrder() {
		$this->requestCreateOrder();
	}

	private function requestCreateOrder() {
		$url = Config::instance()->getApiUrl() . '/customers/' . $this->_referenceCustomerId . '/orders';

		$headerArray[] = 'Accept: application/json';
		$headerArray[] = 'Authorization: Bearer ' . Config::instance()->getAcToken();
		$headerArray[] = 'MS-Contract-Version: v1';
		$headerArray[] = 'MS-RequestId: ' . StringUtil::generateGuid();
		$headerArray[] = 'MS-CorrelationId: ' . StringUtil::generateGuid();
		$headerArray[] = 'Content-Type: application/json';
		$headerArray[] = 'Expect: 100-continue';
		$httpOptions['headers'] = $headerArray;

		$httpOptions['post_json'] = true;
		$httpOptions['post_data'] = $this->toArray();

		$httpClient = new HttpClient();

		$httpResponse = $httpClient->postRequest($url, $httpOptions);
		return $this;
	}

	public function toArray() {
		$data['Id'] = $this->_id;
		$data['ReferenceCustomerId'] = $this->_referenceCustomerId;
		foreach ($this->_lineItems as $lineItem) {
			$data['LineItems'][] = $lineItem->toArray();
		}
		$data['Status'] = $this->_status;
		$data['CreationDate'] = $this->_creationDate;
		$data['Attributes'] = $this->_attributes;
		return $data;
	}
}
