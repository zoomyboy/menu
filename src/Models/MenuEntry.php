<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MenuEntry extends Model
{
	protected $fillable = ['title', 'href', 'icon', 'parent'];

    public function menu() {
    	return $this->belongsTo(Menu::class);
    }

	public function parent() {
		return $this->belongsTo(MenuEntry::class, 'parent_id', 'id');
	}

	public function children() {
		return $this->hasMany(MenuEntry::class, 'parent_id', 'id');
	}

	public function isRoot() {
		return $this->parent == null;
	}

	public function getMenu() {
		$entry = $this;
		while (!$entry->isRoot()) {
			$entry = $entry->parent;
		}

		return $entry->menu;
	}
}
