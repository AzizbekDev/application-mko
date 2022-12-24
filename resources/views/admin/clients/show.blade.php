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
                           {{ $application_info->fio ?? $application->serial_number }}
                           <sup class="badge badge-primary mt-0">{{ $client->status_app_name }}</sup>
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
                                                   <div class="my-4 pl-4">
                                                       @if(!$wallet)
                                                           <a class="btn btn-app bg-light">
                                                               <i class="fa fa-plus text-success" aria-hidden="true" onclick="openWallet({{ $client->id }})"></i> Кошелек открыт
                                                           </a>
                                                       @else
                                                           <a class="btn btn-app bg-light">
                                                               <i class="fa fa-check text-success" aria-hidden="true"></i> Кошелек открыл
                                                           </a>
                                                       @endif
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
                                                           <td><strong>Client ID</strong></td>
                                                           <td>{{ $client->id }}</td>
                                                       </tr>
                                                       <tr>
                                                           <td><strong>Application Status</strong></td>
                                                           <td>{{ $client->status_app_name }}</td>
                                                       </tr>
                                                       <tr>
                                                           <td><strong>Client Status</strong></td>
                                                           <td>{{ $client->status_name }}</td>
                                                       </tr>
                                                       <tr>
                                                           <td><strong>Client Code</strong></td>
                                                           <td>{{ $client->client_code ?? 'Null' }}</td>
                                                       </tr>
                                                       <tr>
                                                           <td><strong>Client Password</strong></td>
                                                           <td>{{ $client->password }}</td>
                                                       </tr>
                                                       <tr>
                                                           <td><strong>Client Lang</strong></td>
                                                           <td>{{ $client->lang }}</td>
                                                       </tr>
                                                       <tr>
                                                           <td><strong>Client Created</strong></td>
                                                           <td>{{ $client->date_pub }}</td>
                                                       </tr>
                                                       </tbody>
                                                   </table>
                                               </div>
                                           </div>
                                           <!-- Application -->
                                           <div class="tab-pane fade" id="application" role="tabpanel" aria-labelledby="application">
                                               <div class="card-body p-0">
                                                   <table class="table table-hover">
                                                       <tbody>
                                                       <tr>
                                                           <td><strong>Application ID</strong></td>
                                                           <td>{{ $application->id }}</td>
                                                       </tr>
                                                       <tr>
                                                           <td><strong>Key APP</strong></td>
                                                           <td>{{ $application->key_app }}</td>
                                                       </tr>
                                                       <tr>
                                                           <td><strong>Serial Number</strong></td>
                                                           <td>{{ $application->serial_number }}</td>
                                                       </tr>
                                                       <tr>
                                                           <td><strong>Pinfl</strong></td>
                                                           <td>{{ $application->pin }}</td>
                                                       </tr>
                                                       <tr>
                                                           <td><strong>Card Number</strong></td>
                                                           <td>{{ $application->card_mask }}</td>
                                                       </tr>
                                                       <tr>
                                                           <td><strong>Phone</strong></td>
                                                           <td>{{ $application->phone }}</td>
                                                       </tr>
                                                       <tr>
                                                           <td><strong>Identified</strong></td>
                                                           <td>{{ $application->is_identified ? 'Identified' : 'Not Identified' }}</td>
                                                       </tr>
                                                       <tr>
                                                           <td><strong>Created At</strong></td>
                                                           <td>{{ $application->created_at }}</td>
                                                       </tr>
                                                       <tr>
                                                           <td><strong>Updated At</strong></td>
                                                           <td>{{ $application->updated_at }}</td>
                                                       </tr>
                                                       </tbody>
                                                   </table>
                                               </div>
                                           </div>
                                           <!-- Application Info-->
                                           <div class="tab-pane fade" id="application-info" role="tabpanel" aria-labelledby="application-info">
                                               <div class="card-body p-0">
                                                   <table class="table table-hover">
                                                       <tbody>
                                                       <tr>
                                                           <td><strong>Full Name</strong></td>
                                                           <td>{{ $application_info->fio }}</td>
                                                       </tr>
                                                       <tr>
                                                           <td><strong>Serial Number</strong></td>
                                                           <td>{{ $application_info->serial_number }}</td>
                                                       </tr>
                                                       <tr>
                                                           <td><strong>Pinfl</strong></td>
                                                           <td>{{ $application_info->pin }}</td>
                                                       </tr>
                                                       <tr>
                                                           <td><strong>Inn</strong></td>
                                                           <td>{{ $application_info->inn }}</td>
                                                       </tr>
                                                       <tr>
                                                           <td><strong>Birth Date</strong></td>
                                                           <td>{{ $application_info->birth_date }}</td>
                                                       </tr>
                                                       <tr>
                                                           <td><strong>Gender</strong></td>
                                                           <td>{{ $application_info->gender ? 'Male' : 'Female' }}</td>
                                                       </tr>
                                                       <tr>
                                                           <td><strong>Telegram</strong></td>
                                                           <td>{{ $application_info->telegram }}</td>
                                                       </tr>
                                                       <tr>
                                                           <td><strong>Work Address</strong></td>
                                                           <td>{{ $application_info->work_address ?? 'Not Filled' }}</td>
                                                       </tr>
                                                       <tr>
                                                           <td><strong>Work Phone</strong></td>
                                                           <td>{{ $application_info->work_phone ?? 'Not Filled' }}</td>
                                                       </tr>
                                                       <tr>
                                                           <td><strong>Work Title</strong></td>
                                                           <td>{{ $application_info->work_title ?? 'Not Filled' }}</td>
                                                       </tr>
                                                       <tr>
                                                           <td><strong>Work Place</strong></td>
                                                           <td>{{ $application_info->work_place ?? 'Not Filled' }}</td>
                                                       </tr>
                                                       <tr>
                                                           <td><strong>Profession</strong></td>
                                                           <td>{{ $application_info->profession ?? 'Not Filled' }}</td>
                                                       </tr>
                                                       <tr>
                                                           <td><strong>Created At</strong></td>
                                                           <td>{{ $application_info->created_at }}</td>
                                                       </tr>
                                                       <tr>
                                                           <td><strong>Updated At</strong></td>
                                                           <td>{{ $application_info->updated_at }}</td>
                                                       </tr>
                                                       </tbody>
                                                   </table>
                                               </div>
                                           </div>
                                           <!-- Application Info-->
                                           <div class="tab-pane fade" id="wallet-info" role="tabpanel" aria-labelledby="wallet-info">
                                               <div class="card-body p-0">
                                                  @if($wallet)
                                                    <table class="table table-hover">
                                                           <tbody>
                                                           <tr>
                                                               <td><strong>Owner</strong></td>
                                                               <td>{{ $wallet->owner }}</td>
                                                           </tr>
                                                           <tr>
                                                               <td><strong>Wallet Card Number</strong></td>
                                                               <td>{{ $wallet->card_number }}</td>
                                                           </tr>
                                                           <tr>
                                                               <td><strong>Wallet SMS Phone</strong></td>
                                                               <td>{{ $wallet->phone }}</td>
                                                           </tr>
                                                           <tr>
                                                               <td><strong>Wallet Token</strong></td>
                                                               <td>{{ $wallet->token }}</td>
                                                           </tr>
                                                           <tr>
                                                               <td><strong>Wallet Status</strong></td>
                                                               <td>{{ $wallet->status ? 'Active' : 'Inactive' }}</td>
                                                           </tr>
                                                           <tr>
                                                               <td><strong>Balance</strong></td>
                                                               <td>{{ $wallet->balance }}</td>
                                                           </tr>
                                                           <tr>
                                                               <td><strong>Created At</strong></td>
                                                               <td>{{ $wallet->created_at }}</td>
                                                           </tr>
                                                           </tbody>
                                                       </table>
                                                  @else
                                                      <div class="my-4 pl-4">
                                                          <a class="btn btn-app bg-light">
                                                              <i class="fa fa-plus text-success" aria-hidden="true" onclick="openWallet({{ $client->id }})"></i> Кошелек открыт
                                                          </a>
                                                      </div>
                                                  @endif
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
                                   <th>СМС</th>
                                   <th>Тип</th>
                                   <th>Статус</th>
                                   <th width="40px;">Действие</th>
                               </tr>
                               </thead>
                               <tbody class="aligin-middle">
                                @foreach($salary_cards as $salary_card)
                                    <tr id="row_{{$salary_card->id}}" class="card_type_{{ $salary_card->card_type }}">
                                        <td class="v-a">{{ $salary_card->card_order }}</td>
                                        <td class="v-a">{{ $salary_card->card_number }} / {{ $salary_card->expire }}</td>
                                        <td class="v-a" id="owner_{{$salary_card->id }}">{{ $salary_card->owner }}</td>
                                        <td class="v-a" id="balance_{{$salary_card->id }}">UZS&nbsp;{{ $salary_card->balance ?? 0 }}</td>
                                        <td class="v-a" id="phone_{{$salary_card->id }}">{{ $salary_card->phone }}</td>
                                        <td class="v-a" id="sms_{{$salary_card->id }}">{{ ($salary_card->sms == 1) ? "Карта активна, подключено смс уведомление." : "Карта неактивна" }}</td>
                                        <td class="v-a">{{ $salary_card->card_type }}</td>
                                        <td class="v-a text-success" id="status_{{$salary_card->id }}">
                                            @if($salary_card->is_active)
                                                <i class="fa fa-toggle-on text-success"></i>
                                            @else
                                                <i class="fa fa-toggle-off text-danger"></i>
                                            @endif
                                        </td>
                                        <td class="v-a">
                                            <div class="btn-group pb-1">
                                                <button type="button" class="btn btn-sm btn-success update">
                                                    <i class="fa fa-sync"></i>
                                                </button>
                                                <button type="button" class="btn btn-sm btn-info" data-toggle="modal" data-target="#modal_card{{$salary_card->id}}">
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
                                @endforeach
                               </tbody>
                           </table>
                       </div>
                       <!-- /.card-body -->
                       <!-- Card Modal -->
                       @foreach($salary_cards as $salary_card)
                       <div class="modal fade" id="modal_card{{$salary_card->id}}" tabindex="-1" role="dialog" aria-hidden="true">
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
                                               <th>Распоряжению</th>
                                               <td>{{ $salary_card->card_order }}</td>
                                           </tr>
                                           <tr>
                                               <th>Номер карты</th>
                                               <td>{{ $salary_card->card_number }} / {{ $salary_card->expire }}</td>
                                           </tr>
                                           <tr>
                                               <th>Владелец карты</th>
                                               <td>{{ $salary_card->owner }}</td>
                                           </tr>
                                           <tr>
                                               <th>Телефон</th>
                                               <td>+{{ $salary_card->phone }}</td>
                                           </tr>
                                           <tr>
                                               <th>СМС</th>
                                               <td>{{ $salary_card->sms ? "Карта активна, подключено смс уведомление." : "Карта неактивна" }}</td>
                                           </tr>
                                           <tr>
                                               <th>Статус</th>
                                               <td>{{ $salary_card->is_active ? 'Активный' : 'Не активный' }}</td>
                                           </tr>
                                           <tr>
                                               <th>Тип</th>
                                               <td>{{ $salary_card->card_type }}</td>
                                           </tr>
                                           <tr>
                                               <th>Bank</th>
                                               <td>{{ $salary_card->bank }}</td>
                                           </tr>
                                           <tr>
                                               <th>Время_создания</th>
                                               <td>{{ $salary_card->created_at }}</td>
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
                       @endforeach
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
        function openWallet(client_id){
            $.ajax({
                url: '/admin/client/wallet-create',
                type: "post",
                data: {
                    _token: "{{ csrf_token() }}",
                    client_id: client_id,
                },
                success:function (result) {
                    location.reload();
                    console.log(result);
                },
                error:function (err) {
                    console.log(err);
                }
            })
        }
    </script>
@endsection