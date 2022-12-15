@extends('layouts.admin')
@section('content')
    {{ Breadcrumbs::render('applications') }}
    <div class="card">
        <div class="card-header">
            <h3 class="card-title float-left">{{ trans('global.list') }} {{ trans('cruds.application.title') }}</h3>
            <span class="badge badge-light py-2">Количество : 26513</span>
            <div class="card-tools">
                <form action="" method="get">
                    <div class="btn-group">
                        <button name="filter" type="button" value="1" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#filter-modal"><i class="fas fa-filter"></i> Фильтр</button>
                        <div class="modal fade" id="filter-modal" tabindex="-1" role="dialog" aria-labelledby="filters" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Фильтр</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group row align-items-center">
                                            <div class="col-3">
                                                <h6>ID_клиентa</h6>
                                            </div>
                                            <div class="col-3">
                                                <select class="form-control form-control-sm" name="client_id_operator">
                                                    <option value=""> = </option>
                                                    <option value="like"> like </option>
                                                </select>
                                            </div>
                                            <div class="col">
                                                <input class="form-control form-control-sm" type="text" name="client_id" value="">
                                            </div>
                                        </div>
                                        <div class="form-group row align-items-center">
                                            <div class="col-3">
                                                <h6>ФИО</h6>
                                            </div>
                                            <div class="col-3">
                                                <select class="form-control form-control-sm like-operator" name="client_name_operator">
                                                    <option value=""> = </option>
                                                    <option value="like" selected=""> like </option>
                                                </select>
                                            </div>
                                            <div class="col">
                                                <input class="form-control form-control-sm" type="text" name="client_name" value="">
                                            </div>
                                        </div>
                                        <div class="form-group row align-items-center">
                                            <div class="col-3">
                                                <h6>Телефон</h6>
                                            </div>
                                            <div class="col-3">
                                                <select class="form-control form-control-sm" name="phone_operator">
                                                    <option value=""> = </option>
                                                    <option value="like"> like </option>
                                                </select>
                                            </div>
                                            <div class="col">
                                                <input class="form-control form-control-sm" type="text" name="phone" value="">
                                            </div>
                                        </div>
                                        <div class="form-group row align-items-center">
                                            <div class="col-3">
                                                <h6>ПасспортID</h6>
                                            </div>
                                            <div class="col-3">
                                                <select class="form-control form-control-sm" name="doc_number_operator">
                                                    <option value=""> = </option>
                                                    <option value="like"> like </option>
                                                </select>
                                            </div>
                                            <div class="col">
                                                <input class="form-control form-control-sm" type="text" name="doc_number" value="">
                                            </div>
                                        </div>
                                        <div class="form-group row align-items-center">
                                            <div class="col-3">
                                                <h6>Состояние</h6>
                                            </div>
                                            <div class="col-3">
                                                <select class="form-control form-control-sm">
                                                    <option value=""> = </option>
                                                </select>
                                            </div>
                                            <div class="col">
                                                <select class="form-control form-control-sm" name="condition">
                                                    <option value="">Не выбран</option>
                                                    <option value="0">Новые клиенты</option>
                                                    <option value="1">Клиенты открыли кошелек</option>
                                                    <option value="2">Клиенты лимит заполнен</option>
                                                    <option value="3">Успешные клиенты</option>
                                                    <option value="4">Отклоненные клиенты</option>
                                                    <option value="5">Закрытый клиент</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" name="filter" class="btn btn-primary">Фильтрация</button>
                                        <button type="reset" class="btn btn-outline-warning float-left pull-left" id="reset_form">Очистить</button>
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыт</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <a class="btn btn-secondary btn-sm" href="{{ route('admin.applications.index') }}"><i class="fa fa-redo-alt"></i> Очистить</a>
                    </div>
                </form>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped table-responsive-lg">
                <thead>
                    <tr class="text-center">
                        <th>App ID</th>
                        <th>ФИО</th>
                        <th>Телефон</th>
                        <th>Паспорт</th>
                        <th>Зарплатная карта</th>
                        <th>Состояние</th>
                        <th>Партнер</th>
                        <th>Дата заявки</th>
                        <th>Действия</th>
                    </tr>
                </thead>
            </table>
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