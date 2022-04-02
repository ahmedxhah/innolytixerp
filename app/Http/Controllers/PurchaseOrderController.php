<?php

namespace App\Http\Controllers;

use App\DataTables\PurchaseOrderDataTable;
use App\Http\Requests;
use App\Http\Requests\CreatePurchaseOrderRequest;
use App\Http\Requests\UpdatePurchaseOrderRequest;
use App\Repositories\PurchaseOrderRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use App\Models\Vendor;
use Response;

class PurchaseOrderController extends AppBaseController
{
    /** @var PurchaseOrderRepository $purchaseOrderRepository*/
    private $purchaseOrderRepository;

    public function __construct(PurchaseOrderRepository $purchaseOrderRepo)
    {
        $this->purchaseOrderRepository = $purchaseOrderRepo;
    }

    /**
     * Display a listing of the PurchaseOrder.
     *
     * @param PurchaseOrderDataTable $purchaseOrderDataTable
     *
     * @return Response
     */
    public function index(PurchaseOrderDataTable $purchaseOrderDataTable)
    {
        return $purchaseOrderDataTable->render('purchase_orders.index');
    }

    /**
     * Show the form for creating a new PurchaseOrder.
     *
     * @return Response
     */
    public function create()
    {
        return view('purchase_orders.create')->with('vendors',Vendor::get());
    }

    /**
     * Store a newly created PurchaseOrder in storage.
     *
     * @param CreatePurchaseOrderRequest $request
     *
     * @return Response
     */
    public function store(CreatePurchaseOrderRequest $request)
    {
        $input = $request->all();

        $purchaseOrder = $this->purchaseOrderRepository->create($input);

        Flash::success(__('messages.saved', ['model' => __('models/purchaseOrders.singular')]));

        return redirect(route('purchaseOrders.index'));
    }

    /**
     * Display the specified PurchaseOrder.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $purchaseOrder = $this->purchaseOrderRepository->find($id);

        if (empty($purchaseOrder)) {
            Flash::error(__('messages.not_found', ['model' => __('models/purchaseOrders.singular')]));

            return redirect(route('purchaseOrders.index'));
        }

        return view('purchase_orders.show')->with('purchaseOrder', $purchaseOrder);
    }

    /**
     * Show the form for editing the specified PurchaseOrder.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $purchaseOrder = $this->purchaseOrderRepository->find($id);

        if (empty($purchaseOrder)) {
            Flash::error(__('messages.not_found', ['model' => __('models/purchaseOrders.singular')]));

            return redirect(route('purchaseOrders.index'));
        }

        return view('purchase_orders.edit')->with('purchaseOrder', $purchaseOrder);
    }

    /**
     * Update the specified PurchaseOrder in storage.
     *
     * @param int $id
     * @param UpdatePurchaseOrderRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatePurchaseOrderRequest $request)
    {
        $purchaseOrder = $this->purchaseOrderRepository->find($id);

        if (empty($purchaseOrder)) {
            Flash::error(__('messages.not_found', ['model' => __('models/purchaseOrders.singular')]));

            return redirect(route('purchaseOrders.index'));
        }

        $purchaseOrder = $this->purchaseOrderRepository->update($request->all(), $id);

        Flash::success(__('messages.updated', ['model' => __('models/purchaseOrders.singular')]));

        return redirect(route('purchaseOrders.index'));
    }

    /**
     * Remove the specified PurchaseOrder from storage.
     *
     * @param int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $purchaseOrder = $this->purchaseOrderRepository->find($id);

        if (empty($purchaseOrder)) {
            Flash::error(__('messages.not_found', ['model' => __('models/purchaseOrders.singular')]));

            return redirect(route('purchaseOrders.index'));
        }

        $this->purchaseOrderRepository->delete($id);

        Flash::success(__('messages.deleted', ['model' => __('models/purchaseOrders.singular')]));

        return redirect(route('purchaseOrders.index'));
    }
}
