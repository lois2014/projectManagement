<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    //
    protected $fillable = [
        'name', 'code'
    ];
    
    public static function text($code)
    {
        $area = self::where('code', $code)->select(['name'])->first();
        return !$area ? null : $area->name;
    }

    public static function getAreas($level = '1', $parent = null, $name = null)
    {
    	if (!in_array($level, ['1', '2', '3'])) {
    		return [];
    	}
    	$query = self::where('level', $level);
    	if (!empty($parent)) {
    		$pre = substr($parent . '', 0, (intval($level) - 1) * 2);
    		$query->where('code', 'like', $pre . '%');
    	}

    	if (!empty($name)) {
    		$query->where('name', 'like', '%' . $name . '%');
    	}
    	$areas = $query->get(DB::raw('code as id'), DB::raw('name as text'));
    	return $areas;
    }

    public static function getAll() {
    	$provinces = self::getAreas();
    	$citites = [];
    	$areas = [];
    	foreach ($provinces as $province) {
    		$list = $cities[$province->id] = self::getAreas('2', $province->id);
    		foreach ($list as $city) {
    			$areas_list = $areas[$city->id] = self::getAreas('3', $city->id);
    		}
    	}
    	return [
    		'provinces' => [$provinces],
    		'cities' => $cities,
    		'areas' => $areas
    	];
    }
}
