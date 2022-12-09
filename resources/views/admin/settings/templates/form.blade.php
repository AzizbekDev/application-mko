@forelse($inputs as $key => $input)
    <div class="form-group">
        <label for="{{ 'field'.$key }}">{{ $input['label'] }}</label>
        <input type="text" name="{{ $input['name'] }}" class="form-control" id="{{ 'field'.$key }}" value="{{ $input['value'] ?? null }}">
    </div>
@empty
    <p class="text-center">Setting values are empty..</p>
@endforelse