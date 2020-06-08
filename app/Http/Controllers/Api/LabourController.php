<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Labour;
use Image;
use Auth;
use App\Area;
use App\Type;

class LabourController extends Controller
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
        return Labour::with('jointype','joinarea','joinuser')->latest()->paginate(10);

    }
    public function GetArea()
    {
        return Area::orderBy('created_at','desc')->get();
    }
    public function GetType()
    {
        return Type::orderBy('created_at','desc')->get();
    }
    public function GetLabour()
    {
        return Labour::orderBy('created_at','desc')->get();
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validate($request,[
            'name' => 'required|max:20',
            'phone' => 'required',
            'areaId' => 'required',
            'typeId' => 'required',
            'price' => 'required',
            'photo' => 'required',
        ]);
        $ext = time().'.' . explode('/', explode(':', substr($request->photo, 0, strpos($request->photo, ';')))[1])[1];
        $img_Up = Image::make($request->photo)->resize(300,300)->save(public_path('img_upload/labour/').$ext);

        $lab = new Labour();
        $lab->name = $request->name;
        $lab->phone = $request->phone;
        $lab->areaId = $request->areaId;
        $lab->typeId = $request->typeId;
        $lab->price = $request->price;
        $lab->photo = $ext;
        $lab->status = 0;
        $lab->totalwork = 0;
        $lab->userId = auth('api')->user()->_id;
        $lab->save();
        return ['message' => 'saved successfully'];
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
        $lab = Labour::findOrFail($id);
        $this->validate($request,[
            'name' => 'required|max:20',
            'phone' => 'required',
            'areaId' => 'required',
            'typeId' => 'required',
            'price' => 'required',
        ]);
        if($request->photo!=$lab->photo)
        {
            $ext = time().'.' . explode('/', explode(':', substr($request->photo, 0, strpos($request->photo, ';')))[1])[1];
            $img_Up = Image::make($request->photo)->resize(300,300)->save(public_path('img_upload/labour/').$ext);

            $imgPath = public_path('img_upload/labour/');
            $img = $imgPath. $lab->photo;

            if(file_exists($img)){
                @unlink($img);
            }

            $lab->name = $request->name;
            $lab->phone = $request->phone;
            $lab->areaId = $request->areaId;
            $lab->typeId = $request->typeId;
            $lab->price = $request->price;
            $lab->photo = $ext;
            $lab->userId = auth('api')->user()->_id;
            $lab->update();
            return ['message' => 'Updated successfully'];
        }
        else
        {
            $lab->name = $request->name;
            $lab->phone = $request->phone;
            $lab->areaId = $request->areaId;
            $lab->typeId = $request->typeId;
            $lab->price = $request->price;
            $lab->userId = auth('api')->user()->_id;
            $lab->update();
            return ['message' => 'Updated successfully'];
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $lab = Labour::findOrFail($id);

        $imgPath = public_path('img_upload/labour/');
        $img = $imgPath. $lab->photo;

        if(file_exists($img)){
            @unlink($img);
        }

        $lab->delete();
        return ['message' => 'deleted'];
    }



}
