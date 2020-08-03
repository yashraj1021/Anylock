@extends('layouts.master')

@section('body')
    <div class="container-fluid">
        <div class="row text-center">
            <div class="col">
                <h1> Locker Status</h1>
                <p>An overview of all your lockers</p>
            </div>
        </div>
        <div class="card col-8 mx-auto">
            <div class="card-body text-center">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th scope="col">Locker Number</th>
                        <th scope="col">Location</th>
                        <th scope="col">End Date</th>
                        <th scope="col">Status</th>
                        <th scope="col"></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($rentals as $current)
                    <tr>
                        <td>{{$current->locker_num}}</td>
                        <td>{{$current->location}}</td>
                        <td>{{$current->end_date}}</td>
                        <td>{{$current->status}}</td>
                    @if($current->status == 'rented')
                        <td><button type="button" class="btn btn-primary">Renew</button>
                    @endif
                    </tr>
@endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @endsection
@push('js')
<script>
    @foreach($rentals as $rental)
    console.log({{$rental->locker_id}});
    @endforeach
</script>
@endpush


