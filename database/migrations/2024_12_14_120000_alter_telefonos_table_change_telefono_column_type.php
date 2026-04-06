<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
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
        if (! $this->isMysqlFamily()) {
            return;
        }

        DB::statement('ALTER TABLE telefonos MODIFY telefono VARCHAR(20) NULL');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (! $this->isMysqlFamily()) {
            return;
        }

        DB::statement('ALTER TABLE telefonos MODIFY telefono INT NULL');
    }

    private function isMysqlFamily(): bool
    {
        return in_array(Schema::getConnection()->getDriverName(), ['mysql', 'mariadb'], true);
    }
};
