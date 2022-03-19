<?php

declare(strict_types=1);

namespace ZeroOfficial\CustomRankShop;

use pocketmine\player\Player;
use pocketmine\event\Listener;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\Config;
use ZeroOfficial\CustomRankShop\command\RankShopCommand;

class CustomRankShop extends PluginBase implements Listener {

	public static $instance;

	public static function getInstance() : self {
		return self::$instance;
	}

	public function onEnable() : void {
		$this->getServer()->getPluginManager()->registerEvents($this, $this);
		$this->saveResource("rank.yml");
		$this->rank = new Config($this->getDataFolder() . "rank.yml", Config::YAML);
		$this->getServer()->getCommandMap()->register("/rankshop", new RankShopCommand($this));
		self::$instance = $this;
	}

	public function getRank(){
		return $this->rank;
	}

	public function onDisable() : void {
		$this->rank->save();
	}
}