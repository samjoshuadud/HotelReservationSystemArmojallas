<?php

class ReservationController extends Controller {
    private $rates = [
        'Single'  => ['Regular' => 100,  'De Luxe' => 300,  'Suite' => 500],
        'Double'  => ['Regular' => 200,  'De Luxe' => 500,  'Suite' => 800],
        'Family'  => ['Regular' => 500,  'De Luxe' => 750,  'Suite' => 1000],
    ];

    public function index() {
        $data = [
            'page_title' => "Reservation — Darrel & Ayien's Five Star Hotel",
            'errors' => [],
            'success' => false,
            'billing' => null
        ];

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
            $data = $this->handlePost($data);
        }

        $this->view('reservation/index', $data);
    }

    private function handlePost($data) {
        $customer_name   = trim($_POST['customer_name'] ?? '');
        $contact_number  = trim($_POST['contact_number'] ?? '');
        $from_date       = $_POST['from_date'] ?? '';
        $to_date         = $_POST['to_date'] ?? '';
        $room_type       = $_POST['room_type'] ?? '';
        $room_capacity   = $_POST['room_capacity'] ?? '';
        $payment_type    = $_POST['payment_type'] ?? '';

        if (empty($customer_name))  $data['errors'][] = "Customer name is required.";
        if (empty($contact_number)) $data['errors'][] = "Contact number is required.";
        if (empty($from_date))      $data['errors'][] = "From date is required.";
        if (empty($to_date))        $data['errors'][] = "To date is required.";
        if (empty($room_capacity))  $data['errors'][] = "No selected room capacity.";
        if (empty($room_type))      $data['errors'][] = "No selected room type.";
        if (empty($payment_type))   $data['errors'][] = "No selected type of payment.";

        if (empty($data['errors'])) {
            $from_dt = new DateTime($from_date);
            $to_dt   = new DateTime($to_date);

            if ($to_dt <= $from_dt) {
                $data['errors'][] = "To date must be after From date.";
            } else {
                $num_days = $to_dt->diff($from_dt)->days;
                $rate_per_day = $this->rates[$room_capacity][$room_type];
                $sub_total    = $rate_per_day * $num_days;

                $discount = 0;
                if ($payment_type === 'Cash') {
                    if ($num_days >= 6)      $discount = $sub_total * 0.15;
                    elseif ($num_days >= 3)  $discount = $sub_total * 0.10;
                } elseif ($payment_type === 'Cheque') {
                    $discount = -($sub_total * 0.05);
                } elseif ($payment_type === 'Credit Card') {
                    $discount = -($sub_total * 0.10);
                }

                $total_bill = $sub_total - $discount;

                $resModel = $this->model('Reservation');
                $success = $resModel->create([
                    ':customer_name'  => $customer_name,
                    ':contact_number' => $contact_number,
                    ':from_date'      => $from_date,
                    ':to_date'        => $to_date,
                    ':room_type'      => $room_type,
                    ':room_capacity'  => $room_capacity,
                    ':payment_type'   => $payment_type,
                    ':num_days'       => $num_days,
                    ':rate_per_day'   => $rate_per_day,
                    ':sub_total'      => $sub_total,
                    ':discount'       => $discount,
                    ':total_bill'     => $total_bill,
                ]);

                if ($success) {
                    $data['success'] = true;
                    $data['billing'] = compact(
                        'customer_name','contact_number','from_date','to_date',
                        'room_type','room_capacity','payment_type',
                        'num_days','rate_per_day','sub_total','discount','total_bill'
                    );
                    $data['billing']['date_reserved'] = date('F d, Y');
                    $data['billing']['time_reserved'] = date('g:i:s A');
                } else {
                    $data['errors'][] = "Failed to save reservation.";
                }
            }
        }
        return $data;
    }
}
