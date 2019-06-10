<?php

include("simple_html_dom.php");

if(isset($_POST['sendData'])){
        //base url
        $base = $_POST['prod_url'];

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($curl, CURLOPT_URL, $base);
        curl_setopt($curl, CURLOPT_REFERER, $base);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
        $str = curl_exec($curl);
        curl_close($curl);

        // Create a DOM object
        $html_base = new simple_html_dom();

        // Load HTML from a string
        $html_base->load($str);

//Product Name 

        foreach($html_base->find('div[class=titlewrap]') as $element3){
                foreach($element3->find('h1[class=title]') as $element4){
                        echo "<b>Product Name : </b>" . $element4->plaintext . "<br>";
                }
        }
//Price 

        foreach($html_base->find('div[class=wrap-price article-price]') as $element3){
                foreach($element3->find('div[id=cphMain_cphColumnOne_ArticleDetails_panPrice]') as $element4){
                       
                        $discount = 0;
                       
                        foreach($element4->find('div') as $element5){        
                                $discount = $discount+1;
                        }   
                        
                        if($discount  == 1)
                                {
                                
                                echo "<b>Price : </b>" . $element4->plaintext . "<br>";   
                                   
                                }
                        else
                                {       
                                $counter = 0;
                                foreach($element4->find('div') as $element5){        
                                        if($counter == 2)
                                                {
                                                echo "<b>Price : </b>" . $element5->plaintext . "<br>";
                                                }
                                        $counter = $counter+1;

                                        }   
                                
                                
                                }

                            
                }
        }

        $i = 1;
//Images URL 
 
        foreach($html_base->find('div[class=detail-image]') as $element3){
                
                        foreach($element3->find('a') as $element4){
                                echo "<b>Image URL " . $i . " : </b>" . $element4->href . "<br>";
                                $i = $i + 1;
                                if($i == 5){
                                        break;
                                }
                        }
                
        }
}

?>

<html>
        <head>
                <title>
                        HQ
                </title>
        </head>
        <body>
                <br><br><br>
                <div align="center">
                        <form action="" method="POST">
                                <input type="text" name="prod_url" placeholder="Enter URL" required>
                                <button name="sendData" type="submit">Fetch Data</button>
                        </form>
                </div>
        </body>
</html>
