<?php

declare(strict_types=1);

namespace ZeroOfficial\CustomRankShop\command;

use pocketmine\player\Player;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use ZeroOfficial\CustomRankShop\CustomRankShop;

class RankShopCommand extends Command {

	private CustomRankShop $plugin;

	public function __construct(CustomRankShop $plugin){
		$this->plugin = $plugin;
	}

	public function execute(CommandSender $sender, string $label, array $args){
        if($sender instanceof Player){
        	ZeroOfficial\CustomRankShop\Forms::menuRankShop($sender);
        }else{
        	$this->plugin->getLogger()->error("Please use command in-game");
        }
	}
}