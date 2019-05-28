<?php

class User
{
	protected $id, $username, $password_hash, $email, $registration_sequence, $has_registered, $bank_account;

	function __construct( $id, $username, $password_hash, $email, $registration_sequence, $has_registered, $bank_account )
	{
		$this->id = $id;
		$this->username = $username;
		$this->password_hash = $password_hash;
    $this->email = $email;
    $this->registration_sequence = $registration_sequence;
    $this->has_registered = $has_registered;
    $this->bank_account = $bank_account;
	}

	function __get( $prop ) { return $this->$prop; }
	function __set( $prop, $val ) { $this->$prop = $val; return $this; }
}

?>
