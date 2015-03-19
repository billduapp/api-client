<?php

namespace iInvoices\Api\Responses;


/**
 * @author Martin Bažík <martin@bazo.sk>
 */
class Collection
{

	/** @var string */
	private $body;

	/** @var array */
	private $headers = [];

	/** @var int */
	private $page;

	/** @var int */
	private $limit;

	/** @var int */
	private $pages;

	/** @var int */
	private $total;

	/** @var string */
	private $selfLink;

	/** @var string */
	private $firstLink;

	/** @var string */
	private $lastLink;

	/** @var string */
	private $previousLink;

	/** @var string */
	private $nextLink;

	/** @var array */
	private $items = [];

	public function __construct($response)
	{
		$this->limit	 = $response->limit;
		$this->pages	 = $response->pages;
		$this->page		 = $response->page;
		$this->total	 = $response->total;
		$links			 = $response->_links;
		$this->selfLink	 = $links->self->href;
		$this->firstLink = $links->first->href;
		$this->lastLink	 = $links->last->href;

		if (isset($links->next)) {
			$this->nextLink = $links->next->href;
		}

		if (isset($links->previous)) {
			$this->previousLink = $links->previous->href;
		}

		$this->items = $response->_embedded->items;
	}


	public function getBody()
	{
		return $this->body;
	}


	public function getHeaders()
	{
		return $this->headers;
	}


	public function getPage()
	{
		return $this->page;
	}


	public function getLimit()
	{
		return $this->limit;
	}


	public function getPages()
	{
		return $this->pages;
	}


	public function getTotal()
	{
		return $this->total;
	}


	public function getSelfLink()
	{
		return $this->selfLink;
	}


	public function getFirstLink()
	{
		return $this->firstLink;
	}


	public function getLastLink()
	{
		return $this->lastLink;
	}


	public function getPreviousLink()
	{
		return $this->previousLink;
	}


	public function getNextLink()
	{
		return $this->nextLink;
	}


	public function getItems()
	{
		return $this->items;
	}


}
