<?php

use App\Enums\Auth\personalAccessTokenType;
use App\Enums\Notification\NotificationStatus;
use App\Enums\Notification\NotificationType;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new  class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->json('title');
            $table->json('body');

            $table->morphs('notifiable');
            $table->enum('type', NotificationType::values());
            $table->enum('user_type', personalAccessTokenType::values());
            $table->enum('status', NotificationStatus::values())->default(NotificationStatus::Unpublished->value);
            $table->timestamp('read_at')->nullable();

            $table->unsignedBigInteger('item_id')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('notifications');
    }
};
