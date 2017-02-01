<?php

namespace iRaw;

/*
 * 
 * 
 * 
 */

use pocketmine\plugin\PluginBase;
use pocketmine\command\CommandSender;
use pocketmine\command\Command;
use pocketmine\Player;
use pocketmine\Server;
use pocketmine\utils\TextFormat;
use pocketmine\scheduler\PluginTask;
use pocketmine\event\player\PlayerJoinEvent;


class Main extends PluginBase implements Listener {
	
	CONST HELP = "-----------------------------------------\nCommands For iRaw: (Page 1/1)\n- /raw tell <player> <message>\n/raw say <message>\n/raw tell - Tells a player a raw message \n/raw say - Sends a raw message to server\n-----------------------------------------";
	
	public function onCommand(CommandSender $sender, Command $command, $label, array $args) {
		if($sender instanceof Player) {
			if(strtolower($command->getName('raw'))) {
				if(empty($args[0])) {
					$sender->sendMessage( Self::HELP );
				}
					if($args[0] == "tell") {
						if (!isset($args[1])){
							$sender->sendMessage("iRaw] You Must Enter A Message!");
							$sender->sendMessage("Usage: /raw tell <player> <message>");
						}
						if ( ! ( $sent = $this->getServer()->getPlayer($args[1]) ) instanceof Player ) {
							$sender->sendMessage("iRaw] $sent is not online.");
							return true;
						} else {
							array_shift($args);
							unset($args[1]);
							$message = "";
							foreach($args as $m){
								$message .= $m." ";
							}
							$sender-> sendMessage("------------------------------------------\n" $message "\nWas successfully sent to $sent\nYour name is not shown Unless you've entered\nYour name in the Message!\n------------------------------------------");
							$sent->sendMessage("$message");
							return true;
						}
					}
					if(args[0] == "say") {
						array_shift($args);
						$message = "";
						foreach($args as $m){
							$message .= $m ." ";
						}
		              			Server::getInstance()->broadcastMessage($message);
						
						if(!$args[1] = 0) {
							$sender->sendMessage("iRaw] You Must Enter A Message!");
							$sender->sendMessage("Usage: /raw say <message>");
						}
					
					} else {
						$sender->sendMessage( Self::HELP );
					}
			}
		}
	}

