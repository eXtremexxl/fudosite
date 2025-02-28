<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDishRatingsTable extends Migration
{
    public function up()
    {
        Schema::create('dish_ratings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('dish_id')->constrained()->onDelete('cascade');
            $table->unsignedTinyInteger('rating')->check('rating >= 1 AND rating <= 5'); // 1-5 звёзд
            $table->timestamps();

            $table->unique(['user_id', 'dish_id']); // Один пользователь — один рейтинг для блюда
        });
    }

    public function down()
    {
        Schema::dropIfExists('dish_ratings');
    }
}