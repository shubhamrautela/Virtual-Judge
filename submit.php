<!-- This file takes the code input from the user and processes it by saving, compiling and running the code. At the time it can only
     process java code but soon other languages will be supported as well. Right now it is unable to work against infinite loops! 
-->

<html>
<head>
<title>your code is successfully submitted</title>
</head>
<?php 
    // function to delete the files created during the process
    function delfiles($files){
        foreach($files as $file)
            shell_exec("del $file");
    }
    
    //variables for input from/ output to user
    $error="";
    $runtime_error="";
    $output="";
    //list of files to be deleted
    $files=array("error.txt","runtime.txt","output.txt","A.java","A.class");
    
    $code=$_POST['code'];
    $lang=$_POST['language'];
    
    echo "code submitted successfully...";
    
    
    // write the code into the file with .java extension
    $fp=fopen("A.java","w");
    fwrite($fp,$code);
    fclose($fp);
    
    // compile the program from shell and redirect the compilation errors to a file, if any
    shell_exec("javac A.java 2>$files[0]");
    
    $fp=fopen($files[0],"r");
    $error=nl2br(fread($fp,filesize($files[0])));
    fclose($fp);
    
    // if there is no compilation error then run the program from shell and redirect runtime errors to a file, if any
	//print "$error";
    if(empty($error)){
        shell_exec("java A  >$files[2] 2>$files[1]");
        $fp=fopen($files[1],"r");
        $runtime_error=nl2br(fread($fp,filesize($files[1])));
        fclose($fp);
        
        // if there are no runtime errors then print the output on the webpage
        if(empty($runtime_error)){
            $fp=fopen("$files[2]","r");
            
            // using nl2br to convert linefeeds to <br> to format properly
            $output=nl2br(fread($fp,filesize($files[2])));
            echo "<br><br>program ran successfully <br> output: <br><hr> $output";
            fclose($fp);
            
            
        }
        // else print the runtime error
        else 
            echo "<br><br>Runtime Exception!<br><hr>$runtime_error";
    }
    else // else print the compilation error
        echo"<br><br>Compilation Error!<br><hr>$error";
    
    delfiles($files);
?>
</html>
