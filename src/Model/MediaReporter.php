<?php namespace Blupl\PrintMedia\Model;

use Carbon\Carbon;
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
        'media_category',
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
        return $this->belongsTo('Blupl\PrintMedia\Model\MediaOrganization', 'form_id', 'form_id');
    }

    public function granter()
    {
        return $this->hasOne('Blupl\PrintMedia\Model\MediaInvolvePerson', 'form_id', 'form_id')->where('category', '=', 'granter');
    }

    public function zone()
    {
        return $this->hasMany('Blupl\PrintMedia\Model\Zone', 'member_id', 'id');
    }

    public function getCreatedAtAttribute($date)
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('Y-m-d');
    }

    public function getUpdatedAtAttribute($date)
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('Y-m-d');
    }

}
