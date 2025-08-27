<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVersionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('versions', function (Blueprint $table) {
            $table->id();
            $table->integer('numero_appstore');
            $table->integer('numero_playstore');
            $table->text('url_appstore');
            $table->text('url_playstore');
            $table->text('motif_appstore')->nullable();
            $table->text('motif_playstore')->nullable();
            $table->text('titre_appstore')->nullable();
            $table->text('titre_playstore')->nullable();
            $table->boolean('obligatoire_appstore')->default(false);
            $table->boolean('obligatoire_playstore')->default(false);
            $table->softDeletes();
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
        Schema::dropIfExists('versions');
    }
}
