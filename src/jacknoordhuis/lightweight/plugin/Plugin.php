<?php

namespace jacknoordhuis\lightweight\plugin;

use pocketmine\plugin\Plugin as PluginContract;
use pocketmine\plugin\PluginDescription;
use pocketmine\plugin\PluginLoader;
use pocketmine\plugin\PluginLogger;
use pocketmine\scheduler\TaskScheduler;
use pocketmine\Server;
use function rtrim;

/**
 * A lightweight alternative to the default PluginBase implementation.
 */
class Plugin implements PluginContract
{
    /**
     * @var \pocketmine\plugin\PluginLoader
     */
    private $loader;

    /**
     * @var \pocketmine\Server
     */
    private $server;

    /**
     * @var \pocketmine\plugin\PluginDescription
     */
    private $description;

    /**
     * @var string
     */
    private $dataFolder;

    /**
     * @var \pocketmine\plugin\PluginLogger
     */
    private $logger;

    /**
     * @var \pocketmine\scheduler\TaskScheduler
     */
    private $scheduler;

    /**
     * @var bool
     */
    private $enabled;

    public function __construct(PluginLoader $loader, Server $server, PluginDescription $description, string $dataFolder, string $file)
    {
        $this->loader = $loader;
        $this->server = $server;
        $this->description = $description;
        $this->dataFolder = rtrim($dataFolder, "\\/") . "/";
        $this->logger = new PluginLogger($this);
        $this->scheduler = new TaskScheduler($description->getFullName());
    }

    /**
     * Called when the plugin is enabled
     */
    public function onEnable(): void
    {

    }

    /**
     * Called when the plugin is disabled.
     */
    public function onDisable(): void
    {

    }

    /**
     * @inheritDoc
     */
    public function onEnableStateChange(bool $enabled): void
    {
        if($this->enabled !== $enabled){
            $this->enabled = $enabled;
            if($this->enabled){
                $this->onEnable();
            }else{
                $this->onDisable();
            }
        }
    }

    /**
     * @inheritDoc
     */
    public function isEnabled(): bool
    {
        return $this->enabled;
    }

    /**
     * @inheritDoc
     */
    public function isDisabled(): bool
    {
        return !$this->enabled;
    }

    /**
     * @inheritDoc
     */
    public function getDataFolder(): string
    {
        return $this->dataFolder;
    }

    /**
     * @inheritDoc
     */
    public function getDescription(): PluginDescription
    {
        return $this->description;
    }

    /**
     * @inheritDoc
     */
    public function getServer(): Server
    {
        return $this->server;
    }

    /**
     * @inheritDoc
     */
    public function getName(): string
    {
        return $this->description->getName();
    }

    /**
     * @inheritDoc
     */
    public function getLogger(): PluginLogger
    {
        return $this->logger;
    }

    /**
     * @inheritDoc
     */
    public function getPluginLoader(): PluginLoader
    {
        return $this->loader;
    }

    /**
     * @inheritDoc
     */
    public function getScheduler(): TaskScheduler
    {
        return $this->scheduler;
    }
}