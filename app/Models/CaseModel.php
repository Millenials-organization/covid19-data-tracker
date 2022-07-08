<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CaseModel extends Model
{
    protected $table = 'covidData';
    protected $primaryKey = 'id';
    protected $fillable = ['caseNumber', 'state'];
}