
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
    {{-- {!! Form::number('tax', null, ['class' => 'form-control']) !!} --}}
    <select name="tax" id="" class="form-control">
        <option value=""></option>
        @foreach ($taxs as $titem)
            <option value="{{$titem->percent}}">{{$titem->title}}</option>
        @endforeach
    </select>
</div>

<!-- Grand Total Field -->
<div class="form-group col-sm-6">
    {!! Form::label('grand_total', __('models/invoices.fields.grand_total').':') !!}
    {!! Form::number('grand_total', null, ['class' => 'form-control']) !!}
</div>

