<?php

namespace App\Http\Controllers;

use App\DataTables\InvoicesDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateInvoicesRequest;
use App\Http\Requests\UpdateInvoicesRequest;
use App\Models\Banks;
use App\Repositories\InvoicesRepository;
use App\Models\Clients;
use App\Models\JobOrder;
use App\Models\InvoicesProducts;
use App\Models\OfficeDetails;
use App\Models\Tax;
use Illuminate\Support\Facades\Auth;
use App\Models\Vendor;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class InvoicesController extends AppBaseController
{
    /** @var InvoicesRepository $invoicesRepository*/
    private $invoicesRepository;

    public function __construct(InvoicesRepository $invoicesRepo)
    {
        $this->invoicesRepository = $invoicesRepo;
    }

    /**
     * Display a listing of the Invoices.
     *
     * @param InvoicesDataTable $invoicesDataTable
     *
     * @return Response
     */
    public function index(InvoicesDataTable $invoicesDataTable)
    {
        return $invoicesDataTable->render('invoices.index');
    }

    /**
     * Show the form for creating a new Invoices.
     *
     * @return Response
     */
    public function create()
    {
        return view('invoices.create')
        ->with('joborders',JobOrder::all())
        ->with('officedetails',OfficeDetails::all())
        ->with('taxs',Tax::all())
        ->with('vendors',Vendor::all())
        ->with('banks',Banks::all());
    }

    /**
     * Store a newly created Invoices in storage.
     *
     * @param CreateInvoicesRequest $request
     *
     * @return Response
     */
    public function store(CreateInvoicesRequest $request)
    {
        $input = $request->all();
        $products=$input['product'];
        unset($input['product']);

        $subtotal=0;
        foreach($products as $k=>$pro){
            $products[$k]['total']=$pro['qty']*$pro['unitprice'];
            $subtotal+=$pro['qty']*$pro['unitprice'];
        }

        $input['created_by']=Auth::id();
        $input['sub_total']=$subtotal;
        $discount=($input['discount']/100)*$subtotal;
        $tax=($input['tax']/100)*$subtotal;
        $input['grand_total']=$subtotal+$tax-$discount;

        $invoices = $this->invoicesRepository->create($input);

        if($invoices){
            foreach($products as $k=>$pro){
                $products[$k]['invoice_id']=$invoices->id;
                InvoicesProducts::create($products[$k]);
            }
        }

        Flash::success(__('messages.saved', ['model' => __('models/invoices.singular')]));

        return redirect(route('invoices.index'));
    }

    /**
     * Display the specified Invoices.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $invoices = $this->invoicesRepository->find($id);

        if (empty($invoices)) {
            Flash::error(__('messages.not_found', ['model' => __('models/invoices.singular')]));

            return redirect(route('invoices.index'));
        }
        return view('invoices.invoice')
        ->with('invoices', $invoices)
        ->with('products',InvoicesProducts::where('invoice_id',$invoices->id)->get())
        ->with('joborder',JobOrder::find($invoices->joborder_id)->with('client')->first())
        ->with('office_detail',OfficeDetails::find($invoices->officedetails_id));
        // return view('invoices.show')->with('invoices', $invoices);
    }

    /**
     * Show the form for editing the specified Invoices.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $invoices = $this->invoicesRepository->find($id);

        if (empty($invoices)) {
            Flash::error(__('messages.not_found', ['model' => __('models/invoices.singular')]));

            return redirect(route('invoices.index'));
        }

        return view('invoices.edit')->with('invoices', $invoices);
    }

    /**
     * Update the specified Invoices in storage.
     *
     * @param int $id
     * @param UpdateInvoicesRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateInvoicesRequest $request)
    {
        $invoices = $this->invoicesRepository->find($id);

        if (empty($invoices)) {
            Flash::error(__('messages.not_found', ['model' => __('models/invoices.singular')]));

            return redirect(route('invoices.index'));
        }

        $invoices = $this->invoicesRepository->update($request->all(), $id);

        Flash::success(__('messages.updated', ['model' => __('models/invoices.singular')]));

        return redirect(route('invoices.index'));
    }

    /**
     * Remove the specified Invoices from storage.
     *
     * @param int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $invoices = $this->invoicesRepository->find($id);

        if (empty($invoices)) {
            Flash::error(__('messages.not_found', ['model' => __('models/invoices.singular')]));

            return redirect(route('invoices.index'));
        }

        $this->invoicesRepository->delete($id);

        Flash::success(__('messages.deleted', ['model' => __('models/invoices.singular')]));

        return redirect(route('invoices.index'));
    }
}
