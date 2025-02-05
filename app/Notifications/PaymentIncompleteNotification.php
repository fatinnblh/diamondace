<?php

namespace App\Notifications;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PaymentIncompleteNotification extends Notification
{
    use Queueable;

    protected $order;

    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Payment Incomplete - Action Required')
            ->line('Your payment for Order #' . $this->order->id . ' is incomplete.')
            ->line('Please submit a valid payment receipt to proceed with your order.')
            ->action('View Order', route('orders.tracking', $this->order->id))
            ->line('If you have any questions, please contact our support team.');
    }
}
