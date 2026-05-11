<?php
/**
 * Authentication Handler
 */

class Auth {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function registerUser($full_name, $email, $phone, $password, $role = 'student') {
        // Validate inputs
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return ['success' => false, 'message' => 'Invalid email format'];
        }

        if (strlen($password) < 8) {
            return ['success' => false, 'message' => 'Password must be at least 8 characters'];
        }

        // Check if user exists
        $stmt = $this->db->prepare("SELECT id FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        if ($stmt->get_result()->num_rows > 0) {
            return ['success' => false, 'message' => 'Email already registered'];
        }

        // Hash password and insert
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);
        $stmt = $this->db->prepare("INSERT INTO users (full_name, email, phone, password, role) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $full_name, $email, $phone, $hashed_password, $role);

        if ($stmt->execute()) {
            return ['success' => true, 'message' => 'Registration successful', 'user_id' => $stmt->insert_id];
        } else {
            return ['success' => false, 'message' => 'Registration failed'];
        }
    }

    public function loginUser($email, $password) {
        $stmt = $this->db->prepare("SELECT id, full_name, email, password, role FROM users WHERE email = ? AND status = 'active'");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 0) {
            return ['success' => false, 'message' => 'Invalid credentials'];
        }

        $user = $result->fetch_assoc();
        if (!password_verify($password, $user['password'])) {
            return ['success' => false, 'message' => 'Invalid credentials'];
        }

        // Set session
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['full_name'] = $user['full_name'];
        $_SESSION['email'] = $user['email'];
        $_SESSION['role'] = $user['role'];
        $_SESSION['user_type'] = 'patient';

        return ['success' => true, 'message' => 'Login successful', 'user_id' => $user['id']];
    }

    public function loginDoctor($email, $password) {
        $stmt = $this->db->prepare("SELECT id, full_name, email, password, specialty FROM doctors WHERE email = ? AND status = 'active'");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 0) {
            return ['success' => false, 'message' => 'Invalid credentials'];
        }

        $doctor = $result->fetch_assoc();
        if (!password_verify($password, $doctor['password'])) {
            return ['success' => false, 'message' => 'Invalid credentials'];
        }

        // Set session
        $_SESSION['doctor_id'] = $doctor['id'];
        $_SESSION['full_name'] = $doctor['full_name'];
        $_SESSION['email'] = $doctor['email'];
        $_SESSION['specialty'] = $doctor['specialty'];
        $_SESSION['user_type'] = 'doctor';

        return ['success' => true, 'message' => 'Login successful', 'doctor_id' => $doctor['id']];
    }

    public function loginAdmin($email, $password) {
        $stmt = $this->db->prepare("SELECT id, full_name, email, password, role FROM admin_users WHERE email = ? AND status = 'active'");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 0) {
            return ['success' => false, 'message' => 'Invalid credentials'];
        }

        $admin = $result->fetch_assoc();
        if (!password_verify($password, $admin['password'])) {
            return ['success' => false, 'message' => 'Invalid credentials'];
        }

        // Set session
        $_SESSION['admin_id'] = $admin['id'];
        $_SESSION['full_name'] = $admin['full_name'];
        $_SESSION['email'] = $admin['email'];
        $_SESSION['admin_role'] = $admin['role'];
        $_SESSION['user_type'] = 'admin';

        return ['success' => true, 'message' => 'Login successful', 'admin_id' => $admin['id']];
    }

    public function logout() {
        session_destroy();
        return ['success' => true, 'message' => 'Logged out successfully'];
    }

    public function isLoggedIn() {
        return isset($_SESSION['user_id']);
    }

    public function isDoctorLoggedIn() {
        return isset($_SESSION['doctor_id']);
    }

    public function isAdminLoggedIn() {
        return isset($_SESSION['admin_id']);
    }

    public function getUser() {
        if ($this->isLoggedIn()) {
            return [
                'id' => $_SESSION['user_id'],
                'full_name' => $_SESSION['full_name'],
                'email' => $_SESSION['email'],
                'role' => $_SESSION['role']
            ];
        }
        return null;
    }

    public function requireLogin() {
        if (!$this->isLoggedIn()) {
            header('Location: ' . APP_URL . '/user/login');
            exit;
        }
    }

    public function requireAdminLogin() {
        if (!$this->isAdminLoggedIn()) {
            header('Location: ' . APP_URL . '/admin/login');
            exit;
        }
    }
}

$auth = new Auth($db);
