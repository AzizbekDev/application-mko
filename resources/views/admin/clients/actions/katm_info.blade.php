@if (!is_null($info->info) && !is_null($info->info->info))
    @php $data = json_decode($info->info->info, true) @endphp
    <div class="modal fade" id="modal_katm_{{ $info->id }}" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg test" role="document">
            <div class="modal-content" id="katm">
                <div class="modal-header">
                    <h6 class="modal-title text-bold ml-auto">"КРЕДИТ-АХБОРОТ ТАХЛИЛИЙ МАРКАЗИ" КРЕДИТ БЮРОСИ</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body" id="printThis">
                    <div class="row">
                        <table class="table table-bordered table-sm">
                        <caption style="caption-side:top;text-align:center;padding:0;">
                            <p class="text-info">ИНФОРМАЦИЯ ОБ ОБРАЩЕНИЯХ СУБЪЕКТА</p>
                        </caption>
                            @if (array_key_exists('client', $data['report']))
                                <thead>
                                <tr>
                                    <th scope="col">№</th>
                                    <th scope="col">ТИП ИНФОРМАЦИИ</th>
                                    <th scope="col">ИНФОРМАЦИЯ</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($data['report']['client'] as $key => $client)
                                    <tr>
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <th class="text-left" scope="row">{{ trans('print.client.'.$key) }}</th>
                                        <th class="text-left" scope="row">{{ $client }}</th>
                                    </tr>
                                @endforeach
                                </tbody>

                            @else
                                <hr><p class="text-center">Нет данных</p><hr>
                            @endif
                        </table>
                    </div>
                    <div class="row text-center">
                        @if (array_key_exists('subject_claims', $data['report']))
                            <table class="table table-bordered table-sm">
                                <caption style="caption-side:top;text-align:center;padding:0;">
                                    <p class="text-info ml-auto">ИНФОРМАЦИЯ ОБ ОБРАЩЕНИЯХ СУБЪЕКТА</p>
                                </caption>
                                <thead>
                                <tr>
                                    <th scope="col">№</th>
                                    <th scope="col">ТИП ОРГАНИЗАЦИИ</th>
                                    <th scope="col">КОЛИЧЕСТВО ЗАЯВОК</th>
                                    <th scope="col">КОЛИЧЕСТВО ОТКЛОНЕНИЙ</th>
                                    <th scope="col">КОЛИЧЕСТВО ДОГОВОРОВ</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($data['report']['subject_claims'] as $key => $subject)
                                    <tr>
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <th scope="row">{{ $subject['org_type'] }}</th>
                                        <th scope="row">{{ $subject['claims_qty'] }}</th>
                                        <th scope="row">{{ $subject['rejected_qty'] }}</th>
                                        <th scope="row">{{ $subject['granted_qty'] }}</th>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        @endif
                    </div>
                    <div class="row text-center">
                        @if (array_key_exists('claims_information', $data['report']))
                            <table class="table table-bordered table-sm">
                                <caption style="caption-side: top;text-align: center;padding: 0;">
                                    <p class="text-info">ИНФОРМАЦИЯ ПО КРЕДИТНЫМ ЗАЯВКАМ</p>
                                </caption>
                                <thead>
                                <tr>
                                    <th scope="col">№</th>
                                    <th scope="col">Кредитная организация</th>
                                    <th scope="col">Дата и номер кредитной заявки</th>
                                    <th scope="col">Дата и номер согласия заемщика</th>
                                    <th scope="col">Наличие сведений кредитной организации о кредитном договоре
                                        (дата и номер)</th>
                                    <th scope="col">Дата окончания кредитного договора</th>
                                    <th scope="col">Класс качества</th>
                                    <th scope="col">Сумма всех видов непогашенных обязательств</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($data['report']['claims_information'] as $claims)
                                    @foreach ($claims as $claim)
                                        <tr>
                                            <th scope="row">{{ $loop->iteration }}</th>
                                            <th scope="row">{{ $claim['org_name'] ?? '-' }}</th>
                                            <th scope="row">{{ $claim['claim_date_number'] ?? '-' }}</th>
                                            <th scope="row">{{ $claim['agreement_date_number'] ?? '-' }}</th>
                                            <th scope="row">{{ $claim['credit_date_number'] ?? '-' }}</th>
                                            <th scope="row">{{ $claim['credit_end_date'] ?? '-' }}</th>
                                            <th scope="row">{{ $claim['credit_quality'] ?? '-' }}</th>
                                            <th scope="row">{{ $claim['credit_debt'] ?? '-' }}</th>
                                        </tr>
                                    @endforeach
                                @endforeach
                                </tbody>
                            </table>
                        @endif
                    </div>
                    <div class="row">
                        <table class="table table-bordered table-sm">
                            <caption style="caption-side: top;text-align: center;padding: 0;">
                                <p class="text-info">ПРОСРОЧЕННЫЕ ПЛАТЕЖИ ПО ССУДНЫМ СЧЕТАМ</p>
                            </caption>
                            @if (array_key_exists('overdue_payments', $data['report']))
                                <thead>
                                <tr>
                                    <th scope="col">Месяц/год</th>
                                    <th scope="col">Сумма срочной задолженности на начало месяца</th>
                                    <th scope="col">Сумма просроченного платежа</th>
                                    <th scope="col">Остаток срочной задолженности на конец месяца</th>
                                    <th scope="col">Сумма просроченного процента</th>
                                    <th scope="col">Сумма просроченных платежей</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if (array_key_exists('overdue_contract', $data['report']['overdue_payments']) && $data['report']['overdue_payments']['overdues_exist'])
                                    @foreach ($data['report']['overdue_payments']['overdue_contract'] as $overdue)
                                        <tr class="text-center table-info">
                                            <th scope="row" colspan=6 class="text-orange text-center">
                                                {{ 'Наличие сведений кредитной организации о кредитном договоре №: ' . $overdue['id_contract'] }}
                                            </th>
                                        </tr>
                                        @foreach ($overdue['overdue'] as $item)
                                            <tr class="@if($item['overdue_percent'] > 0) text-danger @endif">
                                                <th scope="row">{{ $item['month'] ?? '-' }}</th>
                                                <th scope="row">{{ $item['begin_sum'] ?? '0' }}</th>
                                                <th scope="row">{{ $item['overdue_sum'] ?? '0' }}</th>
                                                <th scope="row">{{ $item['total_overdue'] ?? '0' }}</th>
                                                <th scope="row">{{ $item['end_sum'] ?? '0' }}</th>
                                                <th scope="row">{{ $item['overdue_percent'] ?? '0' }}</th>
                                            </tr>
                                        @endforeach
                                    @endforeach
                                @else
                                    <hr><p class="text-center">Нет данных</p><hr>
                                @endif
                                </tbody>
                            @endif
                        </table>
                    </div>
                    <div class="row text-info">
                        <div class="col">@lang('print.cred_nagruzka')</div>
                        <div class="col">{{ price_format($data['report']['cred_nagruzka']).' СУМ' }} / Месяц</div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
                    <button onclick="printModel('#katm')" type="button" class="btn btn-default">Print</button>
                </div>
            </div>
        </div>
    </div>
@endif
