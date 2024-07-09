<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserRole extends Model
{
    public const OTHER = 4000;
    public const STUDENT = 4001;
    public const ADMIN = 4002;
}
