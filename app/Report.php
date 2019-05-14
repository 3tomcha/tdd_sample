<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Report
 *
 * @property-read \App\Customer $customer
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Report newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Report newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Report query()
 * @mixin \Eloquent
 */
class Report extends Model
{
  public function customer()
  {
    return $this->belongsTo('\App\Customer');
  }
}
