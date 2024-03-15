<?php
  require_once './public/humanResources/func/add-employee.php';
  // try {
  //   require_once './src/dbconn.php';
  //   $db = Database::getInstance();
  //   $conn = $db->connect();
  //   if(isset($_POST['save'])) {
  
  //     // BASIC EMPLOYEE INFORMATION
  //     $firstName = $_POST['firstName'];
  //     $middleName = $_POST['middleName'];
  //     $lastName = $_POST['lastName'];
  //     $birthday = $_POST['birthday'];
  //     $gender = $_POST['gender'];
  //     $nationality = $_POST['nationality'];
  //     $civilStatus = $_POST['civilStatus'];
  //     $address = $_POST['address'];
  //     $contactNumber = $_POST['contactNumber'];
  //     $email = $_POST['email'];
  //     $department = $_POST['department'];
  //     $position = $_POST['position'];
  
  //     // SALARY AND TAX INFORMATION
  //     // salary
  //     $baseSalary = $_POST['baseSalary'];
  //     $totalSalary = $_POST['totalSalary'];
  //     // tax
  //     $incomeTax = $_POST['incomeTax'];
  //     $withholdingTax = $_POST['withholdingTax'];
  //     // benefits
  //     $sss = $_POST['sss'];
  //     $pagibig = $_POST['pagibig'];
  //     $philhealth = $_POST['philhealth'];
  //     $thirteenthMonth = $_POST['thirteenthMonth'];
  
  //     // to employees table
  //     $query_employees = "INSERT INTO employees (first_name, last_name, dateofbirth, gender, nationality, civil_status, address, contact_number, email, department, position) VALUES (:firstname, :lastname, :dateofbirth, :gender, :nationality, :civilstatus, :address, contactnumber, :email, :department, :position)";
  //     $stmt_employees = $conn->prepare($query_employees);
  //     $stmt_employees->bindParam(':firstName', $firstName, PDO::PARAM_STR);
  //     $stmt_employees->bindParam(':middleName', $middleName, PDO::PARAM_STR);
  //     $stmt_employees->bindParam(':lastName', $lastName, PDO::PARAM_STR);
  //     $stmt_employees->bindParam(':birthday', $birthday, PDO::PARAM_STR);
  //     $stmt_employees->bindParam(':gender', $gender, PDO::PARAM_STR);
  //     $stmt_employees->bindParam(':nationality', $nationality, PDO::PARAM_STR);
  //     $stmt_employees->bindParam(':civilStatus', $civilStatus, PDO::PARAM_STR);
  //     $stmt_employees->bindParam(':address', $address, PDO::PARAM_STR);
  //     $stmt_employees->bindParam(':contactNumber', $contactNumber, PDO::PARAM_STR);
  //     $stmt_employees->bindParam(':email', $email, PDO::PARAM_STR);
  //     $stmt_employees->bindParam(':department', $department, PDO::PARAM_STR);
  //     $stmt_employees->bindParam(':position', $position, PDO::PARAM_STR);
  //     $stmt_employees->execute();
  //     $lastInsertedEmployeeId = $conn->lastInsertId();
  
  //     // to salary info table
  //     $query_salary = "INSERT INTO salary_info (base_salary, total_salary, employees_id) VALUES (:basesalary, :totalsalary, :employees_id)";
  //     $stmt_salary = $conn->prepare($query_salary);
  //     $stmt_salary->bindParam(':basesalary', $basesalary, PDO::PARAM_STR);
  //     $stmt_salary->bindParam(':totalsalary', $totalsalary, PDO::PARAM_STR);
  //     $stmt_salary->bindParam(':employees_id', $lastInsertedEmployeeId, PDO::PARAM_INT);
  //     $stmt_salary->execute();;
  
  //     // to tax info table
  //     $query_tax = "INSERT INTO tax_info (income_tax, withholding_tax, employees_id) VALUES (:incometax, :withholdingtax, :employees_id)";
  //     $stmt_tax = $conn->prepare($query_tax);
  //     $stmt_tax->bindParam(':incometax', $incometax, PDO::PARAM_STR);
  //     $stmt_tax->bindParam(':withholdingtax', $withholdingtax, PDO::PARAM_STR);
  //     $stmt_tax->bindParam(':employees_id', $lastInsertedEmployeeId, PDO::PARAM_INT);
  //     $stmt_tax->execute();
  
  //     // to benefits info table
  //     $query_benefits = "INSERT INTO benefits_info (sss, pagibig, philhealth, thirteenth_month, employees_id) VALUES (:sss, :pagibig, :philhealth, :thirteenthmonth, :employees_id)";
  //     $stmt_benefits = $conn->prepare($query_benefits);
  //     $stmt_benefits->bindParam(':sss', $sss, PDO::PARAM_STR);
  //     $stmt_benefits->bindParam(':pagibig', $pagibig, PDO::PARAM_STR);
  //     $stmt_benefits->bindParam(':philhealth', $philhealth, PDO::PARAM_STR);
  //     $stmt_benefits->bindParam(':thirteenthmonth', $thirteenthmonth, PDO::PARAM_STR);
  //     $stmt_benefits->bindParam(':employees_id', $lastInsertedEmployeeId, PDO::PARAM_INT);
  //     $stmt_benefits->execute();
  
  //     if($stmt_employees->rowCount() > 0 && $stmt_salary->rowCount() > 0 && $stmt_tax->rowCount() > 0 && $stmt_benefits->rowCount() > 0){
  //       echo "<script>alert('Data Inserted Successfully');</script>";
  //     } else {
  //         echo "<script>alert('Data Not Inserted');</script>";
  //     }
  // }
  // } catch (PDOException $e) {
  //   echo "Error: $e";
  // }
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/remixicon@4.2.0/fonts/remixicon.css" rel="stylesheet"/>
  <link href="./../../src/tailwind.css" rel="stylesheet">
  <title>New Employee</title>
