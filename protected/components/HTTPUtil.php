<?php


class HTTPUtil{
	
	public static function getParam($array,$key,$default){
		if (  array_key_exists($key, $array)){
			return $array[$key];
		}
		return $default;
	}
	
	
	/**
	 * get a parameter from the $_GET array
	 * */
	public static function getParamGet($key,$default = null){
		return self::getParam($_GET, $key, $default);
	}
	
	/**
	 * get a parameter from the $_POST array
	 * */
	public static function getParamPost($key,$default = null){
		return self::getParam($_POST, $key, $default);
	}
	
	
	/**
	 * get a parameter from the $_REQUEST array
	 * */
	public static function getParamRequest($key,$default = null){
		return self::getParam($_REQUEST, $key, $default);
	}
	/*
	 * shortcut for getParamGet
	 * */
	public static function pg($key,$default = null){
		return self::getParamGet($key,$default);
	}
	/**
	 * shortcut for getParamPost
	 * */
	public static function pp($key,$default = null){
		return self::getParamPost($key,$default);
	}
	/**
	 * shortcut for getParamRequest
	 * */
	public static function pr($key,$default = null){
		return self::getParamRequest($key,$default);
	}
	
}
