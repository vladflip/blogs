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
		// return $this->login ? route('profile', $this->login) : route('profile_id', $this->id);
		return route('profile', $this->id);
	}

	public function email_provider(){
			$start = strrpos($this->email, '@');
			$email = substr($this->email, $start + 1);
			return $email;
	}

	public function online(){
		if($this->last_logged_in->diffInMinutes(Carbon::now()) < 30)
			return true;
		return false;
	}

	public function isAdmin(){
		return $this->admin;
	}

	public function banned(){
		return $this->banned;
	}

	public function getDates(){
		return array(static::CREATED_AT, static::UPDATED_AT, 'last_logged_in', 'new_logged_in');
	}

	public function verify(){
		Mail::send('emails.verify', ['code' => $this->confirmation_code], function($message) {
				$message
					->from('info@patriotki.ru', 'МЖА | Блоги')
					->to($this->email, 'Подтверждение email')
					->subject('МЖА - вы не робот');
			});
	}

	public function notify($what, $where){
		if( ! $this->online()){

			switch($what){

				case 'msg':
					Mail::send('emails.notify_msg', ['user' => $this, 'from' => $where], function($message) {
						$message
						->from('info@patriotki.ru', 'МЖА | Блоги')
						->to($this->email, $this->name)
						->subject('Новое сообщение!');
					});
				break;

				case 'cmt':
					Mail::send('emails.notify_cmt', ['user' => $this, 'post' => $where], function($message) {
						$message
						->from('info@patriotki.ru', 'МЖА | Блоги')
						->to($this->email, $this->name)
						->subject('Новый комментарий!');
					});
				break;

			}

		}
	}
}
