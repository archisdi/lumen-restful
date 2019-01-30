<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Webpatser\Uuid\Uuid;


abstract class BaseModel extends Model
{
    protected $primaryKey = 'uuid';

    public $incrementing = false;

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->uuid = (string) Uuid::generate(4);
        });
    }
}