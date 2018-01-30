<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Options extends Model
{
    use SoftDeletes;
    /**
     * 数据表名
     * @var [type]
     */
    protected $table = 'options';

    /**
     * 自动填充的字段
     * @var [type]
     */
    protected $fillable = ['subject_id', 'option', 'fraction', 'created_at', 'updated_at', 'deleted_at' ];
    public function subjects()
    {
        return $this->belongsTo(\App\User::class, 'subject_id', 'id');
    }
}
