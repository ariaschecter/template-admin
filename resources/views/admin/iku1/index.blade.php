@extends('admin.admin_template')

@section('main')
    <div id="content_layout">
        @include('admin.partials.breadcrumb')
        <div class=" space-y-5">
            <div class="card">
                <header class=" card-header noborder">
                    <h4 class="card-title">{{ $title }}
                    </h4>

                    <button class="btn inline-flex justify-center btn-primary" onclick="openModal()">
                        <span class="flex items-center">
                            <iconify-icon class="text-xl ltr:mr-2 rtl:ml-2"
                                icon="heroicons-outline:plus-circle"></iconify-icon>
                            <span>Tambah</span>
                        </span>
                    </button>
                </header>
                <div class="card-body px-6 pb-6">
                    @include('admin.partials.alert')
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
                                                Name
                                            </th>
                                            <th scope="col" class=" table-th ">
                                                NIM
                                            </th>

                                            <th scope="col" class=" table-th ">
                                                Action
                                            </th>

                                        </tr>
                                    </thead>
                                    <tbody
                                        class="bg-white divide-y divide-slate-100 dark:bg-slate-800 dark:divide-slate-700">
                                        @foreach ($users as $key => $user)
                                            <tr>
                                                <td class="table-td">{{ $key + 1 }}</td>
                                                <td class="table-td">{{ $user->name }}</td>
                                                <td class="table-td">{{ $user->nim }}</td>
                                                <td class="table-td ">
                                                    <div class="flex space-x-3 rtl:space-x-reverse">
                                                        <button class="toolTip onTop justify-center action-btn"
                                                            data-tippy-content="Edit"
                                                            data-tippy-theme="info"
                                                            onclick="edit({{ $user }})">
                                                            <iconify-icon icon="heroicons:pencil-square"></iconify-icon>
                                                        </button>
                                                        <form action="{{ route('admin.user.destroy', $user->id) }}"
                                                            method="POST">
                                                            @method('DELETE')
                                                            @csrf
                                                            <button class="toolTip onTop justify-center action-btn"
                                                                type="submit" data-tippy-content="Delete"
                                                                data-tippy-theme="danger">
                                                                <iconify-icon icon="heroicons:trash"></iconify-icon>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Form Modal Area Start -->
            <div id="form_modal" tabindex="-1" aria-labelledby="form_modal" aria-hidden="true"
                class="modal fade fixed top-0 left-0 hidden w-full h-full outline-none overflow-x-hidden overflow-y-auto">
                <div class="modal-dialog modal-md relative w-auto pointer-events-none">
                    <div
                        class="modal-content border-none shadow-lg relative flex flex-col w-full pointer-events-auto bg-white bg-clip-padding rounded-md outline-none text-current">
                        <div class="relative w-full h-full max-w-xl md:h-auto">
                            <div class="relative bg-white rounded-lg shadow dark:bg-slate-700">
                                <!-- Modal header -->
                                <div
                                    class="flex items-center justify-between p-5 border-b rounded-t dark:border-slate-600 bg-black-500">
                                    <h3 class="text-xl font-medium text-white dark:text-white capitalize">
                                        Form Modal
                                    </h3>
                                    <button type="button"
                                        class="text-slate-400 bg-transparent hover:bg-slate-200 hover:text-slate-900 rounded-lg text-sm p-1.5 ml-auto inline-flex
                                    items-center dark:hover:bg-slate-600 dark:hover:text-white"
                                        data-bs-dismiss="modal">
                                        <svg aria-hidden="true" class="w-5 h-5" fill="#ffffff" viewbox="0 0 20 20"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd"
                                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10
                                                    11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                        <span class="sr-only">Close modal</span>
                                    </button>
                                </div>
                                <!-- Modal body -->
                                <div>
                                    <form action="{{ route('admin.iku-1.store') }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="p-6 space-y-6">
                                            <!-- Name -->
                                            <div class="input-group">
                                                <label for="name"
                                                    class="text-sm font-Inter font-normal text-slate-900 block">Name</label>
                                                <input type="text" id="name" name="name"
                                                    class="text-sm font-Inter font-normal text-slate-600 block w-full py-3 px-4 border border-slate-400 rounded-md focus:outline-none focus:ring-0 mt-1"
                                                    placeholder="Enter your name" required>
                                            </div>

                                            <!-- NIM -->
                                            <div class="input-group">
                                                <label for="nim"
                                                    class="text-sm font-Inter font-normal text-slate-900 block">NIM</label>
                                                <input type="text" id="nim" name="nim"
                                                    class="text-sm font-Inter font-normal text-slate-600 block w-full py-3 px-4 border border-slate-400 rounded-md focus:outline-none focus:ring-0 mt-1"
                                                    placeholder="Enter your NIM" required>
                                            </div>

                                            <!-- Select -->
                                            <div class="input-group">
                                                <label for="option"
                                                    class="text-sm font-Inter font-normal text-slate-900 block">Jenis Kegiatan</label>
                                                <select id="option" name="option"
                                                    class="text-sm font-Inter font-normal text-slate-600 block w-full py-3 px-4 border border-slate-400 rounded-md focus:outline-none focus:ring-0 mt-1" required>
                                                    <option value="" selected disabled>Select an option</option>
                                                    <option value="option1">Option 1</option>
                                                    <option value="option2">Option 2</option>
                                                    <option value="option3">Option 3</option>
                                                </select>
                                            </div>

                                            <!-- Description -->
                                            <div class="input-group">
                                                <label for="description"
                                                    class="text-sm font-Inter font-normal text-slate-900 block">Description</label>
                                                <textarea id="description" name="description"
                                                    class="text-sm font-Inter font-normal text-slate-600 block w-full py-3 px-4 border border-slate-400 rounded-md focus:outline-none focus:ring-0 mt-1"
                                                    rows="4" placeholder="Enter description" required></textarea>
                                            </div>

                                            <!-- File -->
                                            <div class="input-group">
                                                <label for="file"
                                                    class="text-sm font-Inter font-normal text-slate-900 block">Upload
                                                    File</label>
                                                <input type="file" id="file" name="file"
                                                    class="text-sm font-Inter font-normal text-slate-600 block w-full py-3 px-4 border border-slate-400 rounded-md focus:outline-none focus:ring-0 mt-1" required>
                                            </div>
                                        </div>
                                        <!-- Modal footer -->
                                        <div
                                            class="flex items-center justify-end p-6 space-x-2 border-t border-slate-200 rounded-b dark:border-slate-600">
                                            <button data-bs-dismiss="modal" type="button"
                                                class="btn inline-flex justify-center btn-outline-dark">Close</button>
                                            <button type="submit"
                                                class="btn inline-flex justify-center text-white bg-black-500">Log
                                                In</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Form Modal Area End -->
        </div>

    </div>
@endsection

@push('js')
    <script>
        $(document).ready(function() {

        });

        function openModal() {
            $('#form_modal').modal('show');
        }

        function edit(data) {
            console.log(data?.id);
        }
    </script>
@endpush
