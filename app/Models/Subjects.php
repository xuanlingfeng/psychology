<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Subjects extends Model
{
    use SoftDeletes;
    /**
     * 数据表名
     * @var [type]
     */
    protected $table = 'subjects';

    /**
     * 自动填充的字段
     * @var [type]
     */
    protected $fillable = ['subject', 'created_at', 'updated_at', 'deleted_at' ];

}
