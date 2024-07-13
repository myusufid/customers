<?php

use App\Models\Customer;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('family_list', function (Blueprint $table) {
            $table->id('fl_id');
            $table->foreignIdFor(Customer::class, 'cst_id');
            $table->char('fl_relation', 50)->nullable();
            $table->char('fl_name', 50);
            $table->date('fl_dob');
            $table->foreign('cst_id')
                ->references('cst_id')
                ->on('customer')
                ->cascadeOnDelete();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('family_list');
    }
};
