<?php

namespace App\Http\Controllers;
  
use Illuminate\Http\Request;
use App\Imports\PostsImport;
use App\Exports\PostsExport;
use Maatwebsite\Excel\Facades\Excel;
use Redirect;

class ImportExportController extends Controller
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function importExportView()
    {
       return view('users/uploadview');
    }
   
    /**
    * @return \Illuminate\Support\Collection
    */
    public function export() 
    {
        return Excel::download(new PostsExport, 'posts.xlsx');
    }
   
    /**
    * @return \Illuminate\Support\Collection
    */
    public function import(Request $request) 
    {
        $extension = request()->file('file')->extension();
        if($extension != "csv"){
            return Redirect::back()->withErrors(['The file must be csv.!!!']);
        }

        Excel::import(new PostsImport,request()->file('file'));

        return redirect('/postlist')->with(['Successfully imported.!!!']);
    }
}
