<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password', 'remember_token');


	protected $fillable = array('login', 'email', 'name', 'password', 'remember_token',
								'avatar', 'age', 'rate', 'about', 'birthday',
								'town', 'confirmation_code', 'confirmed');

	public function posts(){
		return $this->hasMany('Post', 'user_id');
	}

	public function comments(){
		return $this->hasMany('Comment', 'user_id');
	}

	public function isReady(){
		if($this->name && $this->age && $this->town && $this->ava_xl && $this->ava_sm && $this->confirmed)
			return true;
		else return false;
	}

	public function messages(){
		return $this->hasMany('Message', 'to_user');
	}

	public function url(){
		return $this->login ? route('profile', $this->login) : route('profile_id', $this->id);
	}

	public function online(){
		if($this->last_logged_in->diffInMinutes(Carbon::now()) < 30)
			return true;
	}

	public function getDates(){
		return array(static::CREATED_AT, static::UPDATED_AT, 'last_logged_in', 'new_logged_in');
	}

	// public function notify($what){

	// }
}
