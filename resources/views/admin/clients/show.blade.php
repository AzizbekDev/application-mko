@extends('layouts.admin')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Работа с клиентами</h1>
                </div>
            </div>
        </div>
    </section>
   <section class="content">
       <div class="container-fluid">
           <div class="row">
               <div class="col-md-12">
                   <div class="card card-primary card-outline table-responsive">
                       <div class="card-header">
                       <h5 class="card-title">
                           <i class="fa fa-user-circle"></i>
                           MUZAFFAROV AZIZBEK AVAZBEK OGLI
                           <sup class="badge badge-primary mt-0">Новая заявка</sup>
                       </h5>
                   </div>
                   <div class="card-body">
                       <div class="row">
                           <div class="col-md-12">
                               <div class="card card-default card-outline card-outline-tabs">
                                   <div class="card-header p-0 border-bottom-0">
                                       <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
                                           <li class="nav-item">
                                               <a class="nav-link show active" id="vert-tabs-client-info" data-toggle="pill" href="#client-info" role="tab" aria-controls="client-info" aria-selected="true">Клиент</a>
                                           </li>
                                           <li class="nav-item">
                                               <a class="nav-link" id="vert-tabs-application" data-toggle="pill" href="#application" role="tab" aria-controls="application" aria-selected="true">Заявка</a>
                                           </li>
                                           <li class="nav-item">
                                               <a class="nav-link" id="vert-tabs-application-info" data-toggle="pill" href="#application-info" role="tab" aria-controls="application-info" aria-selected="true">Детали заявка</a>
                                           </li>
                                           <li class="nav-item">
                                               <a class="nav-link" id="vert-tabs-application-info" data-toggle="pill" href="#wallet-info" role="tab" aria-controls="wallet-info" aria-selected="true">Информация о кошельке</a>
                                           </li>
                                           <li class="nav-item">
                                               <a class="nav-link" id="vert-tabs-actions-tab" data-toggle="pill" href="#actions-tab" role="tab" aria-controls="actions-tab" aria-selected="false">Действие</a>
                                           </li>
                                       </ul>
                                   </div>
                                   <div class="card-body">
                                       <div class="tab-content" id="custom-tabs-four-tabContent" style="max-height: 500px; overflow: scroll;">
                                           <!--Actions-->
                                           <div class="tab-pane fade" id="actions-tab" role="tabpanel" aria-labelledby="client-info" style="min-height: 150px">
                                               <div class="card-body p-0">
                                                   <div class="row">
                                                       <a class="btn btn-app bg-light">
                                                           <i class="fa fa-plus text-success" aria-hidden="true"></i> Кошелек открыт
                                                       </a>
                                                       <a class="btn btn-app bg-light">
                                                           <i class="fa fa-edit text-info"></i> Изменить статус
                                                       </a>
                                                       <a class="btn btn-app bg-light">
                                                           <i class="fa fa-times-circle text-danger"></i> Отклонять
                                                       </a>
                                                   </div>
                                               </div>
                                           </div>
                                           <!-- Client info -->
                                           <div class="tab-pane fade show active" id="client-info" role="tabpanel" aria-labelledby="client-info">
                                               <div class="card-body p-0">
                                                   <table class="table table-hover">
                                                       <tbody>
                                                       <tr>
                                                           <td><strong>ID_клиентa</strong></td>
                                                           <td>99000092</td>
                                                       </tr>
                                                       <tr>
                                                           <td><strong>Договор ID</strong></td>
                                                           <td>300309</td>
                                                       </tr>
                                                       <tr>
                                                           <td><strong>ФИО</strong></td>
                                                           <td>MUZAFFAROV AZIZBEK AVAZBEK OGLI</td>
                                                       </tr>
                                                       <tr>
                                                           <td><strong>Дт_рождения</strong></td>
                                                           <td>1993-02-01</td>
                                                       </tr>
                                                       <tr>
                                                           <td><strong>ПасспортID</strong></td>
                                                           <td>AA6009200</td>
                                                       </tr>
                                                       <tr>
                                                           <td><strong>PINFL</strong></td>
                                                           <td>30102934310017</td>
                                                       </tr>
                                                       <tr>
                                                           <td><strong>Выдан</strong></td>
                                                           <td>FARGONA V FARGONA SH IIB</td>
                                                       </tr>
                                                       <tr>
                                                           <td><strong>ИНН</strong></td>
                                                           <td>548057878</td>
                                                       </tr>
                                                       <tr>
                                                           <td><strong>Телефон</strong></td>
                                                           <td>999986352 <a href="#myModalTel" role="button" data-toggle="modal"><i class="fa fa-edit"></i></a></td>
                                                       </tr>
                                                       <tr>
                                                           <td><strong>Текущий лимит</strong></td>
                                                           <td>1800000000</td>
                                                       </tr>
                                                       <tr>
                                                           <td><strong>Начальный лимит</strong></td>

                                                           <td>to'ldirilmagan</td>
                                                       </tr>
                                                       <tr>
                                                           <td><strong>Максимальный лимит</strong></td>

                                                           <td>to'ldirilmagan</td>
                                                       </tr>
                                                       <tr>
                                                           <td><strong>Тип</strong></td>
                                                           <td>165</td>
                                                       </tr>
                                                       <tr>
                                                           <td><strong>Адрес</strong></td>
                                                           <td>ФАРГОНА ВИЛОЯТИ ФАРГОНА ШАХРИ NODIRABEGIM TOR 10 A</td>
                                                       </tr>
                                                       <tr>
                                                           <td><strong>Места работы</strong></td>
                                                           <td> </td>
                                                       </tr>
                                                       <tr>
                                                           <td><strong>Принадлежит к</strong></td>
                                                           <td>Application Unired</td>
                                                       </tr>
                                                       </tbody>
                                                   </table>
                                               </div>
                                           </div>
                                       </div>
                                   </div>
                                   <!-- /.card -->
                               </div>
                           </div>
                       </div>
                   </div>
                   </div>
               </div>
               <div class="col-md-12">
                   <div class="card">
                       <div class="card-header">
                           <h3 class="card-title float-left">Зарплатные карты</h3>
                           <div class="btn-group float-right">
                               <a href="#" class="btn btn-success btn-sm">
                                   <i class="fa fa-plus-circle"></i> Добавить
                               </a>
                           </div>
                       </div>
                       <div class="card-body" style="overflow: auto">
                           <table class="table table-bordered text-center">
                               <thead>
                               <tr>
                                   <th width="10px;">#</th>
                                   <th>Номер карты</th>
                                   <th>Владелец карты</th>
                                   <th>Баланс</th>
                                   <th>Телефон</th>
                                   <th>Статус</th>
                                   <th>Тип</th>
                                   <th>СМС</th>
                                   <th width="40px;">Действие</th>
                               </tr>
                               </thead>
                               <tbody id="card_table_body aligin-middle">
                               <tr id="row_28869" class="UZCARD">
                                   <td class="v-a">2</td>
                                   <td class="v-a">8600482957804708 / 1024</td>
                                   <td class="v-a" id="owner_28869">MUZAFFAROV AZIZBEK</td>
                                   <td class="v-a" id="balance_28869">UZS&nbsp;0.13</td>
                                   <td class="v-a" id="phone_28869">998999986352</td>
                                   <td class="v-a" id="status_28869">Карта активна, подключено смс уведомление.</td>
                                   <td class="v-a">UZCARD</td>
                                   <td class="v-a text-success" id="sms_28869"><i class="fa fa-toggle-on text-success"></i></td>
                                   <td class="v-a">
                                       <div class="btn-group pb-1">
                                           <button type="button" class="btn btn-sm btn-success update">
                                               <i class="fa fa-sync"></i>
                                           </button>
                                           <button type="button" class="btn btn-sm btn-info" data-toggle="modal" data-target="#modal_card28869">
                                               <i class="fa fa-eye"></i>
                                           </button>
                                           <form action="#" method="post">
                                               @csrf
                                               @method('delete')
                                               <button type="button" class="btn btn-danger btn-sm submitButton"><i class="fa fa-trash"></i></button>
                                           </form>
                                       </div>
                                   </td>
                               </tr>
                               </tbody>
                           </table>
                       </div>
                       <!-- /.card-body -->
                       <!-- Card Modal -->
                       <div class="modal fade" id="modal_card28869" tabindex="-1" role="dialog" aria-hidden="true">
                           <div class="modal-dialog modal-dialog-centered" role="document">
                               <div class="modal-content">
                                   <div class="modal-header">
                                       <h6 class="modal-title">Больше информации</h6>
                                       <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                           <span aria-hidden="true">×</span>
                                       </button>
                                   </div>
                                   <div class="modal-body">
                                       <table class="table table-striped table-bordered">
                                           <tbody>
                                           <tr>
                                               <th>ID_клиентa</th>
                                               <td>99000092</td>
                                           </tr>
                                           <tr>
                                               <th>Номер карты</th>
                                               <td>8600482957804708 / 1024</td>
                                           </tr>
                                           <tr>
                                               <th>Владелец карты</th>
                                               <td>MUZAFFAROV AZIZBEK</td>
                                           </tr>
                                           <tr>
                                               <th>Телефон</th>
                                               <td>999986352</td>
                                           </tr><tr>
                                               <th>СМС</th>
                                               <td>1</td>
                                           </tr>
                                           <tr>
                                               <th>Статус</th>
                                               <td>Карта активна, подключено смс уведомление.</td>
                                           </tr>
                                           <tr>
                                               <th>Тип</th>
                                               <td>UZCARD</td>
                                           </tr>
                                           <tr>
                                               <th>acct</th>
                                               <td>22618000599062747001</td>
                                           </tr>
                                           <tr>
                                               <th>acct_type</th>
                                               <td>22618</td>
                                           </tr>
                                           <tr>
                                               <th>Время_создания</th>
                                               <td>2021-01-19 22:45:02</td>
                                           </tr>
                                           </tbody>
                                       </table>
                                   </div>
                                   <div class="modal-footer">
                                       <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Закрыт</button>
                                   </div>
                               </div>
                           </div>
                       </div>
                   </div>
               </div>
               <div class="col-md-12">
                   <div class="card">
                       <div class="card-header">
                           <h3 class="card-title">Карта скоринг</h3>
                       </div>
                       <div class="card-body">
                           <table class="table table-bordered text-center">
                               <thead>
                               <tr>
                                   <th width="10px;">#</th>
                                   <th>Номер карты</th>
                                   <th>Владелец карты</th>
                                   <th>Средняя зарплата</th>
                                   <th>Мин. лимит</th>
                                   <th>Макс. лимит</th>
                                   <th>Статус</th>
                                   <th width="40px;">Действие</th>
                               </tr>
                               </thead>
                               <tbody id="card_table_body aligin-middle">
                               <tr id="row_28869" class="UZCARD">
                                   <td class="v-a">1</td>
                                   <td class="v-a">8600482957804708 / 1024</td>
                                   <td class="v-a">MUZAFFAROV AZIZBEK</td>
                                   <td class="v-a">7 500 000</td>
                                   <td class="v-a">2 000 000</td>
                                   <td class="v-a">26 000 000</td>
                                   <td class="v-a text-success">Success Scoring</td>
                                   <td class="v-a">
                                       <div class="btn-group pb-1">
                                           <button type="button" class="btn btn-sm btn-success update">
                                               <i class="fa fa-sync"></i>
                                           </button>
                                           <button type="button" class="btn btn-sm btn-info">
                                               <i class="fa fa-eye"></i>
                                           </button>
                                       </div>
                                   </td>
                               </tr>
                               </tbody>
                           </table>
                       </div>
               </div>
           </div>
               <div class="col-md-12">
                   <div class="card">
                       <div class="card-header">
                           <h3 class="card-title">Налоговый скоринг</h3>
                       </div>
                       <div class="card-body">
                           <table class="table table-bordered text-center">
                               <thead>
                               <tr>
                                   <th width="10px;">#</th>
                                   <th>Серийный номер паспорта</th>
                                   <th>Средняя зарплата</th>
                                   <th>Мин. лимит</th>
                                   <th>Макс. лимит</th>
                                   <th>Статус</th>
                                   <th width="40px;">Действие</th>
                               </tr>
                               </thead>
                               <tbody id="card_table_body aligin-middle">
                               <tr id="row_28869" class="UZCARD">
                                   <td class="v-a">1</td>
                                   <td class="v-a">AA6009200</td>
                                   <td class="v-a">7 500 000</td>
                                   <td class="v-a">2 000 000</td>
                                   <td class="v-a">26 000 000</td>
                                   <td class="v-a text-success">Success Scoring</td>
                                   <td class="v-a">
                                       <div class="btn-group pb-1">
                                           <button type="button" class="btn btn-sm btn-success update">
                                               <i class="fa fa-sync"></i>
                                           </button>
                                           <button type="button" class="btn btn-sm btn-info">
                                               <i class="fa fa-eye"></i>
                                           </button>
                                       </div>
                                   </td>
                               </tr>
                               </tbody>
                           </table>
                       </div>
                   </div>
               </div>
               <div class="col-md-12">
                   <div class="card">
                       <div class="card-header">
                           <h3 class="card-title">Кредитный скоринг</h3>
                       </div>
                       <div class="card-body">
                           <table class="table table-bordered text-center">
                               <thead>
                               <tr>
                                   <th width="10px;">#</th>
                                   <th>asoki_client_id</th>
                                   <th>claim_id</th>
                                   <th>claim_number</th>
                                   <th>scoring_result</th>
                                   <th>scoring_status</th>
                                   <th width="40px;">Действие</th>
                               </tr>
                               </thead>
                               <tbody id="card_table_body aligin-middle">
                               <tr id="row_28869" class="UZCARD">
                                   <td class="v-a">1</td>
                                   <td class="v-a">AA6009200</td>
                                   <td class="v-a">7 500 000</td>
                                   <td class="v-a">2 000 000</td>
                                   <td class="v-a">26 000 000</td>
                                   <td class="v-a text-success">Success Scoring</td>
                                   <td class="v-a">
                                       <div class="btn-group pb-1">
                                           <button type="button" class="btn btn-sm btn-success update">
                                               <i class="fa fa-sync"></i>
                                           </button>
                                           <button type="button" class="btn btn-sm btn-info">
                                               <i class="fa fa-eye"></i>
                                           </button>
                                       </div>
                                   </td>
                               </tr>
                               </tbody>
                           </table>
                       </div>
                   </div>
               </div>
       </div>
   </section>
@endsection
@section('scripts')
    @parent
    <script>
        $('.card').collapse({
            toggle: false
        })
    </script>
@endsection