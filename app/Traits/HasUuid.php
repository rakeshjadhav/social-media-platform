<?php
namespace App\Traits;

use Illuminate\Support\Str;

trait HasUuid
{
    protected static function bootHasUuid()
    {
        static::creating(function ($model) {
            if (empty($model->{$model->getKeyName()})) {
                $model->{$model->getKeyName()} = (string) Str::uuid();
            }
        });
    }

    /**
     * Override the getIncrementing() function to return false to tell
     * Laravel that the identifier does not auto increment (it's a string).
     *
     * @return bool
     */

    public function getIncrementing() : bool
    {
        return false;
    }

    public function getKeyType()
    {
        return 'string';
    }
}
