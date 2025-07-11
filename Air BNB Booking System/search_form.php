<?php
include 'config.php';

$bookedDates = [];
$result = $conn->query("SELECT checkin, checkout FROM bookings");
if ($result && $result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $bookedDates = [];
    $result = $conn->query("
      SELECT bookings.checkin, bookings.checkout, condos.city
      FROM bookings
      JOIN condos ON bookings.condo_id = condos.id
      WHERE bookings.status = 'confirmed'
    ");

    if ($result && $result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        $bookedDates[] = [
          'start' => $row['checkin'],
          'end' => $row['checkout'],
          'city' => $row['city']
        ];
      }
    }
  }
}
?>

<link rel="stylesheet" href="CSS/search_form.css">
<link rel="stylesheet" href="CSS/modal_global.css">

<div class="search-container">
  <form action="find_condo.php" method="get">
    <div class="search-item where-container custom-dropdown">
      <div class="dropdown-input" id="customWhereTo">Where To?</div>
      <div class="dropdown-list" id="cityDropdown">
        <?php
        $cities = ["Tagaytay", "Cavite City", "Dasmariñas", "Bacoor", "Imus", "Alfonso", "General Trias", "Silang", "Tanza", "Trece Martires"];
        foreach ($cities as $city) {
          echo "<div class='dropdown-item'>{$city}</div>";
        }
        ?>
      </div>
    </div>
    <input type="hidden" name="city" id="selectedCity">

    <div class="search-item checkin-container floating-label-container">
      <input type="datetime-local" id="checkin" name="checkin" class="floating-input" required />
      <label for="checkin">Check-in</label>
    </div>

    <div class="search-item checkout-container floating-label-container">
      <input type="datetime-local" id="checkout" name="checkout" class="floating-input" required />
      <label for="checkout">Check-out</label>
    </div>

    <div class="search-item noguest-container">
      <input type="text" name="guest_count" class="nguest" placeholder="No. of Guest">
    </div>

    <div class="search-item search-button">
      <button class="searchbtn" type="submit">SEARCH</button>
    </div>
  </form>
</div>

<div id="bookingModal" class="modal-overlay">
  <div class="modal-box" id="modalBox">
    <button class="close-btn" id="closeModalBtn">&times;</button>
    <span id="modalMessage">Placeholder message</span>
  </div>
</div>

<script>
  const bookedRanges = <?= json_encode($bookedDates); ?>;
  function showModal(message, type = '') {
    const modal = document.getElementById('bookingModal');
    const modalMsg = document.getElementById('modalMessage');
    const modalBox = document.getElementById('modalBox');
    modalMsg.textContent = message;
    modalBox.className = 'modal-box ' + (type ? type : '');
    modal.classList.add('show');
    setTimeout(() => {
      modal.classList.remove('show');
    }, 3000);
  }
  document.getElementById('closeModalBtn').onclick = function() {
    document.getElementById('bookingModal').classList.remove('show');
  };
</script>

<script src="JS/search_form.js"></script>