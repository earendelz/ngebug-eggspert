<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\UsersExport;
use App\Imports\UsersImport;
use Maatwebsite\Excel\Facades\Excel;

class FileImportExportController extends Controller
{
    // Halaman utama
    public function index()
    {
        return view('file-import-export');
    }

    // Ekspor data ke file Excel atau CSV
    public function export(Request $request)
    {
        return Excel::download(new UsersExport, 'users.xlsx');
    }

    // Impor data dari file Excel atau CSV
    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,csv',
        ]);

        Excel::import(new UsersImport, $request->file('file'));

        return redirect()->back()->with('success', 'Data imported successfully!');
    }
}
