@extends('layouts.parent')


@section('title', 'All Products')


@section('css')
    <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
@endsection
@section('content')
    <div class="col-12">
        <table id="example1" class="table table-striped table-bordered" style="width:100%">
            <thead>
                <tr>
                    <th>S</th>
                    <th>Name</th>
                    <th>code</th>
                    <th>status</th>
                    <th>quantity</th>
                    <th>price</th>
                    <th>creation date</th>
                    <th>last updated date</th>
                    <th>operations</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                    <tr>
                        <td>{{ $product->id }}</td>
                        <td>{{ $product->name_ar }} - {{ $product->name_en }}</td>
                        <td>{{ $product->code }}</td>
                        <td @class([
                            'text-danger'=> $product->status == 0,
                            'text-primary'=> $product->status == 1
                            ])>{{ $product->status == 0 ? 'Not Available' : 'Available' }}</td>
                       <td @class([
                        'text-center',
                        'text-danger'=> $product->quantity == 0,
                        'text-success'=>$product->quantity > 0 && $product->quantity < 5,
                        'text-primary'=> $product->quantity >= 5
                        ])>{{ $product->quantity }}</td>
                        <td>{{ $product->price }}</td>
                        <td>{{ $product->created_at }}</td>
                        <td>{{ $product->updated_at }}</td>
                        <td>
                            <a href="{{route('dashboard.products.edit' , $product->id) }}"
                                class="btn btn-outline-primary">Edit</a>

                            <form action="{{ route('dashboard.products.delete' , $product->id) }}" method="post">
                                @csrf
                                @method('DELETE')

                                <button class="btn btn-outline-danger mt-3">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>



@endsection

@section('js')

    <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('plugins/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ asset('plugins/pdfmake/vfs_fonts.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>

    <script>
        $(function() {
            $("#example1").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

        });
    </script>


@endsection
