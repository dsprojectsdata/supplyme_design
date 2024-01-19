<?php

namespace App\Traits;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

trait CommonTrait
{
    public function create_unique_slug($string = '', $table = '', $field = 'slug', $col_name = null, $old_slug = null)
    {
        $slug = Str::of($string)->slug('-');
        $slug = strtolower($slug);

        $i = 0;
        $params = array();
        $params[$field] = $slug;
        if ($col_name) {
            $params["$col_name"] = "<> $old_slug";
        }

        while (DB::table($table)->where($params)->count()) {
            if (!preg_match('/-{1}[0-9]+$/', $slug)) {
                $slug .= '-' . ++$i;
            } else {
                $slug = preg_replace('/[0-9]+$/', ++$i, $slug);
            }
            $params[$field] = $slug;
        }
        return $slug;
    }

    public function file_upload($file, $path)
    {
        try {
            //code...
            $path = Storage::disk(FILE_UPLOAD_LOCATION)->put($path, $file);
            return $path;
        } catch (\Throwable $th) {
            //throw $th;
            Log::debug($th->getMessage());
            return false;
        }
    }
}
