<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('qr_tags', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->string('description');

            $table->json('data');

            $table->string('secret')->unique();

            $table->boolean('include_personal_information')->default(false);

            $table->foreignIdFor(User::class)->constrained();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('qr_tags');
    }
};
