<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\tblTotoSite;

class tbl4DResult extends Model
{
    use HasFactory;
    protected $fillable = [
        'type',
        'n1',
        'n2',
        'n3',
        's1',
        's2',
        's3',
        's4',
        's5',
        's6',
        's7',
        's8',
        's9',
        's10',
        's11',
        's12',
        's13',
        'c1',
        'c2',
        'c3',
        'c4',
        'c5',
        'c6',
        'c7',
        'c8',
        'c9',
        'c10',
        'dd',
        'dn',
        'day',
        'n1_pos',
        'n2_pos',
        'n3_pos',
        'isLive',
        'count',
        'n11',
        'n12',
        'n13',
        'videoUrl',
        'jackpotAmount',

    ];

    public static $rules=[
        'type' =>'required|string|max:10',
        'dd'=>'nullable',
        'dn'=>'nullable',
        'day'=>'nullable|string|max:100',

    ];

    public function tblTotoSite()
    {
        return $this->belongsToMany(tblTotoSite::class,'flag');
    }

    public function site(){
        return $this->hasOne(tblTotoSite::class, 'flag', 'type');
    }
    public function special(){
        return $this->hasOne(tblSpecial::class, 'drawDate', 'dd');
    }
}
