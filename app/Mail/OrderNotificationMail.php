<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class OrderNotificationMail extends Mailable
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
     * Тема письма и отправитель
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: '🍱 Новый заказ на сайте Sushiko',
        );
    }

    /**
     * Контент письма - указываем шаблон
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.order-notification',
            with: ['order' => $this->orderData],
        );
    }

    /**
     * Вложения (если нужно)
     */
    public function attachments(): array
    {
        return [];
    }
}
