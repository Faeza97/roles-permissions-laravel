<?php

namespace App\Imports;

use App\Models\PosDevice;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class PosImport implements ToModel, WithHeadingRow , WithValidation
{
    use Importable;
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new PosDevice([
            'imei'              => $row['imei'],
            'serial_number'     => $row['serial_number'],
            'brand'             => $row['brand'],
            'model'             => $row['model'],
            'carton_no'         => $row['carton_no'],
            'batch'             => $row['batch'],
            'status'            => $row['status'],
            'date_received'     => $row['date_received'],
            'remarks'           => $row['remarks'],
            'availability'      => $row['availability'],

        ]);
    }

    public function rules(): array
    {
        return [
            'imei' => 'unique:pos_devices,imei',
            'serial_number' => 'unique:pos_devices,serial_number',
            'brand' => 'required',
            'model' => 'required',
            'carton_no' => 'required',
            'batch' => 'required',
            'status' => 'required',
            'date_received' => 'required',
            'remarks' => 'required',
            'availability' => 'required',
        ];
    }
     public function validationMessages()
    {
        return [
            'imei.required' => trans('pos_devices.imei_is_required'),
            'imei.unique' => trans('pos_devices.imei_must_be_unique'),
            'serial_number.required' => trans('pos_devices.serial_number_is_required'),
            'serial_number.unique' => trans('pos_devices.serial_number_must_be_unique'),
            'brand.required' => trans('pos_devices.brand_is_required'),
            'model.required' => trans('pos_devices.model_is_required'),
            'carton_no.required' => trans('pos_devices.carton_no_is_required'),
            'batch.required' => trans('pos_devices.batch_is_required'),
            'status.required' => trans('pos_devices.status_is_required'),
            'date_received.required' => trans('pos_devices.date_received_is_required'),
            'remarks.required' => trans('pos_devices.remarks_is_required'),
            'availability.required' => trans('pos_devices.availability_is_required'),
        ];
    }
}
