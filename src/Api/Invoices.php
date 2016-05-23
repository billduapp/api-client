<?php

namespace iInvoices\Api;


/**
 * @author Martin Bažík <martin@bazo.sk>
 */
class Invoices extends TypedDocuments
{

	const TYPE = 'invoice';

	public function pay($id, $amount, $currency = 'EUR', \DateTime $date = NULL)
	{
		if (is_null($date)) {
			$date = new \DateTime;
		}

		$data = [
			'amount' => $amount,
			'currency' => $currency,
			'createdAt' => $date->format('c')
		];


		return $this->curl->post('/documents/' . $id . '/payments', $data);
	}


}
