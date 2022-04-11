<?php

namespace App\Http\Controllers;

use App\DataTables\ChartofaccountsDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateChartofaccountsRequest;
use App\Http\Requests\UpdateChartofaccountsRequest;
use App\Repositories\ChartofaccountsRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use App\Models\Account;
use App\Models\Chartofaccounts;
use Response;
use Scottlaurent\Accounting\Models\Journal;
use Scottlaurent\Accounting\Models\Ledger;

class ChartofaccountsController extends AppBaseController
{
    /** @var ChartofaccountsRepository $chartofaccountsRepository*/
    private $chartofaccountsRepository;

    public function __construct(ChartofaccountsRepository $chartofaccountsRepo)
    {
        $this->chartofaccountsRepository = $chartofaccountsRepo;
    }

    /**
     * Display a listing of the Chartofaccounts.
     *
     * @param ChartofaccountsDataTable $chartofaccountsDataTable
     *
     * @return Response
     */
    public function index()
    {
        return view('chartofaccounts.index')->with('accounts',Account::get()->where('has_parent',0));
    }

    /**
     * Show the form for creating a new Chartofaccounts.
     *
     * @return Response
     */
    public function create()
    {
        return view('chartofaccounts.create')->with('accounts',Account::get()->where('has_parent',0));
    }

    /**
     * Store a newly created Chartofaccounts in storage.
     *
     * @param CreateChartofaccountsRequest $request
     *
     * @return Response
     */
    public function store(CreateChartofaccountsRequest $request)
    {
        $input = $request->all();

        $account=Account::find($input['parent_id']);
        $account->has_child=1;
        $account->save();
        $input['has_parent']=1;

        $this->chartofaccounts = Account::create($input)->initJournal();
        $this->chartofaccounts->assignToLedger($account->journal->ledger);

        // $chartofaccounts = $this->chartofaccountsRepository->create($input);

        Flash::success(__('messages.saved', ['model' => __('models/chartofaccounts.singular')]));

        return redirect(route('chartofaccounts.index'));
    }

    /**
     * Display the specified Chartofaccounts.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $chartofaccounts =Account::find($id);
        // $chartofaccounts = $this->chartofaccountsRepository->find($id);

        if (empty($chartofaccounts)) {
            Flash::error(__('messages.not_found', ['model' => __('models/chartofaccounts.singular')]));

            return redirect(route('chartofaccounts.index'));
        }
        return view('chartofaccounts.show')->with('chartofaccounts', $chartofaccounts->journal);
    }

    /**
     * Show the form for editing the specified Chartofaccounts.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $chartofaccounts = $this->chartofaccountsRepository->find($id);

        if (empty($chartofaccounts)) {
            Flash::error(__('messages.not_found', ['model' => __('models/chartofaccounts.singular')]));

            return redirect(route('chartofaccounts.index'));
        }

        return view('chartofaccounts.edit')->with('chartofaccounts', $chartofaccounts);
    }

    /**
     * Update the specified Chartofaccounts in storage.
     *
     * @param int $id
     * @param UpdateChartofaccountsRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateChartofaccountsRequest $request)
    {
        $chartofaccounts = $this->chartofaccountsRepository->find($id);

        if (empty($chartofaccounts)) {
            Flash::error(__('messages.not_found', ['model' => __('models/chartofaccounts.singular')]));

            return redirect(route('chartofaccounts.index'));
        }

        $chartofaccounts = $this->chartofaccountsRepository->update($request->all(), $id);

        Flash::success(__('messages.updated', ['model' => __('models/chartofaccounts.singular')]));

        return redirect(route('chartofaccounts.index'));
    }

    /**
     * Remove the specified Chartofaccounts from storage.
     *
     * @param int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $chartofaccounts = $this->chartofaccountsRepository->find($id);

        if (empty($chartofaccounts)) {
            Flash::error(__('messages.not_found', ['model' => __('models/chartofaccounts.singular')]));

            return redirect(route('chartofaccounts.index'));
        }

        $this->chartofaccountsRepository->delete($id);

        Flash::success(__('messages.deleted', ['model' => __('models/chartofaccounts.singular')]));

        return redirect(route('chartofaccounts.index'));
    }
}
