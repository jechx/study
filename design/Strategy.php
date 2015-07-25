<?php
interface UserStrategy{
	abstract function ShowAd();
	abstract function ShowCategory();
}

class Female implements UserStrategy{
	public function ShowAd(){
	}
	public function ShowCategory(){
	}
}

class Male implements UserStrategy{
	public function ShowAd(){
	}
	public function ShowCategory(){
	}
}