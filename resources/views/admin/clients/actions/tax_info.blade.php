@if(!is_null($tax_info))
<div class="modal fade" id="modal_tax_{{$tax_info->id}}" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
    <div class="modal-header">
        <h6 class="modal-title">Больше информации</h6>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
    </div>
    <div class="modal-body">
        @if(!is_null($tax_info->details))
            @foreach($tax_info->details->groupBy('company_tin') as $details)
            <table class="table">
                <caption style="caption-side: top;">{{ $details->first()->company_name }}</caption>
                <thead>
                <tr>
                    <th width="10px;">#</th>
                    <th>Год</th>
                    <th>Месяц</th>
                    <th>Сумма налога</th>
                    <th>Сумма ИНПС</th>
                    <th>Зарплата</th>
                </tr>
                </thead>
                <tbody>
                 @foreach($details as $key => $detail)
                     <tr>
                        <td>{{ $key+1 }}</td>
                        <td>{{ $detail->year }}</td>
                        <td>{{ \Carbon\Carbon::create()->month($detail->period)->format('M') }}</td>
                        <td>{{ price_format($detail->salary_tax_sum) }}</td>
                        <td>{{ $detail->inps_sum }}</td>
                        <td>{{ price_format($detail->salary) }}</td>
                     </tr>
                 @endforeach
                </tbody>
            </table>
            @endforeach
        @else
            <div class="row text-center">
                <p>Info details is empty</p>
            </div>
        @endif
    </div>
</div>
    </div>
</div>
@endif