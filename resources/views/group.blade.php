@extends('layouts.app')

@section('content')
@php
        $url = 'pip';
        $ips = request()->ip();
@endphp
@can('manager')
    <div class="sticky-top px-2">
        <button class="btn btn-sm btn-dark mt-2" data-bs-toggle="modal" data-bs-target="#m_add_group">
            +<i class='bx bx-group'></i>
        </button>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="m_add_group" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form action="{{ route('create_group') }}" method="POST">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Add Group</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="input-group mb-3">
                            <span class="input-group-text">ID Group</span>
                            <input type="text" class="form-control" name="id_group">
                        </div>                    
                        <div class="input-group mb-3">
                            <span class="input-group-text">Name Group</span>
                            <input type="text" class="form-control" name="name_group">
                        </div>                    
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endcan


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="table-responsive rounded-3 shadow">
                <table class="table">
                    <thead class="table-dark">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">ID</th>
                            <th scope="col">Group</th>
                            @can('manager')
                            <th scope="col" class="text-center">...</th>
                            @endcan
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $key => $item)
                            <tr>
                                <th scope="row">{{ $key+1 }}</th>
                                <td>{{ $item->id_group }}</td>
                                <td>{{ $item->name_group }}</td>
                                @can('manager')
                                <td class="text-center">
                                    <a href="{{ route('destroy_group', ['id'=>$item->id_group]) }}"><i class='bx bx-x bg-danger rounded-pill text-light fs-5'></i></a>
                                </td>
                                @endcan
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>



<script>
    const myModal = document.getElementById('m_add_user')
    const myInput = document.getElementById('myInput')

    myModal.addEventListener('shown.bs.modal', () => {
    myInput.focus()
    })
</script>
@endsection
