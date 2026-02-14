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
    Schema::create('tenants', function (Blueprint $table) {
        $table->id();

        $table->string('name');
        $table->string('slug')->unique();                 // ex: anaestetica
        $table->string('custom_domain')->nullable()->unique(); // ex: anaestetica.com.br (opcional)

        $table->enum('status', ['active', 'suspended'])->default('active');
        $table->date('next_due_date')->nullable();

        $table->timestamps();
    });
}

public function down(): void 
{
    Schema::dropIfExists('tenants');
}

};
