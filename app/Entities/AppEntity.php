<?php
/**
 * Created by PhpStorm.
 * User: raylison
 * Date: 01/02/19
 * Time: 09:19
 */

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class AppEntity extends Model
{
    const CREATED_AT = 'created';
    const UPDATED_AT = 'modified';
    const DELETED_AT = 'deleted';
}
