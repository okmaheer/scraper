<?php

namespace App\Traits;

use Illuminate\Support\Facades\Auth;
use App\Helper\Helper;

trait HasUid
{
    /**
     * The column attributes from the database table.
     *
     * @var array<string>
     */
    protected $columns;

    /**
     * The method to load database columns for the instanciated
     * model and save it in $columns variable.
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->columns = $this->getConnection()->getSchemaBuilder()->getColumnListing($this->getTable());
    }

    /**
     * The method to check if the model has these two columns,
     * set the values automatically. This will save us from
     * rewriting the same functionality in each model.
     */
    protected static function bootHasUid()
    {
        static::creating(function ($model) {
            if (in_array('uid', $model->columns)) {
                if (class_basename($model) == 'CaseRecord') {
                    $model->uid = Helper::getUniqueFormatedId('CR-');
                } else if (class_basename($model) == 'Patient') {
                    $model->uid = Helper::getUniqueFormatedId('P-');
                } else if (class_basename($model) == 'ComplaintType') {
                    $model->uid = Helper::getUniqueFormatedId('CT-');
                } else if (class_basename($model) == 'TreatmentCategory') {
                    $model->uid = Helper::getUniqueFormatedId('TC-');
                } else if (class_basename($model) == 'TreatmentService') {
                    $model->uid = Helper::getUniqueFormatedId('TS-');
                } else if (class_basename($model) == 'TreatmentProcedure') {
                    $model->uid = Helper::getUniqueFormatedId('TP-');
                } else {
                    $model->uid = Helper::getUniqueID();
                }
            }
            if (in_array('creator_id', $model->columns)) {
                $model->creator_id = Auth::user()->id;
            }
        });
    }
}