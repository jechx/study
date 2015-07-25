<?php
/**
 * 使用sock访问
 */

interface Proto{
	function conn($url);
	function get();
	function post($body);
	function close();
}

class Sock implements Proto{

	protected $fh = null;
	protected $errono = 1;
	protected $erromsg = '';
	protected $timeout = 30;

	protected $url = array();
	protected $line = array();
	protected $head = array();
	protected $body = array();

	public function __construct($url){
		$this->conn($url);
		$this->setHead('Host:'.$this->url['host']);
	}
	protected function setLine($method){
		$this->line[0] = $method . ' ' . $this->url['path'] . ' HTTP/1.1';
	}
	public function setHead($head){
		$this->head[] =  $head;
	}
	protected function setBody($body){
		if(is_array($body)){
			$body = http_build_query($body);
		}
		$this->body[] = $body;
	}
	public function conn($url){
		$this->url = parse_url($url);
		if(!isset($this->url['port'])){
			$this->url['port'] = 80;
		}
		$this->fh = fsockopen($this->url['host'],$this->url['port'],$this->errono,$this->errmsg,$this->timeout);
		try{
			if(!$this->fh) throw new Exception('连接失败');
		}catch(Exception $e){
			echo $e->getMessage();
			exit;
		}
		
	}
	public function get(){
		$this->setLine('GET');

		return $this->request();
	}
	public function post($body){
		$this->setLine('POST');
		$this->setBody($body);
		return $this->request();
	}
	public function request(){
		$req = array_merge($this->line,$this->head,array(''),$this->body,array(''));
		$req = implode("\r\n",$req);

		fwrite($this->fh,$req);

		$response = '';
		while(!feof($this->fh)){
			$response .= fread($this->fh,1024);
		}
		
		$this->close($this->fh);
		return  $response;
	}
	public function close(){
		fclose($this->fh);
	}
}


