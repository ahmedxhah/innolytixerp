<?php

namespace App\Http\Controllers;

use App\DataTables\PaymentvoucherDataTable;
use App\Http\Requests;
use App\Http\Requests\CreatePaymentvoucherRequest;
use App\Http\Requests\UpdatePaymentvoucherRequest;
use App\Repositories\PaymentvoucherRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use App\Models\Account;
use App\Models\Banks;
use Illuminate\Support\Facades\Auth;
use Scottlaurent\Accounting\Services\Accounting as AccountingService;
use Response;

class PaymentvoucherController extends AppBaseController
{
    /** @var PaymentvoucherRepository $paymentvoucherRepository*/
    private $paymentvoucherRepository;

    public function __construct(PaymentvoucherRepository $paymentvoucherRepo)
    {
        $this->paymentvoucherRepository = $paymentvoucherRepo;
    }

    /**
     * Display a listing of the Paymentvoucher.
     *
     * @param PaymentvoucherDataTable $paymentvoucherDataTable
     *
     * @return Response
     */
    public function index(PaymentvoucherDataTable $paymentvoucherDataTable)
    {
        return $paymentvoucherDataTable->render('paymentvouchers.index');
    }

    /**
     * Show the form for creating a new Paymentvoucher.
     *
     * @return Response
     */
    public function create()
    {
        $bank=Banks::get();
        $accounts=Account::get();
        return view('paymentvouchers.create')->with('bank',$bank)->with('account',$accounts);
        // return view('paymentvouchers.create');
    }

    /**
     * Store a newly created Paymentvoucher in storage.
     *
     * @param CreatePaymentvoucherRequest $request
     *
     * @return Response
     */
    public function store(CreatePaymentvoucherRequest $request)
    {
        $input = $request->all();
        $input = $request->all();
        $bank=Banks::find($input['bank_account']);
        $account=Account::find($input['dabit_account']);

        $transaction_group = AccountingService::newDoubleEntryTransactionGroup();
        $transaction_group->addDollarTransaction($account->journal, 'debit', $input['amount'],$input['description']);
        $transaction_group->addDollarTransaction($bank->journal, 'credit', $input['amount'],$input['description']);
        $transaction_group_uuid = $transaction_group->commit();
        $input['created_by']=Auth::id();

        $paymentvoucher = $this->paymentvoucherRepository->create($input);

        Flash::success(__('messages.saved', ['model' => __('models/paymentvouchers.singular')]));

        return redirect(route('paymentvouchers.index'));
    }

    /**
     * Display the specified Paymentvoucher.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $paymentvoucher = $this->paymentvoucherRepository->find($id);

        if (empty($paymentvoucher)) {
            Flash::error(__('messages.not_found', ['model' => __('models/paymentvouchers.singular')]));

            return redirect(route('paymentvouchers.index'));
        }

        return view('paymentvouchers.show')->with('paymentvoucher', $paymentvoucher);
    }

    /**
     * Show the form for editing the specified Paymentvoucher.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $paymentvoucher = $this->paymentvoucherRepository->find($id);

        if (empty($paymentvoucher)) {
            Flash::error(__('messages.not_found', ['model' => __('models/paymentvouchers.singular')]));

            return redirect(route('paymentvouchers.index'));
        }

        return view('paymentvouchers.edit')->with('paymentvoucher', $paymentvoucher);
    }

    /**
     * Update the specified Paymentvoucher in storage.
     *
     * @param int $id
     * @param UpdatePaymentvoucherRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatePaymentvoucherRequest $request)
    {
        $paymentvoucher = $this->paymentvoucherRepository->find($id);

        if (empty($paymentvoucher)) {
            Flash::error(__('messages.not_found', ['model' => __('models/paymentvouchers.singular')]));

            return redirect(route('paymentvouchers.index'));
        }

        $paymentvoucher = $this->paymentvoucherRepository->update($request->all(), $id);

        Flash::success(__('messages.updated', ['model' => __('models/paymentvouchers.singular')]));

        return redirect(route('paymentvouchers.index'));
    }

    /**
     * Remove the specified Paymentvoucher from storage.
     *
     * @param int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $paymentvoucher = $this->paymentvoucherRepository->find($id);

        if (empty($paymentvoucher)) {
            Flash::error(__('messages.not_found', ['model' => __('models/paymentvouchers.singular')]));

            return redirect(route('paymentvouchers.index'));
        }

        $this->paymentvoucherRepository->delete($id);

        Flash::success(__('messages.deleted', ['model' => __('models/paymentvouchers.singular')]));

        return redirect(route('paymentvouchers.index'));
    }
}
