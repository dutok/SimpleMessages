<?php
/**
 * User: Michael Leahy
 * Date: 6/23/14
 * Time: 6:38 PM
 */

namespace SimpleMessages;

use pocketmine\scheduler\PluginTask;
use pocketmine\Server;
use pocketmine\utils\TextFormat;

class SimpleMessagesTask extends PluginTask{

    public $configFile;

    public function onRun($currentTick){
        $this->getOwner();
        $this->configFile = $this->owner->getConfig()->getAll();
        $messages = $this->configFile["messages"];
        $messagekey = array_rand($messages, 1);
        $message = $messages[$messagekey];
        Server::getInstance()->broadcastMessage($this->configFile["color"]."[".$this->configFile["prefix"]."]: ".$message);
    }

}