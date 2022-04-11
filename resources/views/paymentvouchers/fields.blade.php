<!-- Bank Account Field -->
<div class="form-group col-sm-6">
    {!! Form::label('bank_account', __('models/paymentvouchers.fields.bank_account').':') !!}
    <select name="bank_account" id="" class="form-control">
        @foreach ($bank as $item)
            <option value="{{$item->id}}">{{$item->account_title}}</option>
        @endforeach
    </select>
    {{-- {!! Form::text('bank_account', null, ['class' => 'form-control']) !!} --}}
</div>

<!-- Dabit Account Field -->
<div class="form-group col-sm-6">
    {!! Form::label('dabit_account', __('models/paymentvouchers.fields.dabit_account').':') !!}
    {{-- {!! Form::text('dabit_account', null, ['class' => 'form-control']) !!} --}}
    <select name="dabit_account" id="" class="form-control">
        @foreach ($account as $item)
            <option value="{{$item->id}}">{{$item->name}}</option>
        @endforeach
    </select>
</div>

<!-- Description Field -->
<div class="form-group col-sm-6">
    {!! Form::label('description', __('models/paymentvouchers.fields.description').':') !!}
    {!! Form::text('description', null, ['class' => 'form-control']) !!}
</div>

<!-- Amount Field -->
<div class="form-group col-sm-6">
    {!! Form::label('amount', __('models/paymentvouchers.fields.amount').':') !!}
    {!! Form::text('amount', null, ['class' => 'form-control']) !!}
</div>

<!-- Created By Field -->
<div class="form-group col-sm-6">
    {!! Form::label('created_by', __('models/paymentvouchers.fields.created_by').':') !!}
    {!! Form::text('created_by', null, ['class' => 'form-control']) !!}
</div>
