<?php
  
namespace App\Mail;
   
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
  
class SendMail extends Mailable
{
    use Queueable, SerializesModels;
  
    public $details;
    public $file;

   
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($details,$file)
    {
        $this->details = $details;
        $this->file = $file;

    }
   
    /**
     * Build the message.
     *
     * @return $this
     */
     public function build()
    {
        return $this->subject('Mail from omasha')
                    ->markdown($this->file);

    }
}