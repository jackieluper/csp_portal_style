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

class OrderItem {
	private $_lineItemNumber, $_offerId, $_referencedEntitlementUris, $_friendlyName, $_quantity, $_partnerIdOnRecord, $_links;

	function __construct() {
		$this->_lineItemNumber = 0;
		$this->_offerId = '';
		$this->_referencedEntitlementUris = null;
		$this->_friendlyName = '';
		$this->_quantity = 0;
		$this->_partnerIdOnRecord = null;
		$this->_links = new stdClass();
		return $this;
	}

	public function getLineItemNumber() {
		return $this->_lineItemNumber;
	}

	public function setLineItemNumber($lineItemNumber) {
		$this->_lineItemNumber = $lineItemNumber;
		return $this;
	}

	public function getOfferId() {
		return $this->_offerId;
	}

	public function setOfferId($offerId) {
		$this->_offerId = $offerId;
		return $this;
	}

	public function getReferencedEntitlementUris() {
		return $this->_referencedEntitlementUris;
	}

	public function setReferencedEntitlementUris($referencedEntitlementUris) {
		$this->_referencedEntitlementUris = $referencedEntitlementUris;
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

	public function getPartnerIdOnRecord() {
		return $this->_partnerIdOnRecord;
	}

	public function setPartnerIdOnRecord($partnerIdOnRecord) {
		$this->_partnerIdOnRecord = $partnerIdOnRecord;
		return $this;
	}

	public function getLinks() {
		return $this->_links;
	}

	public function setLinks($links) {
		$this->_links = $links;
		return $this;
	}

	public function toArray() {
		$data['LineItemNumber'] = $this->_lineItemNumber;
		$data['OfferId'] = $this->_offerId;
		$data['ReferencedEntitlementUris'] = $this->_referencedEntitlementUris;
		$data['FriendlyName'] = $this->_friendlyName;
		$data['Quantity'] = $this->_quantity;
		$data['PartnerIdOnRecord'] = $this->_partnerIdOnRecord;
		$data['Links'] = $this->_links;
		return $data;
	}
}
