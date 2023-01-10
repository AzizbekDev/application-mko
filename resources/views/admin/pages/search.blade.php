@extends('layouts.admin')
@section('content')
    {{ Breadcrumbs::render('search') }}
    <div class="card">
        <div class="card-header">
            Поиск по нужному параметру
        </div>
        <div class="card-body">
            <div class="row justify-content-center">
                <div class="col-8">
                    <form method="POST" action="{{ route('admin.application.search') }}">
                        @csrf
                        <div class="form-group">
                            <label for="fullName">ФИО</label>
                            <input type="text" name="fio" class="form-control" id="fullName" placeholder="Enter full name">
                        </div>
                        <div class="form-group">
                            <label for="phoneNumber">Номер телефона</label>
                            <input type="text" name="phone" class="form-control" id="phoneNumber" placeholder="Enter phone">
                        </div>
                        <div class="form-group">
                            <label for="cardNumber">Номер карты</label>
                            <input type="text" name="card_number" class="form-control" id="cardNumber" placeholder="Enter card number">
                        </div><br>
                        <div class="form-group text-center">
                            <button type="submit" class="btn btn-primary btn-sm w-25">Поиск</button>
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