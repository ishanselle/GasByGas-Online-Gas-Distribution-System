<?php
use PHPUnit\Framework\TestCase;
require_once __DIR__ . '/../src/UserAuth.php'; // Adjust the path as necessary

class UserAuthTest extends TestCase {
    private $mockDB;
    private $mockStmt;
    private $userAuth;

    protected function setUp(): void {
        // Mock the database connection
        $this->mockDB = $this->createMock(mysqli::class);
        $this->mockStmt = $this->createMock(mysqli_stmt::class);

        // Mock `prepare()` to return the statement object
        $this->mockDB->method('prepare')->willReturn($this->mockStmt);

        // Mock `bind_param()` method (since it returns void)
        $this->mockStmt->method('bind_param')->willReturn(true);

        // Mock `execute()` method (since it returns boolean)
        $this->mockStmt->method('execute')->willReturn(true);

        // Mock `get_result()` with a class that simulates num_rows
        $this->mockStmt->method('get_result')->willReturn(new class {
            public $num_rows = 1; // Simulating a successful match
        });

        // Instantiate UserAuth with mock DB
        $this->userAuth = new UserAuth($this->mockDB);
    }

    public function testLoginWithValidCustomer() {
        $result = $this->userAuth->authenticateUser("validCustomer", "password123");
        $this->assertEquals("Customer", $result);
    }

    public function testLoginWithValidOrganization() {
        $result = $this->userAuth->authenticateUser("validOrg", "orgpass");
        $this->assertEquals("Organization", $result);
    }

    public function testLoginWithInvalidCredentials() {
        // Mock `get_result()` to return zero rows (invalid login)
        $this->mockStmt->method('get_result')->willReturn(new class {
            public $num_rows = 0;
        });

        $result = $this->userAuth->authenticateUser("invalidUser", "wrongpass");
        $this->assertEquals("Invalid Username or Password.", $result);
    }

    public function testLoginWithEmptyFields() {
        $result = $this->userAuth->authenticateUser("", "");
        $this->assertEquals("Both Username and Password are required.", $result);
    }
}
?>
