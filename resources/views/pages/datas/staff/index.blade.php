@extends('layout.main')

@push('script')
    <script>
        $(document).on('click', '.btn-edit', function () {
            const id = $(this).data('id');
            $('#editModal form').attr('action', '{{ route('datas.staff.index') }}/' + id);
            $('#editModal input:hidden#id').val(id);
            $('#editModal input#nip').val($(this).data('nip'));
            $('#editModal input#nama').val($(this).data('nama'));
            $('#editModal input#tanggal_lahir').val($(this).data('tanggal_lahir'));
            $('#editModal input#posisi').val($(this).data('posisi'));
            // Set selected gender in the select element
            $('#editModal select#gender').val(gender);
            const gender = $(this).data('gender');
            console.log('Gender:', gender); // Tambahkan log untuk memeriksa nilai gender
        });
    </script>
@endpush



@section('content')
    <x-breadcrumb
        :values="[__('menu.datas.menu'), __('menu.datas.staff')]">
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
                    <th>{{ __('model.staff.nip') }}</th>
                    <th>{{ __('model.staff.nama') }}</th>
                    <th>{{ __('model.staff.tanggal_lahir') }}</th>
                    <th>{{ __('model.staff.gender') }}</th>
                    <th>{{ __('model.staff.posisi') }}</th>
                    <th>{{ __('menu.general.action') }}</th>
                </tr>
                </thead>
                @if($data)
                    <tbody>
                    @foreach($data as $staff)
                        <tr>
                            <td>{{ $staff->nip }}</td>
                            <td>{{ $staff->nama }}</td>
                            <td>{{ $staff->tanggal_lahir }}</td>
                            <td>{{ $staff->gender }}</td>
                            <td>{{ $staff->posisi }}</td>
                            <td>
                                <button class="btn btn-info btn-sm btn-edit"
                                        data-id="{{ $staff->id }}"
                                        data-nip="{{ $staff->nip }}"
                                        data-nama="{{ $staff->nama }}"
                                        data-tanggal_lahir="{{ $staff->tanggal_lahir }}"
                                        data-gender="{{ $staff->gender }}"
                                        data-posisi="{{ $staff->posisi }}"
                                        data-bs-toggle="modal"
                                        data-bs-target="#editModal">
                                    {{ __('menu.general.edit') }}
                                </button>
                                <form action="{{ route('datas.staff.destroy', $staff) }}" class="d-inline" method="post">
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
                    <th>{{ __('model.staff.nip') }}</th>
                    <th>{{ __('model.staff.nama') }}</th>
                    <th>{{ __('model.staff.tanggal_lahir') }}</th>
                    <th>{{ __('model.staff.gender') }}</th>
                    <th>{{ __('model.staff.posisi') }}</th>
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
            <form class="modal-content" method="post" action="{{ route('datas.staff.store') }}">
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
                    <x-input-form name="nip" :label="__('model.staff.nip')"/>
                    <x-input-form name="nama" :label="__('model.staff.nama')"/>
                    <x-input-form name="tanggal_lahir" :label="__('model.staff.tanggal_lahir')" type="date"/>
                    <div class="form-group">
                        <label for="gender">{{ __('model.staff.gender') }}</label>
                        <select name="gender" id="gender" class="form-control">
                            <option value="Laki-laki">Laki-laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                    </div>
                    <x-input-form name="posisi" :label="__('model.staff.posisi')"/>
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
                    <x-input-form name="nip" :label="__('model.staff.nip')"/>
                    <x-input-form name="nama" :label="__('model.staff.nama')"/>
                    <x-input-form name="tanggal_lahir" :label="__('model.staff.tanggal_lahir')" type="date"/>

                    <div class="form-group">
                        <label for="gender">{{ __('model.staff.gender') }}</label>
                        <select name="gender" id="gender" class="form-control">
                            <option value="Laki-laki">Laki-laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                    </div>

                    <x-input-form name="posisi" :label="__('model.staff.posisi')"/>
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
