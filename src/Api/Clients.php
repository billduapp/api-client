<?php

namespace iInvoices\Api;


use iInvoices\Api\Curl\Client;

/**
 * @author Martin Bažík <martin@bazo.sk>
 */
class Clients
{

	/** @var Client */
	private $curl;

	public function __construct(Client $curl)
	{
		$this->curl = $curl;
	}


	/**
	 * @return \iInvoices\Api\Responses\Collection
	 */
	public function listAll()
	{
		$response = $this->curl->get('/clients');

		return $response->response;
	}


	public function get($id)
	{
		$response = $this->curl->get('/clients/' . $id);

		return $response->response;
	}


	public function create($data)
	{
		$response = $this->curl->post('/clients/', $data);
dump($response);exit;
		return $response->response;
	}


	public function update($id, $data)
	{
		$response = $this->curl->get('/clients/' . $id, $data);

		return $response->response;
	}


	public function delete($id)
	{
		$response = $this->curl->get('/clients/' . $id);

		return $response->response;
	}


}
