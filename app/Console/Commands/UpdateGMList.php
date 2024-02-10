<?php

namespace App\Console\Commands;

use App\Http\Controllers\GMController;
use App\Models\GM;
use App\Models\Region;
use Illuminate\Console\Command;

class UpdateGMList extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update-g-m-list';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get the actual Grandmaster player list and store in the database';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $gmList = new GMController();
            $gmList->verifyToken();
            $region_list = Region::all();
            
            GM::truncate();
            foreach($region_list as $region) {
                $gmList->store($region->id);
            }
            // $gmList->store(1);
    }
}
