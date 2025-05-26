<?php

namespace App\Notifications;

use App\Models\Product;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ProductCreatedNotification extends Notification
{
    use Queueable;

    protected $product;

    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Создан новый продукт')
            ->line('Новый продукт успешно создан.')
            ->line('**Артикул:** ' . $this->product->article)
            ->line('**Название:** ' . $this->product->name)
            ->line('**Статус:** ' . $this->product->status)
            ->line('**Данные:** ' . ($this->product->data ?? 'Нет данных'))
            ->action('Посмотреть продукты', url('/products'))
            ->line('Спасибо за использование нашего приложения!');
    }

    public function toArray(object $notifiable): array
    {
        return [];
    }
}
