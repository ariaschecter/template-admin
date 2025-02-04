<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class IKU3 extends Model
{
    use HasFactory, HasUuids, SoftDeletes;

    protected $table = 'iku_3';

    protected $guarded = ['id'];

    public function select_list() {
        return $this->belongsTo(SelectList::class, 'select_id');
    }
}
