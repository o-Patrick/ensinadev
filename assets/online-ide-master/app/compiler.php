<?php
    $language = strtolower($_POST['language']);
    $code = $_POST['code'];
    // var_dump(explode(" ", $code));
    // exit;

    if ($language !== "html") {
        $random = substr(md5(mt_rand()), 0, 7);
        $filePath = "temp/" . $random . "." . $language;
        $programFile = fopen($filePath, "w");
        fwrite($programFile, $code);
        fclose($programFile);
    }

    if($language == "html") {
        // $output = [];
        // $output = ;
        // print_r(explode("\n", $code));
        echo eval("<p>teste</p>");
    }
    if($language == "php") {
        $output = shell_exec("C:\wamp64\bin\php\php5.6.40\php.exe $filePath 2>&1");
        echo $output;
    }
    if($language == "node") {
        rename($filePath, $filePath.".js");
        $output = shell_exec("node $filePath.js 2>&1");
        echo $output;
    }