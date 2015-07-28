<?php

namespace iInvoices\Api;
use iInvoices\Api\Curl\Client;

/**
 * @author Martin Bažík <martin@bazo.sk>
 */
class Products
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
		$response = $this->curl->get('/products');

		return $response;
	}


	public function get($id)
	{
		$response = $this->curl->get('/products/' . $id);

		return $response;
	}


	public function create($data)
	{
		$data['price'] = (float) $data['price'];
		$data['vat'] = (float) $data['vat'];
		$data['count'] = (float) $data['count'];

		$response = $this->curl->post('/products/', $data);

		return $response;
	}


	public function update($id, $data)
	{
		$response = $this->curl->get('/products/' . $id, $data);

		return $response;
	}


	public function delete($id)
	{
		$response = $this->curl->delete('/products/' . $id);

		return $response;
	}


}
