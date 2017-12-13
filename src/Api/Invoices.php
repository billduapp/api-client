<?php

namespace iInvoices\Api;


/**
 * @author Martin Bažík <martin@bazo.sk>
 */
class Invoices extends TypedDocuments
{

	const TYPE = 'invoice';

	public function pay($id, $price, $currency = 'EUR', \DateTime $date = NULL)
	{
		if (is_null($date)) {
			$date = new \DateTime;
		}

		$data = [
			'price' => $price,
			'currency' => $currency,
			'createdAt' => $date->format('c')
		];


		return $this->curl->post('/documents/' . $id . '/payments', $data);
	}


}
