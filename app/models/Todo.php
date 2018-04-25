<?php

class Todo extends Eloquent {

	protected $fillable = ['title', 'isCompleted'];
   
	// protected $attributes = ['isCompleted'];

	protected $appends = ['isCompleted'];

	public $timestamps = false;
	
	public function getIsCompletedAttribute()
	{
		return $this->attributes['isCompleted'] ? true : false;
	}

	public function setIsCompletedAttribute($value)
	{
		$this->attributes['isCompleted'] = $value == 'true' ? 1 : 0;
	}
}