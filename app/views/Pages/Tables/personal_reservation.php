<?php
$filter_date = date('Y-m-d');
$email = $_SESSION['user_email'];

$personal_reservations = array_filter($data['bookings'], function ($item) use ($email, $filter_date) {
    // Assuming $item->reservation_date contains the reservation date
    $reservation_date = date('Y-m-d', strtotime($item->date));

    return $item->email === $email && $reservation_date >= $filter_date;
});

?>

<!DOCTYPE html>
<html lang="en">

<head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta name="viewport" content="width = device-width, initial-scale=1.0">
      <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/dailyReservation_Table_Style.css">
      <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/popup_reservation.css">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css">
      <title>Personal_Reservations</title>
</head>

<body>
      <div class="recentOrders">
            <div class="cardHeader">
                  <!-- date -->
                  <h2>
                        Upcoming Reservations
                  </h2>
                  <!-- veiw all button -->
                  <a href="#" class="btn">View All</a>
            </div>

            <div class="table-container">
                  <table>
                        <!-- table header -->
                        <thead>
                              <tr>
                                    <td>Date</td>
                                    <td>Time Slot</td>
                                    <td>Net</td>
                                    <td>Status</td>
                              </tr>
                        </thead>

                        <!-- table body -->
                        <tbody>
                              <?php
                              foreach ($personal_reservations as $reservation) {
                                    ?>
                                    <tr onclick="openPopup(<?php echo htmlspecialchars(json_encode($reservation)); ?>)">
                                          <td>
                                                <?php echo $reservation->date; ?>
                                          </td>
                                          <td>
                                                <?php echo $reservation->timeSlot; ?>
                                          </td>
                                          <td>
                                                <?php echo $reservation->netType; ?>
                                          </td>
                                          <td><span class="status paid">Pending</span></td>
                                    </tr>
                                    <?php
                              }
                              ?>

                        </tbody>
                  </table>
            </div>
      </div>

      <!-- Popup message -->
      <div class="popupcontainer" id="popupcontainer">
            <div class="popup" id="popup">
                  <span class="close" onclick="closePopup()"><i class="fa-solid fa-xmark"></i></span>
                  <h2>Reservation</h2>
                  <hr>
                  <div class="popupdetails">
                        <div class="popupdetail">
                              <h2><b>Reservation ID :</b> <span class="r_id"></span></h2>
                        </div>

                        <div class="popupdetail">
                              <h2><b>Customer Name :</b> <span class="r_name"></span></h2>
                        </div>

                        <div class="popupdetail">
                              <h2><b>Reservation Date :</b> <span class="r_date"></span></h2>
                        </div>

                        <div class="popupdetail">
                              <h2><b>Reservation Time :</b> <span class="r_timeSlot"></span></h2>
                        </div>

                        <div class="popupdetail">
                              <h2><b>Net :</b> <span class="r_net"></span></h2>
                        </div>

                        <div class="popupdetail">
                              <h2><b>Status :</b> <span class="r_payment">Pending</span></h2>
                        </div>
                  </div>

                  <div class="btns">
                        <button type="button" onclick="openReschedulePopup()">Reschedule</button>
                        <button type="button">Cancel</button>
                  </div>
            </div>
      </div>

      <!-- Popup message for rescheduling -->
      <div class="popupcontainer" id="reschedulePopupContainer" style="display: none;">
            <div class="popup" id="reschedulePopup">
                  <span class="close" onclick="closeReschedulePopup()"><i class="fa-solid fa-xmark"></i></span>
                  <h2>Reschedule Reservation</h2>
                  <hr>
                  <div class="rescheduleDetails">
                        <h4>Are You Sure You Want To Reschedule?</h4>
                        <h4 class="day">Time For Reservation - <span class="r_timeSlot_r"
                                    style="font-weight:bold"></span></h4>
                  </div>

                  <div class="btns">
                        <button type="button" class="yesButton" onclick="confirmReschedule()">Yes</button>
                        <button type="button" class="noButton" onclick="closeReschedulePopup()">No</button>
                  </div>
            </div>
      </div>

      <!-- JavaScript -->
      <script src="<?php echo URLROOT; ?>/js/personalPopup.js"></script>
</body>

</html>