<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class ChangeNumeroPostoToIntegerInTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Prima aggiorniamo i valori vuoti o non numerici con un valore predefinito
        DB::statement("UPDATE tickets SET numero_posto = '0' WHERE numero_posto = '' OR numero_posto IS NULL");
        
        // Poi convertiamo tutti i valori esistenti in numeri interi
        DB::statement("UPDATE tickets SET numero_posto = CAST(numero_posto AS UNSIGNED)");
        
        // Solo a questo punto modifichiamo il tipo di colonna
        Schema::table('tickets', function (Blueprint $table) {
            $table->integer('numero_posto')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tickets', function (Blueprint $table) {
            $table->string('numero_posto')->change();
        });
    }
}