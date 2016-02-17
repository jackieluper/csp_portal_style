- SETTINGS -
# your profile is created automatically
PUT /profile
GET /profile
	First Name
	Last Name
	Email Address
	Phone Number
	Mailing Address
	Profile Picture

- ADD / LIST CONTACTS -
GET /contact
POST /contact
DELETE /contact
	ID
	Email

- BLANK / RECENT / EDIT SUBJECT CONVERSATION -
# order conversations by date
GET /conversation
GET /conversation/:id
PUT /conversation/:id
POST /conversation
	Conversation ID List
	Message ID List
	Conversation Subject
	Other Party (Sender / Recipient)
	Last Message
	Date / Time

- SEND / LIST MESSAGES -
GET /message/:id
POST /message
	Conversation ID
	Message Text
	Person Picture
	Person Name
	Attachments

- ATTACH FILE -
GET /file/:id
POST /file

- CHANGE PASSWORD -
POST /password

Fix Page Reload Bug with Inbox

=-=-=-=-=-=-=-=-=- DONE -=-=-=-=-=-=-=-=-=-=

- LOGIN / LOGOUT -
GET /session
POST /session
DELETE /session
	Code
	Password
