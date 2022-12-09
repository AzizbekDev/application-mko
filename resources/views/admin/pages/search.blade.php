@extends('layouts.admin')
@section('content')
    {{ Breadcrumbs::render('search') }}
    <div class="card">
        <div class="card-header">
            Kerakli parametr bo'yicha izlash
        </div>
        <div class="card-body">
            <div class="row justify-content-center">
                <div class="col-8">
                    <form>
                        <div class="form-group">
                            <label for="fullName">FIO</label>
                            <input type="text" class="form-control" id="fullName" placeholder="Enter full name">
                        </div>
                        <div class="form-group">
                            <label for="phoneNumber">Telefon raqam</label>
                            <input type="text" class="form-control" id="phoneNumber" placeholder="Enter phone">
                        </div>
                        <div class="form-group">
                            <label for="cardNumber">Karta raqam</label>
                            <input type="text" class="form-control" id="cardNumber" placeholder="Enter card number">
                        </div><br>
                        <div class="form-group text-center">
                            <button type="submit" class="btn btn-primary btn-sm">Qidirish</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    @parent
    <script>
        $(function () {

        });
    </script>
@endsection