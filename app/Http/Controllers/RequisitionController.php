<?php

namespace App\Http\Controllers;
use App\Requisition;
use App\User;
use App\PosDevice;
use App\FastlinkNumber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Validator;
use PDF;

class RequisitionController extends Controller
{

//    function __construct()
//     {
//          $this->middleware('permission:requisition-list|requisition-create|requisition-edit|requisition-delete', ['only' => ['index','show']]);
//          $this->middleware('permission:requisition-create', ['only' => ['create','store']]);
//          $this->middleware('permission:requisition-edit', ['only' => ['edit','update']]);
//          $this->middleware('permission:requisition-delete', ['only' => ['destroy']]);
//     }

    public function index(Request $request)
    {
        $requisitions = Requisition::get();
        $users  =  User::get();

        $sub_distributors_id = $request->get('sub_distributors_id');
        $sales_rep_id = $request->get('sales_rep_id');
        $dealer_id = $request->get('dealer_id');
        $status = $request->get('status');
        $type = $request->get('type');
        $created_at = $request->get('created_at');
        $requisitions = Requisition::query();

        if ($sub_distributors_id) {
            $requisitions = $requisitions->where('sub_distributors_id','LIKE','%'.$sub_distributors_id.'%');
        }
          if ($sales_rep_id) {
            $requisitions = $requisitions->where('sales_rep_id','LIKE','%'.$sales_rep_id.'%');
        }

        if ($dealer_id) {
            $requisitions = $requisitions->where('dealer_id','LIKE','%'.$dealer_id.'%');
        }
        if ($status) {
            $requisitions = $requisitions->where('status','LIKE','%'.$status.'%');
        }

        if ($type) {
            $requisitions = $requisitions->where('type','LIKE','%'.$type.'%');
        }

        if ($created_at) {
            $requisitions = $requisitions->where('created_at','LIKE','%'.$created_at.'%');
        }

        $requisitions = $requisitions->paginate(5);

        if ($requisitions->count() !== 0) {
            return  view('requisition.index', compact('requisitions' , 'users'));
        }
        return redirect()->back()->withErrors(['Oops! Nothing Found']);
    }


    public function create()
    {
        $users =  User::get();
        return view("requisition.create", compact('users'));
    }


   public function store(Request $request)
    {
        $request->validate([
            'addmore.*.sub_distributors_id' => 'required',
            'addmore.*.sales_rep_id'        => 'required',
            'addmore.*.dealer_id'           => 'required',
            // 'addmore.*.status'              => 'required',
            // 'addmore.*.type'                => 'required',

        ]);
         foreach ($request->addmore as $key => $value)
        {
         Requisition::create($value);
        }
          return redirect()->route('requisition.index')->with('status', 'Requests have Created Successfully.');
    }



// upload and store for accstats and accdocument using ajax request
    public function uploadFile($id) {
        $requisition = Requisition::find($id);
        return view('requisition.createFile' , compact('requisition'));

    }

    public function storeFile(Request $request , $id) {

        if ($request->ajax()) {

        $validator = Validator::make($request->all(), [
       // $request->validate([
            'acc_status'            => 'required',
           'acc_document'          => 'required|mimes:doc,docx,pdf,txt,zip|max:2000',
        ],[
                    'acc_document.required' => 'Please upload a file',
                    'acc_document.mimes' => 'Only doc,docx,pdf,txt and zip are allowed',
                    'acc_document.max' => 'Sorry! Maximum allowed size for an image is 5MB',
        ]);

        if ($validator->fails())
        {

               return response()->json(['code'=>422, 'error'=>$validator->errors()]);
        }
        else {
            $requisition = Requisition::find($id);
            $requisition->acc_status =  $request->get('acc_status');

             if($request->hasFile('acc_document'))
            {

            $requisitionFile = public_path("/{$requisition->acc_document}");
             if ($requisition->acc_document!=null)
            {
                    unlink($requisitionFile);
            }
            $FileName = uniqid() .$request->file('acc_document')->getClientOriginalName();
            $path = $request->file('acc_document')->storeAs('uploads', $FileName , 'public');
            $requisition->acc_document = '/storage/' . $path;
            }
            $requisition->save();

            return response()->json(['code'=>200, 'status' => 'Your file has been uploaded successfully!' ,'id'=>$id,   'value'=> $requisition ]);
            }
    }
}


    // Show
    public function show($id)
    {
        $requisition = Requisition::find($id);
        $users =  User::get();
        $pos_devices = PosDevice::get();
        $fastlink_numbers = FastlinkNumber::get();
        return view('requisition.show', compact('requisition' , 'users' , 'fastlink_numbers' , 'pos_devices'));
    }

    // edit
    public function edit($id)
    {
        $requisition = Requisition::find($id);
        $users =  User::get();
        return view('requisition.edit', compact('requisition', 'users'));
    }
    public function update(Request $request, Requisition $requisition)
    {
        $request->validate([
            'sub_distributors_id'      => 'required',
            'sales_rep_id'             => 'required',
            'dealer_id'                => 'required',
            'status'                   => 'required',
            'type'                     => 'required',
            'remarks'                  => 'required',
        ]);
        $requisition->update($request->all());

        return redirect()->route('requisition.index')
            ->with('status', 'Request has been updated successfully.');
    }

    //soft delete
    public function destroy(Requisition $requisition)
    {
        $requisition->delete();
        return redirect()->route('requisition.index')
            ->with('status', 'Request has been deleted successfully.');
    }


    //assign fastlink and pos for the request
    public function assign($id){
         $requisition = Requisition::find($id);
         $pos_devices = PosDevice::get();
        $fastlink_numbers = FastlinkNumber::get();
        return view('requisition/assign', compact('requisition' , 'fastlink_numbers' , 'pos_devices'));
    }
     public function storeAssign(Request $request, Requisition $requisition){
           $request->validate([
            'fastlink_numbers_id'        => 'required|unique:requisitions',
            'pos_devices_id'              => 'required|unique:requisitions',
        ]);

     $requisition = Requisition::find($request->id);
        $requisition->fastlink_numbers_id    = $request->fastlink_numbers_id;
        $requisition->pos_devices_id         = $request->pos_devices_id;
        $requisition->save();
        return redirect()->route('requisition.index')
                         ->with('status','Request has been updated successfully!');
    }


    //changing html into pdf
    public function templatePdf(Request $request , Requisition $requisition){
        $requisition = Requisition::find($request->id);
        $pos_devices = PosDevice::get();
        $fastlink_numbers = FastlinkNumber::get();

        $usersSR = DB::table("users")
            ->select('users.id','users.name','users.mobile_no','users.city','users.area', 'users.type','users.state','requisitions.sales_rep_id')
            ->join('requisitions','requisitions.sales_rep_id','=','users.id')
            ->where('users.type','=','SalesRep')
            ->distinct()
            ->get();

        $usersDealerMerchant = DB::table('users')
            ->select('users.id','users.name','users.mobile_no','users.account_no','users.city','users.state','users.area','users.type','requisitions.dealer_id','requisitions.acc_document')
            ->join('requisitions','requisitions.dealer_id','=','users.id')
            ->groupBy('users.id')->get();

        $pdf = PDF::loadView('pdf.template', compact('requisition' , 'fastlink_numbers' , 'pos_devices' , 'usersSR' , 'usersDealerMerchant'));
        $pdf->setOption('page-size' , 'a4');
        return $pdf->stream('pdf.template');

        return view('pdf/template');
    }

}
