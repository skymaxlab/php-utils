<?php

if (! function_exists('uuid')) {
    /**
     * Get a uuid version 4.
     *
     * @return string
     */
    function uuid()
    {
        return Ramsey\Uuid\Uuid::uuid4()->toString();
    }
}

if (! function_exists('php_fixer_rules')) {
    /**
     * Get rules for php-cs-fixer.
     * Curated list of the rules we like.
     *
     * @return array
     */
    function php_fixer_rules()
    {
        return [
            '@PSR2' => true,
            'combine_consecutive_unsets' => true,
            'array_syntax' => ['syntax' => 'short'],
            'blank_line_before_return' => true,
            'concat_space' => ['spacing' => 'one'],
            'no_leading_import_slash' => true,
            'no_useless_else' => true,
            'ordered_imports' => true,
            'phpdoc_separation' => true,
            'whitespace_after_comma_in_array' => true,
            'psr4' => true,
            'strict_param' => true,
            'php_unit_strict' => true,
            'phpdoc_add_missing_param_annotation' => true,
            'no_extra_consecutive_blank_lines' => ['break', 'continue', 'extra', 'return', 'throw', 'use', 'parenthesis_brace_block', 'square_brace_block', 'curly_brace_block'],
            'binary_operator_spaces' => ['align_double_arrow' => false, 'align_equals' => false],
            'phpdoc_no_package' => true,
            'phpdoc_summary' => true,
        ];
    }
}

if (! function_exists('git_hash')) {
    /**
     * Get the git hash from the git repo.
     *
     * @return string
     */
    function git_hash()
    {
        return exec('git rev-parse HEAD');
    }
}

if (! function_exists('git_hash_short')) {
    /**
     * Get git hash short version.
     *
     * @return string
     */
    function git_hash_short()
    {
        return exec('git rev-parse --short HEAD');
    }
}

if (! function_exists('var_export_short')) {
    /**
     * var_export for short array syntax.
     *
     * @param mixed $expression
     *
     * @return string
     */
    function var_export_short($expression)
    {
        $temp = var_export($expression, true);
        $temp = str_replace('array (', '[', $temp);
        $temp = str_replace(')', ']', $temp);

        return $temp;
    }
}

if (!function_exists('transform')) {
    /**
     * Transform.
     *
     * @param $data
     * @param $transformer
     * @param null $resourceKey
     *
     * @return array
     */
    function transform($data, $transformer, $resourceKey = null)
    {
        if ($data instanceof \Illuminate\Database\Eloquent\Collection) {
            return collection($data, $transformer, $resourceKey);
        }

        return item($data, $transformer, $resourceKey);
    }
}

if (!function_exists('item')) {
    /**
     * Return a fractal item response.
     *
     * @param $data
     * @param $transformer
     * @param null $resourceKey
     *
     * @return array
     */
    function item($data, $transformer, $resourceKey = null)
    {
        $manager = new League\Fractal\Manager();
        $manager->setSerializer(new \SkyMaxLab\Fractal\ResourceKeySerializer());
        $item = new League\Fractal\Resource\Item($data, new $transformer(), $resourceKey);

        return $manager->createData($item)->toArray();
    }
}

if (!function_exists('collection')) {
    /**
     * Return a fractal collection response.
     *
     * @param $data
     * @param $transformer
     * @param null $resourceKey
     *
     * @return array
     */
    function collection($data, $transformer, $resourceKey = null)
    {
        $manager = new League\Fractal\Manager();
        $manager->setSerializer(new \SkyMaxLab\Fractal\ResourceKeySerializer());
        $collection = new League\Fractal\Resource\Collection($data, new $transformer(), $resourceKey);

        return $manager->createData($collection)->toArray();
    }
}

if (!function_exists('substring_tags')) {
    /**
     * Substring within first and second tags.
     *
     * @param $string
     * @param $firstTag
     * @param $sendTag
     *
     * @return string
     */
    function substring_tags($string, $firstTag, $sendTag)
    {
        $pos = strpos($string, $firstTag);
        $string = substr($string, $pos);

        $pos = strpos($string, $sendTag);
        $string = substr($string, 0, $pos + strlen($sendTag));

        return $string;
    }
}
