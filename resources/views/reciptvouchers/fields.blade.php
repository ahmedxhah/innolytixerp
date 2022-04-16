<!-- Bank Account Field -->
<div class="form-group col-sm-6">
    {!! Form::label('bank_account', __('models/reciptvouchers.fields.bank_account').':') !!}
    <select name="bank_account" id="" class="form-control">
        @foreach ($bank as $item)
            <option value="{{$item->id}}">{{$item->name}}</option>
        @endforeach
    </select>
    {{-- {!! Form::text('bank_account', null, ['class' => 'form-control']) !!} --}}
</div>

<!-- Credit Account Field -->
<div class="form-group col-sm-6">
    {!! Form::label('credit_account', __('models/reciptvouchers.fields.credit_account').':') !!}
    <select name="credit_account" id="" class="form-control">
        @foreach ($account as $item)
            <option value="{{$item->id}}">{{$item->name}}</option>
        @endforeach
    </select>
    {{-- {!! Form::text('credit_account', null, ['class' => 'form-control']) !!} --}}
</div>

<!-- Description Field -->
<div class="form-group col-sm-6">
    {!! Form::label('description', __('models/reciptvouchers.fields.description').':') !!}
    {!! Form::text('description', null, ['class' => 'form-control']) !!}
</div>

<!-- Amount Field -->
<div class="form-group col-sm-6">
    {!! Form::label('amount', __('models/reciptvouchers.fields.amount').':') !!}
    {!! Form::text('amount', null, ['class' => 'form-control']) !!}
</div>

<!-- Created By Field -->
<div class="form-group col-sm-6">
    {!! Form::label('created_by', __('Checque No').':') !!}
    {!! Form::text('created_by', null, ['class' => 'form-control']) !!}
</div>
