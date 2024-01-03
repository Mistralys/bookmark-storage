<?php
/**
 * Configuration settings template for the "local" environment.
 *
 * Include in versioning: YES
 *
 * @package BMStorage
 * @subpackage Configuration
 * @template-version 1
 */

declare(strict_types=1);

namespace BMStorage\Configuration;

const BASE_URL = 'http://127.0.0.1';
const VENDOR_URL = 'http://127.0.0.1/vendor';
const AUTH_SALT = 'auth-sample-salt';
const REQUEST_LOG_PASSWORD = 'request-log-password';

const DB_HOST = 'localhost';
const DB_NAME = 'application';
const DB_USER = 'user';
const DB_PASSWORD = '';
const DB_PORT = 3306;

const DB_TEST_HOST = 'localhost';
const DB_TEST_NAME = 'application';
const DB_TEST_USER = 'user';
const DB_TEST_PASSWORD = '';
const DB_TEST_PORT = 3306;
