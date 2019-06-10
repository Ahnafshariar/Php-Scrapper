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

    /* /Date 

    foreach ($html_base->find('tr[class=tb-scroll]') as $element3) {
                           
         echo "<b>Product Name : </b>" . $element3->plaintext . "<br>";    
        
    }
    */
    
    //Price 

    $count = 0;

    
    foreach ($html_base->find('td[class=nw]') as $element4) {
        echo "<b>Weekday : </b>" . $element4->plaintext . "<br>";
        
        
    
    }

    foreach ($html_base->find('th[class=nw]') as $element5) {
        
        echo "<b>Date : </b>" . $element5->plaintext . "<br>";
    
    }
    
    foreach ($html_base->find('td') as $element3) {
        
        echo "<b>Holiday type : </b>" . $element3->plaintext . "<br>";
    
    }

    $i = 1;
    /*/Images URL 

    foreach ($html_base->find('div[class=article-image]') as $element3) {

        foreach ($element3->find('img') as $element4) {
            echo "<b>Image URL " . $i . " : </b>" . $element4->src . "<br>";
            $i = $i + 1;
            if ($i == 5) {
                break;
            }
        }

    } */
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