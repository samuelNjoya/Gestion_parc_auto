<?php

namespace App\Exports;


use App\Models\VehiculeModel;
use Maatwebsite\Excel\Concerns\FromCollection;

class VehiculeExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return VehiculeModel::getVehiculeActive();
    }
}
