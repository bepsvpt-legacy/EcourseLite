<table class="bordered striped centered responsive-table">
    <thead>
        <tr>
            <th>檔案名稱</th>
            <th>檔案名稱</th>
        </tr>
    </thead>
    <tbody>
        @for ($i = 0, $count = count($files); $i < $count; $i += 2)
            <tr>
                <td><a href="{{ (starts_with($files[$i]->href, 'http')) ? $files[$i]->href : \App\Ecourse\Core::ECOURSE . $files[$i]->href }}" target="_blank">{{ $files[$i]->plaintext }}</a></td>
                @if ($count > ($i + 1))
                    <td><a href="{{ (starts_with($files[$i]->href, 'http')) ? $files[$i]->href : \App\Ecourse\Core::ECOURSE . $files[$i+1]->href }}" target="_blank">{{ $files[$i+1]->plaintext }}</a></td>
                @endif
            </tr>
        @endfor
        @if (0 === $count)
            <tr>
                <td>空與白</td>
            </tr>
        @endif
    </tbody>
</table>