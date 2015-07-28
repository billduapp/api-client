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

	public function __construct(Client $curl)
	{
		$this->curl = $curl;
	}


	public function listAll()
	{
		$response = $this->curl->get('/documents');

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


}
