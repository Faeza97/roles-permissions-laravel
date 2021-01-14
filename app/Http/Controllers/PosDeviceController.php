<?php

namespace App\Http\Controllers;
use Validator;
use App\Authorizable;

use Illuminate\Http\Request;
use App\PosDevice;
use App\FastlinkNumber;
use App\Requisition;
use App\Imports\PosImport;
use Maatwebsite\Excel\Facades\Excel;


class PosDeviceController extends Controller
{
    public function homeIndex()
    {
        //main page index
        $data['pos_devices'] = PosDevice::all();
        $data['fastlink_numbers'] = FastlinkNumber::all();
        $data['requisitions'] = Requisition::all();
        return view('home', $data);
    }

     public function index(Request $request)
    {
        $pos_devices = PosDevice::get();

        $status = $request->get('status');
        $availability = $request->get('availability');
        $date_received = $request->get('date_received');
        $serial_number = $request->get('serial_number');
        $pos_devices = PosDevice::query();

        if ($serial_number) {
            $pos_devices = $pos_devices->where('serial_number','LIKE','%'.$serial_number.'%');
        }
        if ($status) {
            $pos_devices = $pos_devices->where('status','LIKE','%'.$status.'%');
        }

        if ($availability) {
            $pos_devices = $pos_devices->where('availability','LIKE','%'.$availability.'%');
        }

        if ($date_received) {
            $pos_devices = $pos_devices->where('date_received','LIKE','%'.$date_received.'%');
        }

        $pos_devices = $pos_devices->paginate(5);

        //IF NO result found
          if ($pos_devices->count() !== 0) {
        return view('pos_device.index')->with('pos_devices',$pos_devices);
        }
        return redirect()->back()->withErrors(['Oops! Nothing Found']);
    }


    //post device bulk & create form
    public function create()
    {
        return view('pos_device.create');
    }
    public function store(Request $request)
    {
          $request->validate([
            'imei'          => 'required|unique:pos_devices',
            'serial_number' => 'required|unique:pos_devices',
            'brand'         => 'required',
            'model'         => 'required',
            'carton_no'     => 'required',
            'batch'         => 'required',
            'date_received' => 'required',
            'status'        => 'required',
            'remarks'       => 'required',
            'availability'  => 'required',
        ]);

        $pos_device                      = new PosDevice;
        $pos_device->imei                = $request->imei;
        $pos_device->serial_number       = $request->serial_number;
        $pos_device->brand               = $request->brand;
        $pos_device->model               = $request->model;
        $pos_device->carton_no           = $request->carton_no;
        $pos_device->batch               = $request->batch;
        $pos_device->date_received       = $request->date_received;
        $pos_device->status              = $request->status;
        $pos_device->remarks             = $request->remarks;
        $pos_device->availability        = $request->availability;
        $pos_device->save();

     return redirect()->route('pos_device.index')
            ->with('status', 'POS device has been created successfully.');
    }

    //bulk upload pos excel sheet
     public function createBulk()
    {
        return view('pos_device.createBulk');
    }
      public function importPos(Request $request)
    {
        Excel::import(new PosImport, $request->file('file'));
        return back()->with('status', 'Pos created successfully.');
    }

    //post device show
    public function show(PosDevice $pos_device)
    {
        return view('pos_device.show', compact('pos_device'));
    }

    //pos device edit
    public function edit(Request $request, $id)
    {
        $pos_device = PosDevice::find($id);
        return view('pos_device.edit', compact('pos_device'));
    }
    public function update(Request $request, PosDevice $pos_device)
    {
        $request->validate([
            'imei'          => 'required',
            'serial_number' => 'required',
            'brand'         => 'required',
            'model'         => 'required',
            'carton_no'     => 'required',
            'batch'         => 'required',
            'date_received' => 'required',
            'status'        => 'required',
            'remarks'       => 'required',
            'availability'  => 'required',
        ]);
        $pos_device->update($request->all());
        return redirect()->route('pos_device.index')
            ->with('status', 'POS device has been updated successfully.');
    }

    //pos delete
    public function destroy(PosDevice $pos_device)
    {
        $pos_device->delete();
        return redirect()->route('pos_device.index')
            ->with('status', 'POS device has been deleted successfully.');
    }
}
