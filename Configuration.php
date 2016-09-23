<?php

/**
 * Debug mode set false for production
 */
define("DEBUG_MODE", true);

/**
 * Application Data
 */
define("APP_TITLE", "PANOSONIC");
define("CMS_TITLE", "CMS PANASONIC");

/**
 * File Application Prefix
 */
define("FILE_PREFIX", "");

/**
 * Database Configuration Parameters
 */
define("DATABASE_SERVER", "localhost");
define("DATABASE_PORT", "3306");
define("DATABASE_NAME", "panasonic");
define("DATABASE_USERNAME", "root");
define("DATABASE_PASSWORD", "");
define("DATABASE_PREFIX", "");

/**
 * Email Settings
 */
define("EMAIL_HOST", "mail.hobesoundequestrianfarms.com");
define("EMAIL_PORT", "25");
define("EMAIL_FROM", "no-reply");
define("EMAIL_USERNAME", "daniel@qwerty.com.bo");
define("EMAIL_PASSWORD", "qwerty.123.");
define("EMAIL_AUTH", true);
define("EMAIL_TYPE", "smtp");

/**
 * Registries State Type
 */
define("ACTION_NONE", "None");
define("ACTION_INSERT", "Insert");
define("ACTION_UPDATE", "Update");
define("ACTION_DELETE", "Delete");

/**
 * Time Zone Configuration
 */
date_default_timezone_set('America/La_Paz');

/**
 * Messages Types
 */
define('MESSAGE_EXCLAMATION', 'Exclamation');
define('MESSAGE_WARNING', 'Warning');
define('MESSAGE_INFORMATION', 'Information');
