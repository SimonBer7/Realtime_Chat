<?php

function logError($message, $endpoint = '')
{
    $error_message = date('Y-m-d H:i:s') . " - Error: $message";
    if (!empty($endpoint)) {
        $error_message .= " - Endpoint: $endpoint";
    }
    error_log($error_message . "\n", 3, 'logs/error.log');
}

function logInfo($message, $endpoint = '')
{
    $info_message = date('Y-m-d H:i:s') . " - Info: $message";
    if (!empty($endpoint)) {
        $info_message .= " - Endpoint: $endpoint";
    }
    error_log($info_message . "\n", 3, 'logs/info.log');
}
?>
