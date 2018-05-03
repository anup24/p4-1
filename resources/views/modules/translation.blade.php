<div class='entry'>
    <table class='table-bordered'>
        <tr>
            <th>Input: {{ $entry->sourcelanguage->name }}</th>
            <th>Output: {{ $entry->targetlanguage->name }}</th>
        </tr>
        <tr>
            <td class='tableEntry'>
                {{ $entry['input'] }}
            </td>
            <td>
                {{ $entry['output'] }}
            </td>
        </tr>
    </table>
    @if ($entry['tags'])
        <div class='table-badges'>
            <ul>
                @foreach ($entry['tags'] as $tag)
                    <li><img src='{{$tag['image']}}' class='badge-image'> {{ $tag['name'] }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    @if ($enableButtons)
        <div class='entry-buttons'>
            <ul>
                <li><a href='/translations/{{ $entry['id'] }}/edit'>Edit</a></li>
                <li><a href='/translations/{{ $entry['id'] }}/delete'>Delete</a></li>
            </ul>
        </div>
    @endif
</div>