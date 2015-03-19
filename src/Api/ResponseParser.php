<?php

namespace iInvoices\Api;


/**
 * @author Martin Bažík <martin@bazo.sk>
 */
class ResponseParser
{

	public static function parse($body)
	{
		$response = \json_decode($body);

		if (isset($response->page)) {
			return self::parseCollection($response);
		} else {
			return self::parseSingle($response);
		}
	}


	private static function parseCollection($response)
	{
		return new \iInvoices\Api\Responses\Collection($response);
	}


	private static function parseSingle($response)
	{
		return new \iInvoices\Api\Responses\Single($response);
	}


}
