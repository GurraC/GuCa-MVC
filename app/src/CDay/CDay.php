<?php
/**
* CDay.php
* A class that simulate one day of a calendar.
* @author Gunnar Carlsson, gc@agx.se
* @copyright Gunnar Carlsson 2014
*/
namespace Mos\CDay;
class CDay {
	private $currentDate;
	private $pColor;
	private $tdColor;
			
	/**
	* Constructor.
	*/
	public function __construct($currentDate,$month){
		$this->currentDate=$currentDate;
		
		if (date('N',$currentDate)==7) {
			$this->pColor='style="color:#f00;"';}
		elseif (date('n',$currentDate)!=$month) {
			$this->pColor='style="color:#aaa;"';}
			
		if ($currentDate==strtotime(date('Y-m-d'))) {
			$this->tdColor='style="background-color: #CCF"';}
	}

	/**
	* Function preparing the HTML output
	*/
	private function dayToHTML() {
		$html='<td class="cal" '.$this->tdColor.'><p class="cal" '.$this->pColor.'>'.date('d',$this->currentDate).'</p></td>';
		return $html;
	}
	
	/**
	* Function returning the day as HTML
	*/
	public function getDay(){
		return $this->dayToHTML();
	}
	
	/**
	* Function returning the weeknumber of this day
	*/
	public function getWeekNr(){
		return date('W',$this->currentDate);
	}


}
?>


