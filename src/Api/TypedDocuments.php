<?php

namespace iInvoices\Api;


namespace iInvoices\Api;


/**
 * @author Martin Bažík <martin@bazo.sk>
 */
abstract class TypedDocuments extends Documents
{

	public function create($data)
	{
		$data['type'] = static::TYPE;
		return parent::create($data);
	}


	public function search($criteria)
	{
		$criteria['type'] = static::TYPE;

		return parent::search($criteria);
	}


	public function update($id, $data)
	{
		$data['type'] = static::TYPE;

		return parent::update($id, $data);
	}


}
