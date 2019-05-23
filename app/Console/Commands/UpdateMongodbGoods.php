<?php

namespace App\Console\Commands;

use App\Models\Goods;
use App\MongoDB\Goods as GoodsMongodb;
use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\Collection;

class UpdateMongodbGoods extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mongodb:goods {--chunk=500}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '重新把商品信息更新到mongodb';

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
     * @throws \Exception
     */
    public function handle()
    {
        $this->info('清除原来的数据.');
        GoodsMongodb::truncate();
        $this->info('更新mongodb goods 数据.');
        Goods::chunk($this->option('chunk'), function (Collection $data){
            $data->load(['categories', 'attributes', 'specItems']);
            $this->output->write('.');
            $data->map(function (Goods $item){
                GoodsMongodb::up($item);
            });
        });
        $this->info('');
    }
}
