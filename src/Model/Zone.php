<?php namespace Blupl\PrintMedia\Model;

use Illuminate\Database\Eloquent\Model;

class Zone extends Model {

	protected $table = 'zones';

    protected $fillable = [
        'zoneable_id',
        'zoneable_type',
        'zone'
    ];

    public function zoneable()
    {
        return $this->morphTo();
    }
}
