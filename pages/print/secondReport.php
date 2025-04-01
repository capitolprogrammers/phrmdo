<?php
include('../../assets/conn/etc.php');
$r = get_array("SELECT 
    jonamestbl.id,
    jonamestbl.jo_number,
    lname,
    fname,
    mname,
    officetbl.office_name,
    designation_name,
    rate,
    contract_start,
    contract_end,
    jo_status,
    address,
    gender,
    bday,
    phonenum,
    c_o,
    acct_code,
    jotbl.status,
    res_center,
    program_name,
    programtbl.office,
    funding_name,
    funding_code,
    jonotestbl.note
FROM
    phrmdo_jorecdbb.jonamestbl
        LEFT JOIN
    employeetbl ON employeetbl.employee_id = jonamestbl.employee_id
        LEFT JOIN
    jotbl ON jonamestbl.jo_number = jotbl.jo_number
        LEFT JOIN
    officetbl ON officetbl.office_id = jonamestbl.office_id
        LEFT JOIN
    programtbl ON programtbl.program_id = jotbl.program_id
        LEFT JOIN
    fundingtbl ON fundingtbl.fund_id = jotbl.fund_id
        LEFT JOIN
    jonotestbl ON jonotestbl.jo_number = jotbl.jo_number
        LEFT JOIN
    designationtbl ON designationtbl.designation_id = jonamestbl.designation_id
WHERE
    contract_start BETWEEN '2023-10-01' AND '2023-12-31'
        AND status = 6
ORDER BY lname , fname , mname");
    
    foreach($r as $v){
        $joid = $v[0];
        $wages = getMonthlyWage($joid);
        $wage1 = 0;
        $wage2 = 0;
        $wage3 = 0;

        if(count(getMonthlyWage($joid)) == 3)
        {
            $wage1 = getMonthlyWage($joid)[0];
            $wage2 = getMonthlyWage($joid)[1];
            $wage3 = getMonthlyWage($joid)[2];
        }
        if(count(getMonthlyWage($joid)) == 2)
        {
            $wage1 = getMonthlyWage($joid)[0];
            $wage2 = getMonthlyWage($joid)[1];
            //$wage3 = getMonthlyWage($joid)[2];
        }
        if(count(getMonthlyWage($joid)) == 1)
        {
            $wage1 = getMonthlyWage($joid)[0];
            // $wage2 = getMonthlyWage($joid)[1];
            //$wage3 = getMonthlyWage($joid)[2];
        }
        
        
        
    }
?>
