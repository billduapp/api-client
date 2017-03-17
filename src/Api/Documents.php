<?php

namespace iInvoices\Api;


use iInvoices\Api\Curl\Client;

/**
 * @author Martin Bažík <martin@bazo.sk>
 */
class Documents
{

	/** @var Client */
	protected $curl;

	public function __construct(Client $curl)
	{
		$this->curl = $curl;
	}


	public function listAll($page = 1, $limit = 10)
	{
		$response = $this->curl->get('/documents/', [
			'page'	 => $page,
			'limit'	 => $limit,
		]);

		return $response;
	}


	public function get($id)
	{
		$response = $this->curl->get('/documents/' . $id);

		return $response;
	}


	public function create($data)
	{
		$response = $this->curl->post('/documents/', $data);

		return $response;
	}


	public function update($id, $data)
	{
		$response = $this->curl->patch('/documents/' . $id, $data);

		return $response;
	}


	public function delete($id)
	{
		$response = $this->curl->delete('/documents/' . $id);

		return $response;
	}


	public function download($id)
	{
		$this->curl->get('/documents/' . $id . '/download');
	}


	public function send($id, $data)
	{
		$this->curl->post('/documents/' . $id . '/send', $data);
	}


	public function getDownloadLink($id)
	{
		$request = $this->curl->createRequest('GET', '/documents/' . $id . '/download');
		$url	 = $request->buildUrl();

		return $url;
	}


	public function search($criteria)
	{
		$response = $this->curl->get('/documents/', $criteria);

		return $response;
	}


}
