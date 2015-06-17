<?php

namespace iInvoices\Api\Guzzle;


use GuzzleHttp\Client;
use GuzzleHttp\Message\RequestInterface;
use iInvoices\Api\ServerException;

/**
 * @author Martin Bažík <martin@bazo.sk>
 */
class WrappedClient extends Client
{

	public function send(RequestInterface $request)
	{
		try {
			return parent::send($request);
		} catch (\GuzzleHttp\Exception\ServerException $e) {
			$response	 = $e->getResponse();
			$body		 = $response->getBody()->getContents();
			$ex			 = new ServerException($e->getMessage(), $e->getCode(), $e);
			$ex->setBody($body);
			throw $ex;
		}
	}


}
