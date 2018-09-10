<?php
namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Area;

class AreaController extends Controller 
{

	public function provinces(Request $request) 
	{
		$name = $request->input('q');
		$data = Area::where('level', '1')->where('name','like', '%' . $name . '%')->select([\DB::raw('code as id'), \DB::raw('name as text')])->get();
		return response()->json($data);
	}

	public function cities(Request $request) 
	{
		$parent_code = $request->input('q');
		$parent = substr($parent_code, 0, 2);
		$data = Area::where('level', '2')->where('code', 'like', $parent . '%')->select([\DB::raw('code as id'), \DB::raw('name as text')])->get();
		return response()->json($data);
	}

	public function areas(Request $request) 
	{
		$parent_code = $request->input('q');
		$parent = substr($parent_code, 0, 4);
		$data = Area::where('level', '3')->where('code', 'like', $parent . '%')->select([\DB::raw('code as id'), \DB::raw('name as text')])->get();
		if ($data->isEmpty()) {
			$data = Area::where('code', $parent_code)->select([\DB::raw('code as id'), \DB::raw('name as text')])->get();
		}
		return response()->json($data);
	}

}