/* =========================================================
   UD-cipher Admin Dashboard — script.js
   ========================================================= */

document.addEventListener('DOMContentLoaded', function () {

  // ============================================================
  // 1. SIDEBAR TOGGLE (Minimize / Expand)
  // ============================================================
  const sidebar = document.getElementById('sidebar');
  const sidebarToggle = document.getElementById('sidebarToggle');

  sidebarToggle.addEventListener('click', function () {
    sidebar.classList.toggle('collapsed');
  });


  // ============================================================
  // 2. NAV ITEM ACTIVE STATE
  // ============================================================
  const navItems = document.querySelectorAll('.nav-item');

  navItems.forEach(function (item) {
    item.addEventListener('click', function (e) {
      e.preventDefault();
      navItems.forEach(function (n) { n.classList.remove('active'); });
      this.classList.add('active');
    });
  });


  // ============================================================
  // 3. OVERVIEW LIKES CHART
  // ============================================================
  const ctx = document.getElementById('overviewChart').getContext('2d');

  const labels = ['Jan', 'Feb', 'Mar', 'Apr', 'May'];

  // Data matching the screenshot as closely as possible
  const dataBlack      = [0,   13,  38,  30,  32];   // black line
  const dataPurple     = [19,  30,  25,  40,  42];   // purple line
  const dataGold       = [12,   5,  20,  15,  50];   // gold / orange line (Best Impression)

  const overviewChart = new Chart(ctx, {
    type: 'line',
    data: {
      labels: labels,
      datasets: [
        {
          label: 'Trend',
          data: dataBlack,
          borderColor: '#2d2d2d',
          backgroundColor: 'transparent',
          borderWidth: 2.2,
          pointBackgroundColor: '#2d2d2d',
          pointBorderColor: '#2d2d2d',
          pointRadius: 5,
          pointHoverRadius: 7,
          tension: 0.4,
          fill: false,
        },
        {
          label: 'Engagement',
          data: dataPurple,
          borderColor: '#9b8ec4',
          backgroundColor: 'transparent',
          borderWidth: 2.2,
          pointBackgroundColor: '#9b8ec4',
          pointBorderColor: '#9b8ec4',
          pointRadius: 5,
          pointHoverRadius: 7,
          tension: 0.4,
          fill: false,
        },
        {
          label: 'Best Impression',
          data: dataGold,
          borderColor: '#d4872a',
          backgroundColor: 'transparent',
          borderWidth: 2.2,
          pointBackgroundColor: '#d4872a',
          pointBorderColor: '#d4872a',
          pointRadius: 5,
          pointHoverRadius: 7,
          tension: 0.4,
          fill: false,
        },
      ]
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      interaction: {
        mode: 'index',
        intersect: false,
      },
      plugins: {
        legend: {
          display: false,   // we have a custom legend in HTML
        },
        tooltip: {
          backgroundColor: 'rgba(20,40,25,0.88)',
          titleColor: '#fff',
          bodyColor: 'rgba(255,255,255,0.75)',
          borderColor: 'rgba(255,255,255,0.1)',
          borderWidth: 1,
          padding: 10,
          cornerRadius: 8,
        },
      },
      scales: {
        x: {
          grid: {
            color: 'rgba(0,0,0,0.05)',
            drawBorder: false,
          },
          ticks: {
            font: { size: 12, family: "'Segoe UI', sans-serif" },
            color: '#999',
          },
          border: { display: false },
        },
        y: {
          min: 0,
          max: 55,
          grid: {
            color: 'rgba(0,0,0,0.05)',
            drawBorder: false,
          },
          ticks: {
            stepSize: 10,
            font: { size: 12, family: "'Segoe UI', sans-serif" },
            color: '#999',
          },
          border: { display: false },
        },
      },
    },
  });


  // ============================================================
  // 4. SORT BY — update chart on change (optional enhancement)
  // ============================================================
  const sortSelect = document.querySelector('.sort-select');
  if (sortSelect) {
    sortSelect.addEventListener('change', function () {
      const val = this.value;

      // Simulate different data per period
      const dataMap = {
        Month: {
          black:  [0,  13, 38, 30, 32],
          purple: [19, 30, 25, 40, 42],
          gold:   [12,  5, 20, 15, 50],
          labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May'],
        },
        Week: {
          black:  [5, 12, 20, 18, 28, 22, 30],
          purple: [8, 18, 22, 30, 25, 35, 40],
          gold:   [3,  7, 15, 12, 25, 20, 45],
          labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
        },
        Year: {
          black:  [10, 18, 25, 30, 35, 28, 32, 38, 42, 36, 30, 28],
          purple: [12, 20, 28, 35, 30, 25, 40, 42, 38, 44, 40, 45],
          gold:   [5,  10, 18, 22, 28, 20, 15, 30, 35, 40, 45, 50],
          labels: ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'],
        },
      };

      const chosen = dataMap[val] || dataMap['Month'];

      overviewChart.data.labels              = chosen.labels;
      overviewChart.data.datasets[0].data   = chosen.black;
      overviewChart.data.datasets[1].data   = chosen.purple;
      overviewChart.data.datasets[2].data   = chosen.gold;
      overviewChart.update('active');
    });
  }

});