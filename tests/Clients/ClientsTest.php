<?php

namespace iInvoices\Tests;

use Tester\Assert;


require __DIR__ . '/../bootstrap.php';

/**
 * @author Martin Bažík <martin@bazo.sk>
 */
class ClientsTest extends TestCase
{

	public function testListAll()
	{
		$response = $this->api->clients->listAllClients();

		Assert::type(\iInvoices\Api\Responses\Collection::class, $response);
		\Tester\Assert::equal(1, $response->getPage());
		\Tester\Assert::equal(10, $response->getLimit());

		\Tester\Assert::equal(1, count($response->getItems()));
	}

	public function testGetClient()
	{
		$client = $this->api->clients->getClient(1);

		Assert::type(\iInvoices\Api\Responses\Single::class, $client);
		\Tester\Assert::equal(4, $client->id);
	}


}

$test = new ClientsTest;
$test->run();
