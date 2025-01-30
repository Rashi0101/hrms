<?php

use CodeIgniter\Test\CIUnitTestCase;
<<<<<<< HEAD
=======
use Config\Services;
>>>>>>> 850ee1497789adeffdc38680989f18a9f64a3c26

/**
 * @internal
 */
final class ExampleSessionTest extends CIUnitTestCase
{
    public function testSessionSimple(): void
    {
<<<<<<< HEAD
        $session = service('session');
=======
        $session = Services::session();
>>>>>>> 850ee1497789adeffdc38680989f18a9f64a3c26

        $session->set('logged_in', 123);
        $this->assertSame(123, $session->get('logged_in'));
    }
}
