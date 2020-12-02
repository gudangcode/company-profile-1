<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Portfolio extends Model
{
    protected $fillable = ['id', 'title', 'slug', 'start_date', 'submission_date', 'client_name', 'tags', 'featured_image', 'content', 'service_id', 'status'];

    public function portfolio_images() {
      return $this->hasMany('App\PortfolioImage');
    }

    public function service() {
      return $this->belongsTo('App\Service');
    }
}
