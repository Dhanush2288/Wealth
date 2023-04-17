<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Blog extends Authenticatable
{
    protected $table="blog";

    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'creator_id',
        'manager_id',
        'title',
        'abstract',
        'risk',
        'product_id',
        'instrument_id',
        'major_id',
        'minor_id',
        'region_id',
        'country_id',
        'content',
        'currency_id',
        'expiry_at',
        'status','maxrange'
    ];

}
