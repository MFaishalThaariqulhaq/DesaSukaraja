// Initialize Chart.js charts with data from JSON script tag
document.addEventListener('DOMContentLoaded', () => {
  // Chart.js should already be loaded from @push('scripts')
  // Wait a moment to ensure it's available, then initialize
  setTimeout(() => {
    if (typeof Chart !== 'undefined') {
      initCharts();
    } else {
      console.warn('Chart.js library not found');
    }
  }, 50);

  function initCharts() {
    // Get data from JSON script tag
    const dataScript = document.getElementById('infografis-data');
    if (!dataScript) {
      console.warn('Infografis data script tag not found');
      return;
    }

    let data;
    try {
      data = JSON.parse(dataScript.textContent);
    } catch (e) {
      console.error('Failed to parse infografis data:', e);
      return;
    }

    // Common chart configuration
    const fontConfig = { family: "'Inter', 'system-ui', '-apple-system', 'sans-serif'", size: 12, weight: 500 };
    const tooltipConfig = {
      backgroundColor: 'rgba(15, 23, 42, 0.9)',
      padding: 12,
      cornerRadius: 8,
      titleFont: { family: fontConfig.family, size: 13, weight: 600 },
      bodyFont: { family: fontConfig.family, size: 12 },
      displayColors: true,
      borderWidth: 1,
      borderColor: 'rgba(255, 255, 255, 0.1)'
    };

    const commonOptions = {
      responsive: true,
      maintainAspectRatio: false,
      plugins: {
        legend: {
          position: 'bottom',
          labels: { usePointStyle: true, padding: 20, font: fontConfig, color: '#64748b' }
        },
        tooltip: tooltipConfig
      },
      animation: { duration: 1500, easing: 'easeOutQuart' }
    };

    // Age Chart
    const ageChartCtx = document.getElementById('ageChart')?.getContext('2d');
    if (ageChartCtx) {
      new Chart(ageChartCtx, {
        type: 'bar',
        data: {
          labels: ['0-5', '6-11', '12-17', '18-59', '60+'],
          datasets: [
            {
              label: 'Laki-laki',
              data: data.age.male,
              backgroundColor: '#3b82f6',
              borderRadius: 6,
              barPercentage: 0.7
            },
            {
              label: 'Perempuan',
              data: data.age.female,
              backgroundColor: '#ec4899',
              borderRadius: 6,
              barPercentage: 0.7
            }
          ]
        },
        options: {
          ...commonOptions,
          scales: {
            y: {
              beginAtZero: true,
              grid: { color: 'rgba(226, 232, 240, 0.5)', drawBorder: false },
              ticks: { padding: 10, font: fontConfig, color: '#94a3b8' }
            },
            x: {
              grid: { display: false },
              ticks: { font: fontConfig, color: '#94a3b8' }
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
          labels: ['SD', 'SMP', 'SMA', 'Diploma/Sarjana', 'Belum Sekolah'],
          datasets: [{
            data: data.education,
            backgroundColor: ['#10b981', '#3b82f6', '#f59e0b', '#8b5cf6', '#94a3b8'],
            borderColor: '#ffffff',
            borderWidth: 3,
            hoverOffset: 15
          }]
        },
        options: {
          ...commonOptions,
          cutout: '75%'
        }
      });
    }

    // Job Chart
    const jobChartCtx = document.getElementById('jobChart')?.getContext('2d');
    if (jobChartCtx) {
      new Chart(jobChartCtx, {
        type: 'bar',
        data: {
          labels: ['Petani', 'Wiraswasta', 'Karyawan Swasta', 'PNS/TNI/Polri', 'IRT', 'Lainnya'],
          datasets: [{
            label: 'Jumlah Penduduk',
            data: data.job,
            backgroundColor: '#10b981',
            borderRadius: 6,
            barThickness: 'flex',
            maxBarThickness: 25
          }]
        },
        options: {
          ...commonOptions,
          indexAxis: 'y',
          scales: {
            x: {
              beginAtZero: true,
              grid: { color: 'rgba(226, 232, 240, 0.5)', drawBorder: false },
              ticks: { padding: 10, font: fontConfig, color: '#94a3b8' }
            },
            y: {
              grid: { display: false },
              ticks: { font: fontConfig, color: '#94a3b8' }
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
            backgroundColor: ['#059669', '#3b82f6', '#ef4444', '#f59e0b', '#6366f1'],
            borderColor: '#ffffff',
            borderWidth: 3,
            hoverOffset: 15
          }]
        },
        options: commonOptions
      });
    }
  }
});
