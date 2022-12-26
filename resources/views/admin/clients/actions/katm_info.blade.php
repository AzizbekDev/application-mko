@if(!is_null($info->report))
    <div class="modal-content">
        <div class="modal-header">
            {{--        <button id="btnPrint" type="button" class="pull-left btn btn-default">Print</button>--}}
            <h4 class="modal-title text-center">"КРЕДИТ-АХБОРОТ ТАХЛИЛИЙ МАРКАЗИ" КРЕДИТ БЮРОСИ
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </h4>
        </div>
        <div class="modal-body">
            <div class="row text-center">
                <p class="text-red">ИНФОРМАЦИЯ ОБ ОБРАЩЕНИЯХ СУБЪЕКТА</p>
                <table class="table table-bordered table-sm">
                    @if(array_key_exists('client',$info->report))
                        <thead>
                        <tr>
                            <th scope="col">№</th>
                            <th scope="col">ТИП ИНФОРМАЦИИ</th>
                            <th scope="col">ИНФОРМАЦИЯ</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($info->report->client as $key => $client)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <th scope="row">{{ $key }}</th>
                                <th scope="row">{{ $client }}</th>
                            </tr>
                        @endforeach
                        </tbody>
                    @else
                        <hr></he><p>No data</p><hr>
                    @endif
                </table>
            </div>
            <div class="row text-center">
                @if(array_key_exists('subject_claims',$info->report))
                    <p class="text-red">ИНФОРМАЦИЯ ОБ ОБРАЩЕНИЯХ СУБЪЕКТА</p>
                    <table class="table table-bordered table-sm">
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
                        @foreach($info->report->subject_claims as $key => $subject)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <th scope="row">{{ $subject->org_type }}</th>
                                <th scope="row">{{ $subject->claims_qty }}</th>
                                <th scope="row">{{ $subject->rejected_qty }}</th>
                                <th scope="row">{{ $subject->granted_qty }}</th>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
            <div class="row text-center">
                @if(array_key_exists('claims_information',$info->report))
                    <p class="text-red">ИНФОРМАЦИЯ ПО КРЕДИТНЫМ ЗАЯВКАМ</p>
                    <table class="table table-bordered table-sm">
                        <thead>
                        <tr>
                            <th scope="col">№</th>
                            <th scope="col">Кредитная организация</th>
                            <th scope="col">Дата и номер кредитной заявки</th>
                            <th scope="col">Дата и номер согласия заемщика</th>
                            <th scope="col">Наличие сведений кредитной организации о кредитном договоре (дата и номер)</th>
                            <th scope="col">Дата окончания кредитного договора</th>
                            <th scope="col">Класс качества</th>
                            <th scope="col">Сумма всех видов непогашенных обязательств</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($info->report->claims_information as $claims)
                            @foreach($claims as $claim)
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <th scope="row">{{ $claim->org_name ?? '-' }}</th>
                                    <th scope="row">{{ $claim->claim_date_number ?? '-'}}</th>
                                    <th scope="row">{{ $claim->agreement_date_number ?? '-'}}</th>
                                    <th scope="row">{{ $claim->credit_date_number ?? '-'}}</th>
                                    <th scope="row">{{ $claim->credit_end_date ?? '-'}}</th>
                                    <th scope="row">{{ $claim->credit_quality ?? '-'}}</th>
                                    <th scope="row">{{ $claim->credit_debt ?? '-'}}</th>
                                </tr>
                            @endforeach
                        @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
            <div class="row text-center">
                <p class="text-red">ПРОСРОЧЕННЫЕ ПЛАТЕЖИ ПО ССУДНЫМ СЧЕТАМ</p>
                <table class="table table-bordered table-sm">
                    @if(array_key_exists('overdue_payments',$info->report))
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
                        @if(array_key_exists('overdue_contract',$info->report->overdue_payments))
                            @php
                                if(!empty($info)){
                                    if(is_object($info->report->overdue_payments->overdue_contract))
                                        $overdue_contracts[] = $info->report->overdue_payments->overdue_contract;
                                    else
                                        $overdue_contracts = $info->report->overdue_payments->overdue_contract;
                                    }
                            @endphp
                            @foreach($overdue_contracts as $overdue)
                                <tr class="text-center table-info">
                                    <th scope="row" colspan=6 class="text-orange text-center">
                                        {{ "Наличие сведений кредитной организации о кредитном договоре №: ".$overdue->id_contract }}
                                    </th>
                                </tr>
                                @foreach($overdue->overdue as $item)
                                    <tr>
                                        <th scope="row">{{ $item->month ?? '-' }}</th>
                                        <th scope="row">{{ $item->begin_sum ?? '0' }}</th>
                                        <th scope="row">{{ $item->overdue_sum  ?? '0'}}</th>
                                        <th scope="row">{{ $item->total_overdue ?? '0'}}</th>
                                        <th scope="row">{{ $item->end_sum ?? '0'}}</th>
                                        <th scope="row">{{ $item->overdue_percent ?? '0'}}</th>
                                    </tr>
                                @endforeach
                            @endforeach
                        @else
                            <tr><th scope="row" class="text-center">No overdue payment details</th></tr>
                        @endif
                        </tbody>
                    @else
                        <tbody>
                        <tr>
                            <th scope="row" class="text-center">No overdue payments</th>
                        </tr>
                        </tbody>
                    @endif
                </table>
            </div>
        </div>
        <div class="modal-footer">
            <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
            <button id="btnPrint" type="button" class="btn btn-default">Print</button>
        </div>
    </div>
@else
    <div class="row justify-content-center">
        <p>Kredit ma'lumotlari kelmagan</p>
    </div>
@endif
