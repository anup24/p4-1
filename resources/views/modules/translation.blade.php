<div class='entry'>
    <table class='table-bordered'>
        <tr>
            <th>Input: {{ $entry->sourcelanguage->name }}</th>
            <th>Output: {{ $entry->targetlanguage->name }}</th>
            @if ($enableButtons)
                <th class='tableButton'><a href='/translations/{{$entry['id']}}'>Edit</a></th>
            @endif
        </tr>
        <tr>
            <td class='tableEntry'>
                {{ $entry['input'] }}
            </td>
            <td>
                {{ $entry['output'] }}
            </td>
            @if($enableButtons)
                <td class='tableButton'>
                    <a href='/translations/{{$entry['id']}}/delete'>Delete</a>
                </td>
            @endif
        </tr>
    </table>
</div>