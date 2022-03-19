<?php

declare(strict_types=1);

namespace ZeroOfficial\CustomRankShop\command;

use pocketmine\player\Player;
use pocketmine\plugin\PluginOwned;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use ZeroOfficial\CustomRankShop\Forms;
use ZeroOfficial\CustomRankShop\CustomRankShop;

class RankShopCommand extends Command implements PluginOwned {

	private CustomRankShop $plugin;

	public function __construct(CustomRankShop $plugin){
		$this->plugin = $plugin;
		parent::__construct("rankshop", "Open menu rank shop", null, ["shoprank", "buyrank"]);
	}

	public function execute(CommandSender $sender, string $label, array $args){
        if($sender instanceof Player){
        	Forms::menuRankShop($sender);
        }else{
        	$this->plugin->getLogger()->error("Please use command in-game");
        }
	}

	public function getOwningPlugin() : CustomRankShop {
		return $this->plugin;
	}
}