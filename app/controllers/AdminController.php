<?php

class AdminController extends Controller {
    private $rates = [
        'Single'  => ['Regular' => 100,  'De Luxe' => 300,  'Suite' => 500],
        'Double'  => ['Regular' => 200,  'De Luxe' => 500,  'Suite' => 800],
        'Family'  => ['Regular' => 500,  'De Luxe' => 750,  'Suite' => 1000],
    ];

    public function __construct() {
        session_start();
        $url = $_GET['url'] ?? '';
        if (!isset($_SESSION['admin_id']) && $url !== 'admin/login') {
            header('Location: ' . URLROOT . '/admin/login');
            exit;
        }
    }

    public function index() {
        $resModel = $this->model('Reservation');
        $search = $_GET['search'] ?? '';
        
        if (isset($_GET['delete'])) {
            $resModel->delete($_GET['delete']);
            header('Location: ' . URLROOT . '/admin/index?msg=deleted');
            exit;
        }

        $data = [
            'page_title' => "Admin Dashboard",
            'reservations' => $resModel->getAll($search),
            'stats' => $resModel->getStats(),
            'search' => $search
        ];

        $this->view('admin/dashboard', $data);
    }

    public function login() {
        if (isset($_SESSION['admin_id'])) {
            header('Location: ' . URLROOT . '/admin/index');
            exit;
        }

        $data = ['error' => ''];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userModel = $this->model('User');
            $user = $userModel->login($_POST['username'], $_POST['password']);
            if ($user) {
                $_SESSION['admin_id'] = $user['id'];
                $_SESSION['admin_username'] = $user['username'];
                header('Location: ' . URLROOT . '/admin/index');
                exit;
            } else {
                $data['error'] = "Invalid credentials.";
            }
        }
        $this->view('admin/login', $data);
    }

    public function logout() {
        session_destroy();
        header('Location: ' . URLROOT . '/admin/login');
        exit;
    }

    public function add() {
        $data = [
            'page_title' => 'Add Reservation',
            'errors' => [],
            'formData' => [
                'customer_name'  => '',
                'contact_number' => '',
                'from_date'      => '',
                'to_date'        => '',
                'room_type'      => '',
                'room_capacity'  => '',
                'payment_type'   => '',
            ]
        ];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $formData = [
                'customer_name'  => trim($_POST['customer_name'] ?? ''),
                'contact_number' => trim($_POST['contact_number'] ?? ''),
                'from_date'      => $_POST['from_date'] ?? '',
                'to_date'        => $_POST['to_date'] ?? '',
                'room_type'      => $_POST['room_type'] ?? '',
                'room_capacity'  => $_POST['room_capacity'] ?? '',
                'payment_type'   => $_POST['payment_type'] ?? '',
            ];
            $data['formData'] = $formData;

            $data['errors'] = $this->validate($formData);

            if (empty($data['errors'])) {
                $billing = $this->calculateBilling($formData);
                $resModel = $this->model('Reservation');
                $success = $resModel->create(array_merge([
                    ':customer_name'  => $formData['customer_name'],
                    ':contact_number' => $formData['contact_number'],
                    ':from_date'      => $formData['from_date'],
                    ':to_date'        => $formData['to_date'],
                    ':room_type'      => $formData['room_type'],
                    ':room_capacity'  => $formData['room_capacity'],
                    ':payment_type'   => $formData['payment_type'],
                ], $billing));

                if ($success) {
                    header('Location: ' . URLROOT . '/admin/index?msg=added');
                    exit;
                }
            }
        }
        $this->view('admin/add', $data);
    }

    public function edit($id) {
        $resModel = $this->model('Reservation');
        $reservation = $resModel->getById($id);
        if (!$reservation) {
            header('Location: ' . URLROOT . '/admin/index');
            exit;
        }

        $data = [
            'page_title' => 'Edit Reservation #' . $id,
            'errors' => [],
            'formData' => $reservation
        ];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $formData = [
                'customer_name'  => trim($_POST['customer_name'] ?? ''),
                'contact_number' => trim($_POST['contact_number'] ?? ''),
                'from_date'      => $_POST['from_date'] ?? '',
                'to_date'        => $_POST['to_date'] ?? '',
                'room_type'      => $_POST['room_type'] ?? '',
                'room_capacity'  => $_POST['room_capacity'] ?? '',
                'payment_type'   => $_POST['payment_type'] ?? '',
            ];
            $data['formData'] = $formData;
            $data['errors'] = $this->validate($formData);

            if (empty($data['errors'])) {
                $billing = $this->calculateBilling($formData);
                $success = $resModel->update($id, array_merge([
                    ':customer_name'  => $formData['customer_name'],
                    ':contact_number' => $formData['contact_number'],
                    ':from_date'      => $formData['from_date'],
                    ':to_date'        => $formData['to_date'],
                    ':room_type'      => $formData['room_type'],
                    ':room_capacity'  => $formData['room_capacity'],
                    ':payment_type'   => $formData['payment_type'],
                ], $billing));

                if ($success) {
                    header('Location: ' . URLROOT . '/admin/index?msg=updated');
                    exit;
                }
            }
        }
        $this->view('admin/edit', $data);
    }

    private function validate($formData) {
        $errors = [];
        foreach ($formData as $key => $val) {
            if (empty($val)) $errors[] = "Field '" . str_replace('_', ' ', $key) . "' is required.";
        }
        if (!empty($formData['from_date']) && !empty($formData['to_date'])) {
            if (new DateTime($formData['to_date']) <= new DateTime($formData['from_date'])) {
                $errors[] = "To date must be after From date.";
            }
        }
        return $errors;
    }

    private function calculateBilling($formData) {
        $from_dt = new DateTime($formData['from_date']);
        $to_dt   = new DateTime($formData['to_date']);
        $num_days = $to_dt->diff($from_dt)->days;
        $rate_per_day = $this->rates[$formData['room_capacity']][$formData['room_type']];
        $sub_total = $rate_per_day * $num_days;
        $discount = 0;
        if ($formData['payment_type'] === 'Cash') {
            if ($num_days >= 6) $discount = $sub_total * 0.15;
            elseif ($num_days >= 3) $discount = $sub_total * 0.10;
        } elseif ($formData['payment_type'] === 'Cheque') {
            $discount = -($sub_total * 0.05);
        } elseif ($formData['payment_type'] === 'Credit Card') {
            $discount = -($sub_total * 0.10);
        }
        $total_bill = $sub_total - $discount;

        return [
            ':num_days' => $num_days,
            ':rate_per_day' => $rate_per_day,
            ':sub_total' => $sub_total,
            ':discount' => $discount,
            ':total_bill' => $total_bill
        ];
    }
}
