<?php

include("simple_html_dom.php");

if (isset($_POST['sendData'])) {
        //base url
        $base = $_POST['prod_url'];

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($curl, CURLOPT_URL, $base);
        curl_setopt($curl, CURLOPT_REFERER, $base);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $str = curl_exec($curl);
        curl_close($curl);

        // Create a DOM object
        $html_base = new simple_html_dom();

        // Load HTML from a string
        $html_base->load($str);

        //Product Name 

        foreach ($html_base->find('h1[class=product--title]') as $element3) {
                $original_text = $element3->plaintext;


                echo "<b>Product Name : </b>" . $original_text . "<br>";
        }
        //Price 

        $count = 0;

        foreach ($html_base->find('tr[class=block-prices--row is--primary]') as $element3) {
                foreach ($html_base->find('td[class=block-prices--cell]') as $element4) {
                        $count++;
                        if($count == 2){
                                $exp = explode("*", $element4->plaintext);
                                echo "<b>Price : </b>" . $exp[0] . "<br>";
                        }
                }
        }

        $i = 1;
        //Images URL 

        foreach ($html_base->find('span[class=image--media]') as $element3) {

                foreach ($element3->find('img') as $element4) {
                       
                        
                        if ($i == 1) {
                                echo "<b>Image URL " . $i . " : </b>" .  $element4->src . "<br>";
                                $i = $i+1;
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
