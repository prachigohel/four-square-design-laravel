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
            $table->string('full_name')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('project_type')->nullable();
            $table->string('scope')->nullable();
            $table->string('door_style')->nullable();
            $table->string('refrigerator')->nullable();
            $table->string('range_cooktop')->nullable();
            $table->string('ventilation')->nullable();
            $table->string('dishwasher')->nullable();
            $table->json('attachments')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('design_requests', function (Blueprint $table) {
            $table->dropColumn([
                'full_name', 'email', 'phone', 'project_type', 'scope', 
                'door_style', 'refrigerator', 'range_cooktop', 
                'ventilation', 'dishwasher', 'attachments'
            ]);
        });
    }
};
