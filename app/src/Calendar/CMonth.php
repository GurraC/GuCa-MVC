<?php
/**
* CMonth.php
* A class that simulate a month.
* @author Gunnar Carlsson, gc@agx.se
* @copyright Gunnar Carlsson 2014
*/
namespace Mos\Calendar;
class CMonth {
	
	private $monthName;
	private $monthId;
	private $numberOfDays;
	private $dayOfWeek;
	private $currentDate;
	private $monthArray = array();
	private $weekdays = array('Mon','Tue','Wed','Thu','Fri','Sat','Sun');

			
	/**
	* Constructor.
	*/
	public function __construct($currentDate){
		$this->monthName = date('F - Y',$currentDate);
		$this->monthId = date('n',$currentDate);
		$this->numberOfDays = date('t',$currentDate);
		$this->dayOfWeek = date('N',$currentDate);
		$this->currentDate=strtotime('-'.($this->dayOfWeek-1).' day',$currentDate);
	}
	
	/**
	* Function that creates a month as an array of CDay objects
	*/
	private function createMonth() {
		for ($i=0; $i<($this->numberOfDays+$this->dayOfWeek-1); $i++) {
			$this->monthArray[$i] = new CDay($this->currentDate,$this->monthId);
			$this->currentDate = strtotime('+1 day',$this->currentDate);
		}
	}
	
	
	
	/**
	* Function preparing the HTML output
	*/
	private function monthToHTML() {
		$html='<table class="cal"><tr><td></td>';
		
		foreach ($this->weekdays as $wd) {
			$html=$html.'<td class="wd">'.$wd.'</td>';
		}
		
		$html=$html.'</tr><tr>';
		
		for ($i=1; $i<=count($this->monthArray);$i++){
			if (($i-1)%7==0) {
				$html=$html.'<td class="wd">'.$this->monthArray[$i-1]->getWeekNr().'</td>';
			}
			$html=$html.$this->monthArray[$i-1]->getDay();
			if ($i%7==0) {
				$html=$html.'</tr>';
				if ($i!=count($this->monthArray)) {
				$html=$html.'<tr>';}
			}
		}
		$html=$html.'</tr></table>';
		return $html;
	}

	/**
	* Function returning the month as HTML
	*/
	public function getMonth(){
		$this->createMonth();
		return $this->monthToHTML();
	}
	
	/**
	* Function returning the name of the month (january - 2014, february - 2014 etc)
	*/
	public function getMonthName(){
		return $this->monthName;
	}
	
	/**
	* Function returning the number of the month
	*/
	public function getMonthId(){
		return $this->monthId;
	}


}
?>


