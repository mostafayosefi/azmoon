<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
	public function card(){
		return $this->belongsTo(Card::class);
		

         $notes = \DB::select('select * from users where id = ?', [$this]);

         return view('cards.index', ['users' => $notes]);
		
		
	}
    //
}
