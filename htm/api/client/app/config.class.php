<?php

//	private static $_ssoUrl = 'http://src.bz/hosted/bp/';
//	private static $_ssoAppIdUri = 'http://src.bz/bp_app_id';
//	private static $_ssoReplyUrl = 'http://src.bz/hosted/bp/authorize.php';
//	private static $_tenantId = '8b32ccee-76a0-4bce-ba67-7f69d06f82f3';
//	private static $_clientId = '8279af7c-afae-4ed5-aac3-9ee9d637c578';
//	private static $_clientSecret = 'cRAMZ4XBdcxZTdV+YpMQNyqMdP0XTQKOjroQvahrdiw=';
//	self::$_scopes = array('');
//	self::$_msoAuth = 'https://login.microsoftonline.com/';
//	self::$_winAuth = 'https://login.windows.net/';
//	self::$_apiAuth = 'https://graph.windows.net/';
//	self::$_fedData = self::$_winAuth . self::$_tenantId . '/FederationMetadata/2007-06/FederationMetadata.xml';
//	self::$_wsFedSignOn = self::$_msoAuth . self::$_tenantId . '/wsfed';
//	self::$_samlpSignOn = self::$_msoAuth . self::$_tenantId . '/saml2';
//	self::$_samlpSignOut = self::$_msoAuth . self::$_tenantId . '/saml2';
//	self::$_commonOauth2Auth = self::$_msoAuth . 'common/oauth2/authorize';
//	self::$_commonOauth2Token = self::$_msoAuth . 'common/oauth2/token';
//	self::$_oauth2Auth = self::$_msoAuth . self::$_tenantId . '/oauth2/authorize';
//	self::$_oauth2Token = self::$_msoAuth . self::$_tenantId . '/oauth2/token';
//	self::$_oauth2AuthQuery = '?response_type=code&prompt=login&client_id=%1$s&redirect_uri=%2$s&state=%3$s';
//	self::$_graphApi = self::$_apiAuth . self::$_tenantId;

// https://msdn.microsoft.com/en-us/library/partnercenter/mt634709.aspx
final class Config {
	private $_apiBaseUrl, $_apiUrl, $_redirectUri, $_tenantId, $_clientId, $_clientSecret, $_tenantName, $_adTokenUrl,
		$_acTokenUrl, $_adTokenCommonUrl, $_resourceUrl, $_partnerCenterAuth, $_webClientId, $_loginUrl;

	protected function __construct() {
		$this->useCredentialsSandbox();
		// $this->useCredentialsProduction();
		$this->_partnerCenterAuth = new PartnerCenterAuth();
	}

	private function useCredentialsSandbox() {
		$this->_redirectUri = 'http://localhost';
		$this->_tenantId = '22e38d40-62cb-47c4-afdf-19421c5522c0';
		$this->_clientId = 'c9d95c0e-8d97-4bba-b3a1-05bad83f7300';
		$this->_webClientId = '3e2eebc8-d054-4e1c-a934-a384cad4b0f9';
		$this->_clientSecret = 'RqK2qX3TEFfTMrluU3BRQh0lKhgsvbaVqbyZvmax/3g=';
		$this->_tenantName = 'managedsolutioncsptesting.onmicrosoft.com';
		$this->_loginUrl = "https://login.windows.net/common/oauth2/authorize?response_type=code&resource=https%3A%2F%2Fgraph.windows.net&client_id=$this->_webClientId&redirect_uri=http%3A%2F%2Fwww.msolcsptest.com%2Fauthorize_ad.php";
		$this->useDefaultUris();
	}

//	private function useCredentialsProduction() {
//		$this->_tenantId = '22e38d40-62cb-47c4-afdf-19421c5522c0';
//		$this->_clientId = 'c9d95c0e-8d97-4bba-b3a1-05bad83f7300';
//		$this->_clientSecret = 'RqK2qX3TEFfTMrluU3BRQh0lKhgsvbaVqbyZvmax/3g=';
//		$this->_tenantName = 'managedsolutioncsptesting.onmicrosoft.com';
//		$this->_redirectUri = 'http://billing.managedsolution.com/authorize.php';
//		$this->useDefaultUris();
//	}

	private function useDefaultUris() {
		$this->_apiBaseUrl = 'https://api.partnercenter.microsoft.com';
		$this->_apiUrl = $this->_apiBaseUrl . '/v1';
		$this->_adTokenUrl = "https://login.microsoftonline.com/$this->_tenantName/oauth2/token?api-version=1.0";
		$this->_adTokenCommonUrl = "https://login.microsoftonline.com/common/oauth2/token?api-version=1.0";
		$this->_resourceUrl = 'https://graph.windows.net';
		$this->_acTokenUrl = "$this->_apiBaseUrl/generatetoken";
	}

	public static function instance() {
		static $instance = null;
		if ($instance === null) {
			$instance = new Config();
		}

		return $instance;
	}

	public function getApiBaseUrl() {
		return $this->_apiBaseUrl;
	}

	public function setApiBaseUrl($apiUrl) {
		$this->_apiBaseUrl = $apiUrl;
		return $this;
	}

	public function getApiUrl() {
		return $this->_apiUrl;
	}

	public function setApiUrl($apiUrl) {
		$this->_apiUrl = $apiUrl;
	}

	public function getAdToken() {
		return $this->_partnerCenterAuth->getAdToken();
	}

	public function getAcToken() {
		return $this->_partnerCenterAuth->getAcToken();
	}

	public function getAdTokenCommonUrl() {
		return $this->_adTokenCommonUrl;
	}

	public function setAdTokenCommonUrl($authTokenCommonUrl) {
		$this->_adTokenCommonUrl = $authTokenCommonUrl;
		return $this;
	}

	public function getRedirectUri() {
		return $this->_redirectUri;
	}

	public function setRedirectUri($redirectUri) {
		$this->_redirectUri = $redirectUri;
	}

	public function getTenantId() {
		return $this->_tenantId;
	}

	public function setTenantId($tenantId) {
		$this->_tenantId = $tenantId;
	}

	public function getClientId() {
		return $this->_clientId;
	}

	public function setClientId($clientId) {
		$this->_clientId = $clientId;
	}

	public function getClientSecret() {
		return $this->_clientSecret;
	}

	public function setClientSecret($clientSecret) {
		$this->_clientSecret = $clientSecret;
	}

	public function getTenantName() {
		return $this->_tenantName;
	}

	public function setTenantName($tenantName) {
		$this->_tenantName = $tenantName;
	}

	public function getAdTokenUrl() {
		return $this->_adTokenUrl;
	}

	public function setAdTokenUrl($authorityUrl) {
		$this->_adTokenUrl = $authorityUrl;
	}

	public function getResourceUrl() {
		return $this->_resourceUrl;
	}

	public function setResourceUrl($resourceUrl) {
		$this->_resourceUrl = $resourceUrl;
	}

	public function getAcTokenUrl() {
		return $this->_acTokenUrl;
	}

	public function setAcTokenUrl($acTokenUrl) {
		$this->_acTokenUrl = $acTokenUrl;
	}

	public function getLoginUrl() {
		return $this->_loginUrl;
	}

	public function setLoginUrl($loginUrl) {
		$this->_loginUrl = $loginUrl;
		return $this;
	}

	function __wakeup() {
	}

	private function __clone() {
	}
}
