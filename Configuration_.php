<?php

/**
 * Debug mode set false for production
 */
define("DEBUG_MODE", true);

/**
 * Application Data
 */
define("APP_TITLE", "FID");

/**
 * File Application Prefix
 */
define("FILE_PREFIX", "");

/**
 * Database Configuration Parameters
 */
define("DATABASE_SERVER", "localhost");
define("DATABASE_PORT", "3306");
define("DATABASE_NAME", "karenhe1_fid");
define("DATABASE_USERNAME", "karenhe1_fid");
define("DATABASE_PASSWORD", "sinapsis.digital");
define("DATABASE_PREFIX", "");

/**
 * Email Settings
 */
define("EMAIL_HOST", "mail.heifer-bolivia.org");
define("EMAIL_PORT", "25");
define("EMAIL_FROM", "no-reply");
define("EMAIL_USERNAME", "dmonroy@sinapsisdigital.la");
define("EMAIL_PASSWORD", "sinapsis.digital");
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
