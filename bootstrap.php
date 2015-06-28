<?php
session_start();

chdir(__DIR__);

function exception_error_handler($severity, $message, $file, $line) {
    if (!(error_reporting() & $severity)) {
        // This error code is not included in error_reporting
        return;
    }
    throw new ErrorException($message, 0, $severity, $file, $line);
}
("exception_error_handler");

include 'classes/File.php';
include 'classes/DB.php';
include 'classes/View.php';
