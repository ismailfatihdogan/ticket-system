<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTagTicketTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tag_ticket', function (Blueprint $table) {
            $table->unsignedInteger('tag_id')->nullable(false)->index('index_tag_id');
            $table->unsignedInteger('ticket_id')->nullable(false)->index('index_ticket_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tag_ticket');
    }
}
