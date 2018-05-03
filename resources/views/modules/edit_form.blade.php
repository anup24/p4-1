<form method='POST' action='/translations/{{ $entry['id'] }}'>
    {{ method_field('PUT') }}
    {{ csrf_field() }}
    <div class='form-group'>
        <label for='sourceLanguage'>Choose your starting language:</label>
        <select name='sourceLanguage' id='sourceLanguage' class='form-control'>
            @foreach ($srcLang as $lang => $arr)
                <option
                    value='{{ $arr->short_name }}' {{($arr->short_name == $entry->sourcelanguage->short_name) ? 'selected' : ''}}>{{ $arr->name }}</option>
            @endforeach
        </select>
        <label for='targetLanguage'>Choose your ending language:</label>
        <select name='targetLanguage' id='targetLanguage' class='form-control'>
            @foreach ($targetLang as $lang => $arr)
                <option
                    value='{{ $arr->short_name }}' {{($arr->short_name == $entry->targetlanguage->short_name) ? 'selected' : ''}}>{{ $arr->name }}</option>
            @endforeach
        </select>
        <label>Enter your text to be translated (required):
            <input type='text' name='translateText' class='form-control' id='translateText'
                   value='{{$entry->input}}'>
        </label>
        <label>Enter any attributes for this translation:</label>
        @foreach ($tags as $tag)
            <label>
                <input
                    type='checkbox'
                    name='tags[]'
                    value='{{$tag['id']}}'
                    {{ in_array($tag['id'],$tagArray) ? 'checked' : '' }}
                >   {{$tag['name']}}
            </label>

        @endforeach
        <div id='submit'>
            <input type='submit' value='Confirm Edit' class='btn btn-primary btn-md'>
            <p id='cancel'>
                Nevermind, <a href='/translations'>take me back home</a>.
            </p>
        </div>

    </div>
    <!-- Errors -->
    @if(count($errors) > 0)
        <ul class='alert alert-danger'>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif
</form>