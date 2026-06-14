<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class DeleteRecord extends Controller
{
    public function deleteRecord(string $table, string $id)
    {
        $primaryKey = DB::selectOne("
        SHOW KEYS
        FROM {$table}
        WHERE Key_name = 'PRIMARY'
    ")->Column_name;

        $affected = DB::table($table)
            ->where($primaryKey, $id)
            ->update([
                'deleted_at' => now(),
            ]);

        return response()->json([
            'status' => (bool) $affected,
            'message' => $affected ? 'Record deleted successfully.' : 'Record not found.',
        ]);
    }
}
