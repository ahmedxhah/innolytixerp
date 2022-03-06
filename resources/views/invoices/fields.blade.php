<!-- Date Field -->
<div class="form-group col-sm-6">
    {!! Form::label('date', __('models/invoices.fields.date').':') !!}
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

<!-- Subject Field -->
<div class="form-group col-sm-6">
    {!! Form::label('subject', __('models/invoices.fields.subject').':') !!}
    {!! Form::text('subject', null, ['class' => 'form-control']) !!}
</div>

<!-- Client Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('client_id', __('models/invoices.fields.client_id').':') !!}
    {!! Form::number('client_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Officedetails Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('officedetails_id', __('models/invoices.fields.officedetails_id').':') !!}
    {!! Form::number('officedetails_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Sub Total Field -->
<div class="form-group col-sm-6">
    {!! Form::label('sub_total', __('models/invoices.fields.sub_total').':') !!}
    {!! Form::number('sub_total', null, ['class' => 'form-control']) !!}
</div>

<!-- Discount Field -->
<div class="form-group col-sm-6">
    {!! Form::label('discount', __('models/invoices.fields.discount').':') !!}
    {!! Form::number('discount', null, ['class' => 'form-control']) !!}
</div>

<!-- Tax Field -->
<div class="form-group col-sm-6">
    {!! Form::label('tax', __('models/invoices.fields.tax').':') !!}
    {!! Form::number('tax', null, ['class' => 'form-control']) !!}
</div>

<!-- Grand Total Field -->
<div class="form-group col-sm-6">
    {!! Form::label('grand_total', __('models/invoices.fields.grand_total').':') !!}
    {!! Form::number('grand_total', null, ['class' => 'form-control']) !!}
</div>

<!-- Bank Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('bank_id', __('models/invoices.fields.bank_id').':') !!}
    {!! Form::number('bank_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Created By Field -->
<div class="form-group col-sm-6">
    {!! Form::label('created_by', __('models/invoices.fields.created_by').':') !!}
    {!! Form::number('created_by', null, ['class' => 'form-control']) !!}
</div>
