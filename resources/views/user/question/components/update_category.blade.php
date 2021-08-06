<div class="form-group">
  <div class="form-group form-inline">
    @foreach ($tagCategories as $id => $name)
    {!! Form::label('tag_category_' . $id, $name, ['class' => 'checkbox-inline']) !!}
    @if ($myQuestion->tagCategories->contains($id))
    {!! Form::checkbox('tag_category_id[]', $id, true, ['id' => 'tag_category_' . $id]) !!}
    @else
    {!! Form::checkbox('tag_category_id[]', $id, false, ['id' => 'tag_category_' . $id]) !!}
    @endif
    </label>
    @endforeach
  </div>
  <div class="has-error">
    @if ($errors->has('tag_category_id'))
    @foreach ($errors->get('tag_category_id') as $error)
    <span class="help-block">{{ $error }}</span>
    @endforeach
    @endif
  </div>
</div>