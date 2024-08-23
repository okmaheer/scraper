@extends('layouts.app')

@section('content')
    <!--begin::Toolbar-->
    <div class="toolbar mb-5 mb-lg-7" id="kt_toolbar">
        <!--begin::Page title-->
        <div class="page-title d-flex flex-column me-3">
            <!--begin::Title-->
            <h1 class="d-flex text-dark fw-bolder my-1 fs-3">Index chapters List</h1>
            <!--end::Title-->
            <!--begin::Breadcrumb-->
            <ul class="breadcrumb breadcrumb-dot fw-bold text-gray-600 fs-7 my-1">
                <!--begin::Item-->
                <li class="breadcrumb-item text-gray-600">
                    <a href="javascript:void(0)" class="text-gray-600 text-hover-primary">Index chapters</a>
                </li>
                <!--end::Item-->
                <!--begin::Item-->
                <li class="breadcrumb-item text-gray-500">Index chapters List</li>
                <!--end::Item-->
            </ul>
            <!--end::Breadcrumb-->
        </div>
        <!--end::Page title-->
        <!--begin::Actions-->
      
        <!--end::Actions-->
    </div>
    <!--end::Toolbar-->
    <div class="d-flex flex-wrap flex-stack pb-7">
        <!--begin::Title-->
        <div class="d-flex flex-wrap align-items-center my-1">
            <h3 class="fw-bolder me-5 my-1" id="carCount">{{ count($chapters) }} Index Chapters(s) Found
        </div>
        <!--end::Title-->
    </div>
    <div class="card mb-6 mb-xl-9">
        <div class="card-body p-9">
            <!--begin::Table container-->
            <div class="table-responsive">
                <!--begin::Table-->
                <table id="test_table" class="table table-row-dashed table-row-gray-100 align-middle gs-0 gy-3">
                    <!--begin::Table head-->
                    <thead>
                        <tr class="fw-bolder text-muted">
                            <th>Chapter Number</th>
                            <th>Manhwa Name</th>

                        </tr>
                    </thead>
                    <!--end::Table head-->
                    <!--begin::Table body-->
                    <tbody>
                        @isset($chapters)
                            @foreach ($chapters as $chapter)
                                <tr>

                                    <td>
                                        {{ $chapter?->chapter?->chapter_number ?? '-' }}
 
                                    </td>
                                    <td>
                                        {{ $chapter?->chapter?->manhwa->name ?? '-' }}
                                    </td>
                                  
                                  
                                 
                                  
                                </tr>
                            @endforeach
                        @endisset
                    </tbody>
                    <!--end::Table body-->
                </table>
                <!--end::Table-->
            </div>
            <!--end::Table container-->
        </div>
    </div>

    <!--begin::Modal - New Target-->

    <!--end::Modal - New Target-->
@endsection
@section('script')
    <script>
        function deleteTest(id) {
            // Display a confirmation dialog
            var isConfirmed = window.confirm('Are you sure you want to delete this Chapter?');

            // Check if the user clicked 'OK'
            if (isConfirmed) {
                // Assuming you are using Laravel's route() function to generate URLs
                var deleteUrl = "{{ route('admin.chapter.delete', ['id' => ':id']) }}";

                // Replace ':id' with the actual ID
                deleteUrl = deleteUrl.replace(':id', id);

                // Redirect to the delete route
                window.location.href = deleteUrl;
            }
        }

        $('#test_table').DataTable({

            // "responsivePriority": 1,
            // "dom": "<'table-responsive'tr>",
            searching: true,
            "order": [
                [2, "asc"]
            ],
            info: !1,
            columns: [{
                    "orderable": true,

                }, {
                    "orderable": true,

                }, {
                    "orderable": true,

                },
                {
                    "orderable": true,

                },
                {
                    "orderable": false,

                }
            ]
        });
    </script>
@endsection
