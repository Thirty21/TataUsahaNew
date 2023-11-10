@extends('layout.main')

{{-- @push('script')
    <script>
        $(document).on('click', '.btn-edit', function () {
            const id = $(this).data('id');
            $('#editModal form').attr('action', '{{ route('absen.index') }}/' + id);
            $('#editModal input:hidden#id').val(id);
            $('#editModal input#nama').val($(this).data('nama'));
            $('#editModal input#tanggal_lahir').val($(this).data('tanggal_lahir'));
            $('#editModal input#gender').val($(this).data('gender'));
            $('#editModal input#alamat').val($(this).data('alamat'));
            $('#editModal input#absen').val($(this).data('absen'));
            // if ($(this).data('active') == 1) {
            //     $('#editModal input#is_active').attr('checked', 1)
            // } else {
            //     $('#editModal input#is_active').removeAttribute('checked');
            // }
        });
    </script>
@endpush

@section('content')
    <x-breadcrumb
        :values="[__('menu.absens')]">
        <button
            type="button"
            class="btn btn-primary btn-create"
            data-bs-toggle="modal"
            data-bs-target="#createModal">
            {{ __('menu.general.create') }}
        </button>
    </x-breadcrumb>

    <div class="card mb-5">
        <div class="table-responsive text-nowrap">
            <table class="table">
                <thead>
                <tr>
                    <th>{{ __('model.absen.nama') }}</th>
                    <th>{{ __('model.absen.tanggal_lahir') }}</th>
                    <th>{{ __('model.absen.gender') }}</th>
                    <th>{{ __('model.absen.alamat') }}</th>
                    <th>{{ __('model.absen.absen') }}</th>
                    <th>{{ __('menu.general.action') }}</th>
                </tr>
                </thead>
                @if($data)
                    <tbody>
                    @foreach($data as $absen)
                        <tr>
                            <td>{{ $absen->nama }}</td>
                            <td>{{ $absen->tanggal_lahir }}</td>
                            <td>{{ $absen->gender }}</td>
                            <td>{{ $absen->alamat }}</td>
                            <td>{{ $absen->absen }}</td>
                            <td>
                                <button class="btn btn-info btn-sm btn-edit"
                                        data-id="{{ $absen->id }}"
                                        data-nama="{{ $absen->nama }}"
                                        data-tanggal_lahir="{{ $absen->tanggal_lahir }}"
                                        data-gender="{{ $absen->gender }}"
                                        data-alamat="{{ $absen->alamat }}"
                                        data-absen="{{ $absen->absen }}"
                                        data-bs-toggle="modal"
                                        data-bs-target="#editModal">
                                    {{ __('menu.general.edit') }}
                                </button>
                                <form action="{{ route('absen.destroy', $absen) }}" class="d-inline" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm btn-delete"
                                            type="button">{{ __('menu.general.delete') }}</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                @else
                    <tbody>
                    <tr>
                        <td colspan="4" class="text-center">
                            {{ __('menu.general.empty') }}
                        </td>
                    </tr>
                    </tbody>
                @endif
                <tfoot class="table-border-bottom-0">
                <tr>
                    <th>{{ __('model.absen.nama') }}</th>
                    <th>{{ __('model.absen.tanggal_lahir') }}</th>
                    <th>{{ __('model.absen.gender') }}</th>
                    <th>{{ __('model.absen.alamat') }}</th>
                    <th>{{ __('model.absen.absen') }}</th>
                    <th>{{ __('menu.general.action') }}</th>
                </tr>
                </tfoot>
            </table>
        </div>
    </div>

    {!! $data->appends(['search' => $search])->links() !!}

    <!-- Create Modal -->
    <div class="modal fade" id="createModal" data-bs-backdrop="static" tabindex="-1">
        <div class="modal-dialog">
            <form class="modal-content" method="post" action="{{ route('absen.store') }}">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="createModalTitle">{{ __('menu.general.create') }}</h5>
                    <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"
                        aria-label="Close"
                    ></button>
                </div>
                <div class="modal-body">
                    <x-input-form name="nama" :label="__('model.absen.nama')"/>
                    <x-input-form name="tanggal_lahir" :label="__('model.absen.tanggal_lahir')" type="date"/>
                    <x-input-form name="gender" :label="__('model.absen.gender')"/>
                    <x-input-form name="alamat" :label="__('model.absen.alamat')"/>
                    <x-input-form name="absen" :label="__('model.absen.absen')"/>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        {{ __('menu.general.cancel') }}
                    </button>
                    <button type="submit" class="btn btn-primary">{{ __('menu.general.save') }}</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Edit Modal -->
    <div class="modal fade" id="editModal" data-bs-backdrop="static" tabindex="-1">
        <div class="modal-dialog">
            <form class="modal-content" method="post" action="">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalTitle">{{ __('menu.general.edit') }}</h5>
                    <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"
                        aria-label="Close"
                    ></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id" id="id" value="">
                    <x-input-form name="nama" :label="__('model.absen.nama')"/>
                    <x-input-form name="tanggal_lahir" :label="__('model.absen.tanggal_lahir')" type="date"/>
                    <x-input-form name="gender" :label="__('model.absen.gender')"/>
                    <x-input-form name="alamat" :label="__('model.absen.alamat')"/>
                    <x-input-form name="absen" :label="__('model.absen.absen')"/>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        {{ __('menu.general.cancel') }}
                    </button>
                    <button type="submit" class="btn btn-primary">{{ __('menu.general.update') }}</button>
                </div>
            </form>
        </div>
    </div>
@endsection --}}

@section('content')
<div class="ag-page-404">
    <div class="ag-toaster-wrap">
      <div class="ag-toaster">
        <div class="ag-toaster_back"></div>
        <div class="ag-toaster_front">
          <div class="js-toaster_lever ag-toaster_lever"></div>
        </div>
        <div class="ag-toaster_toast-handler">
          <div class="ag-toaster_shadow"></div>
          <div class="js-toaster_toast ag-toaster_toast js-ag-hide"></div>
        </div>
      </div>

  
      <canvas id="canvas-404" class="ag-canvas-404"></canvas>
      <img class="ag-canvas-404_img" src="https://raw.githubusercontent.com/SochavaAG/example-mycode/master/pens/404-error-smoke-from-toaster/images/smoke.png">
    </div>
  </div>

 

@endsection