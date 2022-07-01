<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class tblSpecial extends Model
{
    use HasFactory,Sortable;
    protected $fillable = [
        'drawDate',
    ];
    public $sortable=[
        'drawDate',
    ];

    public function special(){
        return $this->hasOne(tblSpecial::class, 'dd', 'drawDate');
    }
}
