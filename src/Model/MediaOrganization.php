<?php namespace Blupl\PrintMedia\Model;

use Illuminate\Database\Eloquent\Model;

class MediaOrganization extends Model {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'media_organizations';

    /**
     * The class name to be used in polymorphic relations.
     *
     * @var string
     */
    protected $morphClass = 'MediaOrganization';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'form_id',
        'user_id',
        'media_category',
        'name',
        'editor_name',
        'address1',
        'address2',
        'city',
        'country',
        'phone',
        'email',
        'fax',
        'website'
    ];

    public function member()
    {
        return $this->hasMany('Blupl\PrintMedia\Model\MediaInvolvePerson', 'form_id', 'form_id');
    }

    public function reporter()
    {
        return $this->hasMany('Blupl\PrintMedia\Model\MediaReporter', 'form_id', 'form_id');
    }

}
