<?php
/**
* Calendar.php
* A class that simulate a monthly calendar.
* @author Gunnar Carlsson, gc@agx.se
* @copyright Gunnar Carlsson 2014
*/
namespace Mos\Calendar;
class Calendar {
	
	private $currentDate;
	private $month;
	private $param;

			
	/**
	* Constructor.
	*/
	public function __construct(){
		if (!isset($_SESSION['currentdate'])) {
			$_SESSION['currentdate']=strtotime(date('Y-m-d'));}
		
		$this->buttonOnClick();
	}

	/**
	* Button clicks.
	*/
	private function buttonOnClick() {
		if (isset($_GET['btnPrev'])) {
			$this->currentDate = date('Y-m-d',strtotime("-1 month",$_SESSION['currentdate']));}
		else if(isset($_GET['btnNext'])) {
			$this->currentDate = date('Y-m-d',strtotime("+1 month",$_SESSION['currentdate']));}
		else {
			$this->currentDate = date('Y').'-'.date('n').'-01';}
		
		$this->saveSession();	
	}
	
	/**
	* Saves this session.
	*/
	private function saveSession(){
			$_SESSION['currentdate'] = strtotime($this->currentDate);
		}
	
	/**
	* Function returning style of the calendar param==true sidebarsize
	*/
	private function getStyle() {
		if ($this->param==true) {
			$html='<style scoped>
				table {margin-left:auto;margin-right:auto;}
				h1.cal {font-size:12px;float: none;}
				input[type=submit] {padding: 0px;font-size: 12px;margin: 0px;}
				table.cal {border: 1px solid;border-collapse: collapse;}
				td.cal {height:15px;width:15px;border:1px solid;vertical-align: top;background-color: #FFC;font-weight:bold;color:#000;}
				td.wd {font-size:10px;}
				p.cal {position:relative;left:0px;top:-10px;}
			</style>';
		}
		else {
			$html='<style scoped>
				table.cal {border: 1px solid;border-collapse: collapse;}
				td.cal {height:75px;width:75px;border:1px solid;vertical-align: top;background-color: #FFC;font-weight:bold;color:#000;}
				p.cal {position:relative;left:0px;top:-10px;}
			</style>';
		}
		return $html;
	}
	
	/**
	* Function preparing the HTML output
	*/
	private function calendarToHTML() {
		$html=$this->getStyle().
				'<table><tr><td>
				<form method="get">
				<input type="submit" value="Prev" name="btnPrev"/>
				</form></td><td>
				<h1 class="cal">'.$this->month->getMonthName().'</h1></td><td>
				<form method="get">
				<input type="submit" value="Next" name="btnNext"/>
				</form></td></tr></table>
				'.$this->month->getMonth();
		return $html;
	}
	
	/**
	* Functions returning the calendar as HTML
	*/
	public function getCalendar(){
		$this->month = new CMonth($_SESSION['currentdate']);
		if (func_num_args()>0){$this->param=func_get_arg(0);} else $this->param=false;
		return $this->calendarToHTML();	
	}
	
	/**
	* Functions returning the kitten of the month
	*/
	public function getCalendarImage(){
		if (isset($_SESSION['currentdate'])){
		$url=str_replace("/home/saxon/students/20141/guca14/www/phpmvc/","../../",dirname(__FILE__));
			return '<img src="'.$url.'/img/'.strtolower($this->month->getMonthId()).'.jpg" alt="'.$this->month->getMonthName().'">';
		}
		else {
			return null;
		}
	}
	
	
	

}
?>


