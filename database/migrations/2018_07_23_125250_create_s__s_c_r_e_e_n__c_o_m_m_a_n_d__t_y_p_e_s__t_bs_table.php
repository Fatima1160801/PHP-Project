<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSSCREENCOMMANDTYPESTBsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('s__s_c_r_e_e_n__c_o_m_m_a_n_d__t_y_p_e_s__t_bs', function (Blueprint $table) {
            $table->increments('id');
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
        Schema::dropIfExists('s__s_c_r_e_e_n__c_o_m_m_a_n_d__t_y_p_e_s__t_bs');
    }
}
