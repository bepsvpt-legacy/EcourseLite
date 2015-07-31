<table class="bordered striped centered responsive-table">
    <thead>
        <tr>
            <th>項目</th>
            <th>比例</th>
            <th>分數</th>
            <th>排名</th>
        </tr>
    </thead>
    <tbody>
        @for ($i = 0, $count = (count($grades) - 2); $i < $count; ++$i)
            <tr>
                @if (0 === count($grades[$i]->children(0)->children))
                    <td>{{ $grades[$i]->children(0)->plaintext }}</td>
                    <td>{{ $grades[$i]->children(1)->plaintext }}</td>
                    <td>{{ $grades[$i]->children(2)->plaintext }}</td>
                    <td>{{ $grades[$i]->children(3)->plaintext }}</td>
                @endif
            </tr>
        @endfor
        <tr>
            <td colspan="2">總成績</td>
            <td>{{ $grades[$count+1]->children(1)->plaintext }}</td>
            <td>{{ $grades[$count]->children(1)->plaintext }}</td>
        </tr>
    </tbody>
</table>