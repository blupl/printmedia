<?php namespace Blupl\PrintMedia;

use Illuminate\Database\Eloquent\Model;

class MediaInvolbePerson extends Model {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'media_involve_people';

    /**
     * The class name to be used in polymorphic relations.
     *
     * @var string
     */
    protected $morphClass = 'MediaInvolvePerson';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'designation',
        'mobile_number',
        'email'
    ];

}
