<?php

namespace iInvoices\Api;


use iInvoices\CurlClient;

/**
 * @author Martin Bažík <martin@bazo.sk>
 */
class Documents
{

	/** @var \GuzzleHttp\Client */
	private $curl;

	public function __construct(\GuzzleHttp\Client $curl)
	{
		$this->curl = $curl;
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
		$response = $this->curl->post('/documents/', ['json' => $data]);

		return $response;
	}


	public function update($id, $data)
	{
		$response = $this->curl->get('/documents/' . $id, ['json' => $data]);

		return $response;
	}


	public function delete($id)
	{
		$response = $this->curl->get('/documents/' . $id);

		return $response;
	}


}