</head>
<body class="text-gray-800 font-sans">

<!-- sidenav -->
<?php 
    include 'inc/sidenav.php';
?>
<!-- end of sidenav -->

<!-- MAIN -->
<main id = "mainContent" class="w-full md:w-[calc(100%-256px)] md:ml-64 min-h-screen transition-all main">
  <!-- Top Bar -->
  <div class="py-2 px-6 bg-white flex items-center shadow-md shadow-black/10">
   <button type="button" class="text-lg text-gray-600 sidebar-toggle">
  <i class="ri-menu-line"></i>
   </button>
   <ul class="flex items-center text-sm ml-4">  
  <li class="mr-2">
    <a route="/hr/dashboard" class="text-[#151313] hover:text-gray-600 font-medium">Human Resources</a>
  </li>
  <li class="text-[#151313] mr-2 font-medium">/</li>
  <a route="/hr/employees" class="text-[#151313] mr-2 font-medium hover:text-gray-600">Employees</a>
  <li class="text-[#151313] mr-2 font-medium">/</li>
  <a href="#" class="text-[#151313] mr-2 font-medium hover:text-gray-600">Add New</a>
   </ul>
   <ul class="ml-auto flex items-center">
  <li class="mr-1">
    <a href="#" class="text-[#151313] hover:text-gray-600 text-sm font-medium">Sample User</a>
  </li>
  <li class="mr-1">
    <button type="button" class="w-8 h-8 rounded justify-center hover:bg-gray-300"><i class="ri-arrow-down-s-line"></i></button> 
  </li>
   </ul>
  </div>
  <!-- End Top Bar -->

  
  <div class="flex items-center flex-wrap">
    <h3 class="ml-6 mt-8 text-xl font-bold">Employee Information</h3>
  </div>
  
