<?php
namespace App\Http\Controllers;
use App\Models\Category;

class ApiController extends Controller
{
	public function categories()
	{
		$categories = Category::select(['id', 'title'])->where('parent_id', 0)->orderBy('order')->get();
		return $this->json($categories);
	}

	protected function json($data, $code = 200)
	{
		return response()->json($data, $code);
	}
}