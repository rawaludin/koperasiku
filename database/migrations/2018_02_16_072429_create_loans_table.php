<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLoansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loans', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('member_id')->unsigned();
            $table->integer('admin_id')->unsigned();
            $table->integer('duration')->unsigned();
            $table->boolean('is_completed')->default(false);
            $table->double('monthly_amount')->nullable();
            $table->double('total_paid')->nullable();
            $table->double('total_amount')->nullable();
            $table->timestamps();

            $table->foreign('member_id')
                ->references('id')->on('users')
                ->onDelete('cascade');

            $table->foreign('admin_id')
                ->references('id')->on('users')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('loans');
    }
}
