<?php

namespace App\Model;

use Illuminate\Support\Facades\DB;
use Vinelab\NeoEloquent\Eloquent\Model as NeoEloquent;


class User extends NeoEloquent
{

    protected $label = 'User';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'age',
    ];

    /**
     * Relation for a user followers
     *
     * @return \Vinelab\NeoEloquent\Eloquent\Relations\BelongsToMany
     *
     */
    public function followers()
    {
        return $this->belongsToMany('App\Model\User', 'FOLLOWS');
    }

    /**
     * Relation for user followers
     *
     * @return \Vinelab\NeoEloquent\Eloquent\Relations\HasMany
     *
     */
    public function following()
    {
        return $this->hasMany('App\Model\User','FOLLOWS');
    }

    /**
     * Delete edge between 2 users
     *
     * @param $user1
     * @param $user2
     * @return array
     */
    public function unfollow($user1,$user2)
    {
        $cypher_query=" MATCH (:User {uuid: $user1})-[r:FOLLOWS]->(:User {uuid: $user2})DELETE r;";
        return DB::select($cypher_query);
    }
}
