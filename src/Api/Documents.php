<?php

namespace iInvoices\Api;


use iInvoices\Api\Curl\Client;

/**
 * @author Martin Bažík <martin@bazo.sk>
 */
abstract class Documents
{

	/** @var Client */
	protected $curl;

	/** @var string */
	protected $apiKey;

	/** @var string */
	protected $apiSecret;

	public function __construct(Client $curl, $apiKey, $apiSecret)
	{
		$this->curl		 = $curl;
		$this->apiKey	 = $apiKey;
		$this->apiSecret = $apiSecret;
	}


	public function listAll()
	{
		$response = $this->curl->get('/documents');

		return $response->response;
	}


	public function get($id)
	{
		$response = $this->curl->get('/documents/' . $id);

		return $response->response;
	}


	public function create($data)
	{
		$response = $this->curl->post('/documents/', $data);

		return $response;
	}


	public function update($id, $data)
	{
		$response = $this->curl->get('/documents/' . $id, $data);

		return $response;
	}


	public function delete($id)
	{
		$response = $this->curl->get('/documents/' . $id);

		return $response;
	}


	public function download($id)
	{
		$this->curl->get('/documents/' . $id . '/download');
	}


	public function getDownloadLink($id)
	{
		$toSign = [
			'apiKey' => $this->apiKey,
			'id'	 => $id
		];

		$json		 = \Nette\Utils\Json::encode($toSign);
		$signature	 = base64_encode(hash_hmac('sha512', $json, $this->apiSecret, $raw		 = TRUE));

		return $this->curl->getBaseUrl() . '/documents/' . $id . '/download?signature=' . urlencode($signature);
	}


}
