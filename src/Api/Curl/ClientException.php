<?php

namespace iInvoices\Api\Curl;


/**
 * @author Martin Bažík <martin@bazo.sk>
 */
class ClientException extends \RuntimeException
{

	/** @var string */
	private $body;

	public function getBody()
	{
		return $this->body;
	}


	public function setBody($body)
	{
		$this->body = $body;
	}


}
