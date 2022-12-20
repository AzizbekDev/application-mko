<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KatmScoring extends Model
{
    protected $fillable = [
        "pinfl",
        "firstname",
        "lastname",
        "middlename",
        "phone",
        "birth_date",
        "region",
        "city",
        "passport",
        "passport_given_date",
        "type",
        "html",
        "status",
        'request_id'
    ];

    public function sendRequest()
    {
        $curl = new RequestController();
        $request = [
            "pin"  => $this->pinfl,
            "first_name"  => $this->firstname,
            "last_name"  => $this->lastname,
            "middle_name"  => $this->middlename,
            "phone"  => $this->phone,
            "extra_phone"  => $this->phone,
            "birth_date"  => date('d.m.Y',strtotime($this->birth_date)),
            "region_name"  => $this->region,
            "city_name"  =>$this->city,
            "passport_seria"  => substr($this->passport,0,2),
            "passport_number"  => substr($this->passport,-7),
            "passport_given_date"  => date('d.m.Y',strtotime($this->passport_given_date)),
            "type"  => 21,
        ];

        $response = $curl->post('https://api.abrand.uz/partner/katm/create-request',
            json_encode($request,128),
            ['x-access-token: '.env('KATM_TOKEN',null)],
            1);

        $this->request_id = -1;
        $this->status = -1;
        if (isset($response['status']) && $response['status'] && isset($response['data']))
        {
            $data = $response['data'];
            $this->request_id = $data['request_id'] ?? -1;
            $this->status = $data['status_id'] ?? -1;

            if (isset($data['data']))
                $this->html = $data['data'];
        }
        $this->save();
        return $response;
    }

    public function getRequest()
    {
        $response = [
            'status' => 0,
            'message' => 'Request id not found'
        ];
        if ($this->request_id != -1)
        {
            $curl = new RequestController();
            $response = $curl->get("https://api.abrand.uz/partner/katm/get-request",
                ['request_id' => $this->request_id],
                ['x-access-token: '.env('KATM_TOKEN',null)],
                1);

            if (isset($response['status']) && $response['status'] && isset($response['data']))
            {
                $data = $response['data'];
                $this->request_id = $data['request_id'] ?? -1;
                $this->status = $data['status_id'] ?? -1;

                if (isset($data['data']))
                    $this->html = $data['data'];
                $this->save();
            }
        }
        if ($this->request_id == -1)
        {
            return $this->sendRequest();
        }
        return $response;
    }

    public function fio()
    {
        return "$this->lastname $this->firstname $this->middlename";
    }

    public static function deepFilters(){

        $tiyin = [
            'total_credit' => true,
            'total_debit' => true,
            'balance' => true,
            'summ_claim' => true,
            'current_debit' => true
        ];

        $obj = new self();
        $request = request();

        $query = self::where('id','!=','0');

        foreach ($obj->fillable as $item) {
            //request operator key
            $operator = $item.'_operator';

            if ($request->has($item) && $request->$item != '')
            {
                if (isset($tiyin[$item])){
                    $select = $request->$item * 100;
                    $select_pair = $request->{$item.'_pair'} * 100;
                }else{
                    $select = $request->$item;
                    $select_pair = $request->{$item.'_pair'};
                }
                //set value for query
                if ($request->has($operator) && $request->$operator != '')
                {
                    if (strtolower($request->$operator) == 'between' && $request->has($item.'_pair') && $request->{$item.'_pair'} != '')
                    {
                        $value = [
                            $select,
                            $select_pair];

                        $query->whereBetween($item,$value);
                    }
                    elseif (strtolower($request->$operator) == 'wherein')
                    {
                        $value = explode(',',str_replace(' ','',$select));
                        $query->whereIn($item,$value);
                    }
                    elseif (strtolower($request->$operator) == 'like')
                    {
                        if (strpos($select,'%') === false)
                            $query->where($item,'like','%'.$select.'%');
                        else
                            $query->where($item,'like',$select);
                    }
                    else
                    {
                        $query->where($item,$request->$operator,$select);
                    }
                }
                else
                {
                    $query->where($item,$select);
                }
            }
        }

        if ($request->has('phone') && $request->phone != '')
        {
            $phones = Phone::select('passport_id')
                ->where('phone','like',"%$request->phone%")
                ->get();

            if ($phones->isNotEmpty())
            {
                $query->whereIn('pinfl',$phones->map(function ($phone){
                    return $phone->pinfl;
                }));
            }

        }

        return $query;
    }

    public function getStatus()
    {
        $statuses = [
            "0" => "Новый",
            "1" => "Ожидание",
            "10" => "Проверка",
            "20" => "ОК"
        ];

        return $statuses[$this->status] ?? 'Undefined';
    }
}
