<form method='POST' action='/translate'>
    {{ csrf_field() }}
    <div class='form-group'>
        <label for='sourceLanguage'>Choose your starting language:</label>
        <select name='sourceLanguage' id='sourceLanguage' class='form-control'>
            @foreach ($srcLang as $lang => $arr)
                <option value='{{ $arr->short_name }}'{{ ($arr->short_name == old('sourceLanguage')) ? ' selected' : '' }}>{{ $arr->name }}</option>
            @endforeach
        </select>
        <label for='targetLanguage'>Choose your ending language:</label>
        <select name='targetLanguage' id='targetLanguage' class='form-control'>
            @foreach ($targetLang as $lang => $arr)
                <option value='{{ $arr->short_name }}'{{ ($arr->short_name == old('targetLanguage')) ? ' selected' : '' }}>{{ $arr->name }}</option>
            @endforeach
        </select>
        <label>Enter your text to be translated (required, 150 characters maximum):
            <input type='text' name='translateText' class='form-control' id='translateText'
                   value='{{ old('translateText') }}' placeholder='Enter your text here...'></label>
        @if($errors->get('translateText'))
            <ul class='alert alert-danger'>
                @foreach($errors->get('translateText') as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif
        <div id='submit'>
            <input type='submit' value='Translate' class='btn btn-primary btn-md'>
        </div>
    </div>
</form>