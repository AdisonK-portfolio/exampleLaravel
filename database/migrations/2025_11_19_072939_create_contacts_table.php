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
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->string('firstName');
            $table->string('lastName');
            $table->string('email')->nullable();
            $table->date('DOB')->nullable();
            $table->foreignId('company_id')->nullable()->constrained()->onDelete('cascade');
            $table->foreignId('madeBy_id')->references('id')->on('users')->constrained()->onDelete('cascade'); //
            $table->softDeletes();
            $table->timestamps();

            $table->fullText('firstName');
            $table->fullText('lastName');
            $table->fullText('email');
        });

        

        // Schema::create('company_contact', function(Blueprint $table){
        //     $table->foreignId('company_id')->constrained()->onDelete('cascade');
        //     $table->foreignId('contact_id')->constrained()->onDelete('cascade');

        // });
    }

    public function down(): void
    {
        Schema::dropIfExists('contacts');
    }
};
