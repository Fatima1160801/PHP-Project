<?php
/**
 * Created by PhpStorm.
 * User: Khaled Al-Haj Salem
 * Date: 10/18/2018
 * Time: 8:53 AM
 */

namespace App\Helpers;
use Illuminate\Support\Facades\Auth;
use DB;
use DateTime;

class Log
{

    private static $instance = null;
    private $requestObjectFields = null;
    private $databaseObjectFields = null;
    private $trans_type_id = null;
    private $primary_id = null;
    private $action_type = null;
    private $trans_amount = null;
    private $screen_id = null;
    private $trans_cur = null;
    private $action_types = [1,2,3];

    private function __construct()
    {
    }

    public static function instance()
    {
        if(!self::$instance)
        {
            self::$instance = new Log();
        }
        return self::$instance;
    }


    public function record($trans_type_id,$primary_id,$screen_id=null,$trans_amount=null,$trans_cur=null,$requestObjectFields=null,$databaseObjectFields=null)
    {
        $this->trans_type_id = $trans_type_id;
        $this->primary_id = $primary_id;
        $this->screen_id = $screen_id;
        $this->trans_amount = $trans_amount;
        $this->trans_cur = $trans_cur;
        $this->requestObjectFields = $requestObjectFields;
        $this->databaseObjectFields = $databaseObjectFields;
        $this->action_type = DB::table('c_trans_log_types')->where('id',$trans_type_id)->pluck('trans_type');
    }


    public function save()
    {
        $trans_string = ['na' => '','fo' => ''];

        if(in_array($this->action_type[0],$this->action_types))
        {
            switch($this->action_type[0])
            {
                case 1:
                    $trans_string = ['na' => '','fo' => ''];
                    break;
                case 2:
                    if(!empty($this->requestObjectFields)){
                    foreach($this->requestObjectFields as $key => $value)
                    {
                        if(isset($this->databaseObjectFields->$key))
                        {
                            if(strlen((string)$this->databaseObjectFields->$key) <= 30)
                            {
                                if(DateTime::createFromFormat('d/m/Y', $value))
                                {
                                    $value = str_replace('/', '-', $value);
                                    $value = date('Y-m-d H:i:s',strtotime($value));
                                }
                                if($this->databaseObjectFields->$key != $value)
                                {
                                    //$trans_string = ['na' => 'updates : ','fo' => 'تم تعديل : '];
                                    //$trans_string['na'] .= $this->logTransNote($key,$this->databaseObjectFields->$key,$value)['na'];
                                    //$trans_string['fo'] .= $this->logTransNote($key,$this->databaseObjectFields->$key,$value)['fo'];
                                } else {
                                    $trans_string['na'] .= '';
                                    $trans_string['fo'] .= '';
                                }
                            }
                        }
                    }
                    }
                    break;
                case 3:
                    $trans_string = ['na' => '','fo' => ''];
                    break;
            }


            DB::table('trans_logs')->insert([
                'trans_type_id' => $this->trans_type_id,
                'user_id' => Auth::id(),
                'screen_id' => $this->screen_id,
                'primary_id' => $this->primary_id,
                'trans_date' => date('Y-m-d H:i:s'),
                'trans_amount' => $this->trans_amount,
                'curr_id' => $this->trans_cur,
                'trans_note_na' => $trans_string['na'],
                'trans_note_fo' => $trans_string['fo']
            ]);

        }

    }


    private function logTransNote($column,$value_from,$value_to)
    {
        $trans_string = [];
        $trans_string['na'] = $column . ' from ' . $value_from . ' to '.$value_to . ' , ';
        $trans_string['fo'] = $column . ' من ' . $value_from . ' إلى '.$value_to . ' , ';

        return $trans_string;
    }

}