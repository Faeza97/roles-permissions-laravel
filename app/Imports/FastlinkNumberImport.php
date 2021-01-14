<?php

namespace App\Imports;

use App\Models\FastlinkNumber;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class FastlinkNumberImport implements ToModel, WithHeadingRow, WithValidation
{
    use Importable;
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new FastlinkNumber([
            'msisdn'            => $row['msisdn'],
            'serial_number'     => $row['serial_number'],
            'batch'             => $row['batch'],
            'date_received'     => $row['date_received'],
            'status'            => $row['status'],
            'remarks'           => $row['remarks'],
            'availability'      => $row['availability'],
        ]);
    }
     public function rules(): array
    {
        return [
            'msisdn' => 'unique:fastlink_numbers,msisdn',
            'serial_number' => 'unique:fastlink_numbers,serial_number',
            'batch' => 'required',
            'date_received' => 'required',
            'status' => 'required',
            'remarks' => 'required',
            'availability' => 'required',
        ];
    }
     public function validationMessages()
    {
        return [
            'msisdn.required' => trans('fastlink_numbers.msisdn_is_required'),
            'msisdn.unique' => trans('fastlink_numbers.msisdn_must_be_unique'),
            'serial_number.required' => trans('fastlink_numbers.serial_number_is_required'),
            'serial_number.unique' => trans('fastlink_numbers.serial_number_must_be_unique'),
            'batch.required' => trans('fastlink_numbers.batch_is_required'),
            'date_received.required' => trans('fastlink_numbers.date_received_is_required'),
            'status.required' => trans('fastlink_numbers.status_is_required'),
            'remarks.required' => trans('fastlink_numbers.remarks_is_required'),
            'availability.required' => trans('fastlink_numbers.availability_is_required'),
        ];
    }
}
