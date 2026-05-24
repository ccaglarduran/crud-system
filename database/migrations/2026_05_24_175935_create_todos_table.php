<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
	public function up(): void
	{
	    Schema::create('todos', function (Blueprint $table) {
	        $table->id();
        	// Görevi hazırlayan kullanıcıyı users tablosuna bağlıyoruz
	        $table->foreignId('user_id')->constrained()->onDelete('cascade'); 
	        $table->string('title');
        	$table->text('description')->nullable();
	        $table->string('position')->nullable(); // Görevi hazırlayanın pozisyonu (örn: Kıdemli Geliştirici)
	        $table->boolean('is_completed')->default(false);
        	$table->timestamps();
	    });
	}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('todos');
    }
};
