<?php

namespace App\Console\Commands;

use App\Http\Controllers\ProductController;
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

    protected $productController;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(ProductController $productController)
    {
        parent::__construct();
        $this->productController = $productController;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $id = $this->ask('What is the id of the product');
        $this->productController->deleteProduct($id);
        $this->info('Product deleted');
    }
}
