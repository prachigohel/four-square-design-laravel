<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        DB::table('design_requests')->where('status', 'Open')->update(['status' => 'Queued']);
        DB::table('design_requests')->where('status', 'WIP')->update(['status' => 'In Progress']);
        DB::table('design_requests')->where('status', 'Info Submitted')->update(['status' => 'Information Submitted']);
        DB::table('design_requests')->where('status', 'Design Update Required')->update(['status' => 'Design Error']);
        DB::table('design_requests')->where('status', 'On Hold')->update(['status' => 'To Be Continued']);
        DB::table('design_requests')->where('status', 'Closed')->update(['status' => 'Project Completed']);
        DB::table('design_requests')->where('status', 'Additional Changes')->update(['status' => 'In Progress']);

        Schema::table('design_requests', function (Blueprint $table) {
            $table->string('status')->default('Queued')->change();
        });
    }

    public function down(): void
    {
        DB::table('design_requests')->where('status', 'Queued')->update(['status' => 'Open']);
        DB::table('design_requests')->where('status', 'In Progress')->update(['status' => 'WIP']);
        DB::table('design_requests')->where('status', 'Information Submitted')->update(['status' => 'Info Submitted']);
        DB::table('design_requests')->where('status', 'Design Error')->update(['status' => 'Design Update Required']);
        DB::table('design_requests')->where('status', 'To Be Continued')->update(['status' => 'On Hold']);
        DB::table('design_requests')->where('status', 'Project Completed')->update(['status' => 'Closed']);

        Schema::table('design_requests', function (Blueprint $table) {
            $table->string('status')->default('Open')->change();
        });
    }
};
