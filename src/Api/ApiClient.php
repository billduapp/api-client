<?php

namespace iInvoices\Api;


//use GuzzleHttp\Client;
use iInvoices\Api\Guzzle\WrappedClient as Client;
use GuzzleHttp\Event\BeforeEvent;
use GuzzleHttp\Event\EmitterInterface;
use iInvoices\CurlClient;

/**
 * @author Martin Bažík <martin@bazo.sk>
 */
class ApiClient
{

	/** @var string */
	private $domain;

	/** @var string */
	private $apiKey;

	/** @var string */
	private $apiSecret;

	/** @var Client */
	private $curl;

	/** @var Clients */
	public $clients;

	/** @var Products */
	public $products;

	/** @var Orders */
	public $orders;

	/** @var Invoices */
	public $invoices;

	public function __construct($domain, $apiKey = NULL, $apiSecret = NULL)
	{
		$this->domain	 = $domain;
		$this->apiKey	 = $apiKey;
		$this->apiSecret = $apiSecret;

		$config = [
			'base_url' => $domain
		];

		$this->curl	 = new Client($config);
		$emitter	 = $this->curl->getEmitter();
		$emitter->on('before', [$this, 'setDefaultCurlHeaders']);
		$emitter->on('complete', [$this, 'parseResponse'], 'first');

		$this->curl->setDefaultOption('verify', false);

		$this->clients	 = new Clients($this->curl);
		$this->products	 = new Products($this->curl);
		$this->orders	 = new Orders($this->curl);
		$this->invoices	 = new Invoices($this->curl);
	}


	public function setDefaultCurlHeaders(BeforeEvent $event, $name, EmitterInterface $emitter = NULL)
	{
		$request = $event->getRequest();
		$request->addHeaders([
			'apiKey'	 => $this->apiKey,
			'apiSecret'	 => $this->apiSecret
		]);
	}


	public function parseResponse(\GuzzleHttp\Event\CompleteEvent $event)
	{
		$response			 = $event->getResponse();
		$response->response	 = \iInvoices\Api\ResponseParser::parse($response->getBody()->getContents());
	}


	/**
	 * Change currently used apiKey and apiSecret
	 * @param string $apiKey
	 * @param string $apiSecret
	 * @return \iinvoices\ApiClient
	 */
	public function changeCredentials($apiKey, $apiSecret)
	{
		$this->apiKey	 = $apiKey;
		$this->apiSecret = $apiSecret;

		return $this;
	}


	public function listAllClients()
	{
		$response = $this->curl->execute(CurlClient::GET, '/clients');

		return $response;
	}


}
