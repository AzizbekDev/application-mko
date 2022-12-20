<?php
namespace App\Traits\Scoring;

trait CreditScoring
{
    static $granted_limit              = 2;
    static $rejected_limit             = 5;
    static $overdue_month_limit        = 0;
    static $percentage_overdue_score   = 10;
    static $substandart_credit_quality = 'Субстандартный';
    static $standart_credit_quality    = 'Стандартный';
    static $credit_debit_sum           = 300000000;
    static $error                      = false;
    static $result                     = [];
    static $result_detail              = [];

    static $org_type_for_check = ['Лизинговая компания','Микрокредитная организация','Ломбард'];
    static $scoring_steps      = ['subject_claims', 'claims_information', 'overdue_payments','client'];

    public function scoring($data)
    {
        $this->subject_claims();
        $this->claims_information();
        return $this->result_detail;
    }

    // scoring step - 1
    public function subject_claims($data)
    {
        $subjects     = $data->subject_claims;
        self::$result_detail['subject_claims'] = [
            'result' => true
        ];
        return self::$result_detail;
    }
}