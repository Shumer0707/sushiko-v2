<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class OrderConfirmationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $orderData;

    /**
     * Конструктор - принимаем данные заказа
     */
    public function __construct(array $orderData)
    {
        $this->orderData = $orderData;
    }

    /**
     * Тема письма
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: '✅ Ваш заказ принят - Sushiko',
        );
    }

    /**
     * Контент письма - указываем шаблон
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.order-confirmation',
            with: ['order' => $this->orderData],
        );
    }

    /**
     * Вложения
     */
    public function attachments(): array
    {
        return [];
    }
}
