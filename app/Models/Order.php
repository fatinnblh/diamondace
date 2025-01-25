<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'file_path',
        'paper_size',
        'binding_style',
        'cover_colour',
        'quantity',
        'page_count',
        'base_cost',
        'shipping_option',
        'payment_method',
        'receipt_path',
        'status',
    ];

    const STATUS_ORDER_SUBMITTED = 'order_submitted';
    const STATUS_AWAITING_PAYMENT = 'awaiting_payment';
    const STATUS_PAYMENT_VERIFIED = 'payment_verified';
    const STATUS_PRINTING = 'printing_in_progress';
    const STATUS_READY = 'ready';

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getFormattedPaymentMethodAttribute()
    {
        $methods = [
            'qr_code' => 'QR Code',
            // Add other payment methods here if needed
        ];

        return $methods[$this->payment_method] ?? ucfirst($this->payment_method);
    }

    public function getFormattedShippingOptionAttribute()
    {
        $options = [
            'delivery' => 'Delivery',
            'pickup' => 'Pick Up at Store'
        ];

        return $options[$this->shipping_option] ?? ucfirst($this->shipping_option);
    }

    public function getFormattedStatusAttribute()
    {
        $statuses = [
            self::STATUS_ORDER_SUBMITTED => 'Order Submitted',
            self::STATUS_AWAITING_PAYMENT => 'Awaiting Payment Verification',
            self::STATUS_PAYMENT_VERIFIED => 'Payment Verified with Receipt',
            self::STATUS_PRINTING => 'Printing in Progress',
            self::STATUS_READY => $this->shipping_option === 'pickup' ? 'Ready to Pick Up' : 'Ready for Delivery'
        ];

        return $statuses[$this->status] ?? ucfirst(str_replace('_', ' ', $this->status));
    }

    public function getStatusStepsAttribute()
    {
        $allStatuses = [
            self::STATUS_ORDER_SUBMITTED,
            self::STATUS_AWAITING_PAYMENT,
            self::STATUS_PAYMENT_VERIFIED,
            self::STATUS_PRINTING,
            self::STATUS_READY
        ];

        $currentStatusIndex = array_search($this->status, $allStatuses);
        
        return array_map(function($status) use ($currentStatusIndex, $allStatuses) {
            $statusIndex = array_search($status, $allStatuses);
            return [
                'title' => $this->getFormattedStatus($status),
                'active' => $statusIndex <= $currentStatusIndex,
                'current' => $status === $this->status
            ];
        }, $allStatuses);
    }

    protected function getFormattedStatus($status)
    {
        $statuses = [
            self::STATUS_ORDER_SUBMITTED => 'Order Submitted',
            self::STATUS_AWAITING_PAYMENT => 'Awaiting Payment Verification',
            self::STATUS_PAYMENT_VERIFIED => 'Payment Verified with Receipt',
            self::STATUS_PRINTING => 'Printing in Progress',
            self::STATUS_READY => $this->shipping_option === 'pickup' ? 'Ready to Pick Up' : 'Ready for Delivery'
        ];

        return $statuses[$status] ?? ucfirst(str_replace('_', ' ', $status));
    }
}