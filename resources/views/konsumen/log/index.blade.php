@extends('admin.admin_template')

@section('main')
    <div id="content_layout">
        @include('admin.partials.breadcrumb')
        <div class=" space-y-5">
            <div class="card">
                <header class=" card-header noborder">
                    <h4 class="card-title">{{ $title }}
                    </h4>
                </header>
                @include('admin.partials.alert')
                <div class="card-body px-6 pb-6">
                    <div class="overflow-x-auto -mx-6 dashcode-data-table">
                        <span class=" col-span-8  hidden"></span>
                        <span class="  col-span-4 hidden"></span>
                        <div class="inline-block min-w-full align-middle">
                            <div class="overflow-hidden ">
                                <table
                                    class="min-w-full divide-y divide-slate-100 table-fixed dark:divide-slate-700 data-table">
                                    <thead class=" bg-slate-200 dark:bg-slate-700">
                                        <tr>
                                            <th scope="col" class=" table-th ">
                                                Id
                                            </th>
                                            <th scope="col" class=" table-th ">
                                                Log Name
                                            </th>
                                            <th scope="col" class=" table-th ">
                                                Description
                                            </th>
                                            <th scope="col" class=" table-th ">
                                                Subject Type
                                            </th>
                                            <th scope="col" class=" table-th ">
                                                Event
                                            </th>
                                            <th scope="col" class=" table-th ">
                                                Subject Id
                                            </th>
                                            <th scope="col" class=" table-th ">
                                                Causer Type
                                            </th>
                                            <th scope="col" class=" table-th ">
                                                Causer Id
                                            </th>
                                            <th scope="col" class=" table-th ">
                                                Properties
                                            </th>
                                            <th scope="col" class=" table-th ">
                                                Time
                                            </th>

                                        </tr>
                                    </thead>
                                    <tbody
                                        class="bg-white divide-y divide-slate-100 dark:bg-slate-800 dark:divide-slate-700">
                                        @foreach ($logs as $key => $log)
                                            <tr>
                                                <td class="table-td">{{ $key + 1 }}</td>
                                                <td class="table-td">{{ $log->log_name }}</td>
                                                <td class="table-td">{{ $log->description }}</td>
                                                <td class="table-td">{{ $log->subject_type }}</td>
                                                <td class="table-td">{{ $log->event }}</td>
                                                <td class="table-td">{{ $log->subject_id }}</td>
                                                <td class="table-td">{{ $log->causer_type }}</td>
                                                <td class="table-td">{{ $log->causer_id }}</td>
                                                <td class="table-td">{{ $log->properties }}</td>
                                                <td class="table-td">{{ \Carbon\Carbon::parse($log->created_at)->diffForHumans() }}</td>
                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
