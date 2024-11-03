<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->string('video_url')->nullable()->after('image_url'); // Add the video_url column
        });
    }
    

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
{
    Schema::table('projects', function (Blueprint $table) {
        $table->dropColumn('video_url');
    });
}

};
