<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Encore\Admin\Traits\AdminBuilder;
use Encore\Admin\Traits\ModelTree;
use Encore\Admin\Tree;

class Category extends Model
{
    use ModelTree, AdminBuilder;
    //
    protected $fillable = [
    	'title', 'parent_id'
    ];

    /**
     * Get options for Select field in form.
     *
     * @return \Illuminate\Support\Collection
     */
    public static function selectOptions()
    {
    	$model = (new static());
        $options = $model->buildSelectOptions();

        return collect($options)->prepend('Root', 0)->all();
    }

}
