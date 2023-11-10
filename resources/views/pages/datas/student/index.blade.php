@extends('layout.main')

@push('script')
    <script>
        $(document).on('click', '.btn-edit', function () {
            const id = $(this).data('id');
            $('#editModal form').attr('action', '{{ route('datas.student.index') }}/' + id);
            $('#editModal input:hidden#id').val(id);
            $('#editModal input#nis').val($(this).data('nis'));
            $('#editModal input#nama').val($(this).data('nama'));
            $('#editModal input#tanggal_lahir').val($(this).data('tanggal_lahir'));
            $('#editModal input#jenis_kelamin').val($(this).data('jenis_kelamin'));
            $('#editModal input#alamat').val($(this).data('alamat'));
        });
    </script>
@endpush

@section('content')
    <x-breadcrumb
        :values="[__('menu.datas.menu'), __('menu.datas.student')]">
        <a
        {{-- . '?' . $query --}}
        href="{{ route('datas.student.print')  }}"
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
                    <th>{{ __('model.student.nis') }}</th>
                    <th>{{ __('model.student.nama') }}</th>
                    <th>{{ __('model.student.tanggal_lahir') }}</th>
                    <th>{{ __('model.student.jenis_kelamin') }}</th>
                    <th>{{ __('model.student.alamat') }}</th>
                    <th>{{ __('menu.general.action') }}</th>
                </tr>
                </thead>
                @if($data)
                    <tbody>
                    @foreach($data as $student)
                        <tr>
                            <td>{{ $student->nis }}</td>
                            <td>{{ $student->nama }}</td>
                            <td>{{ $student->tanggal_lahir }}</td>
                            <td>{{ $student->jenis_kelamin }}</td>
                            <td>{{ $student->alamat }}</td>
                            <td>
                                <button class="btn btn-info btn-sm btn-edit"
                                        data-id="{{ $student->id }}"
                                        data-nis="{{ $student->nis }}"
                                        data-nama="{{ $student->nama }}"
                                        data-tanggal_lahir="{{ $student->tanggal_lahir }}"
                                        data-jenis_kelamin="{{ $student->jenis_kelamin }}"
                                        data-alamat="{{ $student->alamat }}"
                                        data-bs-toggle="modal"
                                        data-bs-target="#editModal">
                                    {{ __('menu.general.edit') }}
                                </button>
                                <form action="{{ route('datas.student.destroy', $student) }}" class="d-inline" method="post">
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
                    <th>{{ __('model.student.nis') }}</th>
                    <th>{{ __('model.student.nama') }}</th>
                    <th>{{ __('model.student.tanggal_lahir') }}</th>
                    <th>{{ __('model.student.jenis_kelamin') }}</th>
                    <th>{{ __('model.student.alamat') }}</th>
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
            <form class="modal-content" method="post" action="{{ route('datas.student.store') }}">
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
                    <x-input-form name="nis" :label="__('model.student.nis')"/>
                    <x-input-form name="nama" :label="__('model.student.nama')"/>
                    <x-input-form name="tanggal_lahir" :label="__('model.student.tanggal_lahir')" type="date"/>
                    <x-input-form name="jenis_kelamin" :label="__('model.student.jenis_kelamin')"/>
                    <x-input-form name="alamat" :label="__('model.student.alamat')"/>
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
                    <x-input-form name="nis" :label="__('model.student.nis')"/>
                    <x-input-form name="nama" :label="__('model.student.nama')"/>
                    <x-input-form name="tanggal_lahir" :label="__('model.student.tanggal_lahir')" type="date"/>
                    <x-input-form name="jenis_kelamin" :label="__('model.student.jenis_kelamin')"/>
                    <x-input-form name="alamat" :label="__('model.student.alamat')"/>
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
