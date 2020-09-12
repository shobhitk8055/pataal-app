<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Create1516728224BookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('bookings')) {
            Schema::create('bookings', function (Blueprint $table) {
                $table->increments('id');
                $table->datetime('time_from')->nullable();
                $table->datetime('time_to')->nullable();
                $table->datetime('check_in_time')->nullable();
                $table->dateTime('check_out_time')->nullable();
                $table->text('additional_information')->nullable();
                $table->text('status')->nullable();
                $table->decimal('amount')->nullable();
                $table->decimal('items_total')->nullable();
                $table->decimal('discount')->nullable();
                $table->decimal('total_amount')->nullable();
                $table->boolean('payment_status')->nullable();
                $table->string('mode')->nullable();
                $table->integer('card_no')->nullable();
                $table->integer('upi_id')->nullable();
                $table->string('paytm_no')->nullable();
                $table->dateTime('time')->nullable();
                $table->timestamps();
                $table->softDeletes();

                $table->index(['deleted_at']);


            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bookings');
    }
}
