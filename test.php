<?php
include '/dns/com/olympe-network/annoncegratuit/protected/database.php';
include '/dns/com/olympe-network/annoncegratuit/protected/functions/functions.php';
$reg_manager = new RegionDeptManager($bdd);
?>
<!DOCTYPE html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-15" />
    <title>Jannonce</title>
    <meta name="description" content="description here"/>
    <meta name="author" content="content here"/>
    <link rel="stylesheet" href="css/style.css" type="text/css"/>
    <script type="text/javascript" >
        function reload(form)
        {
            var val=form.region.options[form.region.options.selectedIndex].value; 
            self.location='test.php?reg_id=' + val ;
        }
        function reload3(form)
        {
            alert("reload3");
            var val=form.region.options[form.region.options.selectedIndex].value; 
            var val2=form.dept.options[form.dept.options.selectedIndex].value; 

            self.location='test.php?reg_id=' + val + '&dept_id=' + val2 ;
        }
     
    </script>
</head>
<body>
    <?php
    include '/dns/com/olympe-network/annoncegratuit/include/header.php';
    if (isset($_GET['reg_id'])) {
        $reg_id = $_GET['reg_id'];
        $depts = $reg_manager->getDepartements($reg_id);
    }
    ?>

    <!--start main content -->
    <div id="main" class="wrapper">

        <form id="myForm" action="test.php" method="post">
            <select id="region" name='region' onchange="reload(this.form);">
                <option value="-1">------Choissisez la region------</option>
                <?php
                $regions = $reg_manager->getRegions();
                foreach ($regions as $region) {
                    if ($region->getId_region() == $reg_id)
                        echo '<option selected="selected" value="' . $region->getId_region() . '">' . $region->getNom_region() . '</option>' . "\n";
                    else
                        echo '<option value="' . $region->getId_region() . '">' . $region->getNom_region() . '</option>' . "\n";
                }
                ?>
            </select>
            <?php
            echo '<select id = "dept" name = "dept" onchange="reload3(this.form)">';
            echo '<option value = "-1">------Choissisez le departement------</option>';

            foreach ($depts as $value) {
                echo '<option value="' . $value->getId_dept() . '">' . $value->getNom_dept() .
                        '&nbsp;(' . $value->getId_dept() . ')</option>';
            }
            echo '</select>';
            ?>

        </form> 
    </div>
    <!--end main content -->

    <!--start footer --> 
    <?php include 'include/footer.php';
    ?>

</body>
</html>

