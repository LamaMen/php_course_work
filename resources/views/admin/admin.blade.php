<x-admin.layout>
    <canvas class="my-4 w-100" id="myChart" width="900" height="380"></canvas>

    <h2>Группы</h2>

    <div class="table-responsive">
        <table class="table table-bordered">
            <tr>
                <th>Инструктор</th>
                <th>Дата</th>
                <th>Время</th>
                <th>Свободных мест</th>
            </tr>

            @foreach($groups as $group)
                <tr>
                    <td>{{ $group->instructor->fullName()}}</td>
                    <td>{{ $group->group->date() }}</td>
                    <td>{{ $group->group->time() }}</td>
                    <td>{{ $group->group->capacity()}}</td>
                </tr>
            @endforeach
        </table>
    </div>

    <x-slot name="scripts">
        <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js"
                integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha"
                crossorigin="anonymous"></script>

        <script>
            const length = {{ count($values) }};
            const labels = [@foreach($names as $name)'{{ $name }}',@endforeach];
            const data = [@foreach($values as $value) {{ $value }},@endforeach];
        </script>

        <script src="/js/admin/chart.js"></script>
    </x-slot>
</x-admin.layout>
