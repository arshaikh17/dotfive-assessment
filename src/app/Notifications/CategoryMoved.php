<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Auth;
class CategoryMoved extends Notification
{
    use Queueable;

    public $category;
    public $new_category;
    public function __construct($category, $new_category)
    {

        $this->category = $category;
        $this->new_category = $new_category;
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
            'to_category' => $this->new_category->category_name,
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
                'to_category' => $this->new_category->category_name,
            ],
        ];
    }
}
