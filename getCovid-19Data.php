<?php

// Dom parsing script from sourceforge.net
include ('simple_html_dom.php');
//Url of the website who's data to be scraped
$websiteUrl = "https://www.covid-19.pk/";

// Getting the raw html of the page given above
$html = file_get_html($websiteUrl);

// Array to store data of all Provinces
$all_provinces = array();

// Direct hit to the Table Body and all the Table rows in Table with ID example2
foreach ($html->find('table#example2 tbody tr') as $tr)
{
    // Every Table Row have 4 children 4 Table data tags

    $province = array();
    // Getting the data from Table row, from the table data tag
    // Using this loop to iterate through 4 of the Table Data tags
    foreach ($tr->find('td') as $key => $td)
    {
        switch ($key)
        {
            case 0: //Case 0 when the Loop runs for the first time for the current table row

                // Getting the province name from the Table Row, Table Data 1st child of Table Row
                $province['name'] = $td->plaintext; //Getting the plaintext from Table Data T
//                echo $td->plaintext;
                break;
            case 1: //Case 1 when the Loop runs for the second time for the current table row

                // Getting the Total Number of Cases in that Province(From this Row First Child) from the Table Row, Table Data 2nd child of Table Row
                $td = $td->innertext;
                $td = preg_replace('#<span class="badge badge-pill badge-warning">(.*?)</span>#','',$td); //removing the unnecessary span tag from anchor tag
                $td = preg_replace('#<span class="badge badge-pill badge-info">(.*?)</span>#','',$td); //removing the unnecessary span tag from anchor tag
                $province['total_cases'] = (int)strip_tags($td); //
//                echo strip_tags($td);
                break;
            case 2: //Case 2 when the Loop runs for the third time for the current table row

                // Getting the Total Number of Recovered Patients in that Province(From this Row First Child) from the Table Row, Table Data Third child of Table Row
                $td = $td->innertext;
                $td = preg_replace('#<span class="badge badge-pill badge-warning">(.*?)</span>#','',$td); //removing the unnecessary span tag from anchor tag
                $td = preg_replace('#<span class="badge badge-pill badge-info">(.*?)</span>#','',$td); //removing the unnecessary span tag from anchor tag
                $province['total_recovered'] = (int)strip_tags($td);
//                echo strip_tags($td);
                break;
            case 3: //Case 3 when the Loop runs for the fourth time(Last time) for the current table row

                // Getting the Total Number of Deaths in that Province(From this Row First Child) from the Table Row, Table Data Fourth child of Table Row
                $td = $td->innertext; //Getting the content of the HTML tags
                $td = preg_replace('#<span class="badge badge-pill badge-warning">(.*?)</span>#','',$td); //removing the unnecessary span tag from anchor tag
                $td = preg_replace('#<span class="badge badge-pill badge-info">(.*?)</span>#','',$td); //removing the unnecessary span tag from anchor tag
                $province['total_deaths'] = (int)strip_tags($td);
//                echo strip_tags($td);
                break;
        }
    }
    $all_provinces[] = $province;
//    echo "<br>";
}
// Checking the output of the data scraped
//echo "<pre>";
//var_dump($all_provinces);
return $all_provinces;
?>