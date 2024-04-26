<?php

$filter_date = isset($_GET['fulldate']) ? urldecode($_GET['fulldate']) : 0;


$duration = 60;
$cleanup = 0;
$start = "07:00";
$end = "22:00";
function time_slot($duration, $cleanup, $start, $end)
{
    $start = new DateTime($start);
    $end = new DateTime($end);
    $interval = new DateInterval("PT" . $duration . "M");
    $cleanupInterval = new DateInterval("PT" . $cleanup . "M");
    $slots = array();

    for ($intStart = $start; $intStart < $end; $intStart->add($interval)) {
        $endPeriod = clone $intStart;
        // echo $endPeriod->format("H:iA");
        $endPeriod->add($interval);
        // echo $endPeriod->format("H:iA");

        if ($endPeriod > $end) {
            break;
        }

        $slots[] = $intStart->format("H:iA") . "-" . $endPeriod->format("H:iA");
    }

    return $slots;
}

?>

<?php
$new_array = array();
foreach ($data['availability'] as $availability) {
    if ($availability->email == $_SESSION['user_email'] && $availability->date == $filter_date) {
        $new_array_2[] = $availability->time_slot;
        $new_array = json_decode($new_array_2[0]);
    }

}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CoachCard</title>
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/availabletimes.css">

</head>

<body>
    <!-- Sidebar -->
    <?php
    $role = $_SESSION['user_role'];
    require APPROOT . '/views/Pages/Dashboard/header.php';
    require APPROOT . '/views/Components/Side Bars/sideBar.php';
    ?>

    <!-- Content -->
    <section class="home">
        <div class="timeSlots">
            <div class="slot">
                <div class="form-group">
                    <select name="language" class="custom-select" multiple>
                        <?php
                        $timeslots = time_slot($duration, $cleanup, $start, $end);
                        foreach ($timeslots as $ts) {
                            ?>
                            <?php
                            $found = false;
                            for ($i = 0; $i < count($new_array); $i++) {
                                if ($new_array[$i] == $ts) {
                                    $found = true;
                                    break;
                                }
                            }
                            if ($found) { ?>
                                <option value="<?php echo $ts; ?>" date = "<?php echo $filter_date; ?>" data-booked="true">
                                    <?php echo $ts; ?>
                                </option>
                            <?php } else { ?>
                                <option value="<?php echo $ts; ?>" data-net-type="Normal Net A"
                                    data-date="<?php echo $filter_date; ?>">
                                    <?php echo $ts; ?>
                                </option>
                            <?php } ?>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div id="confirmationForm">
                <button type="submit" class="btn btn-primary" id="submit">Submit</button>
            </div>
        </div>

    </section>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="<?php echo URLROOT; ?>/js/coachBooking.js"></script>
    <script>
        $(document).ready(function () {
            $('#submit').click(function () {
                var selected = [];
                $('select option:selected').each(function () {
                    selected.push($(this).val());
                });
                var email = '<?= $_SESSION["user_email"] ?>';
                var date = '<?= $filter_date ?>';
                $.ajax({
                    type: 'POST',
                    url: "<?php echo URLROOT; ?>/Coach/saveAvailability",
                    data: {
                        selected: selected,
                        email: email,
                        date: date
                    },
                    success: function (response) {
                        console.log(response);
                        location.reload();
                    }
                });
            });
        });
    </script>

</body>

</html>