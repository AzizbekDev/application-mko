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
                                                       <i class="fa fa-edit text-info" data-toggle="modal" data-target="#changeStatusApp"></i> Изменить статус
                                                   </a>
                                                   <div class="modal fade" id="changeStatusApp" style="display: none;" aria-hidden="true">
                                                           <div class="modal-dialog">
                                                               <div class="modal-content">
                                                                   <div class="modal-header">
                                                                       <h4 class="modal-title">Изменить статус</h4>
                                                                       <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                           <span aria-hidden="true">×</span>
                                                                       </button>
                                                                   </div>
                                                                   <form action="{{ route('admin.clients.status.change') }}" method="post"> @csrf
                                                                       <div class="modal-body">
                                                                           <div class="form-group">
                                                                               <label for="clientId">Client ID</label>
                                                                               <input type="text" name="client_id" class="form-control" id="clientId" readonly value="{{ $client->id }}">
                                                                           </div>
                                                                           <div class="form-group">
                                                                               <label for="statusApp">Статус</label>
                                                                               <select name="status_id" class="form-control" id="statusApp">
                                                                                   <option value="0" @if($client->status_app_id == 0) selected @else disabled @endif>New</option>
                                                                                   <option value="1" @if($client->status_app_id == 1) selected @endif>Viewed</option>
                                                                                   <option value="2" @if($client->status_app_id == 2) selected @endif>Approve</option>
                                                                                   <option value="3" @if($client->status_app_id == 3) selected @endif>Reject</option>
                                                                                   <option value="4" @if($client->status_app_id == 4) selected @endif>Block</option>
                                                                               </select>
                                                                           </div>
                                                                       </div>
                                                                       <div class="modal-footer justify-content-between">
                                                                           <button type="button" class="btn btn-default" data-dismiss="modal">Отменит</button>
                                                                           <button type="submit" class="btn btn-success">Сохранить</button>
                                                                       </div>
                                                                   </form>
                                                               </div>

                                                           </div>

                                                       </div>
                                                   <a class="btn btn-app bg-light">
                                                       <i class="fa fa-times-circle text-danger" onclick="rejectClient({{ $client->id }})"></i> Отклонять
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
                                    <td class="v-a" id="balance_{{$salary_card->id }}">{{ $salary_card->balance ?? 0 }}&nbsp;UZS</td>
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
               </div>
           </div>
           <div class="col-md-12">
               <div class="card">
                   <div class="card-header">
                       <h3 class="card-title">Налоговая информация</h3>
                   </div>
                   <div class="card-body">
                       <table class="table table-bordered text-center">
                           <thead>
                           <tr>
                               <th width="10px;">#</th>
                               <th>Серийный номер паспорта</th>
                               <th>ИНН</th>
                               <th>Пинфл</th>
                               <th>Средняя зарплата</th>
                               <th>Статус</th>
                               <th width="40px;">Действие</th>
                           </tr>
                           </thead>
                           <tbody>
                           @if($tax_info)
                           <tr id="row_{{ $tax_info->id }}">
                               <td>{{ $tax_info->id }}</td>
                               <td>{{ $tax_info->serial_number }}</td>
                               <td>{{ $tax_info->tin }}</td>
                               <td>{{ $tax_info->pinfl }}</td>
                               <td class="text-info">{{ price_format($tax_info->average_salary ?? 0) }}&nbsp;UZS</td>
                               <td class="v-a {{ ($tax_info->status_id == 1) ? 'text-success' : 'text-danger' }}">
                                   {{ $tax_info->status_name }}
                               </td>
                               <td class="v-a">
                                   <div class="btn-group pb-1">
                                       <button type="button" class="btn btn-sm btn-success update">
                                           <i class="fa fa-sync"></i>
                                       </button>
                                       <button type="button" class="btn btn-sm btn-info" data-toggle="modal" data-target="#modal_tax_{{$tax_info->id}}">
                                           <i class="fa fa-eye"></i>
                                       </button>
                                       @include('admin.clients.actions.tax_info', $tax_info)
                                   </div>
                               </td>
                           </tr>
                           @else
                               <p>Tax Info Not Found</p>
                           @endif
                           </tbody>
                       </table>
                   </div>
               </div>
           </div>
           <div class="col-md-12">
               <div class="card">
                   <div class="card-header">
                       <h3 class="card-title">Кредитная информация</h3>
                   </div>
                   <div class="card-body">
                       <table class="table table-bordered text-center">
                           <thead>
                           <tr>
                               <th width="10px;">#</th>
                               <th>Уникальный номер</th>
                               <th>ФИО</th>
                               <th>Дата подачи заявки</th>
                               <th>Уникальный номер (БЮРО)</th>
                               <th>Статус</th>
                               <th width="40px;">Действие</th>
                           </tr>
                           </thead>
                           <tbody id="card_table_body aligin-middle">
                           <tr id="row_{{ $asoki_client->claim_id }}">
                               <td class="v-a">{{ $asoki_client->id }}</td>
                               <td class="v-a">{{ '+000'.$asoki_client->claim_id }}</td>
                               <td class="v-a">{{ $asoki_client->full_name }}</td>
                               <td class="v-a">{{ $asoki_client->claim_date }}</td>
                               <td class="v-a">{{ $asoki_client->katm_sir ?? 'Empty' }}</td>
                               <td class="v-a {{ ($asoki_client->status_id == 2) ? 'text-success' : 'text-danger' }}">
                                   {{ $asoki_client->status_name }}
                               </td>
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
       <!-- Card Modal -->
       @foreach($salary_cards as $salary_card)
           @include('admin.clients.actions.card_info', $salary_card)
       @endforeach
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
    function rejectClient(client_id){
        if(confirm('Вы хотите отменить заявку?')){
            $.ajax({
                url: '/admin/client/reject',
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
            });
        }
    }
</script>
@endsection