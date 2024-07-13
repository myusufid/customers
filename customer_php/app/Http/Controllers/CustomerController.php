<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Nationality;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class CustomerController extends Controller
{

    public function index()
    {
        return view('customers.index');
    }

    public function data()
    {
        $customers = Customer::select([
            'cst_id', 'nationality_id', 'cst_name', 'cst_dob', 'cst_phoneNum', 'cst_email', 'created_at', 'updated_at'
        ])->orderBy('cst_id', 'desc');

        return DataTables::of($customers)
            ->addColumn('action', function($row){
                $deleteForm = $this->getDeleteForm($row->cst_id);
                return "<a href='/customers/".$row->cst_id."/edit' class='edit btn btn-success btn-sm'>Edit</a>$deleteForm";
            })
            ->make(true);
    }

    private function getDeleteForm($id) {
        return "<form action='/customers/".$id."/destroy' method='POST'
     style='display:inline;'
     onsubmit='return confirm(\"Are you sure?\")'>"
            .csrf_field()
            .method_field('DELETE')
            ."<button type='submit' class='delete btn btn-danger btn-sm'>Delete</button>"
            ."</form>";
    }

    public function create()
    {
        $nationalities = Nationality::all();
        return view('customers.store',[
            'nationalities' => $nationalities
        ]);
    }

    public function store(Request $request)
    {
        $this->validateRequest($request);

        DB::beginTransaction();

        try {
            $customer = $this->createCustomer($request);

            $this->createFamilyList($request, $customer);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback(); // rollback if there was an error
            throw $e;
        }

        return redirect()->route('customers.index');
    }

    private function validateRequest(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'dob' => 'required|date',
            'nationality' => 'required|integer|exists:nationality,nationality_id',
            'phone' => 'required|string|max:15',
            'email' => 'required|string|email|max:255',
            'family' => 'sometimes|array',
            'family.*.family_name' => 'required_with:family|string|max:255',
            'family.*.family_dob' => 'required_with:family|date',
            'family.*.family_relation' => 'required_with:family|string|max:50'
        ]);
    }

    private function createCustomer(Request $request) : Customer
    {
        return Customer::create([
            'cst_name' => $request->name,
            'cst_dob' =>  $request->dob,
            'nationality_id' => $request->nationality,
            'cst_phoneNum' => $request->phone,
            'cst_email' => $request->email
        ]);
    }

    private function createFamilyList($request, Customer $customer)
    {
        if ($request->has('family')) {
            foreach($request->family as $family){
                $customer->families()->create([
                    'fl_name' => $family['family_name'],
                    'fl_dob' => $family['family_dob'],
                    'fl_relation' => $family['family_relation']
                ]);
            }
        }
    }

    public function edit(Customer $customer) {
        $nationalities = Nationality::all();
        return view('customers.edit', compact('customer', 'nationalities'));
    }

    public function update(Request $request, Customer $customer)
    {
        $this->validateRequest($request);
        DB::beginTransaction();

        try {

            $customer->update([
                'cst_name' => $request->name,
                'cst_dob' =>  $request->dob,
                'nationality_id' => $request->nationality,
                'cst_phoneNum' => $request->phone,
                'cst_email' => $request->email
            ]);

            $customer->families()->delete();

            $this->createFamilyList($request, $customer);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback(); // rollback if there was an error
            throw $e;
        }


        return redirect()->route('customers.index');
    }

    public function destroy(Customer $customer)
    {
        DB::beginTransaction();
        try {
            $customer->families()->delete();
            $customer->delete();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
        return redirect()->route('customers.index');
    }
}
