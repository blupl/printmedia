<?php namespace Blupl\PrintMedia\Model;

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
        'form_id',
        'category',
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

    public function organization()
    {
        return $this->belongsTo('Blupl\PrintMedia\Model\MediaOrganization', 'id', 'organization_id');
    }

}
