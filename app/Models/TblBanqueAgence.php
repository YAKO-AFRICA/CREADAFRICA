<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TblBanqueAgence extends Model
{
    use HasFactory;

    protected $table = 'tblbanqueagence';

    public $timestamps = false;

    protected $connection = 'mysql4';

    
}
