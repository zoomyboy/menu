<?php

use Illuminate\Database\Seeder;
use App\Menu;
use App\MenuEntry;

class MenuSeeder extends Seeder
{
	protected $menus = [
		'testmenu' => [
			['/app', 'Dashboard', 'home', [
				['/clone', 'Klonen', 'clone']	//Define href, Title and a font-awesome icon
			]]		
		]
	];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		foreach($this->menus as $menuTitle => $menuEntries) {
			$menu = Menu::create(['title' => $menuTitle]);
			$this->createMenuEntries($menu, $menuEntries, null);
		}
	}

	public function createMenuEntries($menu, $menuEntries, $parentMenuEntry = null) {
		foreach ($menuEntries as $entry) {
			$newEntry = MenuEntry::create(['title' => $entry[0], 'href' => $entry[1], 'icon' => $entry[2]]);
			if ($parentMenuEntry == null) {
				$newEntry->menu()->associate($menu);
			} else {
				$newEntry->parent()->associate($parentMenuEntry);
			}
			$newEntry->save();

			if (isset ($entry[3])) {
				$this->createMenuEntries($menu, $entry[3], $newEntry);
			}
		}
	}
}
