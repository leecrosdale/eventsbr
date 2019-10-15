<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class GenerateMap extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'map:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generates a random map';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {

        $map = factory(\App\Map::class)->create();
        $map->generateMap();

        $this->comment("Generated map {$map->name}");
    }
}
