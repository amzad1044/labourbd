<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Labour;
use App\Type;
use App\Area;
use DB;
use App\Onworking;
use Session;

class FrontController extends Controller
{
	public function index()
	{
        $featureLab = Labour::orderBy('totalwork','desc')->where('status',0)->take(9)->get();

		$area = Area::orderBy('created_at','desc')->get();
		$catsTakeall = Type::orderBy('created_at','desc')->get();
		$cats = Type::orderBy('created_at','desc')->take(8)->get();
		return view('front.home.home',[
			'categories' => $cats,
			'areas' => $area,
			'catsdropdown' => $catsTakeall,
            'labourFeature' => $featureLab
		]);
	}
    public function Category()
    {
    	$cats = Type::orderBy('_id','desc')->get();
    	return view('front.category.category',['categories' => $cats]);
    }
    public function LabourCategory($id,$cat_name)
    {
    	$LabByCat = Labour::where('typeId',$id)->where('status',0)->get();
    	return view('front.category.labcategory',['labCats' => $LabByCat,'catName' => $cat_name]);
    }
    public function AllLabour()
    {
    	$all_labour = Labour::where('status',0)->get();
    	return view('front.labour.labour',['labour_all' => $all_labour]);
    }
    public function SearchLabour(Request $request)
    {
    	$area = $request->area;
    	$type = $request->type;
    	$all_labour = Labour::where('areaId',$area)->where('typeId',$type)->where('status',0)->get();
    	return view('front.labour.labour',['labour_all' => $all_labour]);

    }
    public function Hirelabour($id)
    {

        if(Session::has('custId'))
        {
            $singleLabour = Labour::find($id);

            $onwork = new Onworking();
            $onwork->labourid = $id;
            $onwork->clientid = Session::get('custId');
            $onwork->clientName = Session::get('custName');
            $onwork->clientEmail = Session::get('custEmail');
            $onwork->clientPhone = Session::get('custPhone');
            $onwork->status= 2;
            $onwork->seen= 1;
            $onwork->save();
            return view('front.labour.singlelab',['singlelab' => $singleLabour]);
        }
        else
        {
            return redirect('client_login');
        }

    }
    public function About()
    {
        return view('front.about.about');
    }
    public function Contact()
    {
        return view('front.contact.contact');
    }
}
