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

        foreach($html_base->find('div[class=js-product-body]') as $element3){
                foreach($element3->find('h1[class=mb15]') as $element4){
                        echo "<b>Product Name : </b>" . $element4->plaintext . "<br>";
                }
        }

        foreach($html_base->find('div[class=priceboxes-parent-sticky]') as $element3){
                foreach($element3->find('b[class=js-update-price]') as $element4){
                        echo "<b>Price : </b>" . $element4->plaintext . "<br>";
                }
        }

        $i = 1;

        foreach($html_base->find('div[class=js-product-body]') as $element3){
                foreach($element3->find('div[class=carousel]') as $element4){
                        foreach($element4->find('img') as $element5){
                                echo "<b>Image URL " . $i . " : </b>" . $element5->src . "<br>";
                                $i = $i + 1;
                                if($i == 5){
                                        break;
                                }
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