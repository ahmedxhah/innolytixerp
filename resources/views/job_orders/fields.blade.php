<!-- Client Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('client_id', __('models/jobOrders.fields.client_id').':') !!}
    {!! Form::number('client_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Title Field -->
<div class="form-group col-sm-6">
    {!! Form::label('title', __('models/jobOrders.fields.title').':') !!}
    {!! Form::text('title', null, ['class' => 'form-control']) !!}
</div>

<!-- Unique Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('unique_id', __('models/jobOrders.fields.unique_id').':') !!}
    {!! Form::text('unique_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Created By Field -->
<div class="form-group col-sm-6">
    {!! Form::label('created_by', __('models/jobOrders.fields.created_by').':') !!}
    {!! Form::number('created_by', null, ['class' => 'form-control']) !!}
</div>