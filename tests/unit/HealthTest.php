<?php

use CodeIgniter\Test\CIUnitTestCase;
use Config\App;
<<<<<<< HEAD
<<<<<<< HEAD
=======
use Config\Services;
>>>>>>> 850ee1497789adeffdc38680989f18a9f64a3c26
=======
use Config\Services;
>>>>>>> 850ee1497789adeffdc38680989f18a9f64a3c26
use Tests\Support\Libraries\ConfigReader;

/**
 * @internal
 */
final class HealthTest extends CIUnitTestCase
{
    public function testIsDefinedAppPath(): void
    {
        $this->assertTrue(defined('APPPATH'));
    }

    public function testBaseUrlHasBeenSet(): void
    {
<<<<<<< HEAD
<<<<<<< HEAD
        $validation = service('validation');
=======
        $validation = Services::validation();
>>>>>>> 850ee1497789adeffdc38680989f18a9f64a3c26
=======
        $validation = Services::validation();
>>>>>>> 850ee1497789adeffdc38680989f18a9f64a3c26

        $env = false;

        // Check the baseURL in .env
        if (is_file(HOMEPATH . '.env')) {
            $env = preg_grep('/^app\.baseURL = ./', file(HOMEPATH . '.env')) !== false;
        }

        if ($env) {
            // BaseURL in .env is a valid URL?
            // phpunit.xml.dist sets app.baseURL in $_SERVER
            // So if you set app.baseURL in .env, it takes precedence
            $config = new App();
            $this->assertTrue(
                $validation->check($config->baseURL, 'valid_url'),
<<<<<<< HEAD
<<<<<<< HEAD
                'baseURL "' . $config->baseURL . '" in .env is not valid URL',
=======
                'baseURL "' . $config->baseURL . '" in .env is not valid URL'
>>>>>>> 850ee1497789adeffdc38680989f18a9f64a3c26
=======
                'baseURL "' . $config->baseURL . '" in .env is not valid URL'
>>>>>>> 850ee1497789adeffdc38680989f18a9f64a3c26
            );
        }

        // Get the baseURL in app/Config/App.php
        // You can't use Config\App, because phpunit.xml.dist sets app.baseURL
        $reader = new ConfigReader();

        // BaseURL in app/Config/App.php is a valid URL?
        $this->assertTrue(
            $validation->check($reader->baseURL, 'valid_url'),
<<<<<<< HEAD
<<<<<<< HEAD
            'baseURL "' . $reader->baseURL . '" in app/Config/App.php is not valid URL',
=======
            'baseURL "' . $reader->baseURL . '" in app/Config/App.php is not valid URL'
>>>>>>> 850ee1497789adeffdc38680989f18a9f64a3c26
=======
            'baseURL "' . $reader->baseURL . '" in app/Config/App.php is not valid URL'
>>>>>>> 850ee1497789adeffdc38680989f18a9f64a3c26
        );
    }
}
