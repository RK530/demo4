<?php

namespace App\Console\Commands;

use App\Models\tbl4DResult;
use App\Models\tblSpecial;
use App\Models\tblTotoSite;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class storeData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'data:create {date}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create new 4D data';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $date=$this->argument('date');
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
                                'count' => $responseBody['fdData']['count'],
                                'jackpotAmount'=> array_key_exists('jackpotAmount', $responseBody['fdData']) ? $responseBody['fdData']['jackpotAmount'] : "",
                                'videoUrl'=> array_key_exists('videoUrl', $responseBody['fdData']) ? $responseBody['fdData']['videoUrl'] : "",
                            ]);


                        }
                    }
                }
            }

        }

        $this->info('Success create');


    }
    }

