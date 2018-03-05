<?php namespace App\Events;

use Illuminate\Queue\SerializesModels;

class MailEventExample extends Event {

	use SerializesModels;

	public $event;

	public function __construct($event)
	{
		$this->event = $event;
	}
}