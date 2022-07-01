<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Casts\Attribute;

class tblResultApi extends Model
{
    use HasFactory,Searchable;

    protected $fillable = [
        'api_url',
        'toto_site',
        'status',     
       
    ];
    public function toSearchableArray()
    {
        return [
        'api_url'=> $this->api_url,
        'toto_site'=> $this->toto_site,
        'status'=> $this->status,
        
   
        ];
    }

    protected function TotoSite(): Attribute
{
    return new Attribute(
        fn($value) => json_decode($value),
        fn($value) => json_encode($value)
    );
}

    public function tblTotoSite()
    {
        return $this->belongsToMany(tblTotoSite::class,'flag');
    }
}
