<?php
/**
 * User: Michael Leahy
 * Date: 6/24/14
 * Time: 11:02 AM
 */

namespace SimpleMessages;

use pocketmine\plugin\PluginBase;
use pocketmine\utils\Config;
use pocketmine\utils\TextFormat;

class SimpleMessages extends PluginBase{

    public $configFile;

    public function onEnable(){
        @mkdir($this->getDataFolder());
        $this->configFile = (new Config($this->getDataFolder()."config.yml", Config::YAML, array(
            "chat-messages" => "false",
            "popup-messages" => "true",
            "messages" => array(
                "message1",
                "message2",
                "message3",
                "message1",
                "message2",
                "message3"
            ),
            "time" => "30",
            "prefix" => "Broadcast",
            "color" => "§f"
        )))->getAll();

        $time = intval($this->configFile["time"]) * 20;
        $this->getServer()->getScheduler()->scheduleRepeatingTask(new SimpleMessagesTask($this), $time);

        $this->getLogger()->info("I've been enabled!");
    }

    public function onDisable(){
        $this->getLogger()->info("I've been disabled!");
    }

}
