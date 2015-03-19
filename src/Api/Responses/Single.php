<?php

namespace iInvoices\Api\Responses;


/**
 * @author Martin Bažík <martin@bazo.sk>
 */
class Single
{

	private $object;

	public function __construct($response)
	{
		$this->object = $response;
	}


	public function __get($property)
	{
		return $this->object->{$property};
	}


}
