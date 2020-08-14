<?php

namespace App\EBP\Traits;

/**
 * Trait UserInfoTrait
 * @package App\EBP\Traits
 */
trait UserInfoTrait
{
    /**
     * Boot method for creating, updating and deleting models.
     */
    public static function bootUserInfoTrait()
    {
        static::creating(
            function ($model) {
                $model->setAttribute('created_by', isset(currentUser()->id) ? currentUser()->id : 1);
            }
        );

        static::updating(
            function ($model) {
                $model->setAttribute('updated_by', isset(currentUser()->id) ? currentUser()->id : 1);
            }
        );

        static::deleting(
            function ($model) {
                $model->setAttribute('deleted_by', isset(currentUser()->id) ? currentUser()->id : 1);
            }
        );
    }

}
