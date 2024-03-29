<?php

namespace App\Http\Controllers;

use App\DataTables\TaxDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateTaxRequest;
use App\Http\Requests\UpdateTaxRequest;
use App\Repositories\TaxRepository;
use Flash;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AppBaseController;
use Response;

class TaxController extends AppBaseController
{
    /** @var TaxRepository $taxRepository*/
    private $taxRepository;

    public function __construct(TaxRepository $taxRepo)
    {
        $this->taxRepository = $taxRepo;
    }

    /**
     * Display a listing of the Tax.
     *
     * @param TaxDataTable $taxDataTable
     *
     * @return Response
     */
    public function index(TaxDataTable $taxDataTable)
    {
        return $taxDataTable->render('taxes.index');
    }

    /**
     * Show the form for creating a new Tax.
     *
     * @return Response
     */
    public function create()
    {
        return view('taxes.create');
    }

    /**
     * Store a newly created Tax in storage.
     *
     * @param CreateTaxRequest $request
     *
     * @return Response
     */
    public function store(CreateTaxRequest $request)
    {
        $input = $request->all();
        $input['created_by']=Auth::id();
        $tax = $this->taxRepository->create($input);

        Flash::success(__('messages.saved', ['model' => __('models/taxes.singular')]));

        return redirect(route('taxes.index'));
    }

    /**
     * Display the specified Tax.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $tax = $this->taxRepository->find($id);

        if (empty($tax)) {
            Flash::error(__('messages.not_found', ['model' => __('models/taxes.singular')]));

            return redirect(route('taxes.index'));
        }

        return view('taxes.show')->with('tax', $tax);
    }

    /**
     * Show the form for editing the specified Tax.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $tax = $this->taxRepository->find($id);

        if (empty($tax)) {
            Flash::error(__('messages.not_found', ['model' => __('models/taxes.singular')]));

            return redirect(route('taxes.index'));
        }

        return view('taxes.edit')->with('tax', $tax);
    }

    /**
     * Update the specified Tax in storage.
     *
     * @param int $id
     * @param UpdateTaxRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateTaxRequest $request)
    {
        $tax = $this->taxRepository->find($id);

        if (empty($tax)) {
            Flash::error(__('messages.not_found', ['model' => __('models/taxes.singular')]));

            return redirect(route('taxes.index'));
        }

        $tax = $this->taxRepository->update($request->all(), $id);

        Flash::success(__('messages.updated', ['model' => __('models/taxes.singular')]));

        return redirect(route('taxes.index'));
    }

    /**
     * Remove the specified Tax from storage.
     *
     * @param int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $tax = $this->taxRepository->find($id);

        if (empty($tax)) {
            Flash::error(__('messages.not_found', ['model' => __('models/taxes.singular')]));

            return redirect(route('taxes.index'));
        }

        $this->taxRepository->delete($id);

        Flash::success(__('messages.deleted', ['model' => __('models/taxes.singular')]));

        return redirect(route('taxes.index'));
    }
}
