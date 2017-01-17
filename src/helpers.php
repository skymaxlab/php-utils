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
            'align_double_arrow' => false,
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
