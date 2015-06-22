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
		$response = $this->curl->post('/documents/', ['json' => $data]);

		return $response->response;
	}
}
