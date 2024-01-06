<?php

use App\Enums\Category\CategoryChildType;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('image_id')->nullable()->constrained('media');
            $table->foreignId('main_image_id')->nullable()->constrained('media');
            $table->enum('category_child_type', CategoryChildType::values())->default(CategoryChildType::NOT_SEY->value);
            $table->foreignId('parent_id')->nullable()->constrained('categories');
            $table->foreignId('grand_id')->nullable()->constrained('categories');
            $table->string('discount_value')->nullable();
            $table->integer('order')->default(0);

            $table->string('name');

            $table->foreignId('created_by')->nullable()->constrained('users');
            $table->foreignId('updated_by')->nullable()->constrained('users');
            $table->timestamps();

            $table->foreignId('deleted_by')->nullable()->constrained('users');
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categories');
    }
};
