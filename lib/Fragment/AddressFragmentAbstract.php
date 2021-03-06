<?php
/**
 *	PHP based wrapper for SecureTrading's new STPP protocol.
 *	
 *	The addressable object includes functionality for addresses and such, as
 *	quite a lot of functionality is shared between billing and customers, for
 *	example.
 *	
 *	@version: 2.0.0
 *	@author: David Weston <stpp@typefish.co.uk>
 */


namespace OUTRAGElib\Payment\STPP\Fragment;


abstract class AddressFragmentAbstract extends FragmentAbstract
{
	/**
	 *	Store all of the options this object holds in here.
	 */
	protected $options = [];
	
	
	/**
	 *	Set the e-mail address of this addressable object.
	 */
	public function setEmail($email)
	{
		$this->options["email"] = $email;
		return $this;
	}
	
	
	/**
	 *	Set the premise of this addressable object.
	 */
	public function setPremise($premise)
	{
		$this->options["premise"] = $premise;
		return $this;
	}
	
	
	/**
	 *	Set the street of this addressable object.
	 */
	public function setStreet($street)
	{
		$this->options["street"] = $street;
		return $this;
	}
	
	
	/**
	 *	Set the town of this addressable object.
	 */
	public function setTown($town)
	{
		$this->options["town"] = $town;
		return $this;
	}
	
	
	/**
	 *	Set the county of this addressable object.
	 */
	public function setCounty($county)
	{
		$this->options["county"] = $county;
		return $this;
	}
	
	
	/**
	 *	Set the post/zip-code of this addressable object.
	 */
	public function setPostcode($postcode)
	{
		$this->options["postcode"] = $postcode;
		return $this;
	}
	
	
	/**
	 *	Set the country of this addressable object.
	 */
	public function setCountry($country)
	{
		$this->options["country"] = $country;
		return $this;
	}
	
	
	/**
	 *	Set the first name of the person referenced in this addressable object.
	 */
	public function setNamePrefix($prefix)
	{
		if(!isset($this->options["name"]))
			$this->options["name"] = [];
		
		$this->options["name"]["prefix"] = $prefix;
		
		return $this;
	}
	
	
	/**
	 *	Set the first name of the person referenced in this addressable object.
	 */
	public function setFirstName($prefix)
	{
		if(!isset($this->options["name"]))
			$this->options["name"] = [];
		
		$this->options["name"]["first"] = $prefix;
		
		return $this;
	}
	
	
	/**
	 *	Set the first name of the person referenced in this addressable object.
	 */
	public function setMiddleName($middle)
	{
		if(!isset($this->options["name"]))
			$this->options["name"] = [];
		
		$this->options["name"]["middle"] = $middle;
		
		return $this;
	}
	
	
	/**
	 *	Set the first name of the person referenced in this addressable object.
	 */
	public function setLastName($last)
	{
		if(!isset($this->options["name"]))
			$this->options["name"] = [];
		
		$this->options["name"]["last"] = $last;
		
		return $this;
	}
	
	
	/**
	 *	Set the first name of the person referenced in this addressable object.
	 */
	public function setNameSuffix($suffix)
	{
		if(!isset($this->options["name"]))
			$this->options["name"] = [];
		
		$this->options["name"]["suffix"] = $suffix;
		
		return $this;
	}
	
	
	/**
	 *	Set the telephone associated with the person referenced in this addressable
	 *	object, and if not already defined, set the telephone type to be 'home'.
	 */
	public function setTelephone($phone)
	{
		if(!isset($this->options["telephone"]))
			$this->options["telephone"] = [];
		
		if(empty($this->options["telephone"]["type"]))
			$this->options["telephone"]["type"] = "H";
		
		$this->options["telephone"]["number"] = $phone;
		
		return $this;
	}
	
	
	/**
	 *	Set the type/location of the telephone given. Valid values are 'H', 'M', or 'W',
	 *	for home/mobile/work respectively.
	 */
	public function setTelephoneType($type)
	{
		if(!isset($this->options["telephone"]))
			$this->options["telephone"] = [];
		
		$this->options["telephone"]["type"] = $type;
		
		return $this;
	}
	
	
	/**
	 *	Deals with compiling the name node(s).
	 */
	protected function compileName($element)
	{
		if(empty($this->options["name"]))
			return false;
		
		ksort($this->options["name"]);
		
		$node = $element->addChild("name");
		
		foreach($this->options["name"] as $option => $value)
			$node->addChild($option, $value);
		
		return true;
	}
	
	
	/**
	 *	Deals with compiling the telephone node.
	 */
	protected function compileTelephone($element)
	{
		if(empty($this->options["telephone"]))
			return false;
		
		$element->addChild("telephone", $this->escape($this->options["telephone"]["number"]))
		        ->addAttribute("type", $this->escape($this->options["telephone"]["type"]));
		
		return true;
	}
}