<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    //
    //
    protected $fillable = [
        'title', 'polulation', 'area_code', 'category_id', 'investor', 'size', 'address', 'schedule', 'status', 'release', 'province', 'city'
    ];

    public static $statusText = [
    	'未建',
    	'待建',
    	'已建'
    ];

    protected $appends = ['status_text', 'category_text', 'area_text'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function area()
    {
    	return $this->belongsTo(Area::class, 'area_code', 'code');
    }

    public function getAreaTextAttribute()
    {
    	return Area::text($this->province) . Area::text($this->city) . Area::text($this->area_code);
    }

    public function getCategoryTextAttribute() {
    	if (!$this->category) {
    		return null;
    	}
    	return $this->category->title;
    }

    public function getStatusTextAttribute() {
    	$status = $this->status;
    	if (isset(self::$statusText[$status])) {
    		return self::$statusText[$status];
    	}
    	return null;
    }

}
