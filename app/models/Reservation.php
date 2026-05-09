<?php

class Reservation extends Model {
    public function getAll($search = '') {
        $sql = "SELECT * FROM reservations";
        $params = [];
        if ($search) {
            $sql .= " WHERE customer_name LIKE :s OR contact_number LIKE :s2";
            $params[':s']  = "%$search%";
            $params[':s2'] = "%$search%";
        }
        $sql .= " ORDER BY date_reserved DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll();
    }

    public function getById($id) {
        $stmt = $this->db->prepare("SELECT * FROM reservations WHERE id = :id");
        $stmt->execute([':id' => $id]);
        return $stmt->fetch();
    }

    public function create($data) {
        $stmt = $this->db->prepare("
            INSERT INTO reservations
            (customer_name, contact_number, date_reserved, from_date, to_date,
             room_type, room_capacity, payment_type, num_days,
             rate_per_day, sub_total, discount, total_bill)
            VALUES
            (:customer_name, :contact_number, NOW(), :from_date, :to_date,
             :room_type, :room_capacity, :payment_type, :num_days,
             :rate_per_day, :sub_total, :discount, :total_bill)
        ");
        return $stmt->execute($data);
    }

    public function update($id, $data) {
        $data[':id'] = $id;
        $stmt = $this->db->prepare("
            UPDATE reservations SET
                customer_name = :customer_name,
                contact_number = :contact_number,
                from_date = :from_date,
                to_date = :to_date,
                room_type = :room_type,
                room_capacity = :room_capacity,
                payment_type = :payment_type,
                num_days = :num_days,
                rate_per_day = :rate_per_day,
                sub_total = :sub_total,
                discount = :discount,
                total_bill = :total_bill
            WHERE id = :id
        ");
        return $stmt->execute($data);
    }

    public function delete($id) {
        $stmt = $this->db->prepare("DELETE FROM reservations WHERE id = :id");
        return $stmt->execute([':id' => $id]);
    }

    public function getStats() {
        return [
            'total' => $this->db->query("SELECT COUNT(*) FROM reservations")->fetchColumn(),
            'revenue' => $this->db->query("SELECT SUM(total_bill) FROM reservations")->fetchColumn() ?? 0,
            'avg_days' => $this->db->query("SELECT AVG(num_days) FROM reservations")->fetchColumn() ?? 0,
            'today' => $this->db->query("SELECT COUNT(*) FROM reservations WHERE DATE(date_reserved) = CURDATE()")->fetchColumn(),
        ];
    }
}
