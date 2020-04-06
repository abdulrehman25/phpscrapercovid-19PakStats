<h1>Data Scraped from Covid-19.pk</h1>
<?php
$all_provinces = include ('getCovid-19Data.php');
?>
<div style="width: 100%;text-align: center;">
    <div style="width: 100%;display: inline">
        <table border="2px" style="width: 100%;border-collapse: collapse; text-align: center" >
            <thead>
            <th>State/Province</th>
            <th>Total Cases</th>
            <th>Total Recovered</th>
            <th>Total Deaths</th>
            </thead>
            <tbody>
            <?php
            foreach ($all_provinces as $prov)
            {

                ?>
                <tr>
                    <td><?= $prov['name'];?></td>
                    <td><?= $prov['total_cases'];?></td>
                    <td><?= $prov['total_recovered'];?></td>
                    <td><?= $prov['total_deaths'];?></td>
                </tr>
                <?php
            }
            ?>
            </tbody>
        </table>
    </div>
<!--    <div style="width: 50%;display: inline">-->
<!--        <iframe src="https://www.covid-19.pk/" frameborder="0"></iframe>-->
<!--    </div>-->
</div>
