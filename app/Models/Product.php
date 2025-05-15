<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['name', 'description', 'code', 'category_id',  'unit_price', 'unit', 'alert_threshold'];

    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function stockMovements() {
        return $this->hasMany(StockMovement::class);
    }

    public function getAvailableStock()
    {
        $entries = $this->stockMovements()->where('type', 'entry')->sum('quantity');
        $exits = $this->stockMovements()->where('type', 'exit')->sum('quantity');
        
        return $entries - $exits;
    }

    public function isLowStock()
    {
        return $this->getAvailableStock() <= $this->alert_threshold;
    }


}
