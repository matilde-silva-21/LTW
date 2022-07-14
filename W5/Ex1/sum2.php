<html> 
    <?php  
    @$number1=$_GET['number1'];   
    @$number2=$_GET['number2'];   
    $number3 = $number1 + $number2;     
    echo "Sum of $number1 and $number2 is ".$number3;  
    header("sum2.hmtl");
    ?>  
    
    <body>
    <br>
    <a href="sum2.html">
     Do another sum!
   </a>
    </body>
    
</html>
