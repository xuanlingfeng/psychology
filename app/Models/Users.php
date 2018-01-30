<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Users extends Model
{
    use SoftDeletes;
    /**
     * 数据表名
     * @var [type]
     */
    protected $table = 'users';

    /**
     * 自动填充的字段
     * @var [type]
     */
    protected $fillable = ['name', 'email', 'password', 'remember_token', 'created_at', 'updated_at'];

}
