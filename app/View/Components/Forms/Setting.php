<?php

namespace App\View\Components\Forms;

use Illuminate\View\Component;
use App\Models\Setting as SettingModel;
use Illuminate\Support\Collection;
use View;

class Setting extends Component
{
    public $setting;
    public $inputs;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(SettingModel $setting)
    {
        $this->setting  = $setting;
        $this->inputs   = new Collection();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Closure
     */
    public function render()
    {
            if(!empty($this->setting->value)){
                $data = json_decode($this->setting->value);
                foreach ($data as $key => $value){
                    $this->inputs->push([
                        'label' => mb_strtoupper($key),
                        'name'  => $key,
                        'value' => $value
                    ]);
                }
                return View::make('admin.settings.templates.form',[
                    'inputs' => $this->inputs->toArray()
                ]);
            }
            return View::make('admin.settings.templates.form');
    }
}
