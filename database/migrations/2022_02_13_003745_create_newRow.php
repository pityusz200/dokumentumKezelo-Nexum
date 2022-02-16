<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNewRow extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
	 
	//A jelszó test44
    public function up()
    {
        DB::table('users')->insert(
			[
				'name' => 'test',
				'email' => 'test@test.hu',
				'password' => '$2y$10$dCD6u8n0xslhIDZVcLTZKOHBAW.wIwfjU1MRkL1dZ/1sdHaGu1Pce',
				'jogosultsagFelT' => 1,
				'jogosultsagLetT' => 1
			]
		);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('newRow');
    }
}
