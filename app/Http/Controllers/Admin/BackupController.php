<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class BackupController extends Controller
{
    public function index()
    {
        return view('admin.backup.index');
    }

    public function download()
    {
        // Pure PHP Database Dumper
        $tables = DB::select('SHOW TABLES');
        $sql = "-- Quiz Arena Database Backup\n";
        $sql .= "-- Generated at: " . now()->format('Y-m-d H:i:s') . "\n\n";
        $sql .= "SET FOREIGN_KEY_CHECKS=0;\n\n";

        foreach ($tables as $table) {
            $tableName = (array) $table;
            $tableName = array_values($tableName)[0];
            
            // Get Create Table statement
            $createTable = DB::select("SHOW CREATE TABLE `{$tableName}`");
            $createTable = (array) $createTable[0];
            $sql .= "DROP TABLE IF EXISTS `{$tableName}`;\n";
            $sql .= array_values($createTable)[1] . ";\n\n";
            
            // Get Table Data
            $rows = DB::table($tableName)->get();
            if ($rows->count() > 0) {
                $sql .= "-- Data for `{$tableName}`\n";
                foreach ($rows as $row) {
                    $row = (array) $row;
                    $keys = array_keys($row);
                    $values = array_values($row);
                    
                    $values = array_map(function($val) {
                        if (is_null($val)) return "NULL";
                        return "'" . addslashes($val) . "'";
                    }, $values);
                    
                    $sql .= "INSERT INTO `{$tableName}` (`" . implode("`, `", $keys) . "`) VALUES (" . implode(", ", $values) . ");\n";
                }
                $sql .= "\n";
            }
        }
        
        $sql .= "SET FOREIGN_KEY_CHECKS=1;\n";

        $filename = 'quiz_arena_backup_' . now()->format('Y_m_d_His') . '.sql';
        $path = storage_path('app/' . $filename);
        
        File::put($path, $sql);

        return response()->download($path)->deleteFileAfterSend(true);
    }

    public function restore(Request $request)
    {
        $request->validate([
            'backup_file' => 'required|file|max:51200' // max 50MB
        ], [
            'backup_file.required' => 'Pilih file backup (.sql) terlebih dahulu.',
            'backup_file.max' => 'Ukuran file backup maksimal 50MB.'
        ]);

        $file = $request->file('backup_file');
        
        // Cek ekstensi manual untuk memastikan
        if (strtolower($file->getClientOriginalExtension()) !== 'sql') {
            return redirect()->back()->with('error', 'File yang diupload harus berformat .sql');
        }

        try {
            $sql = file_get_contents($file->getRealPath());
            
            // Eksekusi SQL mentah. Harus mematikan foreign key checks dulu.
            DB::unprepared($sql);

            return redirect()->back()->with('status', 'Database berhasil di-restore dengan sukses!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal melakukan restore: ' . $e->getMessage());
        }
    }
}
