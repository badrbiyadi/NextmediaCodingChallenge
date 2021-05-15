<?php

namespace App\Console\Commands;

use App\Http\Controllers\ProductController;
use App\Services\ProductService;
use Exception;
use Illuminate\Console\Command;

class CreateProduct extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'product:create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'You can create product using this commande ';

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
            $name =$this->ask('What is the product name?');
            $description =$this->ask('What is the description of the product?');
            $price =$this->ask('What is the price of the product?');
            $data = [
                'name' => $name,
                'description' => $description,
                'price' => $price,
            ];
            $this->productService->create($data);
            $this->info('Product created');
        }catch (Exception $e) {
            $this->error('Product was not created');
        }
    }

}
