<?php

namespace iInvoices\Api\Guzzle;

use GuzzleHttp\Client;
use GuzzleHttp\Message\RequestInterface;
use iInvoices\Api\ClientException;
use iInvoices\Api\ServerException;
use Nette\Utils\Json;
use Nette\Utils\JsonException;

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

			$message = $e->getMessage();
			try {
				$data	 = Json::decode($body);
				dump($data);
				$message = implode(', ', $data->errors);
			} catch (JsonException $e) {
				//ignore
			}

			$ex = new ServerException($message, $e->getCode(), $e);
			$ex->setBody($body);
			throw $ex;
		} catch (\GuzzleHttp\Exception\ClientException $e) {
			$response	 = $e->getResponse();
			$body		 = $response->getBody()->getContents();

			$message = $e->getMessage();
			try {
				$data	 = Json::decode($body);
				dump($data);
				$message = implode(', ', $data->errors);
			} catch (JsonException $e) {
				//ignore
			}

			$ex = new ClientException($message, $e->getCode(), $e);
			$ex->setBody($body);
			throw $ex;
		}
	}


}
