@extends('layouts.app')

@section('content')
@php
        $query = @unserialize(file_get_contents('http://ip-api.com/php/?fields=status,message,country,region,city,district,lat,lon,isp,org,as,query'));
        if($query && $query['status'] == 'success')
        {
            // $url = 'http://127.0.0.1:8000/qrcode/'.$query['as'];
            // $url = 'http://192.168.0.98:8099/qrcode/'.$query['as'];
            $url = 'http://10.10.104.209:8099/qrcode/'.$query['as'];
        }
        
@endphp
@can('manager')
    <div class="sticky-top px-2">
        <button class="btn btn-sm btn-dark mt-2" data-bs-toggle="modal" data-bs-target="#m_qr_calender">
            <i class='bx bx-qr-scan'></i>
        </button>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="m_qr_calender" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Login end Scan QRCODE</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-1">
                        <div class="text-center">
                            {{ QrCode::size(300)->generate($url); }}
                        </div>                 
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
        </div>
    </div>
@endcan

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif
            
            <div class="table-responsive rounded-3 shadow">
                <table class="table">
                    <thead class="table-dark">
                        <th colspan="9" class="ms-3">Group</th>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Group</th>
                            <th scope="col">IP</th>
                            <th scope="col">Address</th>
                            <th scope="col">Telecom Operator</th>
                            @can('manager')
                            <th scope="col" class="text-center"><a href="{{ route('trun_calen') }}" class="btn btn-sm btn-warning"><i class='bx bx-refresh'></i></a></th>
                            @endcan
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $key => $item)
                            <tr>
                                <th scope="row">{{ $key+1 }}</th>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->email }}</td>
                                <td>{{ $item->name_group }}</td>
                                <td>{{ $item->ip }}</td>
                                <td>{{ $item->address }}</td>
                                <td>{{ $item->telecom_operator }}</td>
                                @can('manager')
                                <td class="text-center">
                                    <a href="{{ route('destroy_user_calen', ['id'=>$item->id]) }}"><i class='bx bx-x bg-danger rounded-pill text-light fs-5'></i></a>
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
@endsection
