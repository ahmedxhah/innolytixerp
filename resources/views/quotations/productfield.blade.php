{{-- <!-- Name Field -->
<div class="form-group col-sm-2">
    {!! Form::label('name:') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<!-- Description Field -->
<div class="form-group col-sm-3">
    {!! Form::label('description', __('models/quotationProducts.fields.description').':') !!}
    {!! Form::text('description', null, ['class' => 'form-control']) !!}
</div>

<!-- Model No Field -->
<div class="form-group col-sm-2">
    {!! Form::label('model_no', __('models/quotationProducts.fields.model_no').':') !!}
    {!! Form::text('model_no', null, ['class' => 'form-control']) !!}
</div>

<!-- Brand Field -->
<div class="form-group col-sm-2">
    {!! Form::label('brand', __('models/quotationProducts.fields.brand').':') !!}
    {!! Form::text('brand', null, ['class' => 'form-control']) !!}
</div>

<!-- Unitprice Field -->
<div class="form-group col-sm-1">
    {!! Form::label('unitprice', __('models/quotationProducts.fields.unitprice').':') !!}
    {!! Form::number('unitprice', null, ['class' => 'form-control']) !!}
</div>

<!-- Qty Field -->
<div class="form-group col-sm-1">
    {!! Form::label('qty', __('models/quotationProducts.fields.qty').':') !!}
    {!! Form::number('qty', null, ['class' => 'form-control']) !!}
</div>

<!-- Vendor Id Field -->
<div class="form-group col-sm-1">
    {!! Form::label('vendor_id', __('models/quotationProducts.fields.vendor_id').':') !!}
    {!! Form::text('vendor_id', null, ['class' => 'form-control']) !!}
</div> --}}


<table class="table table-bordered" id="dynamicTable">
    <tr>
        <th style="width:21%">Name</th>
        <th style="width:21%">Description</th>
        <th style="width:12%">Model</th>
        <th style="width:12%">Brand</th>
        <th style="width:8%">UnitRate</th>
        <th style="width:8%">Qty</th>
        <th style="width:10%">Vendor</th>
        <th style="width:8%">Action</th>
    </tr>
    <tr>
        <td><input type="text" name="product[0][name]" placeholder="Enter your Name" class="form-control" /></td>
        <td><input type="text" name="product[0][description]" placeholder="Enter your Qty" class="form-control" /></td>
        <td><input type="text" name="product[0][model_no]" placeholder="Enter your Price" class="form-control" /></td>
        <td><input type="text" name="product[0][brand]" placeholder="Enter your Price" class="form-control" /></td>
        <td><input type="number" name="product[0][unitprice]" placeholder="Enter your Price" class="form-control" /></td>
        <td><input type="number" name="product[0][qty]" placeholder="Enter your Price" class="form-control" /></td>
        <td><input type="number" name="product[0][vendor_id]" placeholder="Enter your Price" class="form-control" /></td>
        <td><button type="button" name="add" id="add" class="btn btn-success">+Add</button></td>
    </tr>
</table>

@push('page_scripts')
    <script type="text/javascript">
         var i = 0;
    $("#add").click(function(){
        ++i;
        $("#dynamicTable").append('<tr><td><input type="text" name="product['+i+'][name]" placeholder="Enter your Name" class="form-control" /></td><td><input type="text" name="product['+i+'][description]" placeholder="Enter your Name" class="form-control" /></td><td><input type="text" name="product['+i+'][model_no]" placeholder="Enter your Name" class="form-control" /></td><td><input type="text" name="product['+i+'][brand]" placeholder="Enter your Name" class="form-control" /></td><td><input type="number" name="product['+i+'][unitprice]" placeholder="Enter your Name" class="form-control" /></td><td><input type="number" name="product['+i+'][qty]" placeholder="Enter your Name" class="form-control" /></td><td><input type="number" name="product['+i+'][vendor_id]" placeholder="Enter your Name" class="form-control" /></td><td><button type="button" class="btn btn-danger remove-tr">X</button></td></tr>');
    });

    $(document).on('click', '.remove-tr', function(){
         $(this).parents('tr').remove();
    });
    </script>
@endpush
