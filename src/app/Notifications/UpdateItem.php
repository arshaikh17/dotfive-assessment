<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Auth;

class UpdateItem extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public $item;
    public $previous;
    public function __construct($item, $previous)
    {
        $this->item = $item;
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
            'item' => $this->item->item_name,
            'old_item' => $this->previous->item_name,
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
                'item' => $this->item->item_name,
                'old_item' => $this->previous->item_name,
            ],
        ];
    }
}
