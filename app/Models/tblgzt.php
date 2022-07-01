<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;
use Laravel\Scout\Searchable;

class tblgzt extends Model
{
    use HasFactory,Sortable,Searchable;

    protected $table ='tblgzt';
    protected $fillable = [
        'number',
        'cn',
        'en',
        'my',
        'th',
        'image',

    ];

    public $sortable=[
        'number',
    ];

    public function toSearchableArray()
    {
        return [
            'number'=> $this->number,
            'cn'=> $this->cn,
            'en'=> $this->en,
            'my'=> $this->my,
            'th'=> $this->th,


        ];
    }
}
