<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Countries extends MasterModel
{
    use HasFactory;

    /**
     * Get the country name by ID.
     *
     * @param int $id
     * @return string|null
     */
    public static function getNameById($id)
    {
        return self::where('id', $id)->value('name');
    }
}
