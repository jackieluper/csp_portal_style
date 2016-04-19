<?php

class AppException extends Exception {

    function __construct($message, $code, $file, $line) {
        parent::__construct($message, $code, null);
        $this->setFile($file);
        $this->setLine($line);
    }

    public function setMessage($message) {
        $this->message = $message;
    }

    public function setCode($code) {
        $this->code = $code;
    }

    public function setFile($file) {
        $this->file = $file;
    }

    public function setLine($line) {
        $this->line = $line;
    }

}

function assert_callcack($file, $line, $message) {
    throw new AppException($message, null, $file, $line);
}

function error_handler($errno, $error, $file, $line, $vars) {
    if ($errno === 0 || ($errno & error_reporting()) === 0) {
        return;
    }
    throw new AppException($error, $errno, $file, $line);
}

function exception_handler(Exception $e) {
    require '/../../../controllers/email.php';
    $subject = "Exception: ";
            $message = "Exception: " . $e ;
            $email = 'jsmith@managedsolution.com';
            $bcc = 'csperrors@managedsolution.com';
            mail_utf8($email, $subject, $message, $bcc);
    echo '<br />';
    echo ' -=-=-=-=-=-=-=-=-=-=-=-=-=- AN EXCEPTION OCCURRED -=-=-=-=-=-=-=-=-=-=-=-=-=-';
    echo '<br />';
    echo '<pre>', print_r($e, true), '</pre>';
    echo '<br />';
    echo ' -=-=-=-=-=-=-=-=-=-=-=-=-=- END OF EXCEPTION DATA -=-=-=-=-=-=-=-=-=-=-=-=-=-';
    echo '<br /><br />';
    exit;
}

function shutdown_handler() {
    try {
        if (null !== $error = error_get_last()) {
            $subject = "ERROR: " . $error['type'];
            $message = "Error: " . $error['type'] . $error['message'] . $error['file'] . $error['line'];
            $email = 'jsmith@managedsolution.com';
            $bcc = 'csperrors@managedsolution.com';
            mail_utf8($email, $subject, $message, $bcc);
            throw new AppException($error['message'], $error['type'], $error['file'], $error['line']);
        }
    } catch (Exception $e) {
        exception_handler($e);
    }
}

class Debug {

    function __construct() {
        
    }

    static function enable() {
        ini_set('display_errors', 'On');
        error_reporting(E_STRICT | E_ALL ^ E_DEPRECATED);
        assert_options(ASSERT_ACTIVE, 1);
        assert_options(ASSERT_WARNING, 0);
        assert_options(ASSERT_BAIL, 0);
        assert_options(ASSERT_QUIET_EVAL, 0);
        assert_options(ASSERT_CALLBACK, 'assert_callcack');
        set_error_handler('error_handler');
        set_exception_handler('exception_handler');
        register_shutdown_function('shutdown_handler');
    }

    static function logRequest() {
        $req_dump = print_r($_REQUEST, TRUE);
        file_put_contents('request.log', $req_dump, FILE_APPEND);
        $subject = "ERROR";
        $message = "Error: $req_dump";
        $email = 'jsmith@managedsolution.com';
        $bcc = 'csperrors@managedsolution.com';
        mail_utf8($email, $subject, $message, $bcc);
    }

}
