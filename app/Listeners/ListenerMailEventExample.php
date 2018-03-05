<?php namespace App\Listeners;

use App\Events\MailEventExample;
use Illuminate\Support\Facades\Mail;

class ListenerMailEventExample {

	public function handle(MailEventExample $event)
	{	
		$contitionExample = true;
		if($contitionExample)
			$this->send($event);
	}

	public function send($event)
	{
		Mail::send('emails.event-example', ['variable' => true],
			function($message) use ($event)
			{
           		$message->to('email@email.com')
           				->subject('Assunto do email ' . $variable);
    		}
		);
	}
}