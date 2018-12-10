<?php
if (!defined("ROOT_PATH"))
{
	header("HTTP/1.1 403 Forbidden");
	exit;
}

class pjUtil extends pjToolkit
{
	static public function getPostMaxSize()
	{
		$post_max_size = ini_get('post_max_size');
		switch (substr($post_max_size, -1))
		{
			case 'G':
				$post_max_size = (int) $post_max_size * 1024 * 1024 * 1024;
				break;
			case 'M':
				$post_max_size = (int) $post_max_size * 1024 * 1024;
				break;
			case 'K':
				$post_max_size = (int) $post_max_size * 1024;
				break;
		}
		return $post_max_size;
	}	
	
	static public function getWeekRange($date, $week_start)
	{
		$week_arr = array(
				0=>'sunday',
				1=>'monday',
				2=>'tuesday',
				3=>'wednesday',
				4=>'thursday',
				5=>'friday',
				6=>'saturday');
			
		$ts = strtotime($date);
		$start = (date('w', $ts) == 0) ? $ts : strtotime('last ' . $week_arr[$week_start], $ts);
		$week_start = ($week_start == 0 ? 6 : $week_start -1);
		return array(date('Y-m-d', $start), date('Y-m-d', strtotime('next ' . $week_arr[$week_start], $start)));
	}
	
	static public function getWhereClause($period, $week_start)
	{
		$where_str = '';
		switch ($period) {
			case 1:
				$where_str = "(DATE(t1.created) = CURDATE() OR DATE(t1.modified) = CURDATE())";
				break;
				;
			case 2:
				$where_str = "(DATE(t1.created) = DATE(DATE_SUB(NOW(), INTERVAL 1 DAY)) OR DATE(t1.modified) = DATE(DATE_SUB(NOW(), INTERVAL 1 DAY)))";
				break;
				;
			case 3:
				list($start_week, $end_week) = pjUtil::getWeekRange(date('Y-m-d'), $week_start);
				$where_str = "((DATE(t1.created) BETWEEN '$start_week' AND '$end_week') OR (DATE(t1.modified) BETWEEN '$start_week' AND '$end_week'))";
				break;
				;
			case 4:
				list($start_week, $end_week) = pjUtil::getWeekRange(date('Y-m-d', strtotime("-7 days")), $week_start);
				$where_str = "((DATE(t1.created) BETWEEN '$start_week' AND '$end_week') OR (DATE(t1.modified) BETWEEN '$start_week' AND '$end_week'))";
				break;
				;
			case 5:
				$start_month = date('Y-m-01',strtotime('this month'));
				$end_month = date('Y-m-t',strtotime('this month'));
				$where_str = "((DATE(t1.created) BETWEEN '$start_month' AND '$end_month') OR (DATE(t1.modified) BETWEEN '$start_month' AND '$end_month'))";
				break;
				;
			case 6:
				$start_month = date("Y-m-d", mktime(0, 0, 0, date("m")-1, 1, date("Y")));
				$end_month = date("Y-m-d", mktime(0, 0, 0, date("m"), 0, date("Y")));
				$where_str = "((DATE(t1.created) BETWEEN '$start_month' AND '$end_month') OR (DATE(t1.modified) BETWEEN '$start_month' AND '$end_month'))";
				break;
				;
		}
		return $where_str;
	}
	
	static public function getTimezoneName($timezone)
	{
		$offset = $timezone / 3600;
		$timezone_name = timezone_name_from_abbr(null, $offset * 3600, true);
		if($timezone_name === false)
		{
			$timezone_name = timezone_name_from_abbr(null, $offset * 3600, false);
		}
		if($offset == -12)
		{
			$timezone_name = 'Pacific/Wake';
		}
		return $timezone_name;
	}
}
?>