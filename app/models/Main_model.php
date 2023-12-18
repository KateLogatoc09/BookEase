<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class Main_model extends Model {
	public function sales() {
        return $this->db->raw('SELECT SUM(rest) as rest, resc FROM (SELECT SUM(res.total) as rest, DATE(res.created_at) as resc FROM reservations as res WHERE res.status = "COMPLETED" AND DATE(res.created_at) between date_sub(now(),INTERVAL 1 WEEK) and now() GROUP BY DATE(res.created_at)  UNION SELECT SUM(app.total) as appt, DATE(app.created_at) as appc FROM appointment as app WHERE app.status = "COMPLETED" AND  DATE(app.created_at) between date_sub(now(),INTERVAL 1 WEEK) and now() GROUP BY DATE(app.created_at)) s GROUP BY resc');
    }
}
?>
