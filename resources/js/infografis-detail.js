// Initialize Chart.js charts with data from JSON script tag
document.addEventListener('DOMContentLoaded', () => {
  // Wait for Chart.js to be loaded
  const waitForChart = setInterval(() => {
    if (typeof Chart !== 'undefined') {
      clearInterval(waitForChart);
      initCharts();
    }
  }, 100);

  function initCharts() {
    // Get data from JSON script tag
    const dataScript = document.getElementById('infografis-data');
    if (!dataScript) return;

    const data = JSON.parse(dataScript.textContent);

    // Age Chart
    const ageChartCtx = document.getElementById('ageChart')?.getContext('2d');
    if (ageChartCtx) {
      new Chart(ageChartCtx, {
        type: 'bar',
        data: {
          labels: ['Balita (0-5)', 'Anak (6-11)', 'Remaja (12-17)', 'Dewasa (18-59)', 'Lansia (60+)'],
          datasets: [
            {
              label: 'Laki-laki',
              data: data.age.male,
              backgroundColor: '#3b82f6',
              borderRadius: 6,
            },
            {
              label: 'Perempuan',
              data: data.age.female,
              backgroundColor: '#ec4899',
              borderRadius: 6,
            }
          ]
        },
        options: {
          responsive: true,
          maintainAspectRatio: false,
          plugins: {
            legend: {
              position: 'bottom',
              labels: { padding: 15, font: { size: 12, weight: 600 } }
            }
          },
          scales: {
            y: {
              beginAtZero: true,
              grid: { color: '#e2e8f0' }
            }
          }
        }
      });
    }

    // Education Chart
    const eduChartCtx = document.getElementById('educationChart')?.getContext('2d');
    if (eduChartCtx) {
      new Chart(eduChartCtx, {
        type: 'doughnut',
        data: {
          labels: ['SD', 'SMP', 'SMA/K', 'Diploma/Sarjana', 'Belum Sekolah'],
          datasets: [{
            data: data.education,
            backgroundColor: ['#10b981', '#3b82f6', '#f59e0b', '#8b5cf6', '#ec4899'],
            borderColor: '#ffffff',
            borderWidth: 2
          }]
        },
        options: {
          responsive: true,
          maintainAspectRatio: false,
          plugins: {
            legend: {
              position: 'bottom',
              labels: { padding: 15, font: { size: 12, weight: 600 } }
            }
          }
        }
      });
    }

    // Job Chart
    const jobChartCtx = document.getElementById('jobChart')?.getContext('2d');
    if (jobChartCtx) {
      new Chart(jobChartCtx, {
        type: 'bar',
        data: {
          labels: ['Petani', 'Wiraswasta', 'Karyawan Swasta', 'PNS/TNI/Polri', 'Ibu Rumah Tangga', 'Belum Bekerja'],
          datasets: [{
            label: 'Jumlah Penduduk',
            data: data.job,
            backgroundColor: '#10b981',
            borderRadius: 6
          }]
        },
        options: {
          responsive: true,
          maintainAspectRatio: false,
          indexAxis: 'y',
          plugins: {
            legend: {
              display: false
            }
          },
          scales: {
            x: {
              beginAtZero: true,
              grid: { color: '#e2e8f0' }
            }
          }
        }
      });
    }

    // Religion Chart
    const religionChartCtx = document.getElementById('religionChart')?.getContext('2d');
    if (religionChartCtx) {
      new Chart(religionChartCtx, {
        type: 'pie',
        data: {
          labels: ['Islam', 'Kristen', 'Katolik', 'Hindu', 'Buddha'],
          datasets: [{
            data: data.religion,
            backgroundColor: ['#10b981', '#3b82f6', '#f59e0b', '#8b5cf6', '#ec4899'],
            borderColor: '#ffffff',
            borderWidth: 2
          }]
        },
        options: {
          responsive: true,
          maintainAspectRatio: false,
          plugins: {
            legend: {
              position: 'bottom',
              labels: { padding: 15, font: { size: 12, weight: 600 } }
            }
          }
        }
      });
    }
  }
});
