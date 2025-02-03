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
        Schema::create('vacation_requests', function (Blueprint $table) {
            $table->id();

            $table->foreignUlid('departement_id')->constrained()->cascadeOnDelete();
            $table->foreignUlid('user_id')->constrained();

            $table->date('start_date');
            $table->date('end_date');

            $table->string('reason')->nullable();

            $table->boolean('first_approval')->nullable();
            $table->boolean('second_approval')->nullable();

            $table->timestamp('first_approval_update_at')->nullable();
            $table->timestamp('second_approval_update_at')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vacation_requests');
    }
};
