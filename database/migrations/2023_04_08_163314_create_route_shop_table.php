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
        Schema::create('route_shop', function (Blueprint $table) {
            // $table->id();
            $table->foreignId('route_id');
            $table->foreignId('shop_id');
            $table->primary((['route_id', 'shop_id'])); // テーブルには必ずプライマリーキーが必要、idを削除する場合は別で指定。複数キーも設定可能
            // $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('route_shop');
    }
};
