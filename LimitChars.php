<?php

namespace App\Http\Traits;

trait LimitChars
{
    /* 
        Review:
        2024-05-27

        Description:
        It is a scope function that will limit the characters of the columns.
        It is basically used for indexing and listing purpose in Laravel.
        Note: It works only on MySQL database.

        @param $columns: array|string
        @param $limit: integer = 200
        @return $query
        
        Usage:
        $notices = Notice::latest()
            ->limitChars(['title', 'message'], 100)
            ->simplePaginate(10);
        
        Author:
        Md. Hossain Zahour
        apple@vubon.net
    */
    public function scopeLimitChars($query, $columns, $limit = 200)
    {
        $sql = '';

        if (is_array($columns)) {
            // Concating columns
            foreach ($columns as $column) {
                $sql .= ", LEFT($column, $limit) as $column";
            }
        }
        else {
            $sql .= ", LEFT($columns, $limit) as $columns";
        }

        return $query->selectRaw('*'. $sql);
    }
}
