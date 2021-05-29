<?php
session_start();
const USER_ROLES = ["MANAGER" => 1, "PARTNER" => 2];

define('ROOT', $_SERVER['DOCUMENT_ROOT']);

const CORE_PATH = ROOT . "/core/";
const APPS_PATH = ROOT . "/apps/";
const COMPONENT_PATH = ROOT . "/components/";
const TEMPLATE_PATH = ROOT . "/templates/";

const ASSETS_URI = "/assets/";
const CSS_URI = ASSETS_URI . "css/";
const JS_URI = ASSETS_URI . "js/";
const IMG_URI = ASSETS_URI . "images/";
const FONTS_URI = ASSETS_URI . "fonts/";

require_once("db.php");
require_once("route.php");

require_once CORE_PATH . 'Model.php';
require_once CORE_PATH . 'View.php';
require_once CORE_PATH . 'Functions.php';
require_once CORE_PATH . 'Controller.php';
require_once CORE_PATH . 'Component.php';


Route::buildRoute();