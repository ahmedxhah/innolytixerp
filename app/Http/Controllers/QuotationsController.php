<?php

namespace App\Http\Controllers;

use App\DataTables\QuotationsDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateQuotationsRequest;
use App\Http\Requests\UpdateQuotationsRequest;
use App\Repositories\QuotationsRepository;
use Flash;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AppBaseController;
use Response;

class QuotationsController extends AppBaseController
{
    /** @var QuotationsRepository $quotationsRepository*/
    private $quotationsRepository;

    public function __construct(QuotationsRepository $quotationsRepo)
    {
        $this->quotationsRepository = $quotationsRepo;
    }

    /**
     * Display a listing of the Quotations.
     *
     * @param QuotationsDataTable $quotationsDataTable
     *
     * @return Response
     */
    public function index(QuotationsDataTable $quotationsDataTable)
    {
        return $quotationsDataTable->render('quotations.index');
    }

    /**
     * Show the form for creating a new Quotations.
     *
     * @return Response
     */
    public function create()
    {
        return view('quotations.create');
    }

    /**
     * Store a newly created Quotations in storage.
     *
     * @param CreateQuotationsRequest $request
     *
     * @return Response
     */
    public function store(CreateQuotationsRequest $request)
    {
        $input = $request->all();
        $input['created_by']=Auth::id();
        $quotations = $this->quotationsRepository->create($input);

        Flash::success(__('messages.saved', ['model' => __('models/quotations.singular')]));

        return redirect(route('quotations.index'));
    }

    /**
     * Display the specified Quotations.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $quotations = $this->quotationsRepository->find($id);

        if (empty($quotations)) {
            Flash::error(__('messages.not_found', ['model' => __('models/quotations.singular')]));

            return redirect(route('quotations.index'));
        }

        return view('quotations.show')->with('quotations', $quotations);
    }

    /**
     * Show the form for editing the specified Quotations.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $quotations = $this->quotationsRepository->find($id);

        if (empty($quotations)) {
            Flash::error(__('messages.not_found', ['model' => __('models/quotations.singular')]));

            return redirect(route('quotations.index'));
        }

        return view('quotations.edit')->with('quotations', $quotations);
    }

    /**
     * Update the specified Quotations in storage.
     *
     * @param int $id
     * @param UpdateQuotationsRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateQuotationsRequest $request)
    {
        $quotations = $this->quotationsRepository->find($id);

        if (empty($quotations)) {
            Flash::error(__('messages.not_found', ['model' => __('models/quotations.singular')]));

            return redirect(route('quotations.index'));
        }

        $quotations = $this->quotationsRepository->update($request->all(), $id);

        Flash::success(__('messages.updated', ['model' => __('models/quotations.singular')]));

        return redirect(route('quotations.index'));
    }

    /**
     * Remove the specified Quotations from storage.
     *
     * @param int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $quotations = $this->quotationsRepository->find($id);

        if (empty($quotations)) {
            Flash::error(__('messages.not_found', ['model' => __('models/quotations.singular')]));

            return redirect(route('quotations.index'));
        }

        $this->quotationsRepository->delete($id);

        Flash::success(__('messages.deleted', ['model' => __('models/quotations.singular')]));

        return redirect(route('quotations.index'));
    }
}
