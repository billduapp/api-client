<?php

namespace iInvoices\Tests;


use iInvoices\Response;
use Tester\Assert;

require __DIR__ . '/../bootstrap.php';

/**
 * @author Martin Bažík <martin@bazo.sk>
 */
class ApiTest extends TestCase
{

	public function testClientCreatedOk()
	{
		\Tester\Assert::type(\iInvoices\Api\Clients::class, $this->api->clients);
	}


}

$test = new ApiTest;
$test->run();
