<?php
require_once '_init.php';
$oauth = new PartnerCenterAuth();
?>
<html>
<head>
	<title>BP</title>
</head>
<body>
	<p>Please <a href="<?php echo $oauth->getAuthUrl() ?>">sign in</a> with your Microsoft account.</p>
</body>
</html>
