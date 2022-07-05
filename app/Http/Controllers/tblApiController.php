<?php

namespace App\Http\Controllers;

use App\Models\tbl4DResult;
use App\Models\tblTotoSite;
use App\Models\View4DResult;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Ramsey\Collection\Collection;

class tblApiController extends Controller
{
    /**
     * Display a listing of the Api 4D Result.
     * Get a list of 4D Result Site.
     * @urlParam date string required Example:today
     * @Result4DController App\Http\Controllers\Result4DController
     * @tbl4DResult App\Models\tbl4DResult
     * @return Result4DController
     */
    public function index($date)
    {
        if($date=='today' || $date==''){
            $jackpotDate=Carbon::today()->format('Y-m-d');
        }
        else{
            $jackpotDate=Carbon::parse($date)->format('Y-m-d');
            if(Carbon::today() <= Carbon::parse($date)){
                $jackpotDate=Carbon::today()->format('Y-m-d');
            }else{
                $jackpotDate=Carbon::parse($date)->format('Y-m-d');
            }
        }
        $sites=tbl4DResult::where('dd','<=',$date)->orderBy('dd','desc')->with('site')->get()->unique('type');
        foreach ($sites as $site) {
            $results[] = collect(
                ['type' => $site->type,
                    'fdData' => [
                        'n1' => $site->n1,
                        'n1_pos' =>$site->n1_pos,
                        'n2' => $site->n2,
                        'n2_pos' =>$site->n2_pos,
                        'n3' => $site->n3,
                        'n3_pos' =>$site->n3_pos,
                        'n11' => $site->n11,
                        'n12' => $site->n12,
                        'n13' => $site->n13,
                        's1' => $site->s1,
                        's2' => $site->s2,
                        's3' => $site->s3,
                        's4' => $site->s4,
                        's5' => $site->s5,
                        's6' => $site->s6,
                        's7' => $site->s7,
                        's8' => $site->s8,
                        's9' => $site->s9,
                        's10' => $site->s10,
                        's11' => $site->s11,
                        's12' => $site->s12,
                        's13' => $site->s13,
                        'c1' => $site->c1,
                        'c2' => $site->s2,
                        'c3' => $site->s3,
                        'c4' => $site->s4,
                        'c5' => $site->s5,
                        'c6' => $site->s6,
                        'c7' => $site->s7,
                        'c8' => $site->s8,
                        'c9' =>$site->s9,
                        'c10' =>$site->s10,

                        'dd' => $site->dd,
                        'dn' => $site->dn,
                        'day' => $site->day,
                        'isLive' => $site->isLive,
                        'isToday' => $site->isToday,
                        'videoUrl' => $site->videoUrl,
                        'jackpotAmount' => $site->jackpotAmount,
                        'count' => $site->count],
                ]
            );
        }
        return  response()->json($results);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


}
