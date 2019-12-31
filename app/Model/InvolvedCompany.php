<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class InvolvedCompany.
 *
 * @package namespace App\Model;
 */
class InvolvedCompany extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [];

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }
}
