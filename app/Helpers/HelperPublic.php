<?php

namespace App\Helpers;


class HelperPublic
{
    public static function helpStoreFileToStorage($file, string $path)
    {
        $changedName = time() . random_int(100, 999) . $file->getClientOriginalName();

        $file->storeAs($path, $changedName);

        return $path . '/' . $changedName;
    }
}
