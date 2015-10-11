<?php namespace Blupl\PrintMedia;

use Illuminate\Database\Eloquent\Model;

class MediaReporter extends Model {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'media_reporters';

    /**
     * The class name to be used in polymorphic relations.
     *
     * @var string
     */
    protected $morphClass = 'MediaReporter';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'personal_id',
        'gender',
        'date_of_birth',
        'mobile',
        'email',
        'role',
        'work_station',
        'photo',
        'card_collection_point'
    ];

}
