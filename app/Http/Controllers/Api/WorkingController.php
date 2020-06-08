<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Onworking;
use App\Labour;

class WorkingController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Onworking::with('joinlab')->orderBy('status','desc')->paginate(10);
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request, $id)
    {
        $workSts = Onworking::findOrFail($id);

        $workSts->status=1;
        $workSts->seen=0;
        $workSts->update();

    }
    public function UpdateRequest(Request $request,$labid)
    {
        $LabSts = Labour::find($labid);

        $LabSts->status=1;
        $LabSts->update();
        return $labid;
    }

    public function CompleteWork(Request $request,$id)
    {
        $workSts = Onworking::find($id);

        $workSts->status=0;
        $workSts->update();
    }
    public function LabourDone(Request $request,$id)
    {
        $LabSts = Labour::find($id);

        $total_work = $LabSts->totalwork;

        $LabSts->status=0;
        $LabSts->totalwork=$total_work+1;
        $LabSts->update();
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $onwork = Onworking::findOrFail($id);

        $onwork->delete();
        return ['message' => 'deleted'];
    }

    public function Notify()
    {
        $RequestCount = Onworking::where('seen',1)->get();
        return $RequestCount->count();
    }

}
