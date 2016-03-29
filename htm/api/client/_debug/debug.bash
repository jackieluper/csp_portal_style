#!/usr/bin/env bash

# INITIAL SETUP
# https://msdn.microsoft.com/en-us/library/partnercenter/mt634709.aspx

redirectUri='http://localhost';
tenantId='22e38d40-62cb-47c4-afdf-19421c5522c0';
clientId='c9d95c0e-8d97-4bba-b3a1-05bad83f7300';
clientSecret='RqK2qX3TEFfTMrluU3BRQh0lKhgsvbaVqbyZvmax/3g=';
tenantName='managedsolutioncsptesting.onmicrosoft.com';

authorityUrl="https://login.microsoftonline.com/${tenantName}/oauth2/token?api-version=1.0";
resourceUrl='https://graph.windows.net';

apiUrl='https://api.partnercenter.microsoft.com';

getAdToken() {
	curl -s -X "POST" "${authorityUrl}" \
	-H "api-version: 2015-03-31" \
	-H "Content-Type: application/x-www-form-urlencoded" \
	-H "Accept: application/json" \
	--data-urlencode "resource=${resourceUrl}" \
	--data-urlencode "client_id=${clientId}" \
	--data-urlencode "client_secret=${clientSecret}" \
	--data-urlencode "grant_type=client_credentials";
}

getAcToken() {
	curl -s -X "POST" "${apiUrl}/generatetoken" \
	-H "ContentType: application/x-www-form-urlencoded" \
	-H "Authorization: Bearer ${adToken}" \
	--data-urlencode "grant_type=jwt_token";
}

uuid1=$(uuidgen);
uuid2=$(uuidgen);
uuid3=$(uuidgen);
uuid4=$(uuidgen);

regenerateTokens() {
	adToken=$(getAdToken | jsawk 'return this.access_token' | awk '{print $1}');
	echo ${adToken} > adtoken
	acToken=$(getAcToken | jsawk 'return this.access_token' | awk '{print $1}');
	echo ${acToken} > actoken
}

loadTokens() {
	adToken=$(cat adtoken)
	acToken=$(cat actoken)
}

listOffers() {
	curl -v -X "GET" "${apiUrl}/v1/offers?country=US" \
	-H "Accept: application/json" \
	-H "Authorization: Bearer ${acToken}";
}

createCustomer() {
	curl -X "POST" "https://api.cp.microsoft.com/${saId}/customers/create-reseller-customer" \
	-H "Authorization: Bearer ${saToken}" \
	-H "x-ms-tracking-id: ${uuid1}" \
	-H "x-ms-correlation-id: ${uuid2}" \
	-H "api-version: 2015-03-31" \
	-H 'Accept: application/json' \
	-H 'Content-Type: application/json' \
	-d @create_customer.json;
}

loadCustomerById() {
	local tid="$1";
	local etid="$2";
	local eoid="$3";

	curl -X "GET" "https://api.cp.microsoft.com/customers/get-by-identity?provider=AAD&type=external_group&tid=${tid}&etid=${etid}&eoid=${eoid}" \
	-H "Authorization: Bearer ${saToken}" \
	-H "x-ms-tracking-id: ${uuid3}" \
	-H "x-ms-correlation-id: ${uuid4}" \
	-H "api-version: 2015-03-31" \
	-H 'Accept: application/json';
}

loadOrders() {
	local cidReseller="$1";
	local cidCustomer="$2";

	curl -X "GET" "https://api.cp.microsoft.com/${cidReseller}/orders?recipient_customer_id=${cidCustomer}" \
	-H "Authorization: Bearer ${saToken}" \
	-H "x-ms-tracking-id: ${uuid1}" \
	-H "x-ms-correlation-id: ${uuid2}" \
	-H "api-version: 2015-03-31" \
	-H 'Accept: application/json';
}

createOrder() {
	local customerTid="$1";

	curl -v -X "POST" "https://api.partnercenter.microsoft.com/v1/customers/${customerTid}/orders" \
	-H "Authorization: Bearer ${acToken}" \
	-H 'Accept: application/json' \
	-H 'MS-Contract-Version: v1' \
	-H "MS-RequestId: ${uuid3}" \
	-H "MS-CorrelationId: ${uuid4}" \
	-H 'Content-Type: application/json' \
	-H 'Expect: 100-continue' \
	-d @create_order.json
}

regenerateTokens;
loadTokens;

# listOffers;

createOrder "95e724ab-3834-4d4d-a5f9-6bc725a4d87d";


# --- OLD CODE ---

# createCustomer
# customer.id
# customer.identity.data.eoid
# customer.identity.data.etid
# customer.identity.data.tid

# loadCustomerById "6915f401-5999-4df8-bfa2-7c256589f717" "22e38d40-62cb-47c4-afdf-19421c5522c0" "2d4b8415-3d6e-4a23-bbb5-c9dbc9e51b83"

# loadOrders "${tenantId}" "5f536fc8-5be0-4fbd-b05c-e1d4c7a868b8"

# createOrder "${tenantId}";


