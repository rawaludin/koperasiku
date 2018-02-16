<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLoanRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loan_requests', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('amount'); // IDR mil
            $table->integer('duration'); // month
            $table->boolean('is_submitted')->nullable()->default(false);
            $table->boolean('is_approved')->nullable();
            $table->integer('member_id')->unsigned();
            $table->integer('admin_id')->unsigned()->nullable();
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
        Schema::dropIfExists('loan_requests');
    }
}
