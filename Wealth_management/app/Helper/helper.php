<?php
use Illuminate\Support\Facades\DB;


function daaa($ids, $type, $blogid)
{
    foreach ($ids as $value) {
        $input = [
            'project_type_id' => $blogid,
            'project_load_type' => $value,
            'user_id' => $type,
            'status' => 0
        ];
        $rom = DB::table('project_type')->insert($input);
    }
}
