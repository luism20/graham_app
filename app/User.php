<?php

namespace App;

use Cartalyst\Stripe\Stripe;
use function GuzzleHttp\Psr7\str;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{

    use Notifiable;

    protected $guard = 'users';

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The database primary key value.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'stripe_id',
        'company',
        'remember_token',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [];

    public function isAdmin()
    {
        if ($this->rol == 1) {
            return true;
        } else {
            return false;
        }

    }

    public function inTrial()
    {
        if ($this->plan_id == null && strtotime($this->created_at) + strtotime('+14 day') < strtotime('now')) {
            return true;
        }
        return false;
    }

    public function plan()
    {
        $stripe = Stripe::make();
        if ($this->plan_id) {
            $plan = $stripe->plans()->find($this->plan_id);
            return (object) $plan;
        } else {
            return (object) [];
        }
    }

    public function cards()
    {
        return $this->belongsTo(Card::class);
    }

    public function allCards()
    {
        if ($this->cards) {
            $return = \collect();
            $stripe = Stripe::make();
            foreach ($this->cards as $c) {
                $card = $stripe->cards()->find($this->stripe_id, $c->stripe_id);
                $return->push((object) $card);
            }
        } else {
            return false;
        }
    }

}
