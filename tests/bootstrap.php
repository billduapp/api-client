<?php

namespace iInvoices\Tests;

use iInvoices\Api\ApiClient;
use Nette\Caching\Storages\FileStorage;
use Nette\Loaders\RobotLoader;


require __DIR__.'/../vendor/autoload.php';

$loader = new RobotLoader;
// Add directories for RobotLoader to index
$loader->addDirectory(__DIR__.'/../src');
// And set caching to the 'temp' directory on the disc
$loader->setCacheStorage(new FileStorage(__DIR__.'/temp'));
$loader->register(); // Run the RobotLoader

\Tester\Environment::setup();
date_default_timezone_set('Europe/Bratislava');

class TestCase extends \Tester\TestCase
{
	/** @var \iinvoices\ApiClient */
	protected $api;

	public function setUp()
	{
		parent::setUp();

		$this->api = new ApiClient('http://private-ed904-minifaktura.apiary-mock.com');
	}
}
