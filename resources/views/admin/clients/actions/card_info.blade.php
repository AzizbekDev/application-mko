@if(!is_null($salary_card))
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
@else
<div class="row justify-content-center">
    <p>Информация о карте не найдена</p>
</div>
@endif