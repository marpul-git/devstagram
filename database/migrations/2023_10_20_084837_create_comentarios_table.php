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
        Schema::create('comentarios', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');//Cada comentario va a pertenecer a un user y a un post
            $table->foreignId('post_id')->constrained()->onDelete('cascade');// Se conoce como tabla pivote
            //Con onDelete('cascade') cuando eliminemos un post o un usuario se eliminaran sus comentarios
            $table->string('comentario'); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comentarios');
    }
};
