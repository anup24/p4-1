<form method='POST' action='/translate'>
    {{ csrf_field() }}
    <div class='form-group'>
        <label for='sourceLanguage'>Choose your starting language:</label>
        <select name='sourceLanguage' id='sourceLanguage' class='form-control'>
            @foreach ($srcLang as $lang => $arr)
                <option value='{{ $arr->short_name }}'>{{ $arr->name }}</option>
            @endforeach
        </select>
        <label for='targetLanguage'>Choose your ending language:</label>
        <select name='targetLanguage' id='targetLanguage' class='form-control'>
            @foreach ($targetLang as $lang => $arr)
                <option value='{{ $arr->short_name }}'>{{ $arr->name }}</option>
            @endforeach
        </select>
        <label>Enter your text to be translated:
            <input type='text' name='translateText' class='form-control' id='translateText'
                   value='Test post please ignore.'></label>
        <div id='submit'>
            <input type='submit' value='Translate' class='btn btn-primary btn-md'>
        </div>
    </div>
</form>