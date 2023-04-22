<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        # 유저
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 100)->comment('성+이름');
            $table->string('account')->comment('로그인 계정');
            $table->string('email', 100)->comment('이메일 주소');
            $table->string('password')->comment('비밀번호');
            $table->string('mobile')->nullable()->comment('핸드폰번호');
            $table->timestampsTz($precision = 3);
            $table->softDeletesTz($column = 'deleted_at', $precision = 3);

            $table->index('id');
            $table->index('account');
        });

        # 재료
        Schema::create('ingredients', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('recipie_id')->comment('레시피 번호');
            $table->string('name', 100)->comment('재료 이름');
            $table->string('capacity', 100)->nullable()->comment('재료 용량');
            $table->string('type_code', 100)->comment('재료 타입 코드');
            $table->string('type', 100)->comment('재료 타입');
            $table->timestampsTz($precision = 3);
            $table->softDeletesTz($column = 'deleted_at', $precision = 3);

            $table->index('name');
            $table->index('recipie_id');
        });

        # 레시피
        Schema::create('recipies', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 100)->comment('레시피 이름');
            $table->string('introduction', 100)->comment('레시피 간단소개');
            $table->string('type_code', 100)->comment('레시피 타입 코드');
            $table->string('type', 100)->comment('레시피 타입');
            $table->string('time', 100)->comment('레시피 조리 시간');
            $table->string('calorie', 100)->comment('레시피 칼로리');
            $table->string('capacity', 100)->comment('레시피 분량');
            $table->string('difficulty', 100)->comment('레시피 난이도');
            $table->string('price')->nullable()->comment('레시피 가격');
            $table->string('image_link', 100)->comment('레시피 대표 이미지');
            $table->timestampsTz($precision = 3);
            $table->softDeletesTz($column = 'deleted_at', $precision = 3);

            $table->index('id');
            $table->index('name');
            $table->index('type');
        });

        # 레시피 과정
        Schema::create('processes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('recipie_id')->comment('레시피 번호');
            $table->unsignedSmallInteger('position')->comment('레시피 순서');
            $table->string('description', 200)->comment('레시피 과정 설명');
            $table->string('image_link', 100)->nullable()->comment('레시피 과정 이미지');
            $table->string('tip', 200)->nullable()->comment('레시피 과정 팁');
            $table->timestampsTz($precision = 3);
            $table->softDeletesTz($column = 'deleted_at', $precision = 3);

            $table->index('recipie_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('ingredients');
        Schema::dropIfExists('recipies');
        Schema::dropIfExists('processes');
    }
};
