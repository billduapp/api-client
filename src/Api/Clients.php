<?php

namespace iInvoices\Api;


/**
 * @author Martin Bažík <martin@bazo.sk>
 */
class Clients
{

	/** @var \GuzzleHttp\Client */
	private $curl;

	public function __construct(\GuzzleHttp\Client $curl)
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
		$response = $this->curl->post('/clients/', ['json' => $data]);

		return $response->response;
	}


	public function update($id, $data)
	{
		$response = $this->curl->get('/clients/' . $id, ['json' => $data]);

		return $response->response;
	}


	public function delete($id)
	{
		$response = $this->curl->get('/clients/' . $id);

		return $response->response;
	}


}
