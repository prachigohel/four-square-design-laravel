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
        Schema::table('design_requests', function (Blueprint $table) {
            $table->string('request_type')->nullable();
            $table->string('cabinet_brand')->nullable();
            $table->string('ceiling_height')->nullable();
            $table->string('wall_cabinet_height')->nullable();
            $table->date('expected_date')->nullable();
            $table->text('additional_notes')->nullable();
            $table->json('additional_info')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('design_requests', function (Blueprint $table) {
            //
        });
    }
};
