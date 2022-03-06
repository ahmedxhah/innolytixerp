<?php

namespace App\Http\Controllers;

use App\DataTables\JobOrderDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateJobOrderRequest;
use App\Http\Requests\UpdateJobOrderRequest;
use App\Repositories\JobOrderRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class JobOrderController extends AppBaseController
{
    /** @var JobOrderRepository $jobOrderRepository*/
    private $jobOrderRepository;

    public function __construct(JobOrderRepository $jobOrderRepo)
    {
        $this->jobOrderRepository = $jobOrderRepo;
    }

    /**
     * Display a listing of the JobOrder.
     *
     * @param JobOrderDataTable $jobOrderDataTable
     *
     * @return Response
     */
    public function index(JobOrderDataTable $jobOrderDataTable)
    {
        return $jobOrderDataTable->render('job_orders.index');
    }

    /**
     * Show the form for creating a new JobOrder.
     *
     * @return Response
     */
    public function create()
    {
        return view('job_orders.create');
    }

    /**
     * Store a newly created JobOrder in storage.
     *
     * @param CreateJobOrderRequest $request
     *
     * @return Response
     */
    public function store(CreateJobOrderRequest $request)
    {
        $input = $request->all();

        $jobOrder = $this->jobOrderRepository->create($input);

        Flash::success(__('messages.saved', ['model' => __('models/jobOrders.singular')]));

        return redirect(route('jobOrders.index'));
    }

    /**
     * Display the specified JobOrder.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $jobOrder = $this->jobOrderRepository->find($id);

        if (empty($jobOrder)) {
            Flash::error(__('messages.not_found', ['model' => __('models/jobOrders.singular')]));

            return redirect(route('jobOrders.index'));
        }

        return view('job_orders.show')->with('jobOrder', $jobOrder);
    }

    /**
     * Show the form for editing the specified JobOrder.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $jobOrder = $this->jobOrderRepository->find($id);

        if (empty($jobOrder)) {
            Flash::error(__('messages.not_found', ['model' => __('models/jobOrders.singular')]));

            return redirect(route('jobOrders.index'));
        }

        return view('job_orders.edit')->with('jobOrder', $jobOrder);
    }

    /**
     * Update the specified JobOrder in storage.
     *
     * @param int $id
     * @param UpdateJobOrderRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateJobOrderRequest $request)
    {
        $jobOrder = $this->jobOrderRepository->find($id);

        if (empty($jobOrder)) {
            Flash::error(__('messages.not_found', ['model' => __('models/jobOrders.singular')]));

            return redirect(route('jobOrders.index'));
        }

        $jobOrder = $this->jobOrderRepository->update($request->all(), $id);

        Flash::success(__('messages.updated', ['model' => __('models/jobOrders.singular')]));

        return redirect(route('jobOrders.index'));
    }

    /**
     * Remove the specified JobOrder from storage.
     *
     * @param int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $jobOrder = $this->jobOrderRepository->find($id);

        if (empty($jobOrder)) {
            Flash::error(__('messages.not_found', ['model' => __('models/jobOrders.singular')]));

            return redirect(route('jobOrders.index'));
        }

        $this->jobOrderRepository->delete($id);

        Flash::success(__('messages.deleted', ['model' => __('models/jobOrders.singular')]));

        return redirect(route('jobOrders.index'));
    }
}
