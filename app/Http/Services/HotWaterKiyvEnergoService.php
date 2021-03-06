<?php
/**
 * Created by IntelliJ IDEA.
 * User: Artem
 * Date: 07.12.2015
 * Time: 11:55
 */

namespace App\Http\Services;

class HotWaterKiyvEnergoUserInfo
{
    /**
     * @var
     * true if you have dryer for towel
     * false otherwise
     */
    public $dryer;

    /**
     * @var
     * float between 0.0 and 1.0,
     * this value describe discount for this vendor
     */
    public $relief;

    /**
     * @var
     * integer contains number of energy you have with discount
     * which contains in relief variable
     */
    public $numOfReliefHotWater;

    public function __construct()
    {
        $this->dryer = true;
        $this->relief = 0.0;
        $this->numOfReliefHotWater = 0.0;
    }
    public function __construct1($dryer, $relief, $numOfReliefHotWater)
    {
        $this->dryer = $dryer;
        $this->relief = $relief;
        $this->numOfReliefHotWater = $numOfReliefHotWater;
    }

}

class HotWaterKiyvEnergoMonthInfo
{
    /**
     * @var
     * value on your electricity counter that month (in kW*hours)
     */
    public $counter_value;

    /**
     * @var
     * value of money you paid that month
     */
    public $paid_value;


    public function __construct()
    {
        $this->counter_value = 0.0;
        $this->paid_value = 0.0;
    }

    /**
     * HotWaterKiyvEnergoMonthInfo constructor.
     * @param $counter_value
     * @param $paid_value
     */
    public function __construct1($counter_value, $paid_value)
    {
        $this->counter_value = $counter_value;
        $this->paid_value = $paid_value;
    }


}

class HotWaterKiyvEnergoService extends BasicService
{
    const SERVICE_ALIAS = "HotWater";
    const SERVICE_NAME = "Горячее водоснабжение";
    const VENDOR_ALIAS = "KiyvEnergo";
    const VENDOR_NAME = "КиевЭнерго";

    const COST_WITH_DRYER = 40.92;
    const COST_WITHOUT_DRYER = 37.91;

    private $user_info;

    public function __construct()
    {
        $this->user_info = new HotWaterKiyvEnergoUserInfo();
    }

    public function __construct1(HotWaterKiyvEnergoUserInfo $userInfo)
    {
        $this->user_info = $userInfo;
    }

    public function layout()
    {
        // TODO: Implement layout() method.
    }

    public function info()
    {
        // TODO: Implement info() method.
    }

    public function create_user_info()
    {
        // TODO: Implement create_user_info() method.
    }

    /**
     * @param $info_array
     * the first element is counter value of previous month
     * the second value is counter value of current month
     * @return int
     */
    public function calculate($info_array)
    {
        if($info_array[0] && $info_array[1] && $info_array[0] = (int)$info_array[0] && $info_array[1] = (int)$info_array[1])
        {
            $diff = $info_array[1] - $info_array[0] - $this->user_info->numOfReliefHotWater * $this->user_info->relief;
            $cost = 0.0;
            if($this->user_info->dryer)
            {
                $cost = $diff * self::COST_WITH_DRYER;
            }
            else
            {
                $cost = $diff * self::COST_WITHOUT_DRYER;
            }
            return $cost;
        }
        else
        {
            return -1;
        }
    }


}