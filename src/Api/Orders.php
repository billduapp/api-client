<?php

namespace iInvoices\Api;


/**
 * @author Martin Bažík <martin@bazo.sk>
 */
class Orders extends Documents
{

	public function create($data)
	{
		$data['type'] = 'order';
		$response = $this->curl->post('/documents/', $data);

		return $response;
	}


	public function search($criteria)
	{
		$criteria['type'] = 'order';

		$query = http_build_query($criteria);

		$response = $this->curl->get('/documents/?' . $query);

		return $response;
	}


	public function update($id, $data)
	{
		$data['type'] = 'order';

		return parent::update($id, $data);
	}


}
