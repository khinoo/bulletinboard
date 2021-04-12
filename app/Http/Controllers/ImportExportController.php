<?php

namespace App\Http\Controllers;
  
use Illuminate\Http\Request;
use App\Imports\PostsImport;
use App\Exports\PostsExport;
use Maatwebsite\Excel\Facades\Excel;

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
    public function import() 
    {
        Excel::import(new PostsImport,request()->file('file'));
           
        return back();
    }
}
