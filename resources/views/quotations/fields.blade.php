<!-- Client Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('client_id', __('models/quotations.fields.client_id').':') !!}
    {!! Form::number('client_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Officedetails Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('officedetails_id', __('models/quotations.fields.officedetails_id').':') !!}
    {!! Form::number('officedetails_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Date Field -->
<div class="form-group col-sm-6">
    {!! Form::label('date', __('models/quotations.fields.date').':') !!}
    {!! Form::date('date', null, ['class' => 'form-control','id'=>'date']) !!}
</div>

<!-- Subject Field -->
<div class="form-group col-sm-6">
    {!! Form::label('subject', __('models/quotations.fields.subject').':') !!}
    {!! Form::text('subject', null, ['class' => 'form-control']) !!}
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
