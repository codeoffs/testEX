<?php

namespace inc;
/**
* 
*/
class Parser
{
	protected $url = null;	
	protected $data = null;	
	protected $replace_history = [];


	function __construct(string $url = null)
	{
		if (!empty($url)) {
			$this->setUrl($url);
		}
	}

	public function setUrl(string $url)
	{
		$this->url = $url;
	}

	public function getUrl()
	{
		return $this->url;
	}

	public function getHistory()
	{
		return $this->replace_history;
	}


	public function getDataByUrl()
	{	
		$data = null;
		$opts = [
			'http' => [
				"timeout" => 10,
			]
		];

		$context = stream_context_create($opts);
		$data = @file_get_contents($this->url, null, $context);
		
		$this->data = $data;
		return $data;
	}

	public function getContent()
	{
		return $this->data;
	}

	public function replaceByArray(array $data_replace)
	{
		if (empty($this->data)) {
			return 'Нет текста для замены';
		}

		$this->replace_history = array_merge($this->replace_history, $data_replace);

		$this->data = str_replace(array_keys($this->replace_history), array_values($this->replace_history), $this->data);

		return $this->data;
	}

	public function replaceByStr(string $search,  string $replace)
	{
		if (empty($this->data)) {
			return 'Нет текста для замены';
		}

		$this->replace_history[$search] = $replace;

		$this->data = str_replace($search, $replace, $this->data);

		return $this->data;
	}

	public function inverse()
	{
		$this->data = str_replace(array_values($this->replace_history), array_keys($this->replace_history), $this->data);

		return $this->data;
	}
}

