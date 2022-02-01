<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddProfileInfoToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            static $defaultImagePass = "/storage/img/defaultImage.png";
            $table->string('user_image')->default($defaultImagePass);
            $table->string('status_message')->default("");
            $table->string('user_link')->default("");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //全てのユーザー画像を削除
        $directories = \Storage::allDirectories("public/img");
        foreach($directories as $directory){
            \Storage::deleteDirectory($directory);
        }
        
        //プロフィール画像、コメント、ユーザーリンクのカラムを削除
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['user_image','status_message','user_link']);
        });
    }
}
