<?php namespace Blupl\PrintMedia\Model;

use Illuminate\Database\Eloquent\Model;

class MediaInvolvePerson extends Model {

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
        'form_id',
        'media_category',
        'category',
        'name',
        'designation',
        'mobile_number',
        'email'
    ];

    public function organization()
    {
        return $this->belongsTo('Blupl\PrintMedia\Model\MediaOrganization', 'organization_id');
    }

}
