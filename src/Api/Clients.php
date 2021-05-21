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
	public function listAll($page = 1, $limit = 10)
	{
		$response = $this->curl->get('/clients', [
			'page'	 => $page,
			'limit'	 => $limit,
		]);

		return $response;
	}


	public function get($id)
	{
		$response = $this->curl->get('/clients/' . $id);

		return $response;
	}


	public function create($data)
	{
		$response = $this->curl->post('/clients/', $data);

		return $response;
	}


	public function update($id, $data)
	{
		$response = $this->curl->patch('/clients/' . $id, $data);

		return $response;
	}


	public function delete($id)
	{
		$response = $this->curl->delete('/clients/' . $id);

		return $response;
	}


}
