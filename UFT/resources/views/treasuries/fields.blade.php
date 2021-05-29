<!-- Amount Field -->
<div class="form-group col-sm-6">
    {!! Form::label('amount', 'Amount:') !!}
    {!! Form::number('amount', null, ['class' => 'form-control']) !!}
</div>

<!-- Well Wisher Field -->
<div class="form-group col-sm-6">
    {!! Form::label('well_wisher', 'Well Wisher:') !!}
    {!! Form::text('well_wisher', null, ['class' => 'form-control']) !!}
</div>

<!-- Received On Field -->
<div class="form-group col-sm-6">
    {!! Form::label('received_on', 'Received On:') !!}
    {!! Form::date('received_on', null, ['class' => 'form-control','id'=>'received_on']) !!}
</div>

@section('scripts')
    <script type="text/javascript">
        $('#received_on').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss',
            useCurrent: false
        })
    </script>
@endsection

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('treasuries.index') !!}" class="btn btn-default">Cancel</a>
</div>
