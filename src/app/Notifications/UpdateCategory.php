<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Auth;
class UpdateCategory extends Notification
{
    use Queueable;
    public $category;
    public $previous;
    public function __construct($category, $previous)
    {
        $this->category = $category;
        $this->previous = $previous;
    }


    public function via($notifiable)
    {
        return ['database'];
    }
    public function toDatabase($notifiable)
    {

        return [
            'following_id' => Auth::user()->id,
            'following_name' => Auth::user()->name,
            'category' => $this->category->category_name,
            'old_category' => $this->previous->category_name,
        ];
    }
    public function toArray($notifiable)
    {
        return [
            'id' => $this->id,
            'read_at' => null,
            'data' => [
                'following_id' => Auth::user()->id,
                'following_name' => Auth::user()->name,
                'category' => $this->category->category_name,
                'old_category' => $this->previous->category_name,
            ],
        ];
    }
}
