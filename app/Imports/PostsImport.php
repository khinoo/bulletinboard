<?php

namespace App\Imports;

use App\Post;
use Maatwebsite\Excel\Concerns\ToModel;
use Carbon\Carbon;

class PostsImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        // dd($row);
        return new Post([
            'title'     => $row[0],
            'description'    => $row[1], 
            'status'    => $row[2], 
            'created_user_id'    => $row[3], 
            'updated_user_id'    => $row[4], 
            'created_at'    => Carbon::now(), 
            'updated_at'    => Carbon::now(),
        ]);
    }
}
