<?php
namespace App\Http\Controllers;

use App\FastlinkNumber;
use App\Imports\FastlinkNumberImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Authorizable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FastlinkNumberController extends Controller
{

    //multiinputSearch based on fastlink S/N , status, availability and date_received
    public function index(Request $request)
    {
        $fastlink_numbers = FastlinkNumber::get();

        $status = $request->get('status');
        $availability = $request->get('availability');
        $date_received = $request->get('date_received');
        $serial_number = $request->get('serial_number');
        $fastlink_numbers = FastlinkNumber::query();

        if ($serial_number) {
            $fastlink_numbers = $fastlink_numbers->where('serial_number','LIKE','%'.$serial_number.'%');
        }
        if ($status) {
            $fastlink_numbers = $fastlink_numbers->where('status','LIKE','%'.$status.'%');
        }

        if ($availability) {
            $fastlink_numbers = $fastlink_numbers->where('availability','LIKE','%'.$availability.'%');
        }

        if ($date_received) {
            $fastlink_numbers = $fastlink_numbers->where('date_received','LIKE','%'.$date_received.'%');
        }

        $fastlink_numbers = $fastlink_numbers->paginate(5);

        if ($fastlink_numbers->count() !== 0) {
            return view('fastlink_number.index')->with('fastlink_numbers',$fastlink_numbers);
            }
            return redirect()->back()->withErrors(['Oops! Nothing Found']);
    }

    //fastlink_number device create form
    public function create()
    {
        return view('fastlink_number.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'msisdn'        => 'required|unique:fastlink_numbers',
            'serial_number' => 'required|unique:fastlink_numbers',
            'batch'         => 'required',
            'date_received' => 'required',
            'status'        => 'required',
            'remarks'       => 'required',
            'availability'  => 'required',
        ]);

        $fastlink_number                      = new FastlinkNumber;
        $fastlink_number->msisdn              = $request->msisdn;
        $fastlink_number->serial_number       = $request->serial_number;
        $fastlink_number->batch               = $request->batch;
        $fastlink_number->date_received       = $request->date_received;
        $fastlink_number->status              = $request->status;
        $fastlink_number->remarks             = $request->remarks;
        $fastlink_number->availability        = $request->availability;
        $fastlink_number->save();
        return redirect()->route('fastlink_number.index')
                         ->with('status','Fastlink number has been created successfully.');    }



    //bulk upload fastlink_number excel sheet
     public function createBulk()
    {
        return view('fastlink_number.createBulk');
    }
      public function importFastlinkNumber(Request $request)
    {
        Excel::import(new FastlinkNumberImport, $request->file('file'));
        return back()->with('status', 'Fastlink Number created successfully.');
    }

    //fastlink_number device show
    public function show(FastlinkNumber $fastlink_number)
    {
        return view('fastlink_number.show',compact('fastlink_number'));
    }

//fastlink_number device edit
    public function edit(Request $request, $id)
    {
        $fastlink_number = FastlinkNumber::find($id);
        return view('fastlink_number.edit', compact('fastlink_number'));
    }
    public function update(Request $request , FastlinkNumber $fastlink_number)
    {
        $request->validate([
            'msisdn'        => 'required',
            'serial_number' => 'required',
            'batch'         => 'required',
            'date_received' => 'required',
            'status'        => 'required',
            'remarks'       => 'required',
            'availability'  => 'required',
        ]);
        $fastlink_number->update($request->all());
        return redirect()->route('fastlink_number.index')
                         ->with('status','Fastlink number has been updated successfully.');
             }

//fastlink_number delete
    public function destroy(FastlinkNumber $fastlink_number)
    {
        $fastlink_number->delete();
        return redirect()->route('fastlink_number.index')
                         ->with('status','Fastlink number has been deleted successfully.');
    }

}
