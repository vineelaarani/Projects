function loginUser() {
    const name = document.getElementById("username").value;
    localStorage.setItem("username", name);
    alert("Welcome, " + name + "!");
    window.location.href = "booking.html";
    return false;
  }
  
  window.addEventListener("DOMContentLoaded", () => {
    const form = document.getElementById("reservationForm");
    const list = document.getElementById("reservationList");
  
    if (form && list) {
      loadReservations();
  
      form.addEventListener("submit", function (e) {
        e.preventDefault();
        const user = localStorage.getItem("username");
        const flight = document.getElementById("flight").value;
  
        if (!user) {
          alert("Please login first!");
          window.location.href = "index.html";
          return;
        }
  
        const reservation = { name: user, flight };
        const reservations = JSON.parse(localStorage.getItem("reservations") || "[]");
        reservations.push(reservation);
        localStorage.setItem("reservations", JSON.stringify(reservations));
  
        form.reset();
        loadReservations();
        alert("Reservation saved!");
      });
  
      function loadReservations() {
        const user = localStorage.getItem("username");
        const data = JSON.parse(localStorage.getItem("reservations") || "[]");
        const userData = data.filter(r => r.name === user);
        list.innerHTML = "";
  
        if (userData.length === 0) {
          list.innerHTML = "<p>No bookings yet.</p>";
          return;
        }
  
        userData.forEach((r, i) => {
          list.innerHTML += `
            <div class="reservation">
              <strong>${i + 1}. ${r.name}</strong><br>
              Flight: ${r.flight}
            </div>
          `;
        });
      }
    }
  });
  