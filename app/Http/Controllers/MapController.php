<?php
namespace App\Http\Controllers;
use App\Models\Project;
use App\Models\Area;
use App\Models\Category;
use Illuminate\Http\Request;
class MapController extends Controller 
{
	public function index($category_id)
	{
		$conditions = [
			'release' => 1		
		];
		$category_id != 'all' ? $conditions['category_id'] = $category_id : '';
		$projects = Project::where($conditions)->orderBy('id', 'desc')->get();
		$list = [];
		$count = [];
		$count_array = [];
		foreach ($projects as $project) {
			$province = substr($project->area_code, 0, 2) . '0000';
			$list[$province][] = $project;
			$count[$province][$project->status] = isset($count[$province][$project->status]) ? $count[$province][$project->status] + 1 : 1; 
		}
		foreach ($count as $province => $value) {
			// dd(array_keys($value));
			$count_array[$province]['count'] = $value;
			$count_array[$province]['name'] = Area::text($province); 
		}
		// dd($count_array);
		return view('map.index', ['projects' => json_encode($list), 'count' => $count_array, 'categories' => Category::where('parent_id', 0)->get(), 'category_id' => $category_id]);
	}
}