<?php
    $language = strtolower($_POST['language']);
    $code = $_POST['code'];
    $random = substr(md5(mt_rand()), 0, 7);
    $filePath = "temp/" . $random . "." . $language;
    

    if($language == "python") {
        $programFile = fopen($filePath, "w");
        fwrite($programFile, $code);
        fclose($programFile);
        $output = shell_exec("C:\Program Files\Python39\python.exe $filePath 2>&1");
        echo $output;
    }
    if($language == "java") {
        putenv("PATH=C:\Program Files\Java\jdk1.8.0_112\bin");
        $CC="javac";
        $out="java Main";
        $code=$_POST["code"];
        $input=$_POST["input"];
        $filename_code="Main.java";
        $filename_in="input.txt";
        $filename_error="error.txt";
        $runtime_file="runtime.txt";
        $executable="*.class";
        $command=$CC." ".$filename_code;	
        $command_error=$command." 2>".$filename_error;
	    $runtime_error_command=$out." 2>".$runtime_file;

        $outputExe = $random . ".exe";
        $file_code=fopen($filename_code,"w+");
	    fwrite($file_code,$code);
	    fclose($file_code);
	    $file_in=fopen($filename_in,"w+");
	    fwrite($file_in,$input);
	    fclose($file_in);
	    exec("cacls  $executable /g everyone:f"); 
	    exec("cacls  $filename_error /g everyone:f");
        shell_exec($command_error);
        $error=file_get_contents($filename_error);

        if(trim($error)=="")
        {
            if(trim($input)=="")
            {
                shell_exec($runtime_error_command);
                $runtime_error=file_get_contents($runtime_file);
                $output=shell_exec($out);
            }
            else
            {
                shell_exec($runtime_error_command);
                $runtime_error=file_get_contents($runtime_file);
                $out=$out." < ".$filename_in;
                $output=shell_exec($out);
            }
            echo "$output";
        }
        else if(!strpos($error,"error"))
        {
            echo "<pre>$error</pre>";
            if(trim($input)=="")
            {
                $output=shell_exec($out);
            }
            else
            {
                $out=$out." < ".$filename_in;
                $output=shell_exec($out);
            }
            echo "$output";
        }
        else
        {
            echo "<pre>$error</pre>";
        }
    }
