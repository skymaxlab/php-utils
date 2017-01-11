<?php

namespace SkyMaxLab\Console\Commands\App;

use Illuminate\Console\Command;
use DB;
use Format;

class ModelColumns extends Command
{
    protected $signature = 'app:model-columns';

    protected $description = 'Get columns and generate meta data for every model class.';

    /**
     * Create a new command instance.
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
        $this->info('All tables in the database: ');

        $files = $this->getModelFiles();

        foreach ($files as $file) {
            $content = file_get_contents($file);

            $table = $this->getTableName($content);

            if (empty($table)) {
                $this->warn(sprintf('protected $table not defined in %s', $file));
                continue;
            }

            if (strpos($content, $this->getStartColumnsTag()) === false) {
                $this->warn(sprintf('Cannot find %s tag for %s', $this->getStartColumnsTag(), $file));
                continue;
            }

            if (strpos($content, $this->getStartColumnsTag()) === false) {
                $this->warn(sprintf('Cannot find %s tag for %s', $this->getEndColumnsTag(), $file));
                continue;
            }

            $columns = BaseModel::getAllColumns($table);

            $columnMeta = "\n" . '    protected $columns = ' . trim(Format::shortArrayFormat($columns, '        ')) . ";\n    ";

            $startPosition = strpos($content, $this->getStartColumnsTag());
            $startPosition += strlen($this->getStartColumnsTag());
            $endPosition = strpos($content, $this->getEndColumnsTag());

            // remove what's currently there
            $content = substr_replace($content, $columnMeta, $startPosition, $endPosition - $startPosition);

            // rewrite the file
            file_put_contents($file, $content);

            $this->info(sprintf('Done with %s', $file));
        }
    }

    /**
     * Get the table name.
     *
     * @param $content
     *
     * @return mixed
     */
    protected function getTableName($content)
    {
        $lines = explode("\n", $content);

        foreach ($lines as $line) {
            if (strpos($line, '$table') !== false) {
                $tableName = str_replace('    protected $table = \'', '', $line);
                $tableName = str_replace('\';', '', $tableName);

                return $tableName;
            }
        }

        return false;
    }

    /**
     * Get the start column token.
     *
     * @return string
     */
    public function getStartColumnsTag()
    {
        return '// {Columns}';
    }

    /**
     * Get the end column token.
     *
     * @return string
     */
    public function getEndColumnsTag()
    {
        return '// {/Columns}';
    }

    /**
     * Get all the Models php files.
     *
     * @return array
     */
    protected function getModelFiles()
    {
        $dir = app_path('Models');

        // Get all the files
        $files = scandir($dir);

        $out = [];
        foreach ($files as $file) {
            if (ends_with($file, '.php')) {
                $out[] = $dir . '/' . $file;
            }
        }

        return $out;
    }

    /**
     * Get all the tables in the database.
     *
     * @return array
     */
    protected function getTables()
    {
        $connection = config('database.default');
        $databaseName = config('database.connections.' . $connection . '.database');

        $sql = 'SELECT TABLE_NAME FROM information_schema.tables WHERE table_schema = ? ORDER BY TABLE_NAME';

        $rows = DB::select($sql, [$databaseName]);

        $out = [];

        foreach ($rows as $row) {
            $out[] = $row->TABLE_NAME;
        }

        return $out;
    }
}
