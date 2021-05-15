<?php

namespace App\Console\Commands;

use App\Http\Controllers\CategoryController;
use App\Services\CategoryService;
use Exception;
use Illuminate\Console\Command;

class DeleteCategory extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:name';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * This is for addind the product controller
     *
     * @var Controller
     */

    protected $categoryService;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(CategoryService $categoryService)
    {
        parent::__construct();
        $this->categoryService = $categoryService;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        try {
            $id = $this->ask('What is the id of the category');
            $this->categoryService->delete($id);
            $this->info('Category deleted');
        } catch (Exception $e) {
            $this->error('Category was not deleted');
        }
    }
}
