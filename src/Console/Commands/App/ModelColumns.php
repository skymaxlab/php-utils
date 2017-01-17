<?php

namespace SkyMaxLab\Console\Commands\App;

use DB;
use Format;
use Illuminate\Console\Command;

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
                $this->info(sprintf('protected $table not defined in %s', $file));
                continue;
            }

            if (strpos($content, 'public $columns') === false) {
                $this->info(sprintf('public $columns not set for %s', $file));
                continue;
            }

            $columns = $this::getAllColumns($table);

            $columnMeta = 'public $columns = ' . trim($this->shortArrayFormat($columns, '        ')) . ';';

            $startPosition = strpos($content, 'public $columns');
            $endPosition = strpos($content, ';', $startPosition);

            // remove what's currently there
            $content = substr_replace($content, $columnMeta, $startPosition, $endPosition - $startPosition + 1);

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
     * Get all the columns of a table.  Lookup information_schema.
     *
     * @param $table
     *
     * @return array
     */
    public function getAllColumns($table)
    {
        $connection = config('database.default');
        $database = config('database.connections.'.$connection.'.database');

        $sql = 'SELECT COLUMN_NAME FROM information_schema.columns a WHERE TABLE_SCHEMA = ? AND TABLE_NAME = ? ORDER BY ORDINAL_POSITION;';

        $columns = [];

        $rows = DB::select($sql, [$database, $table]);

        foreach ($rows as $row) {
            $columns[] = $row->COLUMN_NAME;
        }

        return $columns;
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

    /**
     * Convert an array to short array format.  Does not support multidimensional array.
     *
     * @param $columns
     * @param string $indent
     *
     * @return string
     */
    public function shortArrayFormat($columns, $indent = '    ')
    {
        $out = '[' . PHP_EOL;

        foreach ($columns as $column) {
            $out .= "{$indent}'{$column}'," . PHP_EOL;
        }

        $bottomIndent = '';
        if (strlen($indent) > 4) {
            $bottomIndent = substr($indent, 4);
        }

        return $out . $bottomIndent . ']' . PHP_EOL;
    }
}
