<!-- Sub Total Field -->
<div class="form-group col-sm-6">
    {!! Form::label('sub_total', __('models/quotations.fields.sub_total').':') !!}
    {!! Form::number('sub_total', null, ['class' => 'form-control']) !!}
</div>

<!-- Discount Field -->
<div class="form-group col-sm-6">
    {!! Form::label('discount', __('models/quotations.fields.discount').':') !!}
    {!! Form::number('discount', null, ['class' => 'form-control']) !!}
</div>

<!-- Tax Field -->
<div class="form-group col-sm-6">
    {!! Form::label('tax', __('models/quotations.fields.tax').':') !!}
    {!! Form::number('tax', null, ['class' => 'form-control']) !!}
</div>

<!-- Grand Total Field -->
<div class="form-group col-sm-6">
    {!! Form::label('grand_total', __('models/quotations.fields.grand_total').':') !!}
    {!! Form::text('grand_total', null, ['class' => 'form-control']) !!}
</div>
