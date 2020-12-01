<?php

namespace App\Services;

class TradeService {

  /**
  * Calculate and format Available value
  * @param int $quantity
  * @param int $current_price
  * @return int Calculated and Rounded to 2
  */
  function calculateAvailable($quantity, $current_price)
  {
    return round($quantity*$current_price, 2);
  }
  /**
   * Calculate and format Paid value
   * @param int $quantity
   * @param int $open_price
   * @return int Calculated and Formated
   */
  function calculatePaid($quantity, $open_price)
  {
    return round($quantity*$open_price, 2);
  }
  /**
   * Calculate and format Profit value
   * @param int $quantity
   * @param int $current_price
   * @param int $open_price
   * @return int Calculated and Formated
   */
  function calculateProfit($quantity, $current_price, $open_price)
  {
    return round((($quantity*$current_price)-($quantity*$open_price)), 2);
  }
  
}