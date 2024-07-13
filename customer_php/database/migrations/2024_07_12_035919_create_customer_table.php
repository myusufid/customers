<?php

use App\Models\Nationality;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('customer', function (Blueprint $table) {
            $table->id('cst_id');
            $table->foreignIdFor(Nationality::class);
            $table->char('cst_name', 50);
            $table->date('cst_dob');
            $table->char('cst_phoneNum', 20)->nullable();
            $table->char('cst_email', 50)->nullable();
            $table->foreign('nationality_id')
                ->references('nationality_id')
                ->on('nationality')
                ->cascadeOnDelete();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('customer');
    }
};
