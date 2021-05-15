<?php

namespace App\Console\Commands;

use App\Http\Controllers\CategoryController;
use App\Services\CategoryService;
use Exception;
use Illuminate\Console\Command;

class CreateCategory extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'category:create';

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

            $name = $this->ask('What is the name of the category?');
            $hasParent = $this->choice(
                'Is this category has a parent?',
                ['No', 'Yes'],
            );
            $parentId = null;
            if ($hasParent === 'Yes') {
                $categories = $this->categoryService->getAllCategories()->pluck( 'name', 'id');    
                $this->info('Please choose the number the parent category ');
                foreach($categories as $index => $category) {
                    $this->info($index .' ==> ' . $category);
                }
                $parentInput = $this->anticipate(
                    '',
                    $categories,
                );
                if(is_numeric($parentInput) && $this->categoryService->checkIfCategoryExists($parentInput)) {
                    $parentId = $parentInput;
                }
            }
            $data = [
                'name' => $name,
                'parent' => $parentId,
            ];
            $this->categoryService->create($data);
            $this->info('Category created');
        }catch (Exception $e) {
            $this->error('Category was not created');
        }
    }
}
