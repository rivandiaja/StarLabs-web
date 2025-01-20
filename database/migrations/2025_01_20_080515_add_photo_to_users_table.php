<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPhotoToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            // Menambahkan kolom photo ke tabel users
            $table->string('photo')->nullable();  // Kolom photo nullable karena tidak semua user wajib memiliki foto
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            // Menghapus kolom photo jika migration di rollback
            $table->dropColumn('photo');
        });
    }
}
