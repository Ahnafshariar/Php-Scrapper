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

        foreach($html_base->find('span[itemprop=name]') as $element3){   
                $original_text = $element3->plaintext;
                
                $new_text = explode("(",$original_text);            
                        echo "<b>Product Name : </b>" . $new_text[0] . "<br>";               
        }
//Price 

        foreach($html_base->find('div[class=product-info-preis]') as $element3){
               echo "<b>Price : </b>" . $element3->plaintext . "<br>";
        }

        $i = 1;
//Images URL 
 
        foreach($html_base->find('div[class=product-info-bild]') as $element3){
                
                        foreach($element3->find('img') as $element4){
                                echo "<b>Image URL " . $i . " : </b>" .  "https://www.tintenalarm.de/" . $element4->src . "<br>";
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
