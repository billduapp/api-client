<?php

namespace iInvoices\Api;


use iInvoices\CurlClient;

/**
 * @author Martin Bažík <martin@bazo.sk>
 */
class Clients
{

	/** @var CurlClient */
	private $curl;

	public function __construct(CurlClient $curl)
	{
		$this->curl = $curl;
	}


	public function listAllClients()
	{
		$response = $this->curl->execute(CurlClient::GET, '/clients');

		return $response;
	}


	public function getClient($id)
	{
		$response = $this->curl->execute(CurlClient::GET, '/clients/' . $id);

		return $response;
	}


	public function createClient($data)
	{
		$response = $this->curl->execute(CurlClient::POST, '/clients/', $data);

		return $response;
	}


	public function updateClient($id, $data)
	{
		$response = $this->curl->execute(CurlClient::PATCH, '/clients/' . $id, $data);

		return $response;
	}

	public function deleteClient($id)
	{
		$response = $this->curl->execute(CurlClient::DELETE, '/clients/' . $id);

		return $response;
	}

}
