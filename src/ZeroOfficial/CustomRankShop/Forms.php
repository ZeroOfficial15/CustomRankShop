<?php

declare(strict_types=1);

namespace ZeroOfficial\CustomRankShop;

use pocketmine\player\Player;
use jojoe77777\FormAPI\SimpleForm;
use ZeroOfficial\CustomRankShop\CustomRankShop;

class Forms {

	public static function menuRankShop(Player $player){
		$instance = CustomRankShop::getInstance();
		$form = new SimpleForm(function(Player $player, $data) use ($instance) {
			if($data == null){
				return true;
			}
			if($data == 0){
				return true;
			}
			if(\onebone\economyapi\EconomyAPI::getInstance()->myMoney($player) >= $instance->getRank()->get($data)["cost"]){
                \onebone\economyapi\EconomyAPI::getInstance()->reduceMoney($player, $instance->getRank()->get($data)["cost"]);
                foreach($instance->getRank()->get($data)["command"]["player"] as $cmd){
                	$command = str_replace(["{player}", "{player_name}"], [$player->getName(), $player->getName()], $cmd);
                	$instance->getServer()->getCommandMap()->dispatch($player, $command);
                }
                foreach($instance->getRank()->get($data)["command"]["console"] as $cmd){
                	$command = str_replace(["{player}", "{player_name}"], [$player->getName(), $player->getName()], $cmd);
                	$instance->getServer()->getCommandMap()->dispatch(new \pocketmine\console\ConsoleCommandSender($instance->getServer(), $instance->getServer()->getLanguage()), $command);
                }
                $player->sendMessage($instance->getRank()->get($data)["msg-buy"]["successfully"]);
			}else{
				$player->sendMessage($instance->getRank()->get($data)["msg-buy"]["fallied"]);
			}
		});
        $form->setTitle("Rank Shop");
        $form->addButton("Exit");
        for($i = 1;$i <= 30;$i++){
        	if($instance->getRank()->exists($i)){
        	    $form->addButton($instance->getRank()->get($i)["button"], 1, $instance->getRank()->get($i)["icon"]);
        	}
        }
        $form->sendToPlayer($player);
	}
}