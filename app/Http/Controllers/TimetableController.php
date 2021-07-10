<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Timetable;

class TimetableController extends Controller
{
    //
    function index(Request $req){

       
       
        return view('timetable');
    }

    function submitpartone(Request $req){
        $total_subjects = $req->total_subject;
        $number_of_working_day = $req->number_of_working_day;
        $number_of_sub_per_day = $req->number_of_sub_per_day;            
        $total_hours_for_week = $req->total_hours_for_week;
        //echo $total_subjects;

        return view('subjectform',[
            'total_subjects'=>$total_subjects,
            'number_of_working_day'=>$number_of_working_day,
            'number_of_sub_per_day'=>$number_of_sub_per_day,
            'total_hours_for_week'=>$total_hours_for_week,
            
        ]);

    }

    function createtitmetable(Request $req){      

        $number_of_working_day=$req->number_of_working_day;
        $number_of_sub_per_day=$req->number_of_sub_per_day;
        $total_hours_for_week=$req->total_hours_for_week;
        $total_subject=$req->total_subjects;

        $sub = array();

        $Timetable = new Timetable();

        $Timetable->total_subject = $req->total_subjects;
        $Timetable->number_of_working_day = $req->number_of_working_day;
        $Timetable->number_of_sub_per_day = $req->number_of_sub_per_day;
        $Timetable->total_hours_for_week = $req->total_hours_for_week;
        $Timetable->subject_name = json_encode($req->subject_name);
        $Timetable->subject_hour = json_encode($req->subject_hour);

        $s=1;
        foreach ($req->subject_name as $key => $value) {
           
           $sub[$s]['name']=$value;
           $sub[$s]['hour']=$req->subject_hour[$key];
           $sub[$s]['remain']=$req->subject_hour[$key];

           $s++; 
        }

       


        $html="<table class='shadow-lg bg-white'>";
            $html .="<thead><tr>";
            for ($i = 1; $i <= $number_of_working_day; $i++) {
                $html .="<th class='bg-blue-100 border text-left px-8 py-4'> Day ".$i;
                $html .="</th>";
            }
            $html .="</tr></thead>";
        $row_Array=array();
        for ($i = 1; $i <= $number_of_sub_per_day; $i++) {
            $row_Array[$i]="<tr>";
        }

        for ($i = 1; $i <= $number_of_working_day; $i++) {
            $start = 1;
            $sub_count=count($sub);
            
            for ($j = 1; $j <=$number_of_sub_per_day ; $j++) {
                
                again:
                if($start > $sub_count){
                    $start = 1;
                }

                
                //$temp_txt = "start=> $start |";
                $temp_txt = "";
                if(!empty($sub[$start]['remain']) && $sub[$start]['remain'] > 0 ){

                    // check howmuch possible for one day
                    if(!empty($sub[$start]['day']) && in_array($i, $sub[$start]['day'])){
                            // check how much possible for one day 
                            if($sub[$start]['hour'] > $number_of_working_day){
                                if($sub[$start]['remain'] > ($number_of_working_day-$i) ){

                                }else{
                                    $start++;
                                    goto again;
                                }

                            }else{
                                $start++;
                                goto again;
                            }
                    }

                    $temp_txt .=$sub[$start]['name'];
                    $sub[$start]['remain']--;
                    $sub[$start]['day'][] = $i;
                }else{
                    $start++;

                    goto again;
                }

                $start++;
                //$row_Array[$j] .="<td>Day ".$i."=> ".$j ." start =>".$start ." ";
                $row_Array[$j] .="<td class='border px-8 py-4'>".$temp_txt;
                $row_Array[$j] .="</td>";       
                
            }

        }

        for ($i = 1; $i <= $number_of_sub_per_day; $i++) {
            $row_Array[$i] .="</tr>";
        }


        $html .=implode("",$row_Array);

        $html .="</table>";

        /*print_r($sub);

         die("SADf");*/

        $Timetable->html =$html;
        $Timetable->save(); 

        return view('viewtimetable',[
            'html'=>$html,           
            
        ]);

    }


    function timetablelist(){
        $tables =Timetable::get();
        //echo "<pre>";print_r($tables);echo "</pre>";
        
        return view('timetablelist',['tables' =>$tables]);
    }
}
