<?php

namespace App\Trait;

use App\Helper\Files;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use Modules\CustomField\Models\CustomField;
use Modules\CustomField\Models\CustomFieldGroup;

trait CustomFieldsTrait
{
    private $extraData;
    public $custom_fields;
    public $custom_fields_data;

    private function getModelName()
    {
        $model = new \ReflectionClass($this);
        return $model->getName();
    }

    public function updateCustomField($group)
    {
        foreach ($group['fields'] as $field) {
            $insertData = [
                'custom_field_group_id' => 1,
                'label' => $field['label'],
                'name' => $field['name'],
                'type' => $field['type'],
            ];

            if (isset($field['required']) && (in_array(strtolower($field['required']), ['yes', 'on', 1]))) {
                $insertData['required'] = 'yes';
            } else {
                $insertData['required'] = 'no';
            }

            if (isset($field['value'])) {
                if (is_array($field['value'])) {
                    $insertData['values'] = json_encode($field['value']);
                } else {
                    $insertData['values'] = $field['value'];
                }
            }

            DB::table('custom_fields')->insert($insertData);
        }
    }

    public function getCustomFieldGroups($fields = false)
    {
        $customFieldGroup = CustomFieldGroup::where('model', $this->getModelName());

        $customFieldGroup = $customFieldGroup->when(method_exists($this, 'company'), function ($query) {
            return $query->where('company_id', $this->company_id ?: company()->id);
        })->first();

        if ($fields && $customFieldGroup) {
            $customFieldGroup->load(['customField'])->append(['fields']);
        }

        return $customFieldGroup;
    }

    public function getCustomFieldGroupsWithFields()
    {
        return $this->getCustomFieldGroups(true);
    }

    public function getCustomFieldsData()
    {
        $modelId = $this->id;

        $data = DB::table('custom_fields_data')
            ->rightJoin('custom_fields', function ($query) use ($modelId) {
                $query->on('custom_fields_data.custom_field_id', '=', 'custom_fields.id');
                $query->on('model_id', '=', DB::raw($modelId));
            })
            ->rightJoin('custom_field_groups', 'custom_fields.custom_field_group_id', '=', 'custom_field_groups.id')
            ->select('custom_fields.id', DB::raw('CONCAT("field_", custom_fields.id) as field_id'), 'custom_fields.type', 'custom_fields_data.value')
            ->where('custom_field_groups.model', $this->getModelName())
            ->get();

        $data = collect($data);
        $result = $data->pluck('value', 'field_id');

        return $result;
    }

    public function updateCustomFieldData($fields)
    {
        if ($fields != '') {
            foreach ($fields as $key => $value) {
                $idarray = explode('_', $key);
                $id = end($idarray);

                $fieldType = CustomField::findOrFail($id)->type;

                $value = ($fieldType == 'date') ? Carbon::createFromFormat('Y-m-d', $value)->format('Y-m-d') : $value;
                $value = ($fieldType == 'file' && !is_string($value) && !is_null($value)) ? Files::uploadLocalOrS3($value, 'custom_fields') : $value;

                $entry = DB::table('custom_fields_data')
                    ->where('model', $this->getModelName())
                    ->where('model_id', $this->id)
                    ->where('custom_field_id', $id)
                    ->first();

                if ($entry) {
                    if ($fieldType == 'file' && (!is_null($entry->value) && $entry->value != $value)) {
                        Files::deleteFile($entry->value, 'custom_fields');
                    }

                    DB::table('custom_fields_data')
                        ->where('model', $this->getModelName())
                        ->where('model_id', $this->id)
                        ->where('custom_field_id', $id)
                        ->update(['value' => $value]);
                } else {
                    DB::table('custom_fields_data')
                        ->insert([
                            'model' => $this->getModelName(),
                            'model_id' => $this->id,
                            'custom_field_id' => $id,
                            'value' => (!is_null($value)) ? $value : '',
                        ]);
                }
            }
        }
    }

    public function getExtrasAttribute()
    {
        if ($this->extraData == null) {
            $this->extraData = $this->getCustomFieldGroupsWithFields();
        }

        return $this->extraData;
    }

    public function withCustomFields()
    {
        $this->custom_fields = $this->getCustomFieldGroupsWithFields();
        $this->custom_fields_data = $this->getCustomFieldsData();

        return $this;
    }
}
