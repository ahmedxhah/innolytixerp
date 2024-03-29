<?php

namespace App\Http\Controllers;

use App\DataTables\TransectionsDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateTransectionsRequest;
use App\Http\Requests\UpdateTransectionsRequest;
use App\Models\Banks;
use App\Models\JobOrder;
use App\Models\OfficeDetails;
use App\Models\Tax;
use App\Models\Vendor;
use Illuminate\Support\Facades\Auth;
use App\Repositories\TransectionsRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class TransectionsController extends AppBaseController
{
    /** @var TransectionsRepository $transectionsRepository*/
    private $transectionsRepository;

    public function __construct(TransectionsRepository $transectionsRepo)
    {
        $this->transectionsRepository = $transectionsRepo;
    }

    /**
     * Display a listing of the Transections.
     *
     * @param TransectionsDataTable $transectionsDataTable
     *
     * @return Response
     */
    public function index(TransectionsDataTable $transectionsDataTable)
    {
        return $transectionsDataTable->render('transections.index');
    }

    /**
     * Show the form for creating a new Transections.
     *
     * @return Response
     */
    public function create()
    {
        return view('transections.create')
        ->with('joborders',JobOrder::all())
        ->with('officedetails',OfficeDetails::all())
        ->with('taxs',Tax::all())
        ->with('vendors',Vendor::all())
        ->with('banks',Banks::all());
    }

    /**
     * Store a newly created Transections in storage.
     *
     * @param CreateTransectionsRequest $request
     *
     * @return Response
     */
    public function store(CreateTransectionsRequest $request)
    {
        $input = $request->all();
        $input['created_by']=Auth::id();
        $transections = $this->transectionsRepository->create($input);

        Flash::success(__('messages.saved', ['model' => __('models/transections.singular')]));

        return redirect(route('transections.index'));
    }

    /**
     * Display the specified Transections.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $transections = $this->transectionsRepository->find($id);

        if (empty($transections)) {
            Flash::error(__('messages.not_found', ['model' => __('models/transections.singular')]));

            return redirect(route('transections.index'));
        }

        return view('transections.show')->with('transections', $transections);
    }

    /**
     * Show the form for editing the specified Transections.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $transections = $this->transectionsRepository->find($id);

        if (empty($transections)) {
            Flash::error(__('messages.not_found', ['model' => __('models/transections.singular')]));

            return redirect(route('transections.index'));
        }

        return view('transections.edit')->with('transections', $transections);
    }

    /**
     * Update the specified Transections in storage.
     *
     * @param int $id
     * @param UpdateTransectionsRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateTransectionsRequest $request)
    {
        $transections = $this->transectionsRepository->find($id);

        if (empty($transections)) {
            Flash::error(__('messages.not_found', ['model' => __('models/transections.singular')]));

            return redirect(route('transections.index'));
        }

        $transections = $this->transectionsRepository->update($request->all(), $id);

        Flash::success(__('messages.updated', ['model' => __('models/transections.singular')]));

        return redirect(route('transections.index'));
    }

    /**
     * Remove the specified Transections from storage.
     *
     * @param int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $transections = $this->transectionsRepository->find($id);

        if (empty($transections)) {
            Flash::error(__('messages.not_found', ['model' => __('models/transections.singular')]));

            return redirect(route('transections.index'));
        }

        $this->transectionsRepository->delete($id);

        Flash::success(__('messages.deleted', ['model' => __('models/transections.singular')]));

        return redirect(route('transections.index'));
    }
}
