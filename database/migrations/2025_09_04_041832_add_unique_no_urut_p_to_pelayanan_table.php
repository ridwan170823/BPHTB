<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::transaction(function () {
            DB::statement(<<<'SQL'
WITH duplicates AS (
    SELECT ctid, no_urut_p,
           ROW_NUMBER() OVER (PARTITION BY no_urut_p ORDER BY ctid) AS rn
    FROM bphtb.pelayanan
)
UPDATE bphtb.pelayanan p
SET no_urut_p = CONCAT(no_urut_p, '-', rn)
FROM duplicates d
WHERE p.ctid = d.ctid AND d.rn > 1;
SQL
            );

            Schema::table('bphtb.pelayanan', function (Blueprint $table) {
                $table->unique('no_urut_p');
            });
        });
    }

    public function down(): void
    {
        Schema::table('bphtb.pelayanan', function (Blueprint $table) {
            $table->dropUnique(['no_urut_p']);
        });
    }
};