<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        // Таблица заказов
        Schema::create('orders', function (Blueprint $table) {
            $table->id();

            // Клиент
            $table->string('customer_name');
            $table->string('customer_phone', 20);
            $table->string('customer_email')->nullable(); // сейчас required, но пусть будет запас

            // Доставка
            $table->string('delivery_method');              // pickup | delivery
            $table->string('address_type')->nullable();     // house | apartment
            $table->string('address')->nullable();
            $table->string('house_number', 50)->nullable();
            $table->string('apartment_number', 50)->nullable();
            $table->string('entrance', 50)->nullable();
            $table->string('floor', 50)->nullable();
            $table->string('intercom', 50)->nullable();

            // Оплата
            $table->string('payment'); // cash | card

            // Суммы
            $table->decimal('total', 10, 2);
            $table->decimal('delivery_cost', 10, 2);
            $table->decimal('total_with_delivery', 10, 2);
            $table->string('currency', 10);

            // Дополнительно
            $table->text('comment')->nullable();
            $table->string('status')->default('new'); // new, in_progress, done и т.п.

            $table->timestamps();
        });

        // Таблица позиций заказа
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();

            $table->foreignId('order_id')
                ->constrained()
                ->onDelete('cascade');

            // id товара из каталога (если нужно связать)
            $table->unsignedBigInteger('product_id')->nullable();

            $table->string('name');
            $table->decimal('price', 10, 2);
            $table->unsignedInteger('quantity');
            $table->decimal('total', 10, 2);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('order_items');
        Schema::dropIfExists('orders');
    }
};
