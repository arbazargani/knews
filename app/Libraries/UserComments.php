<?php

namespace App\Libraries;

use App\Comment;

class UserComments
{
	public function fetch($post_id)
	{
		return Comment::where('status', 'active')->where('post_id', $post_id)->orderBy('created_at', 'Desc')->take(6)->get();
	}
}