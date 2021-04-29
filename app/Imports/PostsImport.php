<?php

namespace App\Imports;

use App\Post;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\WithValidation;
use Carbon\Carbon;

class PostsImport implements ToModel, WithValidation
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Post([
            'title'     => $row[0],
            'description'    => $row[1], 
            'status'    => $row[2], 
            'create_user_id'    => Auth::user()->id, 
            'updated_user_id'    => Auth::user()->id, 
            'created_at'    => Carbon::now(), 
            'updated_at'    => Carbon::now(),
        ]);
    }

    public function rules(): array
    {
        return [
            Rule::unique('posts', 'title'),
        ];
    }
}
