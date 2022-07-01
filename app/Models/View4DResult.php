<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class View4DResult extends Model
{
    public $table = "view_4Dresult_data";

    public function findResult()
    {
        return $this->hasMany(tbl4DResult::class, 'type');
    }
}
