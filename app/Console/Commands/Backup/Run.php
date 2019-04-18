<?php
namespace App\Console\Commands\Backup;
use Illuminate\Console\Command;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
class Run extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'backup:run';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'backup your databases';
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
        $tables = $this->getTables();
        $this->toFiles($tables);
    }
    /**
     * getTables
     * @return array
     * @author luffyzhao@vip.126.com
     */
    protected function getTables(): array
    {
        return DB::select('show tables');
    }
    /**
     * toFiles
     * @param array $tables
     * @author luffyzhao@vip.126.com
     */
    protected function toFiles(array $tables)
    {
        $config = config('database.connections.'.DB::getDefaultConnection());
        foreach ($tables as $table) {
            $tableName = $table->{'Tables_in_'.$config['database']};
            if ($tableName === 'migrations' || $tableName === 'base_logs') {
                continue;
            }
            $columns = DB::selectOne('show columns from `'.$tableName.'`');
            DB::table($tableName)->orderBy($columns->Field)->chunk(
                100,
                function (Collection $results, int $page) use ($tableName) {
                    $json = $results->toJson();
                    $this->saveFile($tableName, $page, $json);
                }
            );
        }
    }
    /**
     * saveFile
     * @param $table
     * @param int $page
     * @param string $json
     * @author luffyzhao@vip.126.com
     */
    protected function saveFile($table, int $page, string $json)
    {
        $dir = database_path('back-up/'.date('Y-m-d-His').'/'.$table);
        if (!is_dir($dir)) {
            mkdir($dir, 0755, true);
        }
        file_put_contents($dir.'/'.$page.'.json', $json);
    }
}