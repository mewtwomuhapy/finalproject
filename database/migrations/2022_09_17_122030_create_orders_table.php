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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->unsignedBigInteger('building_id')->nullable()->unsigned();
            $table->foreign('building_id')->references('id')->on('buildings')->nullable()->constrained();
            $table->unsignedBigInteger('tools_id')->nullable()->unsigned();
            $table->foreign('tools_id')->references('id')->on('tools')->nullable()->constrained();
            $table->unsignedBigInteger('p_sys_id')->nullable()->unsigned();
            $table->foreign('p_sys_id')->references('id')->on('p_sys')->nullable()->constrained();
            $table->string('floors');
            $table->string('rooms');
            $table->string('description');
            $table->string('descriptionfull');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
};
