<?php namespace Blupl\PrintMedia\Validation;

use Orchestra\Support\Validator;

class Media extends Validator
{
    /**
     * List of rules.
     *
     * @var array
     */
    protected $rules = [
        'name' => ['required'],
        'phone' => ['required'],
        'address' => ['required'],
    ];

    /**
     * List of events.
     *
     * @var array
     */
    protected $events = [
        'school.student.validate: student',
    ];

    /**
     * On create validations.
     *
     * @return void
     */
    protected function onCreate()
    {
        $this->rules['name'][] = 'unique:roles,name';
    }

    /**
     * On update validations.
     *
     * @return void
     */
    protected function onUpdate()
    {
        $this->rules['name'][] = 'unique:roles,name,{roleID}';
    }
}
