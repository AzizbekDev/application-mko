@if(!is_null($tax_info))
<div class="modal fade" id="modal_tax_{{$tax_info->id}}" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content" id="tax">
            <div class="modal-header">
                <h6 class="modal-title">Налоговая информация</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table">
                    <caption style="caption-side: top; text-align: center;">
                        <span class="text-info">Общая информация</span>
                    </caption>
                    <thead>
                    <tr>
                        <th>№ Заявка</th>
                        <th>Серийный Номер</th>
                        <th>Пинфл</th>
                        <th>ИНН</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>{{ $tax_info->application_id }}</td>
                        <td>{{ $tax_info->serial_number }}</td>
                        <td>{{ $tax_info->pinfl }}</td>
                        <td>{{ $tax_info->tin }}</td>
                    </tr>
                    </tbody>
                </table>
                @if(!is_null($tax_info->details))
                    @foreach($tax_info->details->groupBy('company_tin') as $details)
                    <table class="table">
                        <caption style="caption-side: top; text-align: center;">
                            <span class="text-info">{{ $details->first()->company_name }}&nbsp;</span>
                            <span class="text-muted">ИНН: {{ $details->first()->company_tin }}</span>
                        </caption>
                        <thead>
                        <tr>
                            <th width="10px;">№</th>
                            <th>Год</th>
                            <th>Месяц</th>
                            <th>Зарплата</th>
                            <th>Сумма налога</th>
                            <th>Сумма ИНПС</th>
                            <th>Зарплата на руке</th>
                        </tr>
                        </thead>
                        <tbody>
                         @foreach($details as $key => $detail)
                             <tr>
                                <td>{{ $key+1 }}</td>
                                <td>{{ $detail->year }}</td>
                                <td>{{ \Carbon\Carbon::create()->month($detail->period)->format('M') }}</td>
                                <td>{{ price_format($detail->salary) }}</td>
                                <td>{{ price_format($detail->salary_tax_sum) }}</td>
                                <td>{{ $detail->inps_sum }}</td>
                                <td>{{ price_format($detail->salary - $detail->salary_tax_sum) }}</td>
                             </tr>
                         @endforeach
                        </tbody>
                    </table>
                    @endforeach
                @else
                    <div class="row text-center">
                        <p>Информационные данные пусты</p>
                    </div>
                @endif
            </div>
            <div class="modal-footer">
                <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
                <button onclick="printModel('#tax')" type="button" class="btn btn-default">Print</button>
            </div>
        </div>
    </div>
</div>
@endif