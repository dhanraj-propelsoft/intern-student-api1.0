<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class mark extends Model
{
    use HasFactory;
    protected $fillable =['reg_no','examid','sub_id1','sub_id1_mark','sub_id2','sub_id2_mark','sub_id3','sub_id3_mark','total_mark','result'];
}
