<div>
    <h1>Data Table</h1>

    @if (!empty($results))
        <table class="table-auto border-collapse border border-gray-300 w-full">
            <thead>
            <tr>
                @foreach (array_keys($results[0]) as $column)
                    <th class="border px-4 py-2">{{ $column }}</th>
                @endforeach
            </tr>
            </thead>
            <tbody>
            @foreach ($results as $row)
                <tr>
                    @foreach ($row as $value)
                        <td class="border px-4 py-2">{{ $value }}</td>
                    @endforeach
                </tr>
            @endforeach
            </tbody>
        </table>
    @else
        <p>Brak danych do wyświetlenia.</p>
    @endif
</div>
