<?php

namespace iInvoices\Api;


use iInvoices\Api\Curl\Client;

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

	/** @var Clients */
	public $clients;

	/** @var Products */
	public $products;

	/** @var Orders */
	public $orders;

	/** @var Invoices */
	public $invoices;

	/** @var Proformas */
	public $proformas;

	/** @var Documents */
	public $documents;

	public function __construct($domain, $apiKey = NULL, $apiSecret = NULL)
	{
		$this->domain	 = $domain;
		$this->apiKey	 = $apiKey;
		$this->apiSecret = $apiSecret;

		$config = [
			'base_url' => $domain
		];

		$curl = new Client($config);

		$curl->onBeforeRequest[] = function(Curl\Request $request) {
			$data = $request->getData();

			$timestamp = time();

			$toSign				 = $data;
			$toSign['timestamp'] = (int) $timestamp;
			$toSign['apiKey']	 = $this->apiKey;

			ksort($toSign);

			$json = \Nette\Utils\Json::encode($toSign);

			$signature	 = base64_encode(hash_hmac('sha512', $json, $this->apiSecret, $raw		 = TRUE));

			$request->setQuery('apiKey', $this->apiKey);
			$request->setQuery('timestamp', $timestamp);
			$request->setQuery('signature', $signature);
		};

		$curl->onBeforeResponse[] = function($response) {
			return ResponseParser::parse($response);
		};

		$this->clients	 = new Clients($curl);
		$this->documents = new Documents($curl);
		$this->products	 = new Products($curl);
		$this->orders	 = new Orders($curl);
		$this->invoices	 = new Invoices($curl);
		$this->proformas = new Proformas($curl);
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


}
