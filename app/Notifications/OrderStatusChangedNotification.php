<?php

namespace App\Notifications;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class OrderStatusChangedNotification extends Notification implements ShouldQueue
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
        $statusMessages = [
            'payment_verified' => 'Your payment has been verified successfully!',
            'printing_in_progress' => 'Your order is now being printed.',
            'ready' => $this->order->shipping_option === 'pickup' 
                ? 'Your order is ready for pickup!' 
                : 'Your order is ready for delivery!'
        ];

        $message = $statusMessages[$this->order->status] ?? 'Your order status has been updated.';

        return (new MailMessage)
            ->subject('Order #' . $this->order->id . ' Status Update')
            ->greeting('Hello ' . $notifiable->name . '!')
            ->line($message)
            ->line('Order Details:')
            ->line('- Order ID: #' . $this->order->id)
            ->line('- Current Status: ' . $this->order->formatted_status)
            ->line('- Paper Size: ' . $this->order->paper_size)
            ->line('- Binding Style: ' . $this->order->binding_style)
            ->line('- Quantity: ' . $this->order->quantity)
            ->action('View Order Details', url('/dashboard'))
            ->line('Thank you for choosing our services!');
    }
}
