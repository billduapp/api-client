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
}
