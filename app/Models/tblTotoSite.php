<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class tblTotoSite extends Model
{
    use HasFactory,Searchable;

    protected $fillable = [
        'siteName',
        'flag',
        'country',
        'siteImage',
        'color',
        'status',
       
    ];

    public function toSearchableArray()
    {
        return [
        'siteName'=> $this->siteName,
        'flag'=> $this->flag,
        'country'=> $this->country,
        'color'=> $this->color,
        'status'=>$this->status,
   
        ];
    }



    public function tblResultApi()
    {
        return $this->belongsTo(tblResultApi::class,'toto_site');
    }
    public function tbl4DResult()
    {
        return $this->belongsTo(tbl4DResult::class,'type');
    }
    public function site(){
        return $this->hasOne(tbl4DResult::class, 'type', 'flag');
    }
}
