<?php

namespace iInvoices\Api;

/**
 * @author Martin Bažík <martin@bazo.sk>
 */
class Invoices extends Documents
{
	public function create($data)
	{
		$data['type'] = 'invoice';
		$response = $this->curl->post('/documents/', $data);

		return $response;
	}

	public function search($criteria)
	{
		$criteria['type'] = 'invoice';

		$query = http_build_query($criteria);

		$response = $this->curl->get('/documents/?' . $query);

		return $response;
	}
}
