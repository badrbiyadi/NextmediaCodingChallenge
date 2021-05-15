<?php

namespace App\Console\Commands;

use App\Http\Controllers\ProductController;
use App\Services\ProductService;
use Exception;
use Illuminate\Console\Command;

class DeleteProduct extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'product:delete';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'You can delete a product from this commande';

    /**
     * This is for addind the product controller
     *
     * @var Controller
     */

    protected $productService;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(ProductService $productService)
    {
        parent::__construct();
        $this->productService = $productService;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        try {
            $id = $this->ask('What is the id of the product');
            $this->productService->delete($id);
            $this->info('Product deleted');
        }catch (Exception $e) {
            $this->error('Product was not deleted');
        }
        
    }
}
