<div class="form-group">
    {!! Form::label('title', __('Title')) !!}
    {!! Form::text('title', old('title'), ['class' => 'form-control']) !!}
    @if ($errors->has('title'))
        <small class="text-danger">{{$errors->first('title')}}</small>
    @endif
</div>
<div class="form-group">
    {!! Form::label('content', __('Content')) !!}
    {!! Form::textarea('content', old('content'), ['class' => 'form-control']) !!}
</div>
{!! Form::submit(__('Save'), ['class' => 'btn btn-primary']) !!}