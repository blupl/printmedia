<?php namespace Blupl\PrintMedia\Model;

use Illuminate\Database\Eloquent\Model;

class Zone extends Model {

	protected $table = 'zones';

    protected $fillable = [
        'member_id',
        'zone'
    ];

    public function member()
    {
        return $this->belongsTo('Blupl\PrintMedia\Model\MediaReporter', 'member_id');
    }
}
