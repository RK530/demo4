<?php

namespace App\Http\Controllers;

use App\Models\tblSpecial;
use App\Models\View4DResult;
use Illuminate\Http\Request;
use App\Models\tbl4DResult;
use App\Models\tblTotoSite;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;
use phpDocumentor\Reflection\Types\Collection;
use RealRashid\SweetAlert\Facades\Alert;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class Result4DController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->filled('dd')){
            $date=$request->dd;
            $mydate=Carbon::createFromFormat('Y-m-d', $date);
            $day=Carbon::createFromFormat('Y-m-d', $date)->format('l');

        }
       else{
        $date=Carbon::now()->format('Y-m-d');
        $day=Carbon::now()->format('l');
    }
    $nn=Carbon::now()->format('Y-m-d');
    $now=Carbon::now()->format('H:i:s');

    $start=Carbon::createFromTimeString('19:00:00')->format('H:i:s');
    $end = Carbon::createFromTimeString('19:00:00')->addDay()->format('Y-m-d H:i:s');
    //return $day=='Saturday'||'Sunday'||'Monday' ? 'true':'false';
    //return $test;

        $results = tbl4DResult::where('dd','<=',$date)->orderBy('dd','desc')->with('site')->get()->unique('type');
        //return  $results[0]->dd >= $test ? 't':'f';
                 //return $totos;
        $totoSites=tblTotoSite::latest()->paginate(9);
        return view('backend.4d_result.index',compact('results','date','totoSites','day','start','now','nn','end'))
            ->with('i', (request()->input('page', 1) - 1) * 9);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.4d_result.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       //return $request->all();
         $result=new tbl4DResult();
         $result->create($request->all());
         return back();
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
    public function update(Request $request, tbl4DResult $result)
    {

         $result->update($request->all());
         return back();



    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        tbl4DResult::find($id)->delete();

        return back()
               ->with('success','Record has been delete successfully');
    }

    public function  getResult($date = 'today')
    {

        if($date=='today' || $date==''){
           $string='';
           $stringDay='';
           $jackpotDate=Carbon::today()->format('Y-m-d');
        }else{
            $jackpotDate=Carbon::parse($date)->format('Y-m-d');
            if(Carbon::today()<=Carbon::parse($date)){
                $string='';
                $stringDay='';
                $date='today';
                $jackpotDate=Carbon::today()->format('Y-m-d');
            }else{
                $valid=['Wed','Sat','Sun'];
                if(!in_array(Carbon::parse($date)->format('D'),$valid)){
                   for($i=1;$i<=7;$i++){
                       $drawdate=$date;
                       $drawdate=Carbon::parse($drawdate)->subDay($i);
                       if(in_array(Carbon::parse($drawdate)->format('D'),$valid)){
                           $drawdate=Carbon::parse($drawdate)->format('Y-m-d');
                           break;
                       }
                   }
                }else{
                    $drawdate=Carbon::parse($date)->format('Y-m-d');
                }
                $string='?d=' .$drawdate;
                $stringDay='?date='.Carbon::parse($date)->format('Y-m-d');
            }
        }
        $url = 'https://api.4dnum.com/api/v1/result/'.$date;
        $response = Http::get($url);
        $responseBodys = json_decode($response->getBody(), true);
        $sites=tblTotoSite::all();
        $results=tbl4DResult::where('dd',$date)->get();
        $special=tblSpecial::where('drawDate',$date)->get();
        $day=Carbon::parse($date)->format('D');
        //return $day;
        //check special draw date
          if($day=='Tue'){
            foreach ($responseBodys as $responseBody){
                //return count($special);
                if($responseBody['type']=='CS' && count($special)==0) {
                    if ($responseBody['fdData']['dd'] == $date) {

                        tblSpecial::create([
                            'drawDate' => $responseBody['fdData']['dd'],
                        ]);
                    }
                }
            }

        }


        if(count($results)==0){
        foreach ($responseBodys as $responseBody) {
                foreach ($sites as $site) {
                        if ($site->flag == $responseBody['type'] && $responseBody['fdData']['dd']==$date) {
                                $newDate = tbl4DResult::create([
                                    'type' => $responseBody['type'],
                                    'n1' => $responseBody['fdData']['n1'],
                                    'n2' => $responseBody['fdData']['n2'],
                                    'n3' => $responseBody['fdData']['n3'],
                                    's1' => $responseBody['fdData']['s1'],
                                    's2' => $responseBody['fdData']['s2'],
                                    's3' => $responseBody['fdData']['s3'],
                                    's4' => $responseBody['fdData']['s4'],
                                    's5' => $responseBody['fdData']['s5'],
                                    's6' => $responseBody['fdData']['s6'],
                                    's7' => $responseBody['fdData']['s7'],
                                    's8' => $responseBody['fdData']['s8'],
                                    's9' => $responseBody['fdData']['s9'],
                                    's10' => $responseBody['fdData']['s10'],
                                    's11' => $responseBody['fdData']['s11'],
                                    's12' => $responseBody['fdData']['s12'],
                                    's13' => $responseBody['fdData']['s13'],
                                    'c1' => $responseBody['fdData']['c1'],
                                    'c2' => $responseBody['fdData']['c2'],
                                    'c3' => $responseBody['fdData']['c3'],
                                    'c4' => $responseBody['fdData']['c4'],
                                    'c5' => $responseBody['fdData']['c5'],
                                    'c6' => $responseBody['fdData']['c6'],
                                    'c7' => $responseBody['fdData']['c7'],
                                    'c8' => $responseBody['fdData']['c8'],
                                    'c9' => $responseBody['fdData']['c9'],
                                    'c10' => $responseBody['fdData']['c10'],
                                    //'n11' => $responseBody['fdData']['n11'],
                                    //'n12' => $responseBody['fdData']['n12'],
                                    //'n13' => $responseBody['fdData']['n13'],
                                    'n11' => array_key_exists('n11', $responseBody['fdData']) ? $responseBody['fdData']['n11'] : "",
                                    'n12' => array_key_exists('n12', $responseBody['fdData']) ? $responseBody['fdData']['n12'] : "",
                                    'n13' => array_key_exists('n13', $responseBody['fdData']) ? $responseBody['fdData']['n13'] : "",
                                    'n1_pos' => $responseBody['fdData']['n1_pos'],
                                    'n2_pos' => $responseBody['fdData']['n2_pos'],
                                    'n3_pos' => $responseBody['fdData']['n3_pos'],
                                    'dn' => $responseBody['fdData']['dn'],
                                    'dd' => $responseBody['fdData']['dd'],
                                    'day' => $responseBody['fdData']['day'],
                                    'isLive' => $responseBody['fdData']['isLive'],
                                    'count' => $responseBody['fdData']['count'],
                                    'jackpotAmount'=> array_key_exists('jackpotAmount', $responseBody['fdData']) ? $responseBody['fdData']['jackpotAmount'] : "",
                                    'videoUrl'=> array_key_exists('videoUrl', $responseBody['fdData']) ? $responseBody['fdData']['videoUrl'] : "",

                                ]);
                        }
                }
            }
            return  response()->json('record created successfully');
        }else{

                foreach ($sites as $site){
                   if(!empty($results)){
                      foreach ($results as $r){
                          if($r->type==$site->flag) {
                              $rr[] = $r->type;
                          }
                      }
                   }
                }


            //return $rr;
            foreach ($sites as $site){
                if(!in_array($site->flag,$rr)){
                    foreach ($responseBodys as $responseBody){
                        if($site->flag ==$responseBody['type'] && $responseBody['fdData']['dd']==$date){
                            $newDate = tbl4DResult::create([
                                'type' => $responseBody['type'],
                                'n1' => $responseBody['fdData']['n1'],
                                'n2' => $responseBody['fdData']['n2'],
                                'n3' => $responseBody['fdData']['n3'],
                                's1' => $responseBody['fdData']['s1'],
                                's2' => $responseBody['fdData']['s2'],
                                's3' => $responseBody['fdData']['s3'],
                                's4' => $responseBody['fdData']['s4'],
                                's5' => $responseBody['fdData']['s5'],
                                's6' => $responseBody['fdData']['s6'],
                                's7' => $responseBody['fdData']['s7'],
                                's8' => $responseBody['fdData']['s8'],
                                's9' => $responseBody['fdData']['s9'],
                                's10' => $responseBody['fdData']['s10'],
                                's11' => $responseBody['fdData']['s11'],
                                's12' => $responseBody['fdData']['s12'],
                                's13' => $responseBody['fdData']['s13'],
                                'c1' => $responseBody['fdData']['c1'],
                                'c2' => $responseBody['fdData']['c2'],
                                'c3' => $responseBody['fdData']['c3'],
                                'c4' => $responseBody['fdData']['c4'],
                                'c5' => $responseBody['fdData']['c5'],
                                'c6' => $responseBody['fdData']['c6'],
                                'c7' => $responseBody['fdData']['c7'],
                                'c8' => $responseBody['fdData']['c8'],
                                'c9' => $responseBody['fdData']['c9'],
                                'c10' => $responseBody['fdData']['c10'],
                                //'n11' => $responseBody['fdData']['n11'],
                                //'n12' => $responseBody['fdData']['n12'],
                                //'n13' => $responseBody['fdData']['n13'],
                                'n11' => array_key_exists('n11', $responseBody['fdData']) ? $responseBody['fdData']['n11'] : "",
                                'n12' => array_key_exists('n12', $responseBody['fdData']) ? $responseBody['fdData']['n12'] : "",
                                'n13' => array_key_exists('n13', $responseBody['fdData']) ? $responseBody['fdData']['n13'] : "",
                                'n1_pos' => $responseBody['fdData']['n1_pos'],
                                'n2_pos' => $responseBody['fdData']['n2_pos'],
                                'n3_pos' => $responseBody['fdData']['n3_pos'],
                                'dn' => $responseBody['fdData']['dn'],
                                'dd' => $responseBody['fdData']['dd'],
                                'day' => $responseBody['fdData']['day'],
                                'isLive' => $responseBody['fdData']['isLive'],
                                'jackpotAmount'=> array_key_exists('jackpotAmount', $responseBody['fdData']) ? $responseBody['fdData']['jackpotAmount'] : "",
                                'count' => $responseBody['fdData']['count'],
                                'videoUrl'=> array_key_exists('videoUrl', $responseBody['fdData']) ? $responseBody['fdData']['videoUrl'] : "",
                            ]);


                        }
                    }
                }
            }
            return  response()->json('record created successfully');

        }

        //return redirect()->route('result.index');


    }

    public function getNumberCount($number){
        $count=0;
        $top=0;
        $special=0;
        $consolation=0;
        $findNumber=View4DResult::where('n1',$number)->orWhere('n2',$number)->orWhere('n3',$number)
                                 ->orWhere('s1',$number)->orWhere('s2',$number)->orWhere('s3',$number)
                                 ->orWhere('s4',$number)->orWhere('s5',$number)->orWhere('s6',$number)
                                 ->orWhere('s7',$number)->orWhere('s8',$number)->orWhere('s9',$number)
                                 ->orWhere('s10',$number)->orWhere('s11',$number)->orWhere('s12',$number)
                                 ->orWhere('s13',$number)->orWhere('c1',$number)->orWhere('c2',$number)
                                 ->orWhere('c3',$number)->orWhere('c4',$number)->orWhere('c5',$number)
                                 ->orWhere('c6',$number)->orWhere('c7',$number)->orWhere('c8',$number)
                                 ->orWhere('c9',$number)->orWhere('c10',$number)->orderBy('dd','desc')
                                 ->get();
        if(count($findNumber)==0){
            return 'not results';
        }

        $ss=tblTotoSite::all();

        foreach ($findNumber as $f){
            $rr[]=$f->type;
        }
        for($i=0;$i<count($findNumber);$i++){
            $count=array_count_values($rr);
        }
        $keys=array_keys($count);
        $v=array_values($count);
        for($i=0;$i<count($count);$i++){
                $c[]= $keys[$i].' : '.$v[$i].'<br />';
        }
        $c=json_encode($count);

      // return response()->json($count);


        //return $findNumber;
            foreach ($findNumber as $n){
                if($n->n1==$number){
                    $collect[]=collect([
                        'type'=>$n->type,
                        'draw date' =>$n->dd,
                        'Prize'=>'1st',
                    ]);
                }elseif ($n->n2==$number){
                    $collect[]=collect([
                        'type'=>$n->type,
                        'draw date' =>$n->dd,
                        'Prize'=>'2nd',
                    ]);
                }elseif ($n->n3==$number){
                    $collect[]=collect([
                        'type'=>$n->type,
                        'draw date' =>$n->dd,
                        'Prize'=>'3rd',
                    ]);
                }elseif ($n->s1==$number){
                    $collect[]=collect([
                        'type'=>$n->type,
                        'draw date' =>$n->dd,
                        'Prize'=>'s1',
                    ]);
                }elseif ($n->s2==$number){
                    $collect[]=collect([
                        'type'=>$n->type,
                        'draw date' =>$n->dd,
                        'Prize'=>'s2',
                    ]);
                }elseif ($n->s3==$number){
                    $collect[]=collect([
                        'type'=>$n->type,
                        'draw date' =>$n->dd,
                        'Prize'=>'s3',
                    ]);
                }elseif ($n->s4==$number){
                    $collect[]=collect([
                        'type'=>$n->type,
                        'draw date' =>$n->dd,
                        'Prize'=>'s4',
                    ]);
                }elseif ($n->s5==$number){
                    $collect[]=collect([
                        'type'=>$n->type,
                        'draw date' =>$n->dd,
                        'Prize'=>'s5',
                    ]);
                }elseif ($n->s6==$number){
                    $collect[]=collect([
                        'type'=>$n->type,
                        'draw date' =>$n->dd,
                        'Prize'=>'s6',
                    ]);
                }elseif ($n->s7==$number){
                    $collect[]=collect([
                        'type'=>$n->type,
                        'draw date' =>$n->dd,
                        'Prize'=>'s7',
                    ]);
                }elseif ($n->s8==$number){
                    $collect[]=collect([
                        'type'=>$n->type,
                        'draw date' =>$n->dd,
                        'Prize'=>'s8',
                    ]);
                }elseif ($n->s9==$number){
                    $collect[]=collect([
                        'type'=>$n->type,
                        'draw date' =>$n->dd,
                        'Prize'=>'s9',
                    ]);
                }elseif ($n->s10==$number){
                    $collect[]=collect([
                        'type'=>$n->type,
                        'draw date' =>$n->dd,
                        'Prize'=>'s10',
                    ]);
                }elseif ($n->s11==$number){
                    $collect[]=collect([
                        'type'=>$n->type,
                        'draw date' =>$n->dd,
                        'Prize'=>'s11',
                    ]);
                }elseif ($n->s12==$number){
                    $collect[]=collect([
                        'type'=>$n->type,
                        'draw date' =>$n->dd,
                        'Prize'=>'s12',
                    ]);
                }elseif ($n->s13==$number) {
                    $collect[] = collect([
                        'type' => $n->type,
                        'draw date' => $n->dd,
                        'Prize' => 's13',
                    ]);
                }elseif ($n->c1==$number){
                    $collect[]=collect([
                        'type'=>$n->type,
                        'draw date' =>$n->dd,
                        'Prize'=>'c1',
                    ]);
                }
                elseif ($n->c2==$number){
                    $collect[]=collect([
                        'type'=>$n->type,
                        'draw date' =>$n->dd,
                        'Prize'=>'c2',
                    ]);
                }
                elseif ($n->c3==$number){
                    $collect[]=collect([
                        'type'=>$n->type,
                        'draw date' =>$n->dd,
                        'Prize'=>'c3',
                    ]);
                }
                elseif ($n->c4==$number){
                    $collect[]=collect([
                        'type'=>$n->type,
                        'draw date' =>$n->dd,
                        'Prize'=>'c4',
                    ]);
                }
                elseif ($n->c5==$number){
                    $collect[]=collect([
                        'type'=>$n->type,
                        'draw date' =>$n->dd,
                        'Prize'=>'c5',
                    ]);
                }
                elseif ($n->c6==$number){
                    $collect[]=collect([
                        'type'=>$n->type,
                        'draw date' =>$n->dd,
                        'Prize'=>'c6',
                    ]);
                }
                elseif ($n->c7==$number){
                    $collect[]=collect([
                        'type'=>$n->type,
                        'draw date' =>$n->dd,
                        'Prize'=>'c7',
                    ]);
                }
                elseif ($n->c8==$number){
                    $collect[]=collect([
                        'type'=>$n->type,
                        'draw date' =>$n->dd,
                        'Prize'=>'c8',
                    ]);
                }
                elseif ($n->c9==$number){
                    $collect[]=collect([
                        'type'=>$n->type,
                        'draw date' =>$n->dd,
                        'Prize'=>'c9',
                    ]);
                }
                elseif ($n->c10==$number){
                    $collect[]=collect([
                        'type'=>$n->type,
                        'draw date' =>$n->dd,
                        'Prize'=>'c10',
                    ]);
                }
            }
            //$collect=json_encode($collect);
        for ($i=0;$i<count($collect);$i++){
            if($collect[$i]['Prize']=='1st' OR $collect[$i]['Prize']=='2nd' OR $collect[$i]['Prize']=='3rd'){
                $top++;
            }elseif ($collect[$i]['Prize']=='s1' OR $collect[$i]['Prize']=='s2' OR $collect[$i]['Prize']=='s3' OR $collect[$i]['Prize']=='s4' OR $collect[$i]['Prize']=='s5' OR $collect[$i]['Prize']=='s6' OR $collect[$i]['Prize']=='s7' OR $collect[$i]['Prize']=='s8' OR $collect[$i]['Prize']=='s9'
                OR $collect[$i]['Prize']=='s10' OR $collect[$i]['Prize']=='s11' OR $collect[$i]['Prize']=='12' OR $collect[$i]['Prize']=='s13'){
                $special++;
            }elseif ($collect[$i]['Prize']=='c1'OR $collect[$i]['Prize']=='c2' OR $collect[$i]['Prize']=='c3' OR $collect[$i]['Prize']=='c4' OR $collect[$i]['Prize']=='c5' OR $collect[$i]['Prize']=='c6' OR $collect[$i]['Prize']=='c7' OR $collect[$i]['Prize']=='c8' OR $collect[$i]['Prize']=='c9'
                OR $collect[$i]['Prize']=='c10'){
                $consolation++;
            }
        }
            $collect=implode('<br>',$collect);
        return $number.'<br>'.'history of have been come out :'. $c.'<br>'.'Total out : '.count($findNumber).'<br>'.'Top prize total come out: '.$top .'<br>'.
            'Special prize : '.$special.'<br>'.'Consolation prize : '.$consolation.'<br>'.$collect;

        //return 'Type : '.$type.'<br>'.'Top prize : '.$count.'<br>'.'Special : '.$special.'<br>'.'Consolation : '.$consolation;


    }




}
