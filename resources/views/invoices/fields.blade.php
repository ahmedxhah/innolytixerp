<!-- Client Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('client_id', __('models/invoices.fields.client_id').':') !!}
    {{-- {!! Form::number('client_id', null, ['class' => 'form-control']) !!} --}}
    <select name="client_id" id="" class="form-control">
        <option value=""></option>
        @foreach ($clients as $item)
            <option value="{{$item->id}}">{{$item->name}}</option>
        @endforeach
    </select>
</div>

<!-- Officedetails Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('officedetails_id', __('models/invoices.fields.officedetails_id').':') !!}
    {{-- {!! Form::number('officedetails_id', null, ['class' => 'form-control']) !!} --}}
    <select name="officedetails_id" id="" class="form-control">
        @foreach ($officedetails as $oitem)
            <option value="{{$oitem->id}}">{{$oitem->name}}</option>
        @endforeach
    </select>
</div>

<!-- Date Field -->
<div class="form-group col-sm-6">
    {!! Form::label('date', __('models/invoices.fields.date').':') !!}
    {!! Form::date('date', null, ['class' => 'form-control','id'=>'date']) !!}
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

<!-- Bank Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('bank_id', __('models/invoices.fields.bank_id').':') !!}
    {{-- {!! Form::number('bank_id', null, ['class' => 'form-control']) !!} --}}
    <select name="bank_id" id="" class="form-control">
        <option value=""></option>
        @foreach ($banks as $item)
            <option value="{{$item->id}}">{{$item->bank_name." | ".$item->account_title." | ".$item->account_no}}</option>
        @endforeach
    </select>
</div>

<!-- Subject Field -->
<div class="form-group col-sm-12">
    {!! Form::label('subject', __('models/invoices.fields.subject').':') !!}
    {!! Form::text('subject', null, ['class' => 'form-control']) !!}
</div>

