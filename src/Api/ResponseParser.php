<?php

namespace iInvoices\Api;


use iInvoices\Api\Responses\Collection;
use Nette\Utils\Json;

/**
 * @author Martin Bažík <martin@bazo.sk>
 */
class ResponseParser
{

	public static function parse($body)
	{
		if (empty($body)) {
			return '';
		}

		try {
			$response = Json::decode($body);

			if (isset($response->page)) {
				return self::parseCollection($response);
			} else {
				return self::parseSingle($response);
			}
		} catch (\Nette\Utils\JsonException $e) {
			return $body;
		}
	}


	private static function parseCollection($response)
	{
		return new Collection($response);
	}


	private static function parseSingle($response)
	{
		return (object) $response;
	}


}
