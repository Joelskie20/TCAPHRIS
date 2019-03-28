<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\WorkshiftPerDay;
use Carbon;
use App\Workshift;
use DB;

class WorkshiftPerDayController extends Controller
{
    public function show(WorkshiftPerDay $day)
    {
        return response()->json($day, 200);
    }

    // public function store(Request $request)
    // {

    //     $id = $request->tid;
    //     $datecode = $request->date;
        
    //     $restDayVal = 0;
    //     $restDayVal_str = '';
    //     if($request->restday == 'true') {
    //         $restDayVal = 1;
    //         $restDayVal_str = 'RD';
    //     }

        // $workshift_schedule = $request->time_in.'-'.$request->time_out.',8.0,'.$restDayVal_str;

    //     // insert data
    //     WorkshiftPerDay::create([
    //         'user_id' => $request->uid,
    //         'workshift_schedule' => $workshift_schedule,
    //         'date_code' => $datecode,
    //         'rest_day' => $restDayVal
    //     ]);

    //     $ws_id = DB::table('user_workshift_per_day')->where([
    //         ['workshift_schedule', '=', $workshift_schedule],
    //         ['date_code', '=', $datecode]
    //     ])->orderBy('id', 'desc')->first()->id;

    //     // SELECT * FROM table ORDER BY id DESC LIMIT 1

    //     // create HTML to append in TD
    //     $td_val = '<div id="ws-'.$ws_id.'" class="btn btn-default btn-block" data-id="'.$ws_id.'" data-time-in="'.$request->time_in.'" data-time-out="'.$request->time_out.'" data-toggle="modal" data-target="#workshift-modal"><span class="userTimeIn">'.Workshift::formatTime($request->time_in).'</span><span class="userTimeOut">'.Workshift::formatTime($request->time_out).'</span>';
    //     if($restDayVal) {
    //         $td_val .= '<span class="userRestDay">Rest Day</span>';
    //     }
    //     $td_val .= '</div>';

    //     echo "<script>
    //         $(function() {
    //             $('.td-".$id."').append('".$td_val."');
    //             $('.btn-modal-close').click();
    //         });
    //     </script>";
    // }

    public function store(Request $request)
    {
        $restDayValue = 0;

        $restDayValStr = '';

        if($request->rest_day == 'true') {

            $restDayValue = 1;

            $restDayValStr = 'RD';
        }

        $workshiftSchedule = $request->time_in.'-'.$request->time_out.',8.0,'.$restDayValStr;

        WorkshiftPerDay::create([
            'user_id' => $request->user_id,
            'workshift_schedule' => $workshiftSchedule,
            'date_code' => $request->date,
            'rest_day' => $restDayValue
        ]);

        $newlyCreatedId = DB::table('user_workshift_per_day')->where([
            ['workshift_schedule', '=', $workshiftSchedule],
            ['date_code', '=', $request->date]
        ])->orderBy('id', 'desc')->first()->id;

        return [
            'td_id' => $request->td_id,
            'new_id' => $newlyCreatedId,
            'time_in_raw' => $request->time_in,
            'time_out_raw' => $request->time_out,
            'time_in' => Workshift::formatTime($request->time_in),
            'time_out' => Workshift::formatTime($request->time_out),
            'rest_day' => $restDayValue
        ];
    }

    public function update(Request $request, $id)
    {
        $restDayValue = 0;
        $restDayValStr = '';

        if ($request->rest_day == 'true') {
            
            $restDayValue = 1;

            $restDayValStr = 'RD';

        }

        $workshiftSchedule = $request->time_in . '-' . $request->time_out . ',8.0,' . $restDayValStr;

        $day = WorkshiftPerDay::findOrFail($id);

        $day->update([
            'workshift_schedule' => $workshiftSchedule,
            'rest_day' => $restDayValue
        ]);

        return [
            'time_in_raw' => $request->time_in,
            'time_out_raw' => $request->time_out,
            'time_in' => Workshift::formatTime($request->time_in),
            'time_out' => Workshift::formatTime($request->time_out),
            'rest_day' => $restDayValue
        ];

    }

    public function destroy($id)
    {
        WorkshiftPerDay::destroy($id);
    }
}
