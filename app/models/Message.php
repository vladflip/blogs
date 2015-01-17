<?php

class Message extends Eloquent{

	protected $fillable = ['to_user', 'from_user', 'msg', 'status'];

	public function receiver(){
		return $this->belongsTo('User', 'to_user');
	}

	public function sender(){
		return $this->belongsTo('User', 'from_user');
	}

}