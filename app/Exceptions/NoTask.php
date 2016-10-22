<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 10/22/16
 * Time: 10:05 PM
 */

namespace App\Exceptions;
use Exception;

class NoTask extends Exception
{
	public function __construct($message)
	{
		$this->message = $message;
	}
}