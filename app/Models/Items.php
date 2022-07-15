<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Items extends Model
{
    protected $table = 'items';
    protected $fillable = ['name', 'description', 'status', 'price', 'photo', 'admin_id', 'category_id', 'user_id'];

    public function category()
    {
        return $this->belongsTo('App\Models\Category', 'category_id');
    }

    public function admin()
    {
        return $this->belongsTo('App\Models\Admins', 'admin_id');
    }

    /**
     * Scope a query to only include 
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeSelection($query)
    {
        return $query->select('id','name','description','photo','admin_id','category_id','price','created_at');
    }
}
