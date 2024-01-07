<?php

use ExpressionEngine\Service\Migration\Migration;

class CreateactiongetctdebugforaddoneedtCartthrob extends Migration
{
    /**
     * Execute the migration
     * @return void
     */
    public function up()
    {
        ee('Model')->make('Action', [
            'class' => 'Eedt_cartthrob',
            'method' => 'GetCtDebug',
            'csrf_exempt' => false,
        ])->save();
    }

    /**
     * Rollback the migration
     * @return void
     */
    public function down()
    {
        ee('Model')->get('Action')
            ->filter('class', 'Eedt_cartthrob')
            ->filter('method', 'GetCtDebug')
            ->delete();
    }
}
