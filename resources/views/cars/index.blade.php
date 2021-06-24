@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Laravel 8 CRUD </h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('cars.create') }}" title="Create a project"> <i class="fas fa-plus-circle"></i>
                    </a>
            </div>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <table class="table table-bordered table-responsive-lg">
        <tr>
            <th>No</th>
            <th>Name</th>
            <th>Description</th>
            <th>Images</th>
            <th>Date Created</th>
        </tr>
        @foreach ($cars as $car)
            <tr>
                <td>{{ ++$i }}</td>
                <td>{{ $car->name }}</td>
                <td>{{ $car->description }}</td>
                <td>
                    @foreach($car->CarImages as $image)
                    <img src='{{Storage::urls($image->name)}}'/>
                    @endforeach
                </td>
                <td>{{ date_format($car->created_at, 'jS M Y') }}</td>
            </tr>
        @endforeach
    </table>

        {!! $cars->links() !!}

@endsection
