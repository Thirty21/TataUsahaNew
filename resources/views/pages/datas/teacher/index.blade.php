@extends('layout.main')


@push('script')
    <script>
        $(document).on('click', '.btn-edit', function () {
            const id = $(this).data('id');
            $('#editModal form').attr('action', '{{ route('datas.teacher.index') }}/' + id);
            $('#editModal input:hidden#id').val(id);
            $('#editModal input#nig').val($(this).data('nig'));
            $('#editModal input#nama').val($(this).data('nama'));
            $('#editModal input#tanggal_lahir').val($(this).data('tanggal_lahir'));
            $('#editModal input#alamat').val($(this).data('alamat'));
            // Set selected gender in the select element
            $('#editModal select#gender').val(gender);
            const gender = $(this).data('gender');
            console.log('Gender:', gender);
        });
    </script>
@endpush

@section('content')
    <x-breadcrumb
        :values="[__('menu.datas.menu'), __('menu.datas.teacher')]">
        <a
        {{-- . '?' . $query --}}
        href="{{ route('datas.teacher.print')  }}"
        target="_blank"
        class="btn btn-primary">
        {{ __('menu.general.print') }}
        </a>
        <button
            type="button"
            class="btn btn-primary"
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
                    <th>{{ __('model.teacher.nig') }}</th>
                    <th>{{ __('model.teacher.nama') }}</th>
                    <th>{{ __('model.teacher.tanggal_lahir') }}</th>
                    <th>{{ __('model.teacher.gender') }}</th>
                    <th>{{ __('model.teacher.alamat') }}</th>
                    <th>{{ __('menu.general.action') }}</th>
                </tr>
                </thead>
                @if($data)
                    <tbody>
                    @foreach($data as $teacher)
                        <tr>
                            <td>{{ $teacher->nig }}</td>
                            <td>{{ $teacher->nama }}</td>
                            <td>{{ $teacher->tanggal_lahir }}</td>
                            <td>{{ $teacher->gender }}</td>
                            <td>{{ $teacher->alamat }}</td>
                            <td>
                                <button class="btn btn-info btn-sm btn-edit"
                                        data-id="{{ $teacher->id }}"
                                        data-nig="{{ $teacher->nig }}"
                                        data-nama="{{ $teacher->nama }}"
                                        data-tanggal_lahir="{{ $teacher->tanggal_lahir }}"
                                        data-gender="{{ $teacher->gender }}"
                                        data-alamat="{{ $teacher->alamat }}"
                                        data-bs-toggle="modal"
                                        data-bs-target="#editModal">
                                    {{ __('menu.general.edit') }}
                                </button>
                                <form action="{{ route('datas.teacher.destroy', $teacher) }}" class="d-inline" method="post">
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
                    <th>{{ __('model.teacher.nig') }}</th>
                    <th>{{ __('model.teacher.nama') }}</th>
                    <th>{{ __('model.teacher.tanggal_lahir') }}</th>
                    <th>{{ __('model.teacher.gender') }}</th>
                    <th>{{ __('model.teacher.alamat') }}</th>
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
            <form class="modal-content" method="post" action="{{ route('datas.teacher.store') }}">
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
                    <x-input-form name="nig" :label="__('model.teacher.nig')" type="number"/>
                    <x-input-form name="nama" :label="__('model.teacher.nama')"/>
                    <x-input-form name="tanggal_lahir" :label="__('model.teacher.tanggal_lahir')" type="date"/>
                    <div class="form-group">
                        <label for="gender">{{ __('model.staff.gender') }}</label>
                        <select name="gender" id="gender" class="form-control">
                            <option value="Laki-laki">Laki-laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                    </div>
                    <x-input-form name="alamat" :label="__('model.teacher.alamat')"/>
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
                    <x-input-form name="nig" :label="__('model.teacher.nig')"/>
                    <x-input-form name="nama" :label="__('model.teacher.nama')"/>
                    <x-input-form name="tanggal_lahir" :label="__('model.teacher.tanggal_lahir')" type="date"/>
                    <div class="form-group">
                        <label for="gender">{{ __('model.teacher.gender') }}</label>
                        <select name="gender" id="gender" class="form-control">
                            <option value="Laki-laki">Laki-laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                    </div>
                    <x-input-form name="alamat" :label="__('model.teacher.alamat')"/>
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
@endsection
