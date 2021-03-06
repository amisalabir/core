<?php

/**
 * This is used for the new (React) client-side code. It provides as much info of the current user, depending on whether
 * they're logged in or not, plus localization strings and other general info.
 */
require_once("library.php");

use FormTools\Core;

Core::init();

$data = array(
    "is_logged_in" => Core::$user->isLoggedIn(),
    "i18n" => Core::$L,
    "constants" => array(
        "root_dir" => Core::getRootDir(),
        "root_url" => Core::getRootUrl(),
        "data_source_url" => Core::getFormToolsDataSource(),
        "core_version" => Core::getCoreVersion()
    )
);
if ($data["is_logged_in"]) {
    $data["user"] = array(
        "account_id" => Core::$user->getAccountId(),
        "username" => Core::$user->getUsername()
    );
}

header("Content-Type: text/javascript");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");

echo json_encode($data);
