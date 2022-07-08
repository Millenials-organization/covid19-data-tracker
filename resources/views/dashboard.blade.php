<x-app-layout>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
    <link href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap4.min.css">
    <x-slot name="header">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <h2 class="text-xl font-semibold leading-tight">
                {{ __('COVID-19 Cases Report') }}
            </h2>
            <x-button target="_blank" href="https://github.com/kamona-wd/kui-laravel-breeze" variant="black"
                class="justify-center max-w-xs gap-2">
                <x-icons.github class="w-6 h-6" aria-hidden="true" />
                <span>Github</span>
            </x-button>
        </div>
    </x-slot>

        <div class="p-6 overflow-hidden bg-white rounded-md shadow-md dark:bg-dark-eval-1">
            <div class="modal fade" id="dataModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Semester Information</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form method="POST" action="{{route('dashboard.store')}}">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group">
                                <label class="form-label">Case Number</label>
                                <input type="number" class="form-control" name="caseNumber" id="caseNumber" aria-describedby="post">
                                <div id="post" class="form-text">Please insert the number of the case.</div>
                            </div>

                            <div class="form-group">
                                <label class="form-label">State</label>
                                <input type="text" class="form-control" name="state" id="state" aria-describedby="post2">
                                <div id="post2" class="form-text">Please insert the state name.</div>
                            </div>

                        </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Submit</button>
                    </div>
                </form>
                </div>
                </div>
            </div>
            <div>
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#dataModal">
                    Insert Information
                </button>
            </div>
        </div>

        <br>
        <div class="p-6 overflow-hidden bg-white rounded-md shadow-md dark:bg-dark-eval-1">
        <table class="table">
            <thead class="thead-dark">
            <tr>
                <th scope="col">State</th>
                <th scope="col">Case Number</th>
                <th scope="col">Update</th>
            </tr>
            </thead>
            @foreach ($dataDB as $data)
            <tbody>
                <tr>
                <td>{{ $data['caseNumber'] }}</td>
                <td>{{ $data['state'] }}</td>
                <td colspan="2">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editModal">
                        Edit
                    </button>
                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal">
                        Delete
                    </button>
                </td>
                </tr>
            </tbody>
            @endforeach
        </table>
        </div>

        <br>
        <div class="p-6 overflow-hidden bg-white rounded-md shadow-md dark:bg-dark-eval-1">
            <div>
                <div id="curve_chart" style="width: 100%; height: 1000px"></div>
                <script type="text/javascript">
                    google.charts.load('current', {'packages':['corechart']});
                    google.charts.setOnLoadCallback(drawChart);
            
                    function drawChart() {
                    var data = google.visualization.arrayToDataTable([
                        ['STATE', 'CASE NUMBER'],
                        @php
                        foreach($dataDB as $performance) {
                        echo "['".$performance->state."', ".$performance->caseNumber."],";
                        }
                        @endphp
                        ]);
            
                    var options = {
                        title: 'Covid-19 Case Number in Malaysia 2022',
                        curveType: 'function',
                        legend: { position: 'bottom' }
                    };
            
                    var chart = new google.visualization.ColumnChart(document.getElementById('curve_chart'));
            
                    chart.draw(data, options);
                    }
                </script>
            </div>
        </div>
       
</x-app-layout>
