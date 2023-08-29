<?php

  function getActiveCompanyEmployees($employees, $currentCompanyId) {
    return array_filter($employees, function($employee) use ($currentCompanyId) {
      return ($employee['company_id'] === $currentCompanyId) && ($employee['isActive'] === "true");
    });
  }

  function addActiveCompanyEmployeesToList($activeCompanyEmployees, &$companyList) {
    if (!count($activeCompanyEmployees)) return;
    array_map(function($activeEmployee) use (&$companyList){
      $companyList .= "<ul>";
      $companyList .= "<li>{$activeEmployee['employee_name'][0]['first_name']} {$activeEmployee['employee_name'][0]['last_name']}</li>";
      $companyList .= "<li>{$activeEmployee['email']}</li>";
      $companyList .= "<li>{$activeEmployee['phone']}</li>";
      $companyList .= "<li>{$activeEmployee['address']}</li>";
      $companyList .= "<li>{$activeEmployee['department'][0]['name']}</li>";
      $companyList .= "</ul>";
    }, $activeCompanyEmployees);
  }

  $companiesString = file_get_contents('companies.json');
  $companyEmployeesString = file_get_contents('company_employees.json');

  $companiesJson = json_decode($companiesString, true);
  $companyEmployeesJson = json_decode($companyEmployeesString, true);

  $companyList = "<html>";
  $companies = $companiesJson['companies'];
  for ($i = 0; $i < count($companies); $i++) {
    $currentCompany = $companies[$i];

    $currentCompanyName = $currentCompany['company_name'];
    $currentCompanyId = $currentCompany['company_id'];

    $companyList .= "<h1>{$currentCompanyName}</h1>";

    $activeCompanyEmployees = getActiveCompanyEmployees($companyEmployeesJson['employees'], $currentCompanyId);
    addActiveCompanyEmployeesToList($activeCompanyEmployees, $companyList);
  }

  $companyList .= "</html>";

  echo $companyList;
?>