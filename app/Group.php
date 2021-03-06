<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'private'
    ];

    /**
     * Get the user that owns this group
     *
     * @return void
     */
    public function owner()
    {
        return $this->belongsTo('App\User', 'owner_id');
    }

    /**
     * Get the users that belong to this group
     *
     * @return void
     */
    public function users()
    {
        return $this->belongsToMany('App\User', 'group_user');
    }

    /**
     * Get the androidApps that belong to this group
     *
     * @return void
     */
    public function androidApps()
    {
        return $this->belongsToMany('App\AndroidApp', 'group_android_app');
    }

    /**
     * Return whether a given user belongs to this group
     *
     * @param [type] $user
     * @return boolean
     */
    public function isMember($user)
    {
        return $this->users->pluck('id')->contains($user->id);
    }
}
