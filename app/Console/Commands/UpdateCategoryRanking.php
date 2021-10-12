<?php

namespace App\Console\Commands;

use App\Services\RankingService;
use Illuminate\Console\Command;

class UpdateCategoryRanking extends Command
{
    private $rankingService;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'category_ranking:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This will update a user ranking table.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(RankingService $rankingService)
    {
        parent::__construct();
        $this->rankingService = $rankingService;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->rankingService->updateCategoryRanking();
    }
}
