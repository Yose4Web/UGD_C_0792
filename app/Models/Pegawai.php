<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    use HasFactory;

    /**
    * fillable
    *
    * @var array
    */

    protected $fillable = [
        'nip',
        'nama_pegawai',
        'departemen_id',
        'email',
        'telepon',
        'gender',
        'status',
    ]; 
}