<!-- Profile -->
<div class="py-2 px-6 mt-4">
  <div class="flex">
    <div class="mr-4">
      <img src="#" alt="Profile Picture" class="w-48 h-48 object-cover">
      <span>
        <div class="ml-2 mb-20 mt-4"> 
          <button type="button" class="focus:outline-none text-white bg-yellow-400 hover:bg-yellow-500 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:focus:ring-yellow-900">Upload</button>
          <button type="button" class="focus:outline-none text-black bg-white hover:bg-gray-100 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:focus:ring-yellow-900">Remove</button>
        </div>    
      </span>
    </div>

    <?php 
      if ($_SERVER["REQUEST_METHOD"] == "POST") {
        insertEmployee($_POST);
      }
      ?>
  <!-- Employee Information -->
  
                            <form action= "/hr/employes/add" method="post">
  <div class="flex flex-col ml-20">
    <div class="mb-4">
      <div class="flex">
        <div class="mr-2">
            <label class="block mb-2 mt-0 text-sm font-bold text-gray-700" for="firstName">
              First Name
            </label>
            <input
              class="w-64 px-3 py-2 text-sm leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
              name="firstName"
              id="firstName"
              type="text"
              placeholder="First Name"
            />
        </div>
        <div class="mr-2">
            <label class="block mb-2 mt-0 text-sm font-bold text-gray-700" for="middleName">
              Middle Name
            </label>
            <input
              class="w-64 px-3 py-2 text-sm leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
              name="middleName"
              id="middleName"
              type="text"
              placeholder="Middle Name"
            />
        </div>
        <div>
            <label class="block mb-2 mt-0 text-sm font-bold text-gray-700" for="lastName">
              Last Name
            </label>
            <input  
              class="w-64 px-3 py-2 text-sm leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
              name="lastName"
              id="lastName"
              type="text"
              placeholder="Last Name"
            />
        </div>
      </div>
    </div>
      <!-- Employee Information 2 -->
  <div class="flex flex-col">
    <div class="mb-4">
      <div class="flex">
        <div class="mr-2">
            <label class="block mb-2 mt-0 text-sm font-bold text-gray-700" for="birthday">
              Date of Birth
            </label>
            <input
              class="w-64 px-3 py-2 text-sm leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
              name="birthday"
              id="birthday"
              type="date"
            />
        </div>
        <div class="mr-2">
            <label class="block mb-2 mt-0 text-sm font-bold text-gray-700" for="gender">
              Gender
            </label>
            <select
            class="w-64 px-3 py-2 text-sm leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
            name="gender"
            id="gender">
            <option value="">Select Gender</option>
            <option value="Female">Female</option>
            <option value="Male">Male</option>
          </select>
        </div>
        <div>
            <label class="block mb-2 mt-0 text-sm font-bold text-gray-700" for="nationality">
              Nationality
            </label>
            <input  
              class="w-64 px-3 py-2 text-sm leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
              name="nationality"
              id="nationality"
              type="text"
              placeholder="Nationality"
            />
        </div>
      </div>
    </div>
    <!-- Employee Information 3-->
    <div class="flex flex-col">
      <div class="mb-4">
        <div class="flex">
          <div class="mr-2">
            <label class="block mb-2 mt-0 text-sm font-bold text-gray-700" for="civilstatus">
              Civil Status
            </label>
            <select
              class="w-64 px-3 py-2 text-sm leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
              id="civilstatus"
              name="civilstatus">
              <option value="">Single</option>
              <option value="Female">Married</option>
              <option value="Male">Widowed</option>
              <option value="">Divorced</option>
          </select>
          </div>
          <div class="mr-2">
            <label class="block mb-2 mt-0 text-sm font-bold text-gray-700" for="address">
              Address
            </label>
            <input  
            class="w-64 px-3 py-2 text-sm leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
            name="address"
            id="address"
            type="text"
            placeholder="Address"
          />
          </div>
          <div>
            <label class="block mb-2 mt-0 text-sm font-bold text-gray-700" for="contactnumber">
              Contact Number
            </label>
            <input  
              class="w-64 px-3 py-2 text-sm leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
              name="contactnumber"
              id="contactnumber"
              type="tel"
              placeholder="Contact Number"
            />
          </div>
        </div>
      </div>

      <!-- Employee Information 4-->
      <div class="flex flex-col">
      <div class="mb-4">
        <div class="flex">
          <div class="mr-2">
            <label class="block mb-2 mt-0 text-sm font-bold text-gray-700" for="email">
              Email
            </label>
            <input
              class="w-64 px-3 py-2 text-sm leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
              name="email"
              id="email"
              placeholder="example@gmail.com">
          </div>
          <div class="mr-2">
            <label class="block mb-2 mt-0 text-sm font-bold text-gray-700" for="department">
              Department
            </label>
            <select
              class="w-64 px-3 py-2 text-sm leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
                        name="department" id="Department" placeholder="Department">
                        
                        <option value="">Select Department</option>
                        <option value="Product Order">Product Order</option>
                        <option value="Inventory">Inventory</option>
                        <option value="Inventory">Delivery</option>
                        <option value="Human Resources">Human Resources</option>
                        <option value="Point of Sales">Point of Sales</option>
                        <option value="Finance">Finance/Accounting</option>
                      
                      </select>
          </div>
          <div>
            <label class="block mb-2 mt-0 text-sm font-bold text-gray-700" for="Position">
              Position
            </label>
            <input  
              class="w-64 px-3 py-2 text-sm leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
              name="position"
              id="Position"
              type="text"
              placeholder="Position"
            />  
          </div>
        </div>
      </div>
                  <!-- Salary Information and Tax Information -->
            <div>
              <h2 class="block mb-2 mt-8 text-base font-bold text-gray-700">Salary and Tax Information</h2>
              <div class="flex flex-col">
                <div class="mb-4 mt-4">
                  <div class="flex">
                    <div class="mr-2">
                        <label class="block mb-2 mt-0 text-sm font-bold text-gray-700" for="basesalary">
                          Base Salary
                        </label>
                        <input
                          class="w-64 px-3 py-2 text-sm leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
                          name="basesalary"
                          id="basesalary"
                          type="number"
                          placeholder="Base Salary"
                        />
                    </div>
                    <div class="mr-2">
                        <label class="block mb-2 mt-0 text-sm font-bold text-gray-700" for="incometax">
                          Income Tax
                        </label>
                        <input
                          class="w-64 px-3 py-2 text-sm leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
                          name="incometax"
                          id="incometax"
                          type="number"
                          placeholder="Income Tax"
                        />
                    </div>
                    <div>
                        <label class="block mb-2 mt-0 text-sm font-bold text-gray-700" for="withholdingtax">
                          Withholding tax
                        </label>
                        <input  
                          class="w-64 px-3 py-2 text-sm leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
                          name="withholdingtax"
                          id="withholdingtax"
                          type="number"
                          placeholder="Withholding Tax"
                        />
                    </div>
                  </div>
                </div>
                <div>
                  <div class="flex flex-col">
                    <div class="mb-4">
                      <div class="flex">
                        <div class="mr-2">
                            <label class="block mb-2 mt-0 text-sm font-bold text-gray-700" for="sss">
                              SSS
                            </label>
                            <input
                              class="w-64 px-3 py-2 text-sm leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
                              name="sss"
                              id="sss"
                              type="text"
                              placeholder="SSS"
                            />
                        </div>
                        <div class="mr-2">
                            <label class="block mb-2 mt-0 text-sm font-bold text-gray-700" for="pagibig">
                              Pag-IBIG Fund
                            </label>
                            <input
                              class="w-64 px-3 py-2 text-sm leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
                              name="pagibig"
                              id="pagibig"
                              type="text"
                              placeholder="PAG-IBIG Fund"
                            />
                        </div>
                        <div>
                            <label class="block mb-2 mt-0 text-sm font-bold text-gray-700" for="philhealth">
                              Philhealth
                            </label>
                            <input  
                              class="w-64 px-3 py-2 text-sm leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
                              name="philhealth"
                              id="philhealth"
                              type="text"
                              placeholder="Philhealth"
                            />
                        </div>
                      </div>
                    </div>
                    <div class="flex flex-col">
                      <div class="mb-4">
                        <div class="flex">
                          <div class="mr-2">
                              <label class="block mb-2 mt-0 text-sm font-bold text-gray-700" for="thirteenththmonth">
                                13th Month Pay
                              </label>
                              <input
                                class="w-64 px-3 py-2 text-sm leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
                                name="thirteenththmonth"
                                id="thirteenththmonth"
                                type="number"
                                placeholder="13th Month Pay"
                              />
                          </div>
                          <div class="mr-2">
                              <label class="block mb-2 mt-0 text-sm font-bold text-gray-700" for="totalsalary">
                                Total Salary
                              </label>
                              <input
                                class="w-64 px-3 py-2 text-sm leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
                                name="totalsalary"
                                id="totalsalary"
                                type="number"
                                placeholder="Total Salary"
                              />
                          </div>
                      </div>
                      
  </form>
                      <div>
                      </div>
                      <div class="flex flex-row mt-8 justify-center">
                        <button type="button" class="focus:outline-none text-white bg-yellow-400 hover:bg-yellow-500 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:focus:ring-yellow-900">Save</button>
                        <button route="/hr/employees" type="button" class="focus:outline-none text-gray-700 bg-white hover:bg-gray-100 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:focus:ring-yellow-900">Cancel</button>
                      </div>
    </div>
  </div>
</div> 
</main>

<script  src="./../../src/route.js"></script>

<!-- Sidebar active/inactive -->
<script>
  document.querySelector('.sidebar-toggle').addEventListener('click', function() {
    document.getElementById('sidebar-menu').classList.toggle('hidden');
    document.getElementById('sidebar-menu').classList.toggle('transform');
    document.getElementById('sidebar-menu').classList.toggle('-translate-x-full');
    document.getElementById('mainContent').classList.toggle('md:w-full');
    document.getElementById('mainContent').classList.toggle('md:ml-64');
  });
</script>
</body>
</html> 