<?php
    $language = strtolower($_POST['language']);
    $code = $_POST['code'];
    $random = substr(md5(mt_rand()), 0, 7);
    $filePath = "temp/" . $random . "." . $language;
    $programFile = fopen($filePath, "w");
    fwrite($programFile, $code);
    fclose($programFile);

    // if($language == "python") {
    //     $output = shell_exec("C:\Users\KishlayBhardwaj\AppData\Local\Programs\Python\Python39\python.exe $filePath 2>&1");
    //     echo $output;
    // }
    // if($language == "java") {
    //     $outputExe = $random . ".exe";
    //     shell_exec("gcc $filePath -o $outputExe");
    //     $output = shell_exec(__DIR__ . "//$outputExe");
    //     echo $output;
    // }
    ?>