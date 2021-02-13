<?php

namespace App\Console\Commands;

use App\Http\Controllers\CategoryController;
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

    protected $categoryController;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(CategoryController $categoryController)
    {
        parent::__construct();
        $this->categoryController = $categoryController;
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

            if ($hasParent === 'Yes') {
                // create the logic that link a 
                $categories = $this->categoryController->getAllCategories();    
                $parentChoices = [];
                foreach($categories as $cat){
                   $parentChoices[$cat->id] = $cat->name;
                }
             
                $parentName = $this->choice(
                    'Please choose the parent of the category',
                    $parentChoices,
                );

            }

            dd($parentName);

            $data = [
                'name' => $name,
                'parent' => '',
            ];

            //$this->categoryController->createCategory($data);
            $this->info('Category created');
        }catch (Exception $e) {
            dd($e->getMessage());
            $this->error('Category was not created');
        }
    }
}
