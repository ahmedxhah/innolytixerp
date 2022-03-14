<!-- Joborder Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('joborder_id', __('models/purchaseOrders.fields.joborder_id').':') !!}
    {!! Form::number('joborder_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Vendor Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('vendor_id', __('models/purchaseOrders.fields.vendor_id').':') !!}
    {!! Form::number('vendor_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Officedetail Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('officedetail_id', __('models/purchaseOrders.fields.officedetail_id').':') !!}
    {!! Form::number('officedetail_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Reference No Field -->
<div class="form-group col-sm-6">
    {!! Form::label('reference_no', __('models/purchaseOrders.fields.reference_no').':') !!}
    {!! Form::text('reference_no', null, ['class' => 'form-control']) !!}
</div>

<!-- Date Field -->
<div class="form-group col-sm-6">
    {!! Form::label('date', __('models/purchaseOrders.fields.date').':') !!}
    {!! Form::text('date', null, ['class' => 'form-control','id'=>'date']) !!}
</div>

@push('page_scripts')
    <script type="text/javascript">
        $('#date').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss',
            useCurrent: true,
            sideBySide: true
        })
    </script>
@endpush

<!-- Payment Terms Field -->
<div class="form-group col-sm-6">
    {!! Form::label('payment_terms', __('models/purchaseOrders.fields.payment_terms').':') !!}
    {!! Form::text('payment_terms', null, ['class' => 'form-control']) !!}
</div>

<!-- Sub Total Field -->
<div class="form-group col-sm-6">
    {!! Form::label('sub_total', __('models/purchaseOrders.fields.sub_total').':') !!}
    {!! Form::number('sub_total', null, ['class' => 'form-control']) !!}
</div>

<!-- Tax Field -->
<div class="form-group col-sm-6">
    {!! Form::label('tax', __('models/purchaseOrders.fields.tax').':') !!}
    {!! Form::number('tax', null, ['class' => 'form-control']) !!}
</div>

<!-- Grand Total Field -->
<div class="form-group col-sm-6">
    {!! Form::label('grand_total', __('models/purchaseOrders.fields.grand_total').':') !!}
    {!! Form::number('grand_total', null, ['class' => 'form-control']) !!}
</div>

<!-- Bank Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('bank_id', __('models/purchaseOrders.fields.bank_id').':') !!}
    {!! Form::number('bank_id', null, ['class' => 'form-control']) !!}
</div>